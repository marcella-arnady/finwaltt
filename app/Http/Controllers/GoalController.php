<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class GoalController extends Controller
{
    public function indexGoal(){
        $goals = Goal::where('user_id', Auth::user()->id)->get();
        return view('/goal/indexGoal', compact('goals'));
    }

    public function addGoalPage(){
        $categories = Category::all();
        return view('/goal/addGoal', compact('categories'));
    }

    public function editGoalPage($id){
        $goal = Goal::find($id);
        $categories = Category::all();
        return view('/goal/editGoal', compact(['goal', 'categories']));
    }

    public function addGoal(Request $req){
        $rules = [
            'name' => 'required|max:20',
            'amount' => 'required|numeric',
            'saved' => 'required|numeric',
            'endPeriod'=> 'required'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $customID = Goal::generateID();

        Goal::create([
            'id' => $customID,
            'name' => $req->name,
            'amount' => $req->amount,
            'saved' => $req->saved,
            'startPeriod' => now()->format('Y-m-d'),
            'endPeriod' => $req->endPeriod,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/indexGoal');
    }

    public function editGoal(Request $req, $id){
        $rules = [
            'name' => 'required|max:20',
            'amount' => 'required|numeric',
            'saved' => 'required|numeric',
            'endPeriod'=> 'required'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $goal = Goal::find($id);

        $goal->name = $req->name != null ? $req->name : $goal->name;
        $goal->amount = $req->amount != null ? $req->amount : $goal->amount;
        $goal->saved = $req->saved != null ? $req->saved : $goal->saved;
        $goal->endPeriod = $req->endPeriod != null ? $req->endPeriod : $goal->endPeriod;

        $goal->save();

        return redirect('/indexGoal');
    }

    public function deleteGoal($id){
        $goal = Goal::find($id);

        if(isset($goal)){
            $goal->delete();
        }

        return redirect()->back();

    }
}
