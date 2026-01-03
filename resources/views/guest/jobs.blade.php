@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Available Job Positions</h1>
    <div class="row">
        @forelse($jobs as $job)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $job->title }}</h5>
                    <p class="card-text">
                        <strong>Company:</strong> {{ $job->company_name }}<br>
                        <strong>Location:</strong> {{ $job->location }} ({{ ucfirst($job->work_system) }})<br>
                        <strong>Type:</strong> {{ ucfirst($job->job_type) }}<br>
                        <strong>Salary:</strong> {{ $job->salary_range }}<br>
                        <strong>Category:</strong> {{ $job->category }}
                    </p>
                    <a href="{{ route('guest.apply') }}" class="btn btn-primary">Apply Now</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-center">No job positions available at the moment.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
