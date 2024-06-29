<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class NotificationsDropdown extends Component
{
    protected $listeners = ['refreshNotifications' => '$refresh'];

    public function render()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5) // Adjust as needed
            ->get();

        return view('livewire.notifications-dropdown', [
            'notifications' => $notifications
        ]);
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->update(['read_at' => now()]);
        }
        $this->emit('refreshNotifications');
    }
}
