<?php
  session_start();
  include("../../includes/config.php");
  if(strlen($_SESSION['alogin'])==0){
    header('location: ../../../index.php?error=must_signin_first.');
  }
  else{
    $user = $_SESSION['alogin'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Administrator Page of Miscellaneous Payment System">
  <meta name="author" content="Jericho Jade Madolid and Thesis Group 6">

  <title>ENHS | System Administrator</title>

  <link rel="icon" href="../assets/img/est.png" type="image/gif" sizes="16x16">

  <!-- Custom styles for this template -->
  <link href="../assets/css/admin.style.css" rel="stylesheet">
  <link href="../assets/css/simple-sidebar.css" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      #chart_wrap {
      position: relative;
      padding-bottom: 67%;
      height: 0;
      overflow:hidden;
        }

        #donutchart {
            position: absolute;
            top: 0;
            left: 0;
            right:0;
            bottom:0;
            width:100%;
            height:350px;
        }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="main-color-bg" id="sidebar-wrapper">
      <div class="sidebar-heading text-light main-color-bg"><img src="../assets/img/est.png" width="50px"><strong> ENHS Payment</strong></div>
      <div class="list-group list-group-flush">
        <p class="list-group-item list-group-item-action main-color-bg text-light text-center lead mb-0">Navigation</p>
        <a href="../index.php" class="list-group-item list-group-item-action main-color-bg text-light"><img src="../assets/icons/bar-chart-steps.svg" width="20px"> Dashboard</a>
        <a href="payment.php" class="list-group-item list-group-item-action bg-info text-light"><img src="../assets/icons/cash.svg" width="20px"> Payment</a>
        <a href="#" class="list-group-item list-group-item-action main-color-bg text-light" data-toggle="collapse" data-target="#demo"><img src="../assets/icons/book-half.svg" width="20px"> User Activities <img src="../assets/icons/plus.svg" class="float-right" width="20px"></a>
        <div id="demo" class="collapse">
          <a href="../activity.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="../assets/icons/calendar-check.svg" width="20px"> Most Recent</a>
          <a href="../inquiries.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="../assets/icons/chat.svg" width="20px"> Inquiries</a>
        </div>
        <a href="#" class="list-group-item list-group-item-action main-color-bg text-light" data-toggle="collapse" data-target="#demo1"><img src="../assets/icons/people-fill.svg" width="20px"> Users <img src="../assets/icons/plus.svg" class="float-right" width="20px"></a>
        <div id="demo1" class="collapse">
          <a href="../users.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="../assets/icons/list.svg" width="20px"> All Users</a>
          <a href="#" type="button" data-toggle="modal" data-target="#createAdmin" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="../assets/icons/person-plus.svg" width="20px"> Add User</a>
        </div>
        <a href="#" class="list-group-item list-group-item-action main-color-bg text-light" data-toggle="collapse" data-target="#demo2"><img src="../assets/icons/person-badge.svg" width="20px"> Students <img src="../assets/icons/plus.svg" class="float-right" width="20px"></a>
        <div id="demo2" class="collapse">
          <a href="../students.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="../assets/icons/list-check.svg" width="20px"> All Students</a>
          <a href="#" type="button" data-toggle="modal" data-target="#addedit" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="../assets/icons/person-plus.svg" width="20px"> Add Student</a>
          <a type="button" target="_blank" href="student-list.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="../assets/icons/printer.svg" width="20px"> Print List</a>
        </div>
        <a href="../profile.php" class="list-group-item list-group-item-action main-color-bg text-light"><img src="../assets/icons/pencil.svg" width="20px"> My Profile</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-dark main-color-bg">
        <button class="btn" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span><img src="../assets/icons/arrow-down.svg" width="20px"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <?php
              $fetch_user = "SELECT fname, mname, lname, user_type  FROM users WHERE username='$user';";
              $result = $conn->query($fetch_user);
              $row = $result->fetch_assoc();
              
              $fname = $row['fname'];
              $mname = $row['mname'];
              $lname = $row['lname'];
              $usertype = $row['user_type'];

              ?>
              <a class="nav-link text-light"><strong>Welcome, <?php echo $fname;?></strong></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="../assets/icons/person-circle.svg" width="25px" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="php_actions/changepassword.php">Change Password</a>
                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#logout">Logout</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Cancel</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    
    <header id="header">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>
                    <img src="../assets/icons/cash.svg" alt="" width="32" height="32" title="Bootstrap">
                    Payment</h1>
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
<?php endif?>
<?php
    $studentLRN = "XXXXXXXXXXXXX";
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
          echo "<section id='breadcrumb'>
          <div class='container'>
            <div class='alert alert-dismissible fade show alert-danger role='alert'>
            Student Record Not Found!
              <button type='button' class='close' data-dismiss='alert' arial-label='close'>
                <span aria-hidden='true'>&times;</span>
              </button>
          </div>
        </section>";
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
   <!--Process of student payment-->
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3 order-lg-last order-first">
                        <button class="btn btn-block btn-outline-dark mb-2" data-toggle="modal" data-target="#newpayment">New Transaction</button>
                        <div class="card">
                          <div class="card-heading main-color-bg">
                            <h6 class="card-title lead">Payment History</h6>
                          </div>
                            <?php
                              //Show current miscellaneous fee
                              $sqlMiscFee = $conn->query("SELECT fee FROM miscfee") or die($conn->error());
                              $miscResult = $sqlMiscFee->fetch_assoc();
                              $currentMiscFee = $miscResult['fee'];

                              $history = $conn->query("SELECT * FROM payment WHERE LRN = '$studentLRN' LIMIT 1") or die($conn->error());
                              $his = $history->fetch_assoc();

                              if($his==null){
                                 echo "<div class='card-body shadow mb-0'>
                                      <p class='lead text-center text-danger mb-0'><strong>No</p>
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
                                <form action="printR.php" method="POST">
                                    <p class="lead text-center"><strong>LRN#: </strong><?php echo $hisLRN;?></p>
                                    <input type="hidden" name="LRN" value="<?php echo $hisLRN;?>">
                                    <p>Amount Paid <span class="badge badge-success float-right"><?php echo "₱" . $hisAmount . ".00";?></span> </p>
                                    
                                    <p>Status <span class="badge badge-info float-right"><?php echo $hisPtype;?></span> </p>
                                    
                                    <p>Last Payment <span class="badge badge-warning float-right"><?php echo $hisDate;?></span></p>
                                    
                                    <p>Remaining Balance: &nbsp;<?php echo "₱" . $remainingBal . ".00";?></p>

                                    <button class ="btn btn-info btn-block btn-sm" name="print" type="submit">Print Receipt</button>
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
                                    <form class="needs-validation" method="POST" action="printReceipt.php" novalidate>
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
                                            <p class="text-info mb-1">Saving Options:</p>
                                        </div>
                                        <!--Radio Button-->
                                        <div class="row mx-auto">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="customControlValidation1" name="example" value="1" required>
                                                <label class="custom-control-label" name="send" for="customControlValidation1"><small>Send SMS & Print Receipt</small></label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="customControlValidation2" name="example" value="2" required>
                                                <label class="custom-control-label" name="send" for="customControlValidation2"><small>Only Send SMS Notification</small></label>
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

<!-- New Payment -->
<div class="modal fade" id="newpayment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header main-color-bg">
            <h5 class="modal-title Lead" id="newpayment"><strong>New Payment</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row mx-auto">
              <div class="col-md-12">
                <div class="create">
                <form method="POST" class="needs-validation" novalidate>
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Enter Student LRN No." aria-label="Search" required>
                    <div class="invalid-feedback">
                        Please enter student LRN
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" name="payment" class="btn btn-outline-success">Proceed</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--Create User-->
    <div class="modal fade" id="createAdmin" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header main-color-bg">
            <h5 class="modal-title" id="createAdmin">New User Creation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <form action="php_actions/process.php" class="needs-validation" method="POST" novalidate>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" maxlength="10" placeholder="Enter Username" required>
                                    <div class="invalid-feedback">
                                      Choose valid username.
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                                    <div class="invalid-feedback">
                                      Choose valid password.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <hr class="col-md-11"><!--Guhit-->
                              <h5 class="lead text-center text-info mb-1"><strong>Personal Information</strong></h5>
                              <div class="row">
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="ufname" placeholder="Enter First Name" required>
                                    <div class="invalid-feedback">
                                      Please enter first name.
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="ulname" placeholder="Enter Last Name" required>
                                    <div class="invalid-feedback">
                                      Please enter last name.
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label>M.I</label>
                                    <input type="text" class="form-control" maxlength="1" name="umname" placeholder="M.I" required>
                                    <div class="invalid-feedback">
                                      *Requried.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <script>
                                  //on selection
                                    function random1(){
                                      var a=document.getElementById('input').value;
                                          if(a === '7'){
                                              var array=['Aguinaldo','Bonifacio', 'Lapu-Lapu', 'Rizal'];
                                          }
                                          else if(a === '8'){
                                            var array=['Amber','Diamond','Emerald', 'Pearl'];
                                          }
                                          else if(a === '9'){
                                            var array=['Eagle','Hawk','Ostrich', 'Parrot'];
                                          }
                                          else if(a === '10'){
                                            var array=['Aristotle','Einstein','Newton', 'Tesla'];
                                          }
                                          else if(a === 'Not Applicable'){
                                            var array=['Not Applicable'];
                                          }
                                          else{
                                              var array=['Please Select'];
                                          }
                                           var string="";
                                            for(i=0;i<array.length;i++){
                                              string=string+"<option>"+array[i]+"</option>";
                                            }
                                            string="<select name='usection'>"+string+"</select>";
                                          document.getElementById('output').innerHTML=string;
                                        }
                                      </script>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>User Type</label>
                                    <select class="form-control" name="usertype" required>
                                      <option>--Select User type--</option>
                                      <option>Accountant</option>
                                      <option>Adviser</option>
                                    </select>
                                    <div class="valid-feedback">
                                      Please select user type.
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label>Grade</label>
                                    <select class="form-control" name="ugrade" id="input" onchange="random1()" required>
                                        <option>Select Grade</option>
                                        <option>Not Applicable</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                       <option>10</option>
                                    </select>
                                      
                                    <div class="invalid-feedback">
                                      Select option that apply.
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-5">
                                  <div class="form-group">
                                  <label>Section</label>
                                  <select class="form-control" name="usection" id="output" required>
                                    <option>Select Section</option>
                                    </select>
                                  </div>
                                  <div class="valid-feedback">
                                      Select Option that apply.
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" maxlength="11" name="uphone" placeholder="Enter your phone number" required>
                                    <div class="invalid-feedback">
                                      Phone number required.
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-7">
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="uemail" placeholder="Enter email address" required>
                                    <div class="invalid-feedback">
                                      Please enter email address.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="uaddress" placeholder="Enter Address" required>
                                    <div class="invalid-feedback">
                                      Please enter address.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="ucity" placeholder="City" required>
                                    <div class="invalid-feedback">
                                      Enter City.
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" class="form-control" name="ucountry" placeholder="Country" required>
                                    <div class="invalid-feedback">
                                      Please enter country.
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="number" class="form-control" name="upostal" placeholder="ZIP Code" required>
                                    <div class="invalid-feedback">
                                      *Requred.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row float-right">
                                <div class="col-md-12">
                                  <button class="btn btn-warning mt-3 mb-2" data-dismiss="modal">Cancel</button>
                                  <button class="btn btn-info mt-3 mb-2" type="submit" name="addUser">Add New User</button>
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
                                                <input type="text" class="form-control" maxlength="1" name="mname" placeholder="M.I" required>
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
                                      <script>
                                      //on selection
                                        function random(){
                                          var a=document.getElementById('input1').value;
                                            if(a === '7'){
                                                var array=['Aguinaldo','Bonifacio', 'Lapu-Lapu', 'Rizal'];
                                            }
                                            else if(a === '8'){
                                              var array=['Amber','Diamond','Emerald', 'Pearl'];
                                            }
                                            else if(a === '9'){
                                              var array=['Eagle','Hawk','Ostrich', 'Parrot'];
                                            }
                                            else if(a === '10'){
                                              var array=['Aristotle','Einstein','Newton', 'Tesla'];
                                            }
                                            else{
                                                var array=['Please Select'];
                                            }

                                            var string="";
                                            for(i=0;i<array.length;i++){
                                              string=string+"<option>"+array[i]+"</option>";
                                            }
                                            string="<select name='lol'>"+string+"</select>";
                                          document.getElementById('output1').innerHTML=string;
                                        }
                                      </script>
                                      <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label class="lead"><strong>Grade</strong></label>
                                                <select class="form-control" name="grade" id="input1" onchange="random()" required>
                                                  <option>Select Grade</option>
                                                  <option>7</option>
                                                  <option>8</option>
                                                  <option>9</option>
                                                  <option>10</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label class="lead"><strong>Section</strong></label>
                                                <select class="form-control" name="section" id="output1" required>
                                                  <option>Select Section</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please fill up this field.
                                                </div>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <label class="lead"><strong>LRN Number</strong></label>
                                                <input type="text" class="form-control" maxlength="13" name="LRN" placeholder="Student LRN number" required>
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
                                          <input type="text" class="form-control" maxlength="11" name="parentNum" placeholder="Parent's Contact number" required>
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
    



      </div>
    </div>

<script src="../assets/js/validation.js"></script>
<script src="../libraries/jquery/jquery-3.5.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script>
  // Add the following code if you want the name of the file appear on select
  $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
</body>
</html>
<?php }?>
