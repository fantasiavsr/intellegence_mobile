<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" {{-- style="background-color: #4FBEAB" --}}>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ 'user' }}">
        <div class="sidebar-brand-icon pt-3">
            <img class="img" src="{{ asset('img/Untitled.png') }}" alt="" style="width: 83%">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-2">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('pages/student/home')) ? 'active' : '' }}">
        <a class="nav-link" href=""
            @if ($title === 'Dashboard') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -Transaksi -->
    <div class="sidebar-heading">
        Test
    </div>

    <!-- Nav Item  -->
    <li class="nav-item {{ (request()->is('pages/student/tests*')) ? 'active' : '' }}">
        <a class="nav-link " href="{{ route('student.tests') }}"
            @if ($title === 'Test' || request()->is('pages/student/test*')) style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
            <i class="fas fa-fw fa-folder"></i>
            <span>Test List</span>
        </a>
    </li>

    <!-- Nav Item  -->
    <li class="nav-item {{ (request()->is('')) ? 'active' : '' }}">
        <a class="nav-link " href=""
            @if ($title === '') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
            <i class="fas fa-fw fa-check"></i>
            <span>Evaluations</span>
        </a>
    </li>




    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading - Utilites -->
    <div class="sidebar-heading">
        Utilites
    </div>

    <!-- Nav Item - Pengaturan -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Pengaturan</span>
        </a>
    </li>

    <!-- Nav Item - Profile -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('student.learning') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Learning</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
