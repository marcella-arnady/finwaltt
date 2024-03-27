@extends('layouts.main')

@push('title')
    Wallet
@endpush

@section('content')

<div class="m-4">
    <div class="card p-2 grey-card">
        <div class="card-body">
            <h2 class="mb-4">WALLET</h2>

            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col-md">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <h5>TOTAL WALLET AMOUNT</h5>
                                <h2>IDR {{ number_format($sum, 0, '.', ',') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <h5>TOTAL WALLET OWNED</h5>
                                <h2>{{$count}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="/addUserwallet" class="btn btn-primary py-2 px-5">Add Wallet</a>
            </div>

            <div class="col-md">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="m-3">
                            <h5>My Wallets</h5>
                            <table class="table table-hover table-bordered text-center">
                                <thead>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($userwallets as $userwallet)
                                        <tr>
                                            <td>{{$userwallet->wallet->name}}</td>
                                            <td>IDR {{ number_format($userwallet->amount, 0, '.', ',') }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="d-flex justify-content-center">
                                                            <a href="/detailUserwallet/{{$userwallet->wallet_id}}" class="btn btn-success me-2"><i class="bi bi-search"></i></a>
                                                            <a href="/editUserwallet/{{$userwallet->wallet_id}}" class="btn btn-warning me-2"><i class="bi bi-pencil-square text-white"></i></a>
                                                            <form action="/userwallet/{{$userwallet->wallet_id}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this wallet?')" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
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
