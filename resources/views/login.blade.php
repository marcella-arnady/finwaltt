@extends('layouts.main')

@push('title')
    Login
@endpush

@section('content')

<div class="login-reg-page vh-100 py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card ">
                

                <div class="card-body px-5">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show rounded" role="alert">
                        {{$errors->first()}}
                    </div>
                    @endif
                    <div class="container">
                        <div class="row mt-2 mb-2">
                            <h5 class="card-title">LOGIN</h5>
                        </div>
                    </div>
                    <form enctype="multipart/form-data" action="/login" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <label class="col-md-12 col-form-label text-md-start" for="email">Email</label>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email" required>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-12 col-form-label text-md-start" for="password">Password</label>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password" required>
                                </div>
                            </div>
                            <div class="row mb-3 mt-3">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary shadow-sm py-2 px-5">Login</button>
                                    <a class="btn btn-danger" href="{{ url('/auth/redirect') }}">
                                        <i class="fab fa-google"></i> 
                                        Login with Google
                                    </a>
                                </div>
                            </div>
                            <div class="form-redirect row mb-3">
                                <div class="col-md-12">
                                    <p class="mb-0">New to Finwalt? <a href="/register">Register Here</a></p>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
