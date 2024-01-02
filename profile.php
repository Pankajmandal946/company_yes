
<?php
  include "include/header.php";
  include "include/navbar.php";
//   print_r($_SESSION);exit;   
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Profile</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="profile.php">Pages</a></li>
        <li class="breadcrumb-item active text-white">Profile Detail</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Profile Page Start -->
<div class="container-fluid py-5 bg-light rounded">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-3 bg-white p-3">                     
                <i class="fa fa-user-circle-o" style="font-size:30px;"></i>
                <p style="margin-left: 36px; margin-top: -29px;">
                    Hello <b style="color:black;"><?php echo ucfirst($_SESSION['register_name']) ?> </b>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Profile Page End -->

<?php include "include/footer.php"; ?>
<?php include "include/footerJs.php"; ?>