<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" {{-- style="background-color: #4FBEAB" --}}>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ 'user' }}">
        <div class="sidebar-brand-icon pt-3">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            {{-- <img class="img" src="{{ asset('img/gv-text-dark.png') }}" alt="" style="width: 83%"> --}}
            {{-- Intelligance Guidance Brand --}}
            <h4 class="pt-3">
                <span style="color: #4FBEAB">Intelligance</span> <span style="color: #4FBEAB">Guidance</span>
            </h4>
        </div>
        {{-- <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-2">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('user')) ? 'active' : '' }}">
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
    <li class="nav-item {{ (request()->is('admin-transaksi')) ? 'active' : '' }}">
        <a class="nav-link " href=""
            @if ($title === 'Admin - List Transaksi') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Test List</span>
        </a>
    </li>

    <!-- Nav Item  -->
    <li class="nav-item {{ (request()->is('admin-penjualan')) ? 'active' : '' }}">
        <a class="nav-link " href=""
            @if ($title === 'Admin - List Penjualan') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Evaluations</span>
        </a>
    </li>

    <!-- Heading  -->
    <div class="sidebar-heading">
        Class
    </div>

    <!-- Nav Item - Item -->
    <li class="nav-item {{ (request()->is('admin-item')) ? 'active' : '' }}">
        <a class="nav-link " href=""
            @if ($title === 'Admin - List Item') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
            <i class="fas fa-fw fa-archive"></i>
            <span>Classrooms</span>
        </a>
    </li>

    <!-- Nav Item - Item -->
    <li class="nav-item {{ (request()->is('admin-item')) ? 'active' : '' }}">
        <a class="nav-link " href=""
            @if ($title === 'Admin - List Item') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
            <i class="fas fa-fw fa-archive"></i>
            <span>Students</span>
        </a>
    </li>

    <!-- Heading - User -->
    <div class="sidebar-heading">
        Debug
    </div>

    <!-- Nav Item  -->
    <li class="nav-item {{ (request()->is('admin-user')) ? 'active' : '' }}">
        <a class="nav-link " href="{{ route('teacher.debug.input_question') }}"
            @if ($title === 'Admin - List User') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
            <i class="fas fa-fw fa-user"></i>
            <span>Input Questions</span>
        </a>
    </li>

    <!-- Nav Item  -->
    <li class="nav-item {{ (request()->is('admin-user')) ? 'active' : '' }}">
        <a class="nav-link " href="{{ route('teacher.debug.answer_question') }}"
            @if ($title === 'Admin - List User') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
            <i class="fas fa-fw fa-user"></i>
            <span>Answer Question</span>
        </a>
    </li>

    {{-- <!-- Nav Item - Transaksi -->
    <li
        class="nav-item {{ (request()->is('transaksi*')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Transaksi</span>
        </a>
        <div id="collapseUtilities" class="collapse {{ (request()->is('transaksi*')) ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Green Investment:</h6>
                <a class="collapse-item {{ $title === 'Transaksi | Green Bond' ? 'active' : '' }}" href="{{ route('transaksi.greenbond') }}"
                    @if ($title === 'Transaksi | Green Bond') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>Green
                    Bond</a>
                <a class="collapse-item {{ $title === 'Transaksi | Green Sukuk' ? 'active' : '' }}" href="{{ route('transaksi.greensukuk') }}#"
                    @if ($title === 'Transaksi | Green Sukuk') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>Green
                    Sukuk</a>
                <a class="collapse-item {{ $title === 'Transaksi | Green Taxonomy' ? 'active' : '' }}" href="{{ route('transaksi.greentaxonomy') }}"
                    @if ($title === 'Transaksi | Green Taxonomy') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>Green
                    Taxonomy</a>
                <h6 class="collapse-header">Lainnya:</h6>
                <a class="collapse-item {{ $title === 'Transaksi | List Transaksi' ? 'active' : '' }}" href="#"
                    @if ($title === 'Transaksi | List Transaksi') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
                    List Transaksi</a>
            </div>
        </div>
    </li> --}}

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

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    {{-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components,
            and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to
            Pro!</a>
    </div> --}}

</ul>
