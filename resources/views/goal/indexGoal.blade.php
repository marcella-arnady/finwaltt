@extends('layouts.main')

@push('title')
    Goal
@endpush

@section('content')

<div class="m-4">
    <div class="card p-2 grey-card">
        <div class="card-body">
            <h2 class="mb-4">GOAL</h2>

            <div class="mb-3">
                <a href="/addGoal" class="btn btn-primary py-2 px-5">Add Goal</a>
            </div>

            <div class="col-md">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="m-3">
                            <h5>My Goals</h5>
                            <table class="table table-hover table-bordered text-center">
                                <thead>
                                    <th>End Period</th>
                                    <th>Name</th>
                                    <th>Target</th>
                                    <th>Saved</th>
                                    <th>Progress</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($goals as $goal)
                                        <tr>
                                            <td>{{ date('Y/m/d', strtotime($goal->endPeriod)) }}</td>
                                            <td>{{$goal->name}}</td>
                                            <td>IDR {{ number_format($goal->amount, 0, '.', ',') }}</td>
                                            <td>IDR {{ number_format($goal->saved, 0, '.', ',') }}</td>
                                            <td>{{ number_format(($goal->saved / $goal->amount) * 100, 0) }}%</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="d-flex justify-content-center">
                                                            <a href="/editGoal/{{$goal->id}}" class="btn btn-warning me-2"><i class="bi bi-pencil-square text-white"></i></a>
                                                            <form action="/goal/{{$goal->id}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this goal?')" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
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
