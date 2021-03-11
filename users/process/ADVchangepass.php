<?php
  session_start();
  include("../../includes/config.php");
  if(strlen($_SESSION['alogin'])==0){
    header('location: ../../index.php?error=must_signin_first.');
  }
  else{
    $user = $_SESSION['alogin'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Public School Miscellaneous Payment System">
    <meta name="author" content="Jericho Jade B. Madolid and Thesis Group 6">

    <title>ENHS | Change Password</title>

    <!-- Styling -->
<link rel="icon" href="../../admin/assets/img/est.png" type="image/gif" sizes="16x16">
<link href="../../admin/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../../admin/assets/css/style.css" rel="stylesheet">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      .error {color: #FF0000;}

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-default fixed-top">
      <a class="navbar-brand" href="../acc/index.php"><img src="../../admin/assets/img/est.png" width="25px">
      ENHS <small>Payment System</small></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../adv/index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../adv/user.php">My Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../adv/students.php">Students</a>
      </li>
    </ul>

    <ul class="navbar-nav">
        <li class="nav-item">
        <?php
            $fetch_user = "SELECT fname FROM users WHERE username='$user';";
            $result = $conn->query($fetch_user);
            $row = $result->fetch_assoc();
            
            $fname = $row['fname'];

          ?>
          <a class="nav-link"><strong>Welcome, <?php echo $fname;?></strong></a>
        </li>
        <li class="nav-item">
          <div class="btn-group dropleft mt-1">
            <img src="../../admin/assets/icons/person-circle.svg" width="25px" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="dropdown-menu mt-3" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" type="button" data-toggle="modal" data-target="#logout">Logout</a>
              <a class="dropdown-item" href="#">Cancel</a>
            </div>
          </div>
        </li>
      </ul>
  </div>
</nav>

<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>
                    <img src="../../admin/assets/icons/gear.svg" alt="" width="32" height="32" title="Bootstrap">
                    Account Settings </small></h1>
            </div>
        </div>
    </div>
</header>

    <section id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="../adv/index.php">Home</a></li>
                <li class="active">/Change Password</li>
            </ol>
        </div>
    </section>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                            <div class="card-body gradient-color shadow">
                              <img src="../../admin/assets/img/est.png" alt="Estancia Logo" class="img-fluid rounded mx-auto d-block" height="100px">
                            </div>
                    </div>
                </div>
                <br>
                <div class="col-md-9">
                <!--Change Password Confirmation with Validation and backend functionalities|| This section is the same section in dashboard overview-->
                <?php
                    if(isset($_POST['changepass'])){
                    
                    $changePass = "SELECT password FROM users WHERE username = '$user';";
                    $changepass_result = $conn->query($changePass);
                    $showpass = $changepass_result->fetch_assoc();

                    $oldpass = $showpass['password'];
                        
                    if($oldpass == $_POST['oldpass']){
                        $newpass = $_POST['newpass'];
                        $confirmnewpass = $_POST['confirmnewpass'];

                        if($_POST['newpass'] == $_POST['confirmnewpass']){
                            $updatepass = "UPDATE users SET password = '$newpass' WHERE username='$user' AND password='$oldpass'";
                            
                            $update_result = $conn->query($updatepass);
                                echo "<div class='col-md-12-fluid'><div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <p class='text-dark mb-0'>Congratulations! Your new password is set!</p>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                            </div></div>";
                            
                        }
                        else{
                            echo "<div class='col-md-12-fluid'><div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <p class='text-danger mb-0'>Your password did not match!</p>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div></div>";
                        }
                    }else{
                        echo "<div class='col-md-12-fluid'><div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <p class='text-danger mb-0'>Your old password is incorrect.</p>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div></div>";
                    }
                    }

                ?>
                    <div class="card shadow p-3">
                        <div class="card-heading main-color-bg">
                            <h6 class="card-title text-center lead"><strong>Change Password</strong></h6>
                        </div>
                        <div class="card-body">
                            <h5 class="lead text-info"><strong>Note:</strong><small> Please always put a strong password.</small></h5>
                            <form class="needs-validation" method="POST" action="" name="ChangePassword" novalidate>  
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group text-center"> 
                                        <label class="lead"><strong>Old Password</strong></label>
                                    </div>
                                    <div class="col-md-7 form-group">
                                        <input type="password" class="form-control" id="validationCustom03" name="oldpass" placeholder="Your old password" required>
                                        <div class="invalid-feedback">
                                              Old Password is required.
                                        </div>
                                    </div>
                                </div>
                                <hr class="col-md-10-fluid main-color-bg">
                                <br>
                                <div class="row">
                                    <div class="col-md-4 form-group text-center"> 
                                        <label class="lead"><strong>New Password</strong></label>
                                    </div>
                                    <div class="col-md-7 form-group">
                                        <input type="password" class="form-control" id="validationCustom03" name="newpass" placeholder="Your new password" required>
                                        <div class="invalid-feedback">
                                              New Password is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group text-center"> 
                                        <label class="lead"><strong>Confirm Password</strong></label>
                                    </div>
                                    <div class="col-md-7 form-group">
                                        <input type="password" class="form-control" id="validationCustom03" name="confirmnewpass" placeholder="confirm new password" required>
                                        <div class="invalid-feedback">
                                              Confirm Password is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-5 mx-auto">
                                    <button type="submit" class="btn btn-info btn-block mt-1" name="changepass">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
      Copyright &copy; 2019 - <script>document.write(new Date().getFullYear());</script> All rights reserved
    </footer>

    <!-- Logout -->
    <div class="modal fade" id="logout" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header main-color-bg">
            <h5 class="modal-title" id="logout">Logout</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            You're About to Logout.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cancel</button>
            <form action="../../includes/logout.php" method="POST">
            <button type="submit" name="logout" class="btn btn-outline-danger">Proceed</button>
            </form>
          </div>
        </div>
      </div>
    </div>

<script src="../../admin/assets/js/validation.js"></script>
<script src="../../admin/libraries/jquery/jquery-3.5.1.min.js"></script>
<script src="../../admin/assets/js/bootstrap.bundle.js"></script>
<script src="../../admin/assets/js/bootstrap.bundle.min.js"></script>
<script src="../../admin/assets/js/bootstrap.min.js"></script>
</body>
</html>
    <?php }?>
