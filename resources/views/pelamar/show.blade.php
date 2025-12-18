@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Detail Lamaran</h3>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informasi Pribadi</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td>{{ $pelamar->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $pelamar->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Posisi:</strong></td>
                                    <td>{{ $pelamar->posisi }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($pelamar->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($pelamar->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dilamar pada:</strong></td>
                                    <td>{{ $pelamar->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Dokumen</h5>
                            @if($pelamar->cv)
                                <div class="mb-3">
                                    <strong>CV:</strong><br>
                                    <a href="{{ Storage::url($pelamar->cv) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-file-pdf"></i> Lihat CV
                                    </a>
                                </div>
                            @else
                                <p class="text-muted">Tidak ada CV yang diupload</p>
                            @endif
                        </div>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'Staff')
                            <hr>
                            <div class="d-flex gap-2">
                                <form method="POST" action="{{ route('staff.pelamar.update', $pelamar) }}" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Approve lamaran ini?')">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('staff.pelamar.update', $pelamar) }}" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Reject lamaran ini?')">Reject</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
