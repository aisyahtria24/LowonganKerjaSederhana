@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Notifications</h1>
                <div>
                    <a href="{{ route('admin.notifications', ['read' => '0']) }}" class="btn btn-outline-warning me-2">Unread Only</a>
                    <a href="{{ route('admin.notifications') }}" class="btn btn-outline-primary">All Notifications</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($notifications->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($notifications as $notification)
                                <div class="list-group-item {{ $notification->is_read ? '' : 'list-group-item-warning' }}">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 {{ $notification->is_read ? '' : 'fw-bold' }}">{{ $notification->title }}</h6>
                                            <p class="mb-2">{{ $notification->message }}</p>
                                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                            @if($notification->pelamar)
                                                <div class="mt-2">
                                                    <strong>Applicant:</strong> {{ $notification->pelamar->first_name }} {{ $notification->pelamar->last_name }}<br>
                                                    <strong>Email:</strong> {{ $notification->pelamar->email }}<br>
                                                    <strong>Position:</strong> {{ $notification->pelamar->posisi_dilamar }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column gap-2">
                                            @if(!$notification->is_read)
                                                <form method="POST" action="{{ route('admin.notifications.mark-read', $notification->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-primary">Mark as Read</button>
                                                </form>
                                            @endif
                                            @if($notification->pelamar)
                                                <a href="{{ route('admin.pelamar.show', $notification->pelamar_id) }}" class="btn btn-sm btn-primary">View Applicant</a>
                                            @endif
                                            <form method="POST" action="{{ route('admin.notifications.destroy', $notification->id) }}" onsubmit="return confirm('Are you sure you want to delete this notification?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No notifications found</h5>
                            <p class="text-muted">You don't have any notifications at the moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-refresh notifications every 30 seconds
setInterval(function() {
    // You could add AJAX to refresh notification count in navbar
    // For now, just refresh the page occasionally
}, 30000);
</script>
@endsection
