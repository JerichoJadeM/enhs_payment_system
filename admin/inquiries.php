<?php
  session_start();
  include("../includes/config.php");
  if(strlen($_SESSION['alogin'])==0){
    header('location: ../index.php?error=must_signin_first.');
  }
  else{
    $user = $_SESSION['alogin'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ENHS | System Administrator</title>

  <link rel="icon" href="assets/img/est.png" type="image/gif" sizes="16x16">

  <!-- Custom styles for this template -->
  <link href="assets/css/admin.style.css" rel="stylesheet">
  <link href="assets/css/simple-sidebar.css" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
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
      <div class="sidebar-heading text-light main-color-bg"><img src="assets/img/est.png" width="50px"><strong> ENHS Payment</strong></div>
      <div class="list-group list-group-flush">
        <p class="list-group-item list-group-item-action main-color-bg text-light text-center lead mb-0">Navigation</p>
        <a href="index.php" class="list-group-item list-group-item-action main-color-bg text-light"><img src="assets/icons/bar-chart-steps.svg" width="20px"> Dashboard</a>
        <a href="php_actions/payment.php" class="list-group-item list-group-item-action main-color-bg text-light"><img src="assets/icons/cash.svg" width="20px"> Payment</a>
        <a href="#" class="list-group-item list-group-item-action main-color-bg text-light" data-toggle="collapse" data-target="#demo"><img src="assets/icons/book-half.svg" width="20px"> User Activities <img src="assets/icons/plus.svg" class="float-right" width="20px"></a>
        <div id="demo" class="collapse show">
          <a href="activity.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="assets/icons/calendar-check.svg" width="20px"> Most Recent</a>
          <a href="inquiries.php" class="list-group-item list-group-item-action bg-info text-light pl-5"><img src="assets/icons/chat.svg" width="20px"> Inquiries</a>
        </div>
        <a href="#" class="list-group-item list-group-item-action main-color-bg text-light" data-toggle="collapse" data-target="#demo1"><img src="assets/icons/people-fill.svg" width="20px"> Users <img src="assets/icons/plus.svg" class="float-right" width="20px"></a>
        <div id="demo1" class="collapse">
          <a href="users.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="assets/icons/list.svg" width="20px"> All Users</a>
          <a href="#" type="button" data-toggle="modal" data-target="#createAdmin" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="assets/icons/person-plus.svg" width="20px"> Add User</a>
        </div>
        <a href="#" class="list-group-item list-group-item-action main-color-bg text-light" data-toggle="collapse" data-target="#demo2"><img src="assets/icons/person-badge.svg" width="20px"> Students <img src="assets/icons/plus.svg" class="float-right" width="20px"></a>
        <div id="demo2" class="collapse">
          <a href="students.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="assets/icons/list-check.svg" width="20px"> All Students</a>
          <a href="#" type="button" data-toggle="modal" data-target="#addedit" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="assets/icons/person-plus.svg" width="20px"> Add Student</a>
          <a type="button" target="_blank" href="php_actions/student-list.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="assets/icons/printer.svg" width="20px"> Print List</a>
        </div>
        <a href="profile.php" class="list-group-item list-group-item-action main-color-bg text-light"><img src="assets/icons/pencil.svg" width="20px"> My Profile</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-dark main-color-bg">
        <button class="btn" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span><img src="assets/icons/arrow-down.svg" width="20px"></span>
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
              <img src="assets/icons/person-circle.svg" width="25px" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                    <img src="assets/icons/chat.svg" alt="" width="32" height="32" title="Bootstrap">
                    Inquiries</h1>
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
  <section id="main">
        <div class="container">
            <div class="row">
                     <!--Latest Activity-->
                  <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                          <div class="table-responsive-sm">
                            <table class="table table-striped table-sm">
                                <thead>
                                  <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Date</th>
                                    <th scope="col" class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $act = $conn->query("SELECT * FROM messages GROUP BY id DESC LIMIT 20") or die($conn->error);
                                  $count = 1;
                                ?>
                                <?php while($row = $act->fetch_assoc()): ?>
                                  <tr>
                                    <td scope="row"><?php echo $count;?></td>
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['Subject'];?></td>
                                    <td><?php echo $row['message'];?></td>
                                    <td><?php echo $row['dateRecieved'];?></td>
                                    <td class="text-center">
                                    <a class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="View"  type="submit" name="view" href = "php_actions/reply.php?edit=<?php echo $row['id'];?>"><img src="assets/icons/eye.svg" width="15px"></a>
                                      <button type="button" data-toggle="tooltip" data-placement="top" title="Delete" data-toggle="modal" class="btn btn-sm btn-outline-danger delete"><img src="assets/icons/trash.svg" width="15px"></button>
                                    </td>
                                  </tr>
                                  <?php $count++; endwhile;?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="container-fluid" id="footer">
      Copyright &copy; 2019 - <script>document.write(new Date().getFullYear());</script> All rights reserved
    </footer>
  </div>
    <!--MODALS-->
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
                                    function random(){
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
                                            string="<select name='lol'>"+string+"</select>";
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
                                    <select class="form-control" name="ugrade" id="input" onchange="random()" required>
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
                                  <select class="form-control" name="section" id="output" required>
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
                                    <form action="../process/process.php" class="needs-validation" method="POST" novalidate>
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
                                            else{
                                                var array=['Please Select'];
                                            }

                                            var string="";
                                            for(i=0;i<array.length;i++){
                                              string=string+"<option>"+array[i]+"</option>";
                                            }
                                            string="<select name='lol'>"+string+"</select>";
                                          document.getElementById('output').innerHTML=string;
                                        }
                                      </script>
                                      <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label class="lead"><strong>Grade</strong></label>
                                                <select class="form-control" name="grade" id="input" onchange="random()" required>
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
                                                <select class="form-control" name="section" id="output" required>
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
    <!-- Delete Student -->
    <div class="modal fade" id="delete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header main-color-bg">
            <h5 class="modal-title" id="delete">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="php_actions/process.php" method="POST">
          <div class="modal-body">
                <input type="hidden" name="id" id="id">
            Confirm to delete message.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cancel</button>
            <button type="submit" name="deleteMsg" class="btn btn-outline-danger">Confirm</a>
            </form>
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
            <form action="../includes/logout.php" method="POST">
            <button type="submit" name="logout" class="btn btn-outline-danger">Proceed</button>
            </form>
          </div>
        </div>
      </div>
    </div>

<script src="assets/js/validation.js"></script>
<script src="libraries/jquery/jquery-3.5.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
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
  <script>
    //Delete function
    $(document).ready(function(){
        $('.delete').on('click', function(){
          $('#delete').modal('show');
            
            $tr=$(this).closest('tr');

            var data=$tr.children('td').map(function(){
              return $(this).text();
            }).get();

            console.log(data);

            $('#id').val(data[1]);
        });
    });
    </script>
</body>
</html>
  <?php }?>
