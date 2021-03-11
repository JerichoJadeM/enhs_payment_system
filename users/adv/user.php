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

    <title>Admin | Dashboard</title>

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
      .custom-file-label{
        padding-left:-100px;
      }
  
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>

  <body>
  <nav class="navbar navbar-expand-md navbar-default fixed-top">
  <a class="navbar-brand" href="index.php"><img src="../../admin/assets/img/est.png" width="25px">
    ENHS <small>Payment System</small></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="user.php">My Profile <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="students.php">Students</a>
      </li>
    </ul>

    <ul class="navbar-nav">
        <li class="nav-item">
        <?php
            $fetch_user = "SELECT * FROM users WHERE username='$user';";
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
                  <a class="dropdown-item" role="button" href="../process/ADVchangepass.php">Change Password</a>
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
            <div class="col-md-12">
                <h1>
                    <img src="../../admin/assets/icons/person.svg" alt="" width="32" height="32" title="Bootstrap">
                    User Profile</h1>
            </div>
        </div>
    </div>
</header>
<?php
  if(isset($_SESSION['message'])): ?>
    <section id="breadcrumb">
      <div class="container">
        <div class="alert alert-dismissible fade show alert-<?=$_SESSION['msg_type']?>" role="alert">
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          ?>
          <button type="button" class="close" data-dismiss="alert" arial-label="close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    </section>
  <?php endif ?>
    <section id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">/Profile</li>
            </ol>
        </div>
    </section>

    <section id="main">
        <div class="container">
            <div class="row">
                <!--Section For User Profile-->
                <?php
                  $user_result = $conn->query("SELECT * FROM users WHERE username='$user' ") or die($conn->error);
                  
                ?>
                  <?php while($row=$user_result->fetch_assoc()):
                    $id=$row['userid'];
                    ?>
                      <div class="col-md-8">
                        <div class="card shadow p-3">
                          <div class="card-heading main-color-bg">
                            <h5 class="title lead"><strong>Manage User Information</strong></h5>
                          </div>
                          <div class="card-body">
                            <form action="../process/edit-user.php" method="GET" enctype="multipart/form-data">
                              <input type="hidden" value="<?php echo $id;?>" name="userid">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $user?>" readonly>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="fname" value="<?php echo $row['fname'];?>">
                                  </div>
                                </div>
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="lname" value="<?php echo $row['lname'];?>">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label>M.I</label>
                                    <input type="text" class="form-control" maxlength="1" name="mname" value="<?php echo $row['mname'];?>">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-7">
                                  <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>">
                                  </div>
                                </div>
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>Phone #</label>
                                    <input type="text" class="form-control" maxlength="11" name="phone" value="<?php echo $row['phone'];?>">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" value="<?php echo $row['city'];?>">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" class="form-control" name="country" value="<?php echo $row['country'];?>">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="number" class="form-control" name="postal" value="<?php echo $row['postal_code'];?>">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>About Me</label>
                                    <textarea rows="4" cols="80" class="form-control" name="about"><?php echo $row['about'];?></textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="row float-right">
                                <div class="col">
                                  <button type="submit" name="edituser" class="btn btn-info mt-2">Save Changes</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 order-lg-last order-first">
                        <div class="card shadow p-3">
                          <div class="image">
                            <img src="../../admin/assets/img/bg5.png" class="img-fluid  mx-auto d-block" alt="background" />
                          </div>
                          <div class="card-body text-center">
                            <div class="author">
                                <img class="img-fluid rounded-circle mx-auto img-thumbnail d-block" style="margin-top:-100px; margin-bottom: 20px; width:200px; height:200px;" src="<?php echo "../../" . $row['photo_file'];?>" width="200px" alt="Profile Picture" />
                                <h4 class="text-center text-primary create"><?php echo $row['fname'] . " " . $row['mname'] . ". " . $row['lname'];?></h4>
                              
                              <p class="description lead mb-0">
                              <strong><?php echo $row['user_type'];?></strong>
                              </p>
                              <p><?php echo $row['grade'] . " - " . $row['section'];?></p>
                            </div>
                            <p class="description text-center">
                            "<?php echo $row['about'];?>"
                            </p>
                            <hr>
                            <div class="row">
                              <div class="col">
                                <form action="../process/upload.php" method="POST" enctype="multipart/form-data">
                                  <input type="hidden" name="userid" value="<?php echo $row['userid'];?>">
                                  <input type="file" class="form-control-file btn-outline-info" name="img">
                                  <button class="btn btn-info btn-block mt-2 mb-0 btn-sm" type="submit" name="upload">Upload New Photo</button>
                                </form>
                              </div>
                          </div>
                        </div>
                      </div>
                  <?php endwhile;?>
                 <!--Latest Activity Section Removed from this page-->
            </div>
        </div>
    </section>

    <footer id="footer">
        Copyright &copy; 2019 - <script>document.write(new Date().getFullYear());</script> All rights reserved
    </footer>

    <!--MODALS-->
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

<script src="../../admin/libraries/jquery/jquery-3.5.1.min.js"></script>
<script src="../../admin/assets/js/bootstrap.bundle.js"></script>
<script src="../../admin/assets/js/bootstrap.bundle.min.js"></script>
<script src="../../admin/assets/js/bootstrap.min.js"></script>

<script>
  // Add the following code if you want the name of the file appear on select
  $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
  </script>

</body>
</html>
  <?php }?>
