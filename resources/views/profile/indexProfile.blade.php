@extends('layouts.main')

@push('title')
    Profile
@endpush

@section('content')

<div class="m-4">
    <div class="card p-2 grey-card">
        <div class="card-body">
            <h2 class="mb-4">PROFILE</h2>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row mt-3">
                            <label class="col-md-12 col-form-label text-md-start" for="name">Name</label>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="rounded-3 p-2 border">
                                    {{$user->name}}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label class="col-md-12 col-form-label text-md-start" for="email">Email</label>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="rounded-3 p-2 border">
                                    {{$user->email}}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="col-md-2">
                                <div class="button-container">
                                    <a href="/editProfile/{{$user->id}}" class="btn btn-warning text-white custom-btn btn-same-size">Edit Profile</a>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="button-container">
                                    <a href="/logout" class="btn btn-dark custom-btn btn-same-size">Log Out</a>
                                </div>
                            </div>
                            @if (Auth::user()->role == 'User')
                            <div class="col-md-2">
                                <div class="button-container">
                                    <form action="/profile/{{$user->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" onclick="return confirm('Are you sure you want to delete this profile?')" class="btn btn-danger custom-btn btn-same-size">Delete Account</a>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
