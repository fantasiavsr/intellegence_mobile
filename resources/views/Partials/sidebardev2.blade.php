<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" {{-- style="background-color: #4FBEAB" --}}>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ 'user' }}">
        <div class="sidebar-brand-icon pt-3">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            <img class="img" src="{{ asset('img/gv-text-dark.png') }}" alt="" style="width: 83%">
        </div>
        {{-- <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-2">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('user')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}"
            @if ($title === 'Dashboard') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading  -->
    <div class="sidebar-heading">
        Item
    </div>

    <!-- Nav Item - Item -->
    <li class="nav-item {{ (request()->is('asubdmin-item')) ? 'active' : '' }}">
        <a class="nav-link " href="{{ route('subadmin.item') }}"
            @if ($title === 'Admin - List Item') style="color: #4FBEAB; background-color:#F9FAFC;  border-right: 8px solid #4FBEAB;" @endif>
            <i class="fas fa-fw fa-archive"></i>
            <span>List Item</span>
        </a>
    </li>



</ul>
