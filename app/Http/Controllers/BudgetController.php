<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Cashflow;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BudgetController extends Controller
{
    public function indexBudget(Request $req){

        $selectedMonth = $req->input('month', date('m'));
        $selectedYear = $req->input('year', date('Y'));

        //find current month and year
        $months = Budget::selectRaw('MONTH(month) as month')->distinct()->pluck('month');
        $years = Budget::selectRaw('YEAR(month) as year')->distinct()->pluck('year');

        //find this month transaction and budget
        $budgets = Budget::where('user_id', Auth::user()->id)->whereMonth('month', $selectedMonth)->whereYear('month', $selectedYear)->get();
        $transactions = Transaction::where('user_id', Auth::user()->id)->whereMonth('date', $selectedMonth)->whereYear('date', $selectedYear)->get();

        //find transaction and budget sum
        $transactionSum = $transactions->where('cashflow_id', 'CF0001')->sum('amount');
        $budgetSum = $budgets->sum('amount');

        return view('/budget/indexBudget', compact(['budgets', 'transactionSum', 'budgetSum', 'months', 'years', 'selectedMonth', 'selectedYear']));
    }

    public function addBudgetPage(){
        $categories = Category::all();
        return view('/budget/addBudget', compact('categories'));
    }

    public function editBudgetPage($id){
        $budget = Budget::find($id);
        $categories = Category::all();
        return view('/budget/editBudget', compact(['budget', 'categories']));
    }

    public function addBudget(Request $req){
        $rules = [
            'name' => 'required|max:20',
            'amount' => 'required|numeric',
            'month' => 'required',
            'year' => 'required'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $customID = Budget::generateID();

        $date = $req->year . '-' . str_pad($req->month, 2, '0', STR_PAD_LEFT) . '-01';

        Budget::create([
            'id' => $customID,
            'name' => $req->name,
            'amount' => $req->amount,
            'month' => $date,
            'category_id' => $req->category,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/indexBudget');
    }

    public function editBudget(Request $req, $id){
        $rules = [
            'name' => 'required|max:20',
            'amount' => 'required|numeric',
            'month' => 'required',
            'year' => 'required'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $budget = Budget::find($id);

        $date = $req->year . '-' . str_pad($req->month, 2, '0', STR_PAD_LEFT) . '-01';

        $budget->month = $date;
        $budget->name = $req->name;
        $budget->amount = $req->amount;
        $budget->category_id = $req->category;

        $budget->save();

        return redirect('/indexBudget');
    }

    public function deleteBudget($id){
        $budget = Budget::find($id);

        if(isset($budget)){
            $budget->delete();
        }

        return redirect()->back();
    }
}
