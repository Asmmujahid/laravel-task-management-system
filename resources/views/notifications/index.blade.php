@extends('layout.app')

@section('title', 'Notifications')

@section('content')

<div class="page-header">

    <div>

        <h2>

            Notifications

        </h2>

        <p class="subtitle">

            Manage your latest system notifications and updates.

        </p>

    </div>

    @if($notifications->count() > 0)

        <form action="{{ route('notifications.readAll') }}"
              method="POST">

            @csrf

            <button type="submit"
                    class="btn btn-primary">

                <i class="fa-solid fa-check-double"></i>

                Mark All Read

            </button>

        </form>

    @endif

</div>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))

    <x-alert
        type="success"
        :message="session('success')"
    />

@endif

{{-- NOTIFICATIONS --}}
<div class="notifications-wrapper">

    @forelse($notifications as $notification)

        @php

            $status = $notification->data['status'] ?? 'default';

            $icon = 'fa-bell';

            $badgeClass = 'badge-secondary';

            if($status == 'pending') {
                $badgeClass = 'badge-warning';
                $icon = 'fa-clock';
            }

            elseif($status == 'in_progress') {
                $badgeClass = 'badge-info';
                $icon = 'fa-spinner';
            }

            elseif($status == 'completed') {
                $badgeClass = 'badge-success';
                $icon = 'fa-circle-check';
            }

            elseif($status == 'approved') {
                $badgeClass = 'badge-success';
                $icon = 'fa-thumbs-up';
            }

            elseif($status == 'rejected') {
                $badgeClass = 'badge-danger';
                $icon = 'fa-circle-xmark';
            }

            elseif($status == 'correction') {
                $badgeClass = 'badge-warning';
                $icon = 'fa-pen';
            }

            elseif($status == 'submitted') {
                $badgeClass = 'badge-primary';
                $icon = 'fa-paper-plane';
            }

            elseif($status == 'team_created') {
                $badgeClass = 'badge-dark';
                $icon = 'fa-users';
            }

            elseif($status == 'deadline_reminder') {
                $badgeClass = 'badge-danger';
                $icon = 'fa-hourglass-end';
            }

        @endphp

        <div class="notification-card
             {{ is_null($notification->read_at) ? 'notification-unread' : '' }}">

            <div class="notification-top">

                <div class="notification-icon">

                    <i class="fa-solid {{ $icon }}"></i>

                </div>

                <div class="notification-content">

                    <div class="notification-header">

                        <h4>

                            {{ $notification->data['title'] ?? 'Notification' }}

                        </h4>

                        @if(is_null($notification->read_at))

                            <span class="notification-new">

                                New

                            </span>

                        @endif

                    </div>

                    @if(isset($notification->data['message']))

                        <p class="notification-message">

                            {{ $notification->data['message'] }}

                        </p>

                    @endif

                    {{-- TASK --}}
                    @if(isset($notification->data['task']))

                        <div class="notification-meta">

                            <strong>Task:</strong>

                            {{ $notification->data['task'] }}

                        </div>

                    @endif

                    {{-- TEAM --}}
                    @if(isset($notification->data['team']))

                        <div class="notification-meta">

                            <strong>Team:</strong>

                            {{ $notification->data['team'] }}

                        </div>

                    @endif

                    {{-- MEMBER --}}
                    @if(isset($notification->data['member']))

                        <div class="notification-meta">

                            <strong>Member:</strong>

                            {{ $notification->data['member'] }}

                        </div>

                    @endif

                    {{-- COMMENT --}}
                    @if(isset($notification->data['comment']) &&
                        !empty($notification->data['comment']))

                        <div class="notification-extra">

                            <strong>Comment:</strong>

                            <p>

                                {{ $notification->data['comment'] }}

                            </p>

                        </div>

                    @endif

                    {{-- REVIEW --}}
                    @if(isset($notification->data['review']) &&
                        !empty($notification->data['review']))

                        <div class="notification-extra success-extra">

                            <strong>Review:</strong>

                            <p>

                                {{ $notification->data['review'] }}

                            </p>

                        </div>

                    @endif

                    {{-- STATUS --}}
                    <div class="notification-footer">

                        <span class="custom-badge {{ $badgeClass }}">

                            {{ ucfirst(str_replace('_', ' ', $status)) }}

                        </span>

                        <small>

                            {{ $notification->created_at->diffForHumans() }}

                        </small>

                    </div>

                </div>

            </div>

            {{-- ACTIONS --}}
            <div class="notification-actions">

                @if(is_null($notification->read_at))

                    <form action="{{ route('notifications.read', $notification->id) }}"
                          method="POST">

                        @csrf

                        <button type="submit"
                                class="btn btn-primary btn-sm">

                            <i class="fa-solid fa-check"></i>

                            Mark Read

                        </button>

                    </form>

                @endif

                <form action="{{ route('notifications.delete', $notification->id) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this notification?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger btn-sm">

                        <i class="fa-solid fa-trash"></i>

                        Delete

                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="empty-notification">

            <i class="fa-regular fa-bell-slash"></i>

            <h3>No Notifications Found</h3>

            <p>

                You currently don't have any notifications.

            </p>

        </div>

    @endforelse

</div>

@endsection