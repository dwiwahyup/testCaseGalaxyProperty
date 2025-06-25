<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if (Auth::user()->role === 'finance' || Auth::user()->role === 'manager')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('payment.index') }}">
                    <i class="bi bi-cart-check"></i>
                    @if (Auth::user()->role === 'finance')
                        <span>Payment</span>
                    @elseif(Auth::user()->role === 'manager')
                        <span>Payment Approval</span>
                    @endif
                </a>
            </li>
        @endif
        @if (Auth::user()->role === 'director')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('payment.salary.report.index') }}">
                    <i class="bi bi-cart-check"></i>
                    <span>Payment Report</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('employee.index') }}">
                <i class="bi bi-cart-check"></i>
                <span>Employee</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('notifications.index') }}">
                <i class="bi bi-cart-check"></i>
                <span>Notification</span>
            </a>
        </li>
    </ul>
</aside>
