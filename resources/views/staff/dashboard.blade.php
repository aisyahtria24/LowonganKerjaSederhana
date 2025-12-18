@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Staff Dashboard - Job Applications</h1>
    <div class="row">
        @foreach($pelamars as $pelamar)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $pelamar->nama }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Email:</strong> {{ $pelamar->email }}</p>
                    <p class="card-text"><strong>Position:</strong> {{ $pelamar->posisi }}</p>
                    <p class="card-text">
                        <strong>Status:</strong>
                        @if($pelamar->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($pelamar->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('staff.pelamar.show', $pelamar) }}" class="btn btn-info btn-sm">View Details</a>
                        <form method="POST" action="{{ route('staff.pelamar.update', $pelamar) }}" class="d-inline">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm d-inline-block w-auto me-2" onchange="this.form.submit()">
                                <option value="pending" {{ $pelamar->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $pelamar->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $pelamar->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $pelamars->links() }}
</div>
@endsection
