
<?php
  include "include/header.php";
  include "include/navbar.php";
//   print_r($_SESSION);exit;   
?>

<?php if(isset($_SESSION['register_loginId'])) {?>
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
            <div class="col-3 userU">
                <p>
                <span><i class="fa fa-user-circle-o" style="font-size:30px;"></i></span> Hello <b style="color:black;"><?php echo ucfirst($_SESSION['register_name']) ?> </b>
                </p>
            </div>
            <div class="col-9">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            <h5>Personal Details :<span>*</span>&nbsp;&nbsp;&nbsp;<span id="edit" type='submit'>Edit</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-3"></div>
            <div class="col-9">                     
                <form action="">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name">
                                </div>                                                            
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-9">
                                    <label for="gender">Gender :</label>&nbsp;
                                    <input type="radio" name="gender" id="gender" value="male" checked> Male &nbsp;&nbsp;
                                    <input type="radio" name="gender" id="gender1" value="female"> Female &nbsp;&nbsp;
                                    <input type="radio" name="gender" id="gender2" value="other"> Other
                                </div>                                                         
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <label for="number">Mobile Number :</label>&nbsp;
                                    <input type="text" name="number" id="number" class="form-control" placeholder="Number">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md">
                                    <button class="btn border-secondary rounded-pill text-primary text-uppercase" id="suBbtn" type="button">submit</button>
                                </div>  
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Profile Page End -->

<?php } else {?>
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
            <div class="col-12 text-center">                     
                <h2> Please <a href="login.php">Login</a> </h2>
            </div>
        </div>
    </div>
</div>
<!-- Profile Page End -->
<?php }?>

<?php include "include/footer.php"; ?>
<?php include "include/footerJs.php"; ?>
<script>
    $(document).ready(function(){
        $('#name').prop('disabled', true);
        $('#lastName').prop('disabled', true);
        $('#gender').prop('disabled', true);
        $('#gender1').prop('disabled', true);
        $('#gender2').prop('disabled', true);
        $('#number').prop('disabled', true);
        $('#suBbtn').prop('disabled', true);
        $('#edit').click(function(){
            $('#name').prop('disabled', false);
            $('#lastName').prop('disabled', false);
            $('#gender').prop('disabled', false);
            $('#gender1').prop('disabled', false);
            $('#gender2').prop('disabled', false);
            $('#number').prop('disabled', false);
            $('#suBbtn').prop('disabled', false);
        });

    });
</script>
<?php include "include/footerEnd.php"; ?>