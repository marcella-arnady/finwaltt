@extends('layouts.main')

@push('title')
    FinWalt | Budget, Track, Succeed
@endpush

@section('content')
<div class="landing-page">
        <div class="landing-container"> 
            <div class="left-side">
            <div class="typed-text mb-5">
                <img src="{{ asset('images/landing-left.png') }}" alt="Landing Image">
            </div>
                <a class="nav-link active" aria-current="page" href="/login">Get Started</a>
            </div>
            <div class="right-side">
                <img src="{{ asset('images/landing-top.png') }}" alt="Landing Image">
            </div>
        </div>

 

<section class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-arrow-left-right m-auto icon-green"></i></div>
                            <h3>Budget</h3>
                            <p class="lead mb-0">Take charge and control your finances this month!</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-calculator m-auto icon-green"></i></div>
                            <h3>Transaction</h3>
                            <p class="lead mb-0">Gain insight into your spending habits with transaction analytics!</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-bullseye m-auto icon-green"></i></div>
                            <h3>Goal</h3>
                            <p class="lead mb-0">Transform your dreams into reality with goal-oriented financial planning!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="round-landing">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                    <div class="col-12 col-lg-5">
                        <h2 class="display-4 lh-1 mb-4">Chart your path to financial success</h2>
                        <p class="lead fw-normal text-muted mb-5 mb-lg-0">Our personal finance platform simplifies money management, empowering you to budget, track expenses, and plan for the future. Start achieving your financial goals today!</p>
                    </div>
                    <div class="col-sm-8 col-md-6">
                        <div class="px-5 px-sm-0"><img class="img-fluid rounded-circle" src="{{ asset('images/landing-circle.png') }}" alt="..." /></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="cta-content">
                <div class="container px-5 py-4">
                    <h2 class="text-white display-1 lh-1 mb-4">
                        Budget. Track.
                        <br />
                        Succeed. Repeat.
                    </h2>
                    <a class="btn btn-outline-light py-3 px-4 rounded-pill" href="/login">Try FinWalt</a>
                </div>
            </div>
        </section>
</div>
@endsection