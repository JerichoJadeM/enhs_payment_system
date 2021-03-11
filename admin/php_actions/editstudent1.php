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
<link rel="icon" href="../assets/img/est.png" type="image/gif" sizes="16x16">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/style.css" rel="stylesheet">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
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
  <a class="navbar-brand" href="../index.php"><img src="../assets/img/est.png" width="25px">
      ENHS <small>Payment System</small></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../index.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../user.php">My Profile</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../students.php">Students <span class="sr-only">(current)</span></a>
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
            <img src="../assets/icons/person-circle.svg" width="25px" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="dropdown-menu mt-3" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" role="button" href="changepassword.php">Change Password</a>
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
            <div class="col-md-9">
                <h1>
                    <img src="../assets/icons/gear.svg" alt="" width="32" height="32" title="Bootstrap">
                    Students </small></h1>
            </div>
            <div class="col-md-3">
                <div class="create">
                    <a class="btn btn-light btn-block text-dark shadow" type="button" href="addstudent.php" data-toggle="modal" data-target="#addedit">
                        <strong>Add New Student</strong>
                    </a>
                  </div>
                </div>
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
                <li><a href="../index.php">Dashboard</a></li>
                <li><a href="../students.php">/Students</a></li>
                <li class="active">/Update Student Record</li>
            </ol>
        </div>
    </section>
    <?php
        if(isset($_GET['edit'])){
            $id = $_GET['edit'];

            $edit = "SELECT * FROM students WHERE LRN_number = '$id';";
            $editquery = mysqli_query($conn, $edit);

            $Redit = mysqli_fetch_assoc($editquery);
            $studentLRN = $Redit['LRN_number'];

          }
        ?>
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                            <div class="card-body gradient-color shadow">
                              <img src="../assets/img/est.png" alt="Estancia Logo" class="img-fluid rounded mx-auto d-block" height="100px">
                            </div>
                    </div>
                    <br>
                        <div class="card">
                          <div class="card-heading main-color-bg">
                            <h6 class="card-title lead">Payment History</h6>
                          </div>
                          <?php
                              $history = $conn->query("SELECT * FROM payment WHERE LRN = '$studentLRN' LIMIT 1") or die($conn->error());
                              $his = $history->fetch_assoc();

                              if($his==null){
                                 echo "<div class='card-body shadow mb-0'>
                                      <p class='lead text-center text-danger mb-0'><strong>No Payment</p>
                                      <p class='lead text-center text-danger mt-0'>History!</strong></p>
                                 </div>";
                              }
                              else{
                                $hisLRN = $his['LRN'];
                                $hisPtype = $his['payment_type'];
                                $hisAmount = $his['amount'];
                                $hisDate = $his['datepaid'];
                            ?>
                            <div class="card-body shadow mb-0">
                                    <p class="lead text-center"><strong>LRN#: </strong><?php echo $hisLRN;?></p>
                                    <p>Amount Paid <span class="badge badge-success float-right"><?php echo $hisAmount . ".00";?></span> </p>
                                    
                                    <p>Status <span class="badge badge-info float-right"><?php echo $hisPtype;?></span> </p>
                                    
                                    <p>Last Payment <span class="badge badge-warning float-right"><?php echo $hisDate;?></span> </p>
                            </div>
                            <?php  
                              }?>
                          </div>
                      <br>
                </div>
                <br>
                <div class="col-md-9">
                <!--Edit Student Information ||-->
                    <div class="card shadow p-3">
                        <div class="card-heading main-color-bg">
                            <h6 class="card-title lead text-center"><strong>Student Information</strong></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form action="process.php" class="needs-validation" method="GET" novalidate>
                                      <input type="hidden" value="<?php $Redit['LRN_number'];?>" name="student">
                                      <div class="row">
                                            <div class="col-md-12">
                                                <label class="lead"><strong>Student Full Name</strong></label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input type="text" class="form-control" name="fname" value="<?php echo $Redit['Fname'];?>" id="validationCustom03" placeholder="First Name" required>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>

                                            <div class="col-md-2 form-group">
                                                <input type="text" class="form-control" maxlength="1" name="mname" value="<?php echo $Redit['Mname'] . ".";?>" placeholder="M.I" required>
                                                <div class="invalid-feedback">
                                                    *Required
                                                </div>
                                            </div>

                                            <div class="col-md-5 form-group">
                                                <input type="text" class="form-control" name="lname" value="<?php echo $Redit['Lname'];?>" placeholder="Last Name" required>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>
                                      </div>

                                      <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label class="lead"><strong>Grade</strong></label>
                                                <input type="text" class="form-control" name="grade" value="<?php echo $Redit['GradeLevel'];?>" placeholder="Grade" readonly>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label class="lead"><strong>Section</strong></label>
                                                <input type="text" class="form-control" name="section" value="<?php echo $Redit['Section'];?>" placeholder="Section" readonly>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <label class="lead"><strong>LRN Number</strong></label>
                                                <input type="text" class="form-control" maxlength="13" name="LRN" value="<?php echo $Redit['LRN_number'];?>" placeholder="Student LRN number" readonly>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>
                                      </div>

                                      <div class="row">
                                            <div class="col-md-12">
                                                <label class="lead"><strong>Complete Address</strong></label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <input type="text" class="form-control" name="address" value="<?php echo $Redit['Address'];?>" placeholder="Address" required>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-md-7 form-group">
                                          <label class="lead"><strong>Parent/Guardian</strong></label>
                                          <input type="text" class="form-control" name="parent" value="<?php echo $Redit['GuardianName'];?>" placeholder="Name of parent" required>
                                            <div class="invalid-feedback">
                                                    Please fill up this field.
                                            </div>
                                        </div>

                                        <div class="col-md-5 form-group">
                                          <label class="lead"><strong>Parent/Guardian No.</strong></label>
                                          <input type="text" class="form-control" maxlength="11" name="parentNum" value="<?php echo $Redit['GuardianNum'];?>" placeholder="Parent's Contact number" required>
                                          <div class="invalid-feedback">
                                                    Please fill up this field.
                                            </div>
                                        </div>
                                      </div>

                                      <div class="row float-right">
                                        <div class="col-md-12 mx-auto">
                                            <a href="../students.php" type="button" class="btn btn-danger mt-1" name="cancel">Cancel</a>
                                            <button type="submit" class="btn btn-info mt-1" name="editstudent">Save Changes</button>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                                <div class="col-md-4 order-lg-last order-first">
                                  <div class="card mb-2">
                                    <img src="<?php echo "../../" . $Redit['student_pic'];?>" height="180px" width="180px" class="card-img-top mt-3 px-3" alt="Student Photo">
                                    <div class="card-body text-center">
                                      <div class="form-group mb-0">
                                        <form action="uploadstudent.php" method="POST" enctype="multipart/form-data">
                                          <input type="hidden" name="student" value="<?php echo $Redit['LRN_number'];?>"> 
                                          <label><strong>Upload New Photo</strong></label>
                                          <input type="file" class="form-control-file btn-outline-info" id="exampleFormControlFile1" name="img">
                                          <button class="btn btn-info btn-block mt-2 mb-0 btn-sm" name="studentpic">Upload</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer">
      Copyright &copy; 2019 - <script>document.write(new Date().getFullYear());</script> All rights reserved
    </footer>

    <!--MODALS--><!--MODALS--><!--MODALS--><!--MODALS--><!--MODALS--><!--MODALS--><!--MODALS--><!--MODALS--><!--MODALS-->
    <!-- Add Student -->
    <div class="modal fade" id="addedit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header main-color-bg">
            <h5 class="modal-title text-center" id="addedit">Add Student Record</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="card shadow p-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="process.php" class="needs-validation" method="POST" novalidate>
                                      <div class="row">
                                            <div class="col-md-12">
                                                <label class="lead"><strong>Student Full Name</strong></label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input type="text" class="form-control" name="fname" id="validationCustom03" placeholder="First Name" required>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>

                                            <div class="col-md-2 form-group">
                                                <input type="text" class="form-control" name="mname" placeholder="M.I" required>
                                                <div class="invalid-feedback">
                                                    *Required
                                                </div>
                                            </div>

                                            <div class="col-md-5 form-group">
                                                <input type="text" class="form-control" name="lname" placeholder="Last Name" required>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>
                                      </div>

                                      <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label class="lead"><strong>Grade</strong></label>
                                                <input type="text" class="form-control" name="grade" placeholder="Grade" required>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label class="lead"><strong>Section</strong></label>
                                                <input type="text" class="form-control" name="section" placeholder="Section" required>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <label class="lead"><strong>LRN Number</strong></label>
                                                <input type="text" class="form-control" name="LRN" placeholder="Student LRN number" required>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>
                                      </div>

                                      <div class="row">
                                            <div class="col-md-12">
                                                <label class="lead"><strong>Complete Address</strong></label>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <input type="text" class="form-control" name="address" placeholder="Address" required>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-md-7 form-group">
                                          <label class="lead"><strong>Parent/Guardian</strong></label>
                                          <input type="text" class="form-control" name="parent" placeholder="Name of parent" required>
                                            <div class="invalid-feedback">
                                              Please fill up this field.
                                            </div>
                                        </div>

                                        <div class="col-md-5 form-group">
                                          <label class="lead"><strong>Parent/Guardian No.</strong></label>
                                          <input type="text" class="form-control" name="parentNum" placeholder="Parent's Contact number" required>
                                          <div class="invalid-feedback">
                                                    Please fill up this field.
                                            </div>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-md-12 mx-auto">
                                            <button type="submit" class="btn btn-info btn-block mt-1" name="addstudent">Save Record</button>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
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

<script src="../assets/js/validation.js"></script>
<script src="../libraries/jquery/jquery-3.5.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
    <?php }?>
