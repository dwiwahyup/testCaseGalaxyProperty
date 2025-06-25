@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
@endphp

<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
            <img src="{{ url('assets/admin/img/logo.png') }}" alt="">
            <span class="d-none d-lg-block">NiceAdmin</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">{{ auth()->user()->myUnreadNotifications->count() }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header" id="notification-count">
                        Kamu punya {{ auth()->user()->myUnreadNotifications->count() }} notifikasi baru
                        <a href="{{ route('notifications.index')}}"><span class="badge rounded-pill bg-primary p-2 ms-2">Lihat Semua</span></a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    @forelse(auth()->user()->myUnreadNotifications()->orderByDesc('created_at')->take(5)->get() as $notification)
                        <li class="notification-item {{ !$notification->is_read ? 'bg-light' : '' }}">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div style="cursor: pointer;" onclick="markAsRead('{{ $notification->id }}', '{{ $notification->link }}')">
                                <h4>{{ $notification->title }}</h4>
                                <p>{{ $notification->message }}</p>
                                <p class="text-muted">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    @empty
                        <li class="notification-item">
                            <i class="bi bi-info-circle text-secondary"></i>
                            <div>
                                <h4>No notifications</h4>
                                <p>-</p>
                                <p class="text-muted">Now</p>
                            </div>
                        </li>
                    @endforelse


                    <li class="dropdown-footer">
                        <a href="{{ route('notifications.index') }}">Lihat Semua Notifikasi</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="dropdown-item d-flex align-items-center"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>
                                    @csrf
                                    Logout
                                </span>
                            </form>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
