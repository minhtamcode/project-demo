<!-- Brand Logo -->
<a href="index.php" class="brand-link">
  <img src="dist/img/q.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
  <span class="brand-text font-weight-light"><strong>THU CHI CÁ NHÂN</strong></span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">Nguyễn Minh Tâm</a>
    </div>
  </div>

  <!-- SidebarSearch Form -->
  <div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <li class="nav-item menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Danh mục quản lý
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="collect-mng.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Quản lý thu nhập</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="expense-mng.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Quản lý chi tiêu</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="statistical.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Thông kê - Báo cáo</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Danh mục
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Items-Collect.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục thu nhập</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Items-Expense.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh mục chi tiêu</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>