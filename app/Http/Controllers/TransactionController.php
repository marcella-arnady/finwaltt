<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Cashflow;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Userwallet;
use App\Models\Budget;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function indexTransaction(Request $req){
        $selectedMonth = $req->input('month', date('m'));
        $selectedYear = $req->input('year', date('Y'));

        //find current month and year
        $months = Transaction::selectRaw('MONTH(date) as month')->distinct()->pluck('month');
        $years = Transaction::selectRaw('YEAR(date) as year')->distinct()->pluck('year');

        //find this month transaction and budget
        $transactions = Transaction::where('user_id', Auth::user()->id)->whereMonth('date', $selectedMonth)->whereYear('date', $selectedYear)->get();
        $budgets = Budget::where('user_id', Auth::user()->id)->whereMonth('month', $selectedMonth)->whereYear('month', $selectedYear)->get();

        //find transaction and budget sum
        $transactionSum = $transactions->where('cashflow_id', 'CF0001')->sum('amount');
        $budgetSum = $budgets->sum('amount');

        return view('/transaction/indexTransaction', compact('transactions', 'transactionSum', 'budgetSum', 'months', 'years', 'selectedMonth', 'selectedYear'));
    }

    public function addTransactionPage(){
        $categories = Category::all();
        $cashflows = Cashflow::all();
        $wallets = User::find(Auth::user()->id)->wallets;
        return view('/transaction/addTransaction', compact(['categories', 'cashflows', 'wallets']));
    }

    public function editTransactionPage($id){
        $tr = Transaction::find($id);
        $categories = Category::all();
        $cashflows = Cashflow::all();
        $wallets = User::find(Auth::user()->id)->wallets;
        return view('/transaction/editTransaction', compact(['tr', 'categories', 'cashflows', 'wallets']));
    }

    public function addTransaction(Request $req){
        $rules = [
            'name' => 'required|max:20',
            'amount' => 'required|numeric',
            'date' => 'required',
            'note'=> 'max:50'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $wallet = Userwallet::where('user_id', Auth::user()->id)->where('wallet_id', $req->wallet)->first();

        $customID = Transaction::generateID();

        Transaction::create([
            'id' => $customID,
            'name' => $req->name,
            'amount' => $req->amount,
            'date' => $req->date,
            'note' => $req->note,
            'category_id' => $req->category,
            'cashflow_id' => $req->cashflow,
            'user_id' => Auth::user()->id,
            'wallet_id' => $req->wallet
        ]);

        //if transaction is expense
        if ($req->cashflow == 'CF0001') {
            //the amount is subtracted
            $wallet->amount = $req->amount != null ? ($wallet->amount - $req->amount) : $wallet->amount;
        }else{
            //the amount is added
            $wallet->amount = $req->amount != null ? ($wallet->amount + $req->amount) : $wallet->amount;
        }

        $wallet->save();

        return redirect('/indexTransaction');
    }

    public function editTransaction(Request $req, $id){
        $rules = [
            'name' => 'required|max:20',
            'amount' => 'required|numeric',
            'date' => 'required',
            'note'=> 'max:50'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $tr = Transaction::find($id);

        $currWallet = Userwallet::where('user_id', Auth::user()->id)->where('wallet_id', $tr->wallet_id)->first();
        $newWallet = Userwallet::where('user_id', Auth::user()->id)->where('wallet_id', $req->wallet)->first();

        //if amount/wallet/cashflow is changed
        if ($req->amount != $tr->amount || $req->wallet != $tr->wallet_id || $tr->cashflow_id != $req->cashflow){
            //if cashflow is changed
            if ($tr->cashflow_id != $req->cashflow){
                //if the new cashflow is expense
                if ($req->cashflow == 'CF0001'){
                    //back to before income transaction
                    $currWallet->amount = $currWallet->amount - $tr->amount;
                    //if wallet is changed
                    if($tr->wallet_id != $req->wallet){
                        $newWallet->amount = $newWallet->amount - $req->amount;
                    }else{
                        $currWallet->amount = $currWallet->amount - $req->amount;
                    }
                }else{
                    //back to before expense transaction
                    $currWallet->amount = $currWallet->amount + $tr->amount;
                    //if wallet is changed
                    if($tr->wallet_id != $req->wallet){
                        $newWallet->amount = $newWallet->amount + $req->amount;
                    }else{
                        $currWallet->amount = $currWallet->amount + $req->amount;
                    }
                }
            }else{
                //if the cashflow is expense
                if ($tr->cashflow_id == 'CF0001') {
                    //back to before transaction
                    $currWallet->amount = $currWallet->amount + $tr->amount;
                    //if wallet is changed
                    if($tr->wallet_id != $req->wallet){
                        $newWallet->amount = $newWallet->amount - $req->amount;
                    }else{
                        $currWallet->amount = $currWallet->amount - $req->amount;
                    }
                }else{
                    //back to before transaction
                    $currWallet->amount = $currWallet->amount - $tr->amount;
                    // If the wallet is changed
                    if ($tr->wallet_id != $req->wallet) {
                        $newWallet->amount = $newWallet->amount + $req->amount;
                    } else {
                        $currWallet->amount = $currWallet->amount + $req->amount;
                    }
                }
            }
        }

        $tr->name = $req->name != null ? $req->name : $tr->name;
        $tr->amount = $req->amount != null ? $req->amount : $tr->amount;
        $tr->date = $req->date != null ? $req->date : $tr->date;
        $tr->note = $req->note != null ? $req->note : $tr->note;
        $tr->category_id = $req->category != null ? $req->category : $tr->category_id;
        $tr->cashflow_id = $req->cashflow != null ? $req->cashflow : $tr->cashflow_id;
        $tr->wallet_id = $req->wallet != null ? $req->wallet : $tr->wallet_id;

        $tr->save();
        $currWallet->save();
        $newWallet->save();

        return redirect('/indexTransaction');
    }

    public function deleteTransaction($id){
        $transaction = Transaction::find($id);

        $wallet = Userwallet::where('user_id', Auth::user()->id)->where('wallet_id', $transaction->wallet_id)->first();
        if($transaction->cashflow_id == 'CF0001'){
            $wallet->amount = $wallet->amount + $transaction->amount;
        }else{
            $wallet->amount = $wallet->amount - $transaction->amount;
        }

        if(isset($transaction)){
            $transaction->delete();
            $wallet->save();
        }

        return redirect()->back();
    }
}