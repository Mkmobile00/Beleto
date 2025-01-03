<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('customer.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{auth()->guard('customer')->user()->customerDetail->first_name }} {{auth()->guard('customer')->user()->customerDetail->last_name }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('customer.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{route('customer.subscriptionlogin')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Subscription</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('customer.paymentslogin')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Payments/Statements</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('customer.alldevicelist')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Device List</a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    
</ul>