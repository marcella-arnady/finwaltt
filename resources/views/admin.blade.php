@extends('layouts.main')

@push('title')
    Landing
@endpush

@section('content')

<div class="container vh-100 py-5">
    <h2>Hi Admin!</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 p-4 shadow-sm rounded">
            <div class="mb-3">
                <h5>TOTAL USER</h5>
                <h5>{{$totalUser}}</h5>
            </div>
        </div>
        <div class="col-md-6 p-4 shadow-sm rounded">
            <div class="mb-3">
                <h5>TOTAL TRANSACTION</h5>
                <h5>{{$totalTransaction}}</h5>
            </div>
        </div>
        <div class="col-md-6 p-4 shadow-sm rounded">
            <div class="mb-3">
                <h5>TOTAL BUDGET</h5>
                <h5>{{$totalBudget}}</h5>
            </div>
        </div>
        <div class="col-md-6 p-4 shadow-sm rounded">
            <div class="mb-3">
                <h5>TOTAL GOAL</h5>
                <h5>{{$totalGoal}}</h5>
            </div>
        </div>
        <div class="col-md-6 p-4 shadow-sm rounded">
            <div class="mb-3">
                <h5>TOTAL WALLET OWNED</h5>
                <h5>{{$totalWallet}}</h5>
            </div>
        </div>
    </div>
</div>

@endsection
