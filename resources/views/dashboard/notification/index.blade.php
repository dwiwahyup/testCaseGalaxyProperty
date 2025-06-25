@extends('dashboard.layouts.template')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Notifications</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Notifications</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Your Notifications</h5>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <button class="btn btn-sm btn-outline-primary mark-all-read">
                                        <i class="bi bi-check-all"></i> Mark All as Read
                                    </button>
                                </div>
                            </div>

                            @if($notifications->isEmpty())
                                <div class="alert alert-info">You don't have any notifications yet.</div>
                            @else
                                <div class="list-group">
                                    @foreach($notifications as $notification)
                                        <a href="{{ $notification->link }}" 
                                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center notification-item 
                                                  {{ $notification->is_read ? '' : 'active-notification' }}"
                                           data-notification-id="{{ $notification->id }}">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $notification->title }}</h6>
                                                <p class="mb-1">{{ $notification->message }}</p>
                                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            <div class="ms-3">
                                                @if(!$notification->is_read)
                                                    <span class="badge bg-primary">New</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                                <div class="mt-3">
                                    {{ $notifications->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection