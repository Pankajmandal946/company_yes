<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link" style="text-align: center;">
        <span class="brand-text font-weight-bold">Backend Panal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        CASE WHEN u.user_type IN('Manager') THEN if(u2.user_short_name='',LEFT(  u2.user_name,16),u2.user_short_name)
        ELSE ifnull(if(u1.user_short_name='',LEFT(  u1.user_name,16),u1.user_short_name),
        if(u2.user_short_name='',LEFT(  u2.user_name,16),u2.user_short_name)) END as hod, -->
        <!-- /.SidebarSearch Form -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="home.php" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open">
                    <a href="user.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="user_type.php" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            UserType
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="fruit_cate.php" class="nav-link">
                        <i class="nav-icon fas fa-leaf"></i>
                        <p>
                            Categories of Fruit
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.Main Sidebar Container -->