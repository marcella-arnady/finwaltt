@extends('layouts.main')

@push('title')
    Transaction
@endpush

@section('content')

<div class="m-4">
    <div class="card p-2 grey-card">
        <div class="card-body">
            <h2 class="mb-4">TRANSACTION</h2>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col-md">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <h5>TOTAL SPENDING</h5>
                                <h2>IDR {{ number_format($transactionSum, 0, '.', ',') }}</h2>
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
                <div class="col-md-3 mt-4">
                    <a href="/addTransaction" class="btn btn-primary py-2 px-4">Add Transaction</a>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <form method="get" action="/indexTransaction">
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
                            <h5>My Transactions</h5>
                            <table class="table table-hover table-bordered text-center">
                                <thead>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Wallet</th>
                                    <th>Amount</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $tr)
                                        <tr>
                                            <td>{{$tr->date}}</td>
                                            <td>{{$tr->category->name}}</td>
                                            <td>{{$tr->name}}</td>
                                            <td>{{$tr->userwallet->wallet->name}}</td>
                                            <td class="{{ $tr->cashflow_id == 'CF0001' ? 'text-danger' : 'text-success' }}">
                                                IDR {{ number_format($tr->amount, 0, '.', ',') }}
                                            </td>
                                            <td>{{$tr->note}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="d-flex justify-content-center">
                                                            <a href="/editTransaction/{{$tr->id}}" class="btn btn-warning me-2"><i class="bi bi-pencil-square text-white"></i></a>
                                                            <form action="/transaction/{{$tr->id}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this transaction?')" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
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
