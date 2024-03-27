<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserwalletController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/auth/redirect', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/logout', [AuthController::class, 'logout']);

//if the user already login else the user will redirect to middleware authenticate
Route::middleware(['auth'])->group(function () {
    //transaction
    Route::get('/indexTransaction', [TransactionController::class, 'indexTransaction']);
    Route::get('/addTransaction', [TransactionController::class, 'addTransactionPage']);
    Route::post('/addTransaction', [TransactionController::class, 'addTransaction']);
    Route::get('/editTransaction/{id}', [TransactionController::class, 'editTransactionPage']);
    Route::put('/editTransaction/{id}', [TransactionController::class, 'editTransaction']);
    Route::delete('/transaction/{id}', [TransactionController::class, 'deleteTransaction']);
    //budget
    Route::get('/indexBudget', [BudgetController::class, 'indexBudget']);
    Route::get('/addBudget', [BudgetController::class, 'addBudgetPage']);
    Route::post('/addBudget', [BudgetController::class, 'addBudget']);
    Route::get('/editBudget/{id}', [BudgetController::class, 'editBudgetPage']);
    Route::put('/editBudget/{id}', [BudgetController::class, 'editBudget']);
    Route::delete('/budget/{id}', [BudgetController::class, 'deleteBudget']);
    Route::get('/budgetDetail/{id}', [BudgetController::class, 'budgetDetailPage']);
    //goal
    Route::get('/indexGoal', [GoalController::class, 'indexGoal']);
    Route::get('/addGoal', [GoalController::class, 'addGoalPage']);
    Route::post('/addGoal', [GoalController::class, 'addGoal']);
    Route::get('/editGoal/{id}', [GoalController::class, 'editGoalPage']);
    Route::put('/editGoal/{id}', [GoalController::class, 'editGoal']);
    Route::delete('/goal/{id}', [GoalController::class, 'deleteGoal']);
    //userwallet
    Route::get('/indexUserwallet', [UserwalletController::class, 'indexUserwallet']);
    Route::get('/addUserwallet', [UserwalletController::class, 'addUserwalletPage']);
    Route::post('/addUserwallet', [UserwalletController::class, 'addUserwallet']);
    Route::get('/editUserwallet/{id}', [UserwalletController::class, 'editUserwalletPage']);
    Route::put('/editUserwallet/{id}', [UserwalletController::class, 'editUserwallet']);
    Route::delete('/userwallet/{id}', [UserwalletController::class, 'deleteUserwallet']);
    Route::get('/detailUserwallet/{id}', [UserwalletController::class, 'detailUserwalletPage']);
    //profile
    Route::get('/indexProfile', [ProfileController::class, 'indexProfile']);
    Route::get('/editProfile/{id}', [ProfileController::class, 'editProfilePage']);
    Route::put('/editProfile/{id}', [ProfileController::class, 'editProfile']);
    Route::delete('/profile/{id}', [ProfileController::class, 'deleteProfile']);

    //if admin else the user will redirect to middleware security
    Route::get('/admin', [HomeController::class, 'adminPage'])->middleware('security');
});


