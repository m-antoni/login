<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon">
      <i class="fas fa-user-circle"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Companyname</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{route('dashboard')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Heading -->
{{--   <div class="sidebar-heading">
    Register Users
  </div>
 --}}

  
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#messagescollapse" aria-expanded="true" aria-controls="messagescollapse">
      <i class="fas fa-fw fa-envelope"></i>
      <span>Inbox</span>
    </a>
    <div id="messagescollapse" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Messages:</h6>
        <a class="collapse-item" href="#">Compose</a>
        <a class="collapse-item" href="#">View</a>
      </div>
    </div>
  </li>
  
    <!-- Divider -->
  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-users"></i>
      <span>Register</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
{{--         <h6 class="collapse-header">Custom Components:</h6> --}}
        <a class="collapse-item" href="{{route('register.index')}}">Users</a>
        <a class="collapse-item" href="{{route('register.create')}}">Add New</a>
        <a class="collapse-item" href="{{ route('employees')}}">Employees</a>
        <a class="collapse-item" href="{{ route('interns')}}">Interns</a>
      </div>
    </div>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
{{--   <div class="sidebar-heading">
    Addons
  </div> --}}

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span>Logs</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">LIST OF ALL:</h6>
        <a class="collapse-item" href="{{ route('logs.index')}}">View All</a>
        <a class="collapse-item" href="{{ route('active')}}">Active</a>
        <a class="collapse-item" href="{{ route('inactive')}}">Inactive</a>
        <a class="collapse-item" href="{{ route('late')}}">Late</a>
        <a class="collapse-item" href="{{ route('under')}}">Under Time</a>
      </div>
    </div>
  </li>
  
  <!-- Divider -->
  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link" href="{{route('testqrcode')}}">
      <i class="fas fa-fw fa-qrcode"></i>
      <span>Tester</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{route('about')}}">
      <i class="fas fa-fw fa-table"></i>
      <span>About</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar