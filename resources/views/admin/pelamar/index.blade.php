@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Job Applications Management</h1>
        <a href="{{ route('admin.pelamar.create') }}" class="btn btn-primary">Add New Application</a>
    </div>

    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.pelamar.index') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, email, position" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>CV</th>
                            <th>Applied At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelamars as $pelamar)
                        <tr>
                            <td>{{ $pelamar->nama }}</td>
                            <td>{{ $pelamar->email }}</td>
                            <td>{{ $pelamar->posisi }}</td>
                            <td>
                                @if($pelamar->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($pelamar->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if($pelamar->cv)
                                    <a href="{{ Storage::url($pelamar->cv) }}" target="_blank" class="btn btn-sm btn-outline-primary">Download</a>
                                @else
                                    No CV
                                @endif
                            </td>
                            <td>{{ $pelamar->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.pelamar.show', $pelamar) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('admin.pelamar.edit', $pelamar) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form method="POST" action="{{ route('admin.pelamar.destroy', $pelamar) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No applications found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $pelamars->links() }}
        </div>
    </div>
</div>
@endsection
