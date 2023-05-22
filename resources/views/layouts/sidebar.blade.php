<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-text mx-3">Peminjaman Buku</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if(Auth::user()->type == 'admin')

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->segment(2) == 'dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item {{ (request()->segment(2) == 'books') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/books">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span>Master Buku</span></a>
    </li>

    <li class="nav-item {{ (request()->segment(2) == 'members') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/members">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>Master Anggota</span></a>
    </li>
    <li class="nav-item {{ (request()->segment(2) == '') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/request-loan">
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
            <span>Pengajuan Buku</span></a>
    </li>

    <li class="nav-item {{ (request()->segment(2) == '') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/return-loan">
            <i class="fa fa-list" aria-hidden="true"></i>
            <span>List Peminjaman Buku</span></a>
    </li>

    @else

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->segment(2) == 'dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/member/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ (request()->segment(3) == 'create') ? 'active' : '' }}">
        <a class="nav-link" href="/member/loans/create">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span>Pengajukan Pinjaman Buku</span></a>
    </li>

    <li class="nav-item {{ (request()->segment(2) == 'loans' && request()->segment(3) == '') ? 'active' : '' }}">
        <a class="nav-link" href="/member/loans">
            <i class="fa fa-list" aria-hidden="true"></i>
            <span>List Pengajukan</span></a>
    </li>

    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->