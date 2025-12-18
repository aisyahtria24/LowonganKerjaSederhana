@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-5">
                <h1 class="display-4">Lowongan Kerja Sederhana</h1>
                <p class="lead">Temukan pekerjaan impian Anda dengan mudah</p>
            </div>

            @guest
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-briefcase fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Cari Lowongan Kerja</h5>
                                <p class="card-text">Lihat berbagai lowongan pekerjaan yang tersedia</p>
                                <a href="{{ route('guest.jobs') }}" class="btn btn-primary">Lihat Lowongan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-user-plus fa-3x text-success mb-3"></i>
                                <h5 class="card-title">Daftar Akun</h5>
                                <p class="card-text">Buat akun untuk melamar pekerjaan</p>
                                <a href="{{ route('register') }}" class="btn btn-success">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
                </div>
            @else
                <div class="text-center">
                    <h3>Selamat datang, {{ auth()->user()->name }}!</h3>
                    <p class="mb-4">Role Anda: <strong>{{ auth()->user()->role }}</strong></p>

                    @if(auth()->user()->role === 'Admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg me-2">Dashboard Admin</a>
                        <a href="{{ route('admin.pelamar.index') }}" class="btn btn-outline-primary btn-lg">Kelola Lamaran</a>
                    @elseif(auth()->user()->role === 'Staff')
                        <a href="{{ route('staff.dashboard') }}" class="btn btn-success btn-lg">Dashboard Staff</a>
                    @else
                        <a href="{{ route('guest.jobs') }}" class="btn btn-info btn-lg me-2">Lihat Lowongan</a>
                        <a href="{{ route('guest.apply') }}" class="btn btn-outline-info btn-lg">Lamar Pekerjaan</a>
                    @endif
                </div>
            @endguest
        </div>
    </div>
</div>
@endsection
