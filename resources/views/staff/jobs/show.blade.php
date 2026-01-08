@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1 class="h4 mb-0 text-gray-800">Job Details</h1>
                    <div>
                        <a href="{{ route('staff.jobs.edit', $job) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('staff.jobs.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back to Jobs
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="h3 mb-3">{{ $job->title }}</h2>

                            <div class="mb-3">
                                <span class="badge {{ $job->status == 'active' ? 'bg-success' : 'bg-secondary' }} fs-6">
                                    {{ $job->status == 'active' ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <p class="mb-2">
                                        <i class="fas fa-building text-muted me-2"></i>
                                        <strong>Company:</strong> {{ $job->company }}
                                    </p>
                                    <p class="mb-2">
                                        <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                        <strong>Location:</strong> {{ $job->location }}
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-2">
                                        <i class="fas fa-tags text-muted me-2"></i>
                                        <strong>Category:</strong> {{ $job->category->name ?? 'Uncategorized' }}
                                    </p>
                                    <p class="mb-2">
                                        <i class="fas fa-dollar-sign text-muted me-2"></i>
                                        <strong>Salary:</strong> ${{ number_format($job->salary, 0) }}
                                    </p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Description</h5>
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($job->description)) !!}
                                </div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    Created: {{ $job->created_at->format('M d, Y \a\t H:i') }}
                                </small>
                            </div>
                        </div>

                        @if($job->logo)
                        <div class="col-md-4">
                            <div class="text-center">
                                <h6>Company Logo</h6>
                                <img src="{{ asset('storage/' . $job->logo) }}" alt="Company Logo" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
