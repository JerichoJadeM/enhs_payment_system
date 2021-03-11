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

  <!-- Custom styles -->
  <link href="../assets/css/admin.style.css" rel="stylesheet">
  <link href="../assets/css/simple-sidebar.css" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

  <script src="../libraries/ckeditor/ckeditor.js"></script>
    
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
        <a href="payment.php" class="list-group-item list-group-item-action main-color-bg text-light"><img src="../assets/icons/cash.svg" width="20px"> Payment</a>
        <a href="#" class="list-group-item list-group-item-action main-color-bg text-light" data-toggle="collapse" data-target="#demo"><img src="../assets/icons/book-half.svg" width="20px"> User Activities <img src="../assets/icons/plus.svg" class="float-right" width="20px"></a>
        <div id="demo" class="collapse show">
          <a href="../activity.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="../assets/icons/calendar-check.svg" width="20px"> Most Recent</a>
          <a href="../inquiries.php" class="list-group-item list-group-item-action bg-info text-light pl-5"><img src="../assets/icons/chat.svg" width="20px"> Inquiries</a>
        </div>
        <a href="#" class="list-group-item list-group-item-action main-color-bg text-light" data-toggle="collapse" data-target="#demo1"><img src="../assets/icons/people-fill.svg" width="20px"> Users <img src="../assets/icons/plus.svg" class="float-right" width="20px"></a>
        <div id="demo1" class="collapse">
          <a href="../users.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="../assets/icons/list.svg" width="20px"> All Users</a>
          <a href="../users.php" class="list-group-item list-group-item-action main-color-bg text-light pl-5"><img src="../assets/icons/person-plus.svg" width="20px"> Add User</a>
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
              $fetch_user = "SELECT fname, mname, lname, user_type, photo_file  FROM users WHERE username='$user';";
              $result = $conn->query($fetch_user);
              $row = $result->fetch_assoc();
              
              $fname = $row['fname'];
              $mname = $row['mname'];
              $lname = $row['lname'];
              $usertype = $row['user_type'];
              $photo = $row['photo_file'];

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
                    <img src="../assets/icons/chat.svg" alt="" width="32" height="32" title="Bootstrap">
                    Message</h1>
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
        if(isset($_GET['edit'])){
            $id = $_GET['edit'];

            $edit = "SELECT * FROM messages WHERE id = '$id';";
            $editquery = mysqli_query($conn, $edit);

            $Redit = mysqli_fetch_assoc($editquery);
            $msg = $Redit['id'];

          }
        ?>
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <!--Edit Student Information ||-->
                    <div class="card">
                        <div class="card-header mb-0">
                            <div class="row">    
                                <div class="col">
                                    <h6 class="card-title lead mb-0"><strong>Subject: </strong><small><?php echo $Redit['Subject']?></small></h6>
                                </div>
                                <div class="col">
                                    <h6 class="card-title lead text-right mb-0"><strong>Date: </strong><?php echo $Redit['dateRecieved']?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="myForm" action="sendEmail.php" class="needs-validation" method="POST" novalidate>
                                      <input type="hidden" value="<?php echo $Redit['id'];?>" name="id">
                                      <input type="hidden" name="name" value="<?php echo $Redit['name']?>">
                                      <input type="hidden" name="position" value="<?php echo $Redit['position']?>">
                                      <input type="hidden" name="email" value="<?php echo $Redit['email']?>">
                                      <div class="row">
                                            <div class="col-md-12">
                                                <label class="mb-0"><strong>Sender Name</strong></label>
                                            </div>
                                            <div class="col-md-5">
                                                <p class="lead text-center"><?php echo $Redit['name'];?></p>
                                            </div>
                                      </div>

                                      <div class="row">
                                            <div class="col-md-3">
                                                <label class="mb-0"><strong>Position</strong></label>
                                                <p class="lead text-center"><?php echo $Redit['position'];?></p>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="mb-0"><strong>Email Address</strong></label>
                                                    <p class="lead text-center"><?php echo $Redit['email'];?></p>
                                            </div>
                                      </div>

                                      <div class="row">
                                            <div class="col-md-12 form-group">
                                                <div class="card px-5 pt-1">
                                                <p><?php echo $Redit['message'];?></p>
                                                </div>
                                            </div>
                                      </div>
                                      <div class="row">
                                            <div class="col-md-12">
                                                <div class="card shadow">
                                                    <div class="card-header bg-light">
                                                      <span><img src="../../<?php echo $photo?>" class="rounded-circle ml-1 mr-2" width="40px"></span><img src="../assets/icons/arrow-90deg-left.svg"> <?php echo "<i>Replyng to:</i> <strong>" . $Redit['name'] . "</strong> " . "(" . $Redit['email'] . ")"; ?>
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="form-group mb-0">
                                                        <input type="text" name="subject" class="form-control mb-1 mt-0" placeholder="Type your subject here..." required>
                                                          <div class="invalid-feedback mb-1">
                                                             Your message must have a subject.
                                                          </div>
                                                      </div>
                                                        <div class="form-group mb-0">
                                                            <textarea name="editor" class="form-control mb-0" required></textarea>
                                                              <div class="invalid-feedback mb-1">
                                                                You must type your response.
                                                              </div>
                                                            <script>
                                                                CKEDITOR.replace( 'editor', {
                                                                    uiColor: '#9AB8F3'
                                                                });
                                                            </script>
                                                        </div>
                                                    </div>
                                                    <div class="row mr-0 mt-0">
                                                        <div class="col-md-12 mb-0">
                                                            <button type="submit" class="btn btn-info mt-0 mb-2 float-right" name="reply">Send Reply</button>
                                                        </div>
                                                    </div>
                                                </div>
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
    </section>
    <footer id="footer">
      Copyright &copy; 2019 - <script>document.write(new Date().getFullYear());</script> All rights reserved
    </footer>

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
