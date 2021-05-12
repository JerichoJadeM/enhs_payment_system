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

    <title>ENHS | Payment</title>

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
      <li class="nav-item">
        <a class="nav-link" href="user.php">My Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="students.php">Students</a>
      </li>
    </ul>

    <ul class="navbar-nav">
        <li class="nav-item">
        <?php
            $fetch_user = "SELECT fname, mname, lname, user_type FROM users WHERE username='$user';";
            $result = $conn->query($fetch_user);
            $row = $result->fetch_assoc();
            
            $fname = $row['fname'];
            $mname = $row['mname'];
            $lname = $row['lname'];
            $usertype = $row['user_type'];

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
            <div class="col-md-8">
                <h1>
                    <img src="../../admin/assets/icons/cash.svg" alt="" width="32" height="32" title="Bootstrap">
                    Payment </small></h1>
            </div>
            <div class="col-md-4">
              <div class="create">
                <form class="form-inline my-2 my-lg-0" method="POST">
                  <input class="form-control mr-sm-2" type="search" name="search" placeholder="Enter Student LRN No." aria-label="Search" required>
                  <button class="btn btn-info my-2 my-sm-0" type="submit" name="payment">New Payment</button>
                </form>
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
                <li class="active">Transaction</li>
            </ol>
        </div>
    </section>
    <!--Process of student payment-->
<?php
  $studentLRN = "";
      $Lname = "";
      $Mname = "";
      $Fname = "";
      $Grade = "";
      $Section = "";
      $GuardianNum = "";
      $GuardianName = "";
      $Address = "";
      $student_pic = "images/img/est.png";
  if(isset($_POST['payment'])){
    $search = $_POST['search'];

    $result = $conn->query("SELECT * FROM students WHERE LRN_number = '$search'") or die($conn->error);
    $row = $result->fetch_assoc();
    $count = $result->num_rows;
    if($count==0){   
      $_SESSION['message'] = "No student Record!";
      $_SESSION['msg_type'] = "danger";

      header("location: index.php");
    }
    else{
      
      $studentLRN = $row['LRN_number'];
      $Lname = $row['Lname'];
      $Mname = $row['Mname'];
      $Fname = $row['Fname'];
      $Grade = $row['GradeLevel'];
      $Section = $row['Section'];
      $GuardianNum = $row['GuardianNum'];
      $GuardianName = $row['GuardianName'];
      $Address = $row['Address'];
      $student_pic= $row['student_pic'];
    }
    
  }
?>
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                            <div class="card-body gradient-color shadow d-sm-none d-md-block d-none d-sm-block">
                              <img src="../../admin/assets/img/est.png" alt="Estancia Logo" class="img-fluid rounded mx-auto d-block" height="100px">
                            </div>
                    </div>
                    <br>
                        <div class="card">
                          <div class="card-heading main-color-bg">
                            <h6 class="card-title lead">Payment History</h6>
                          </div>
                            <?php
                              // Display for the CURRENT Miscellaneous Value 
                              $sqlMiscFee = $conn->query("SELECT fee FROM miscfee") or die($conn->error());
                              $miscResult = $sqlMiscFee->fetch_assoc();
                              $currentMiscFee = $miscResult['fee'];

                              $history = $conn->query("SELECT * FROM payment WHERE LRN = '$studentLRN' LIMIT 1") or die($conn->error());
                              $his = $history->fetch_assoc();

                              if($his==null){
                                 echo "<div class='card-body shadow mb-0'>
                                      <p class='lead text-center text-danger mb-0'><strong>Search for</p>
                                      <p class='lead text-center text-danger mt-0'>Record</strong></p>
                                 </div>";
                              }
                              else{
                                $hisLRN = $his['LRN'];
                                $hisPtype = $his['payment_type'];
                                $hisAmount = $his['amount'];
                                $hisDate = $his['datepaid'];

                                $remainingBal = $currentMiscFee - $hisAmount;
                            ?>
                            <div class="card-body shadow mb-0">
                                <form action="../process/ADVprintR.php" method="POST">
                                    <p class="lead text-center"><strong>LRN#: </strong><?php echo $hisLRN;?></p>
                                    <input type="hidden" name="LRN" value="<?php echo $hisLRN;?>">
                                    <p>Amount Paid <span class="badge badge-success float-right"><?php echo $hisAmount . ".00";?></span> </p>
                                    
                                    <p>Status <span class="badge badge-info float-right"><?php echo $hisPtype;?></span> </p>
                                    
                                    <p>Last Payment <span class="badge badge-warning float-right"><?php echo $hisDate;?></span></p>

                                    <p>Remaining Balance: &nbsp;<?php echo "₱" . $remainingBal . ".00";?></p>

                                   <!-- <button class ="btn btn-info btn-block btn-sm" name="print" type="submit">Print Receipt</button> -->
                                </form>
                            </div>
                            <?php  
                              }?>
                          </div>
                      <br>
                </div>

                <div class="col-md-9">
                <!--Payment Confirmation with Validation || This section is the same section in dashboard overview-->
                
                    <div class="card shadow p-3">
                        <div class="card-heading main-color-bg">
                            <h6 class="card-title text-center lead">Confirm Payment Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form class="needs-validation" method="POST" action="../process/ADVprintReceipt.php" novalidate>
                                      <input type="hidden" name="user" value="<?php echo $fname . " " . $mname . "." . " " . $lname; ?>">
                                      <input type="hidden" name="usertype" value="<?php echo $usertype;?>">
                                      <input type="hidden" name="lrn" value="<?php echo $row['LRN_number']?>">
                                      <input type="hidden" name="fname" value="<?php echo $row['Fname']?>">
                                      <input type="hidden" name="mname" value="<?php echo $row['Mname']?>">
                                      <input type="hidden" name="lname" value="<?php echo $row['Lname']?>">
                                      <input type="hidden" name="grade" value="<?php echo $row['GradeLevel']?>">
                                      <input type="hidden" name="section" value="<?php echo $row['Section']?>">
                                      <input type="hidden" name="address" value="<?php echo $row['Address']?>">
                                      <input type="hidden" name="phone" value="<?php echo $row['GuardianNum']?>">
                                      
                                      <div class="row">
                                        <div class="col-md-7 form-group">
                                          <h6>Full Name:</h6>
                                          <p class="lead text-center mb-0"><?php echo $Fname . " " . $Mname . ". " . $Lname;?></p>
                                        </div>

                                        <div class="col-md-5 form-group">
                                          <h6>Grade & Section:</h6>
                                          <p class="lead mb-0"><?php echo $Grade . " - " . $Section;?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-md-3">
                                          <h6>Billing Address</strong></h6>
                                        </div>
                                        <div class="col-md-9">
                                          <p><?php echo $Address;?></p>
                                        </div>
                                      </div>

                                      <hr class="col-md-10-fluid main-color-bg mt-0"><!--Separator--> 
                                      <div class="row mx-auto">
                                        <div class="col-md-5 form-group">
                                          <label for="validationCustom03"><strong>Payment Type</strong></label>
                                            <select class="form-control" id="validationCustom03" name="payment_type" required>
                                                <option readonly>--Payment Type--</option>
                                                <option>Full Payment</option>
                                                <option>Partial Payment</option>
                                                <option>Promi</option>
                                            </select>
                                            <div class="valid-feedback">
                                              Choose payment type.
                                            </div>
                                        </div>

                                        <div class="col-md-5 form-group">
                                          <label for="validationCustom03"><strong>Amount</strong></label>
                                          <input type="text" class="form-control" id="validationCustom03" name="amount" placeholder="Enter Amount" required>
                                            <div class="invalid-feedback">
                                            Enter amount, 0 if its a promi.
                                            </div>
                                        </div>
    
                                        <div class="col-md-10">
                                            <p class="text-info mb-1">Other Options:</p>
                                        </div>
                                        <!--Radio Button-->
                                        <div class="row mx-auto">
                                           <!-- <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="customControlValidation1" name="example" value="1" required>
                                                <label class="custom-control-label" name="send" for="customControlValidation1"><small>Send SMS & Print Receipt</small></label>
                                            </div> -->
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="customControlValidation2" name="example" value="2" required>
                                                <label class="custom-control-label" name="send" for="customControlValidation2"><small>Send SMS Notification</small></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="customControlValidation3" name="example" value="3" required>
                                                <label class="custom-control-label" name="send" for="customControlValidation3"><small>Save Only</small></label>
                                            </div>
                                        </div>
                                      </div><!--End of row-->
                                        <div class="row mx-auto">
                                            <button class="btn btn-outline-info btn-block mt-3" type="submit" name="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="col-md-4 order-lg-last order-first">
                                  <div class="card mt-2">
                                    <img src="<?php echo "../../" . $student_pic;?>" height="180px" width="180px" class="card-img-top img-fluid mt-2 px-3" alt="Student Photo">
                                    <div class="card-body">
                                          <h5 class="text-center text-info"><strong>Student LRN</strong></h5>
                                          <p class="lead text-center mb-0"><strong><?php echo $studentLRN;?></strong></p>
                                        </div>
                                  </div><br>
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
