<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    @if (Auth::user()->id_level == '2')
        
    <!-- Sidebar - Admin -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/admin/user">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>User</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="/admin/tagihan">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Tagihan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/admin/pembayaran">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Pembayaran</span></a>
    </li>
    
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


    @else
    
    <!-- Sidebar - Bank -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/bank">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/bank">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/bank/tagihan">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tagihan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/bank/pembayaran">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Pembayaran</span></a>
    </li>
        
    @endif
</ul>