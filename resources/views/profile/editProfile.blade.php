@extends('layouts.main')

@push('title')
    Edit Profile
@endpush

@section('content')

<div class="m-4">
    <a href="/indexProfile" class="btn text-decoration-none mb-2">
        <i class="bi bi-arrow-left-circle-fill"></i> Back
    </a>
    <div class="card grey-card p-2">
        <div class="card-body col-md-12 p-4">
            <h2>EDIT PROFILE</h2>

            <div class="container bg-white shadow p-2 rounded mt-4">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded" role="alert">
                    {{$errors->first()}}
                </div>
                @endif

                <form enctype="multipart/form-data" action="/editProfile/{{$user->id}}" method="POST" class="m-2 mx-4">
                    {{method_field('PUT')}}
                    @csrf
                    <div class="row mt-4">
                        <label class="col-md-12 col-form-label text-md-start">Name</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input type="text" name="name" value="{{$user->name}}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-12 col-form-label text-md-start">Email</label>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <input type="email" name="email" value="{{$user->email}}" class="form-control">
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
