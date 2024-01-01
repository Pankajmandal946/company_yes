<?php
// print_r($_SESSION);exit; ?>
<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6">Fruitables</h1></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="shop.php" class="nav-item nav-link">Shop</a>
                    <a href="shop_detail.php" class="nav-item nav-link">Shop Detail</a>
                    <!-- <a href="testimonial.php" class="nav-item nav-link">Testimonial</a> -->
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="cart.php" class="dropdown-item">Cart</a>
                            <a href="chackout.php" class="dropdown-item">Chackout</a>
                            <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                            <a href="404.php" class="dropdown-item">404 Page</a>
                        </div>
                    </div> -->
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                    <a href="cart.php" class="position-relative me-4 my-auto">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                    </a>
                    <a href="chackout.php" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>                        
                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                    </a>
                    <?php if(isset($_SESSION['register_loginId'])){ ?>
                    <button class="btn-view btn btn-md-square bg-white me-4" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="fa fa-user-circle-o fa-2x"></i></button>
                    <?php } else { ?>
                        <a href="login.php" class="log">
                        <button class="btn-view btn btn-md-square bg-white me-4"><i class="fa fa-user-circle-o fa-2x"></i></button>
                    </a>
                    <?php }?>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->


<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->

<!-- Modal View Start -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                <span class="dropdown-item text-center ">
                    <i class="fa fa-user-circle-o" style="font-size:50px;"></i>
                </span>
                    <!-- <i class="fa fa-user-circle-o profle"></i> -->
                    <span class="dropdown-item text-center">
                        <p><b><?php echo ucfirst($_SESSION['register_name']) ?></b></p>
                    </span>
                    <span class="d-flex justify-content-between">
                        <a href="#"><button class="btn btn-sm btn-info m-2" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</button></a>
                        <a href="#" class="btn btn-sm btn-warning w-100 m-2">Change Password</a>
                    </span>
                    <span class="d-flex justify-content-center">
                        <a href="logout.php" class="btn btn-sm btn-danger w-100 m-2" style="width:cover;">Log Out</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal View End -->

<!-- Modal Profile Start -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <img src="theme/img/user/<?php echo (file_exists("theme/img/user/" . strtolower(substr($_SESSION['register_name'], 0, 1)) . ".png")) ? strtolower(substr($_SESSION['register_name'], 0, 1)) : 'def' ?>.png" style="width:10%; box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75); margin-top: 30px; border-radius: 50%; margin-left: 335px;"/>
                <!-- <div class="input-group w-75 mx-auto d-flex">
                    <span class="dropdown-item text-center ">
                        <i class="fa fa-user-circle-o" style="font-size:50px;"></i>
                    </span>
                    <span class="dropdown-item text-center">
                        <p><b><?php echo ucfirst($_SESSION['register_name']) ?></b></p>
                    </span>
                    <span class="d-flex justify-content-between">
                        <a href="#" class="btn btn-sm btn-info m-2"><button class="btn-view btn btn-md-square bg-white me-4" data-bs-toggle="modal" data-bs-target="#viewModal">Profile</button></a>
                        <a href="#" class="btn btn-sm btn-warning w-100 m-2">Change Password</a>
                    </span>
                    <span class="d-flex justify-content-center">
                        <a href="logout.php" class="btn btn-sm btn-danger w-100 m-2" style="width:cover;">Log Out</a>
                    </span>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- Modal Profile End -->