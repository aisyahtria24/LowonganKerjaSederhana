@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Available Job Positions</h1>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Software Developer</h5>
                    <p class="card-text">Develop and maintain web applications using modern technologies.</p>
                    <a href="{{ route('guest.apply') }}" class="btn btn-primary">Apply Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Project Manager</h5>
                    <p class="card-text">Lead project teams and ensure successful delivery of projects.</p>
                    <a href="{{ route('guest.apply') }}" class="btn btn-primary">Apply Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">UI/UX Designer</h5>
                    <p class="card-text">Create beautiful and user-friendly interfaces for our products.</p>
                    <a href="{{ route('guest.apply') }}" class="btn btn-primary">Apply Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
