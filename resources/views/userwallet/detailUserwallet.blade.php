@extends('layouts.main')

@push('title')
    Wallet Detail
@endpush

@section('content')
<div class="m-4">
    <a href="/indexUserwallet" class=" btn text-decoration-none mb-2">
        <i class="bi bi-arrow-left-circle-fill"></i> Back
    </a>

    <div class="card grey-card border-0 p-2">
        <div class="card-body col-md-12 p-4">
            <h2>WALLET DETAIL</h2>

            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col-md">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <h5>WALLET NAME</h5>
                                <h2>{{$userwallet->wallet->name}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <h5>WALLET AMOUNT</h5>
                                <h2>IDR {{ number_format($userwallet->amount, 0, '.', ',') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3"></div>
            <div class="col-md">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="m-3">
                            <h5>Transaction History</h5>
                            <table class="table table-hover table-bordered text-center">
                                <thead>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Note</th>
                                    <th>Cash Flow</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $tr)
                                        <tr>
                                            <td>{{$tr->date}}</td>
                                            <td>{{$tr->category->name}}</td>
                                            <td>{{$tr->name}}</td>
                                            <td class="{{ $tr->cashflow_id == 'CF0001' ? 'text-danger' : 'text-success' }}">
                                                IDR {{ number_format($tr->amount, 0, '.', ',') }}
                                            </td>
                                            <td>{{$tr->note}}</td>
                                            <td>{{$tr->cashflow->name}}</td>
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
