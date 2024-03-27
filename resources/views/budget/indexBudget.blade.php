@extends('layouts.main')

@push('title')
    Budget
@endpush

@section('content')

<div class="m-4">
    <div class="card p-2 grey-card">
        <div class="card-body">
            <h2 class="mb-4">BUDGET</h2>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col-md">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <h5>TOTAL BUDGET</h5>
                                <h2>IDR {{ number_format($budgetSum, 0, '.', ',') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <h5>TOTAL SPENDING THIS MONTH</h5>
                                <h2>IDR {{ number_format($transactionSum, 0, '.', ',') }} / {{ number_format($budgetSum, 0, '.', ',') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row py-3 justify-content-between">
                <div class="col-md-6 mt-4">
                    <a href="/addBudget" class="btn btn-primary py-2 px-5">Add Budget</a>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <form method="get" action="/indexBudget">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="yearFilter">Year</label>
                                        <select class="form-select" name="year">
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}" @if ($selectedYear == $year) selected @endif>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="monthFilter">Month</label>
                                        <select class="form-select" name="month">
                                            @foreach ($months as $month)
                                                <option value="{{ $month }}" @if ($selectedMonth == $month) selected @endif>
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-4">
                                    <button type="submit" class="btn btn-primary px-3 shadow-sm">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="m-3">
                            <h5>My Budgets</h5>
                            <table class="table table-hover table-bordered text-center">
                                <thead>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($budgets as $budget)
                                        <tr>
                                            <td>{{date('Y', strtotime($budget->month))}}</td>
                                            <td>{{date('F', strtotime($budget->month))}}</td>
                                            <td>{{$budget->category->name}}</td>
                                            <td>{{$budget->name}}</td>
                                            <td>IDR {{ number_format($budget->amount, 0, '.', ',') }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="d-flex justify-content-center">
                                                            <a href="/editBudget/{{$budget->id}}" class="btn btn-warning me-2"><i class="bi bi-pencil-square text-white"></i></a>
                                                            <form action="/budget/{{$budget->id}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this budget?')" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
