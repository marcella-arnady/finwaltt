<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userwallet;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserwalletController extends Controller
{
    public function indexUserwallet(){
        $userwallets = Userwallet::where('user_id', Auth::user()->id)->with('wallet')->get();
        $count = count($userwallets);
        $sum = $userwallets->sum('amount');
        return view('/userwallet/indexUserwallet', compact(['userwallets', 'sum', 'count']));
    }

    public function addUserwalletPage(){
        $userWalletsIds = Auth::user()->wallets->pluck('id')->toArray();
        $wallets = Wallet::whereNotIn('id', $userWalletsIds)->get();

        return view('/userwallet/addUserwallet', compact('wallets'));
    }

    public function editUserwalletPage($id){
        $userwallet = Userwallet::where('user_id', Auth::user()->id)->where('wallet_id', $id)->first();

        return view('/userwallet/editUserwallet', compact('userwallet'));
    }

    public function detailUserwalletPage($id){
        $userwallet = Userwallet::where('user_id', Auth::user()->id)->where('wallet_id', $id)->first();
        $transactions = Transaction::where('user_id', Auth::user()->id)->where('wallet_id', $id)->get();

        return view('/userwallet/detailUserwallet', compact(['userwallet', 'transactions']));
    }

    public function addUserwallet(Request $req){
        $rules = [
            'amount' => 'required|numeric'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        Userwallet::create([
            'user_id' => Auth::user()->id,
            'wallet_id' => $req->wallet,
            'amount' => $req->amount
        ]);

        return redirect('/indexUserwallet');
    }

    public function editUserwallet(Request $req, $id){
        $rules = [
            'amount' => 'required|numeric'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $userwallet = Userwallet::where('user_id', Auth::user()->id)->where('wallet_id', $id)->first();
        $userwallet->amount = $req->amount != null ? $req->amount : $userwallet->amount;
        $userwallet->save();

        return redirect('/indexUserwallet');
    }

    public function deleteUserwallet($id){
        $userwallet = Userwallet::where('user_id', Auth::user()->id)->where('wallet_id', $id)->first();

        if(isset($userwallet)){
            $userwallet->delete();
        }

        return redirect()->back();
    }
}
