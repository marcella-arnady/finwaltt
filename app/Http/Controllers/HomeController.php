<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Userwallet;
use App\Models\Budget;
use App\Models\Goal;
use App\Models\Category;
use App\Models\Cashflow;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if (Auth::check()) {
            if(Auth::user()->role == 'Admin'){
                return redirect('/admin');
            }else{
                $transactions = Transaction::where('user_id', Auth::user()->id)->whereMonth('date', date('m'))->whereYear('date', date('Y'))->get();

                //the sum after grouping the id
                $cashflowSums = $transactions->groupBy('cashflow_id')->map(function ($transactions) {
                    return $transactions->sum('amount');
                });

                $cashflowLabels = [];
                $cashflowData = [];

                foreach ($cashflowSums as $cashflowId => $totalAmount) {
                    $cashflow = Cashflow::find($cashflowId);

                    if ($cashflow) {
                        $cashflowLabels[] = $cashflow->name;
                        $cashflowData[] = $totalAmount;
                    }
                }

                $cashflow = [
                    'labels' => $cashflowLabels,
                    'data' => $cashflowData,
                ];

                //the sum after grouping the id
                $categorySums = $transactions->groupBy('category_id')->map(function ($group) {
                    return $group->sum('amount');
                });

                $categoryLabels = [];
                $categoryData = [];

                foreach ($categorySums as $categoryId => $totalAmount) {
                    $category = Category::find($categoryId);

                    if ($category) {
                        $categoryLabels[] = $category->name;
                        $categoryData[] = $totalAmount;
                    }
                }

                $category = [
                    'labels' => $categoryLabels,
                    'data' => $categoryData,
                ];

                $budgets = Budget::where('user_id', Auth::user()->id)->whereMonth('month', date('m'))->whereYear('month', date('Y'))->get();

                $transactionSum = $transactions->where('cashflow_id', 'CF0001')->sum('amount');
                $budgetSum = $budgets->sum('amount');

                $budget = [
                    'labels' => ['Transaction', 'Budget'],
                    'data' => [$transactionSum, $budgetSum],
                ];

                $name = Auth::user()->name;

                return view('home', compact(['budget', 'category', 'cashflow', 'name']));
            }
        }else{
            return view('landing');
        }
    }

    public function adminPage(){
        $totalUser = count(User::all());
        $totalTransaction = count(Transaction::all());
        $totalBudget = count(Budget::all());
        $totalGoal = count(Goal::all());
        $totalWallet = count(Userwallet::all());
        return view('admin', compact(['totalUser', 'totalTransaction', 'totalBudget', 'totalGoal', 'totalWallet']));
    }
}
