<!-- resources/views/livewire/notifications-dropdown.blade.php -->

<div class="dropdown">
    <a data-mdb-dropdown-init href="#" class="text-white" id="notificationsDropdown" role="button"
       data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell me-1"></i> Notifications
        @if($notifications->whereNull('read_at')->count() > 0)
            <span class="badge bg-danger">{{ $notifications->whereNull('read_at')->count() }}</span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
        @foreach ($notifications as $notification)
            <li class="dropdown-item">
                <div>
                    {{ $notification->message }}
                </div>
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                <button wire:click="markAsRead({{ $notification->id }})" class="btn btn-sm btn-link">Mark as Read</button>
            </li>
        @endforeach
    </ul>
</div>
