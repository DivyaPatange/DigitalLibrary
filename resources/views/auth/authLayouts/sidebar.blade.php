<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
  <!-- <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div> -->
  <img src="{{ asset('adminAsset/img/logo1.png') }}"  width="180px">
  <!-- <div class="sidebar-brand-text">Sau. Leena Kishor Mamidwar Institute of Management Studies and Research</div> -->
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="{{ route('home') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Interface
</div>
@can('admin')
<!-- Nav Item - Tables -->
<li class="nav-item">
  <a class="nav-link" href="{{ route('admin.users.index') }}">
    <i class="fas fa-fw fa-user"></i>
    <span>Users</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="{{ route('admin.category.index') }}">
    <i class="fas fa-list"></i>
    <span>Category</span></a>
</li>
<!-- Nav Item - Tables -->
<li class="nav-item">
  <a class="nav-link" href="{{ route('admin.books.index') }}">
    <i class="fas fa-fw fa-table"></i>
    <span>All Books</span></a>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
  <i class="fas fa-fw fa-table"></i>
    <span>All Journal</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin.journals.index') }}">Journal Pdf File</a>
      <a class="collapse-item" href="{{ url('/admin/journal-list') }}">Add Journal</a>
    </div>
  </div>
</li>
<li class="nav-item">
  <a class="nav-link" href="{{ route('admin.videos.index') }}">
    <i class="fas fa-list"></i>
    <span>All Videos</span></a>
</li>
@endcan
@can('user')
<!-- Nav Item - Tables -->
<li class="nav-item">
  <a class="nav-link" href="{{ route('user.books.index') }}">
    <i class="fas fa-fw fa-table"></i>
    <span>All Books</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="{{ route('user.journals.index') }}">
    <i class="fas fa-fw fa-table"></i>
    <span>All Journals</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="{{ route('user.videos.index') }}">
    <i class="fas fa-list"></i>
    <span>All Videos</span></a>
</li>
<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Components</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Custom Components:</h6>
      <a class="collapse-item" href="buttons.html">Buttons</a>
      <a class="collapse-item" href="cards.html">Cards</a>
    </div>
  </div>
</li> -->
@endcan
<!-- Nav Item - Utilities Collapse Menu -->


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<!-- <div class="sidebar-heading">
  Addons
</div> -->

<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Pages</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Login Screens:</h6>
      <a class="collapse-item" href="login.html">Login</a>
      <a class="collapse-item" href="register.html">Register</a>
      <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
      <div class="collapse-divider"></div>
      <h6 class="collapse-header">Other Pages:</h6>
      <a class="collapse-item" href="404.html">404 Page</a>
      <a class="collapse-item" href="blank.html">Blank Page</a>
    </div>
  </div>
</li> -->

<!-- Nav Item - Charts -->
<!-- <li class="nav-item">
  <a class="nav-link" href="charts.html">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Charts</span></a>
</li> -->

<!-- Nav Item - Tables -->
<!-- <li class="nav-item">
  <a class="nav-link" href="tables.html">
    <i class="fas fa-fw fa-table"></i>
    <span>Tables</span></a>
</li> -->

<!-- Divider -->
<!-- <hr class="sidebar-divider d-none d-md-block"> -->

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>