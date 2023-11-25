<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="home.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a> -->
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <!-- Profile Nav start -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user-circle-o" style="font-size:22px;"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item text-center ">
                    <i class="fa fa-user-circle-o" style="font-size:50px;"></i>
                </a>
                <span class="dropdown-item text-center">
                    <p><b><?php echo ucfirst($_SESSION['c_x_name']); ?></b></p>
                    <p><?php echo ucfirst($_SESSION['c_x_user_type']); ?></p>
                </span>
                <span class="d-flex justify-content-between">
                    <a href="#" class="btn btn-sm btn-info w-100 m-2">Profile</a>
                    <a href="modify_password.php" class="btn btn-sm btn-warning w-100 m-2">Change Password</a>
                </span>
                <span class="d-flex justify-content-center">
                    <a href="logout.php" class="btn btn-sm btn-danger w-100 m-2" style="width:cover;">Log Out</a>
                </span>
            </div>
        </li>
        <!-- Profile Nav End -->
        <!-- fullscreen & control-sidebar -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
        <!-- /.fullscreen & control-sidebar -->
    </ul>
</nav>
<!-- /.navbar -->