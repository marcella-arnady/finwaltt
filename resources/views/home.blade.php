@extends('layouts.main')

@push('title')
    Home
@endpush

@section('content')

<div class="m-4">
    <div class="row">
        <div class="col-md-12 my-4">
            <div>
                <h3>Hi, {{$name}}!</h3>
                <p class="text-secondary">Rule No. 1: Never lose money. Rule No. 2: Never forget Rule No. 1.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body row justify-content-center text-center">
                    <h5>CASHFLOW</h5>
                    <div class="canvas-container" style="width: 300px; height: 300px;">
                        <canvas id="cfChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body row justify-content-center text-center">
                    <h5>TRANSACTION</h5>
                    <div class="canvas-container" style="width: 300px; height: 300px;">
                        <canvas id="trChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <h5>BUDGET</h5>
                    <div class="canvas-container row justify-content-center" style="width: 100%; height: 300px;">
                        <canvas id="buChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/barChart.js') }}"></script>
<script src="{{ asset('js/doughnutChart.js') }}"></script>
<script>
    createDoughnutChart(@json($cashflow['labels']), @json($cashflow['data']), 'cfChart');
    createDoughnutChart(@json($category['labels']), @json($category['data']), 'trChart');
    createBarChart(@json($budget['labels']), @json($budget['data']), 'buChart');
</script>
@endsection
