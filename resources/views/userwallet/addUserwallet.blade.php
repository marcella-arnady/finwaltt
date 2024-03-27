@extends('layouts.main')

@push('title')
    Add Wallet
@endpush

@section('content')

<div class="m-4">
    <a href="/indexUserwallet" class="btn text-decoration-none mb-2">
        <i class="bi bi-arrow-left-circle-fill"></i> Back
    </a>
    <div class="card grey-card border-0 p-2">
        <div class="card-body col-md-12 p-4">
            <h2>ADD WALLET</h2>

            <div class="container bg-white shadow p-2 rounded mt-4">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded" role="alert">
                {{$errors->first()}}
            </div>
            @endif

            <form enctype="multipart/form-data" action="/addUserwallet" method="POST" class="m-2 mx-4">
                @csrf
                <div class="row mt-4">
                    <label class="col-md-12 col-form-label text-md-start">Name</label>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <select name="wallet" class="form-select">
                            @foreach ($wallets as $wallet)
                                <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-12 col-form-label text-md-start">Amount</label>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">
                    <input type="text" name="amount" placeholder="Type Wallet Amount" required class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center m-2">
                        <button type="submit" class="btn btn-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection
