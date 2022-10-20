@props([
    'notifications',
    'unreadNotificationsCount',
])

<x-filament-notifications::modal
    id="database-notifications"
    close-button
    slide-over
    width="md"
>
    @if ($notifications->count())
        <x-slot name="header">
            <x-filament-notifications::database.modal.heading
                :unread-notifications-count="$unreadNotificationsCount"
            />

            <x-filament-notifications::database.modal.actions
                :notifications="$notifications"
                :unread-notifications-count="$unreadNotificationsCount"
            />
        </x-slot>

        <div class="mt-[calc(-1rem-1px)]">
            @foreach ($notifications as $notification)
                <div @class([
                    '-mx-6 border-b',
                    'border-t' => $notification->unread(),
                    'dark:border-gray-700' => (! $notification->unread()) && config('filament-notifications.dark_mode'),
                    'dark:border-gray-800' => $notification->unread() && config('filament-notifications.dark_mode'),
                ])>
                    <div @class([
                        'py-2 pl-4 pr-2',
                        'bg-primary-50 -mb-px' => $notification->unread(),
                        'dark:bg-gray-700' => $notification->unread() && config('filament-notifications.dark_mode'),
                    ])>
                        {{ $this->getNotificationFromDatabaseRecord($notification)->inline() }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <x-filament-notifications::database.modal.empty-state />
    @endif
</x-filament-notifications::modal>
