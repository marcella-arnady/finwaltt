@extends('layouts.main')

@push('title')
    Add Goal
@endpush

@section('content')

<div class="m-4">
    <a href="/indexGoal" class="btn text-decoration-none mb-2">
        <i class="bi bi-arrow-left-circle-fill"></i> Back
    </a>
    <div class="card grey-card border-0 p-2">
        <div class="card-body col-md-12 p-4">
            <h2>ADD GOAL</h2>

            <div class="container bg-white shadow p-2 rounded mt-4">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded" role="alert">
                {{$errors->first()}}
            </div>
            @endif

            <form enctype="multipart/form-data" action="/addGoal" method="POST" class="m-2 mx-4">
                @csrf
                <div class="row mt-4">
                    <label class="col-md-12 col-form-label text-md-start">End Period</label>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">
                    <input type="date" name="endPeriod" placeholder="DD/MM/YYYY" required class="form-control">
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-12 col-form-label text-md-start">Name</label>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <input type="text" name="name" placeholder="Type Goal Name" required class="form-control">
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-12 col-form-label text-md-start">Target</label>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">
                    <input type="text" name="amount" placeholder="Type Goal Target Amount" required class="form-control">
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-12 col-form-label text-md-start">Saved Amount</label>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">
                    <input type="text" name="saved" placeholder="Type Goal Saved Amount" required class="form-control">
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
@endsection
