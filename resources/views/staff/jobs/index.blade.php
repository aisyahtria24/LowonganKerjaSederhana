@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">My Jobs</h1>
                <a href="{{ route('staff.jobs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Add New Job
                </a>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('staff.jobs.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search by job title, company..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="category_id" class="form-select">
                                <option value="">All Categories</option>
                                @if(isset($categories))
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-primary me-2">Filter</button>
                            <a href="{{ route('staff.jobs.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jobs Cards -->
    <div class="row">
        @forelse($jobs as $job)
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title text-truncate mb-0" title="{{ $job->title }}">
                            {{ $job->title }}
                        </h5>
                        <span class="badge {{ $job->status == 'active' ? 'bg-success' : 'bg-secondary' }} ms-2">
                            {{ $job->status == 'active' ? 'Active' : 'Inactive' }}
                        </span>
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

                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">
                                ${{ number_format($job->salary, 0) }}
                            </span>
                            <div class="btn-group" role="group">
                                <a href="{{ route('staff.jobs.show', $job) }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('staff.jobs.edit', $job) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('staff.jobs.destroy', $job) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No jobs found</h5>
                    <p class="text-muted">There are no jobs matching your criteria.</p>
                    <a href="{{ route('staff.jobs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Create First Job
                    </a>
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

.btn-outline-primary:hover {
    color: #fff;
}
</style>
@endsection
