<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- <li class="nav-item">
      <a href="/dashboard" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p class="text-light">Dashboard</p>
      </a>
    </li> -->
    <li class="nav-item">
      <a href="/puskesmas" class="nav-link">
        <i class="nav-icon fas fa-database"></i>
        <p class="text-light">Data Bantuan Sosial</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('monitoring.index') }}" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p class="text-light">Monitoring</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/auth/logout" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p class="text-light">Logout</p>
      </a>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->