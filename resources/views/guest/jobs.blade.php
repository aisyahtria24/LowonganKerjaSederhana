@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">Available Job Positions</h1>
                @auth
                    <span class="badge bg-success">Welcome back, {{ auth()->user()->name }}!</span>
                @else
                    <div>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('guest.jobs') }}" class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control" placeholder="Search by job title..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="category_id" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary me-2">Search</button>
                            <a href="{{ route('guest.jobs') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jobs Grid -->
    <div class="row">
        @forelse($jobs as $job)
        <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title text-truncate mb-0" title="{{ $job->title }}">
                            {{ $job->title }}
                        </h5>
                        <span class="badge bg-success">Active</span>
                    </div>

                    <div class="mb-3">
                        <p class="text-muted small mb-1">
                            <i class="fas fa-building me-1"></i>{{ $job->company }}
                        </p>
                        <p class="text-muted small mb-1">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $job->location }}
                        </p>
                        <p class="text-muted small mb-0">
                            <i class="fas fa-tags me-1"></i>{{ $job->category->name ?? 'Uncategorized' }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <p class="text-primary fw-bold mb-0">
                            ${{ number_format($job->salary, 0) }}
                        </p>
                    </div>

                    <div class="mt-auto">
                        @auth
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#applyModal{{ $job->id }}">
                                <i class="fas fa-paper-plane me-1"></i>Lamar Sekarang
                            </button>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary w-100">
                                <i class="fas fa-user-plus me-1"></i>Lamar Sekarang
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Apply Modal for Authenticated Users -->
        @auth
        <div class="modal fade" id="applyModal{{ $job->id }}" tabindex="-1" aria-labelledby="applyModalLabel{{ $job->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyModalLabel{{ $job->id }}">Apply for {{ $job->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('pelamar.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="posisi_dilamar" value="{{ $job->title }}">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name{{ $job->id }}" class="form-label">First Name *</label>
                                    <input type="text" class="form-control" id="first_name{{ $job->id }}" name="first_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name{{ $job->id }}" class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" id="last_name{{ $job->id }}" name="last_name" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email{{ $job->id }}" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email{{ $job->id }}" name="email" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone{{ $job->id }}" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone{{ $job->id }}" name="phone">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="birthday{{ $job->id }}" class="form-label">Birthday</label>
                                    <input type="date" class="form-control" id="birthday{{ $job->id }}" name="birthday">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="gender{{ $job->id }}" class="form-label">Gender *</label>
                                <select class="form-select" id="gender{{ $job->id }}" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="cv_file{{ $job->id }}" class="form-label">CV File (PDF) *</label>
                                <input type="file" class="form-control" id="cv_file{{ $job->id }}" name="cv_file" accept=".pdf" required>
                                <div class="form-text">Maximum file size: 2MB</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endauth

        @empty
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No jobs found</h5>
                    <p class="text-muted">There are no job positions matching your criteria.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($jobs->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $jobs->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

.badge {
    font-size: 0.75em;
}

.btn-primary:hover {
    color: #fff;
}
</style>
@endsection
