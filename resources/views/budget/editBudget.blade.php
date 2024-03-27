@extends('layouts.main')

@push('title')
    Edit Budget
@endpush

@section('content')

<div class="m-4">
    <a href="/indexBudget" class="btn text-decoration-none mb-2">
        <i class="bi bi-arrow-left-circle-fill"></i> Back
    </a>
    <div class="card grey-card p-2">
        <div class="card-body col-md-12 p-4">
            <h2>EDIT BUDGET</h2>

            <div class="container bg-white shadow p-2 rounded mt-4">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded" role="alert">
                    {{$errors->first()}}
                </div>
                @endif

                <form enctype="multipart/form-data" action="/editBudget/{{$budget->id}}" method="POST" class="m-2 mx-4">
                    {{method_field('PUT')}}
                    @csrf
                    <div class="row mt-4 mb-3">
                        <div class="col-md-2">
                            <label class="col-form-label text-md-start">Year</label>
                            <select name="year" class="form-select">
                                @for ($i = date("Y"); $i >= date("Y") - 10; $i--)
                                    <option value="{{ $i }}" @if(date('Y', strtotime($budget->month)) == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="col-form-label text-md-start">Month</label>
                            <select name="month" class="form-select">
                                @for ($i = 0; $i < 12; $i++)
                                    <option value="{{ $i+1 }}" @if(date('Y-m', strtotime($budget->month)) == date('Y-m', mktime(0, 0, 0, $i+1, 1))) selected @endif>{{ date('F', mktime(0, 0, 0, $i+1, 1)) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-md-12 col-form-label text-md-start">Category</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <select name="category" class="form-select">
                                @foreach ($categories as $cat)
                                    <option value="{{$cat->id}}" @if($cat->id == $budget->category->id) selected @endif>{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-12 col-form-label text-md-start">Name</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input type="text" name="name" value="{{$budget->name}}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-12 col-form-label text-md-start">Amount</label>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <input type="text" name="amount" value="{{$budget->amount}}" class="form-control">
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
