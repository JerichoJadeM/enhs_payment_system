<?php
session_start();
include("includes/config.php");
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Public School Miscellaneous Payment System">
  <meta name="author" content="Jericho Jade B. Madolid and Thesis Group 6">

  <title>ENHS | Login Account</title>

  <!-- Styling -->
  <link rel="icon" href="admin/assets/img/est.png" type="image/gif" sizes="16x16">
  <link href="admin/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="admin/assets/css/style.css" rel="stylesheet">

  <style>
    body {
      background-color: #333333;
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .card-img {
      border-top-left-radius: 5%;
      border-bottom-left-radius: 5%;
    }

    .card {
      border-radius: 5%;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
</head>

<body>
  <div class="container mt-4">
    <div class="card mb-3 shadow mx-auto" style="max-width: 90%; max-height:100%;">
      <div class="row no-gutters">
        <div class="col-md-5 d-sm-none d-md-block d-none d-sm-block">
          <img src="admin/assets/img/hs.jpg" class="card-img h-100" alt="display picture">
        </div>
        <div class="col-md-7 mt-4">
          <div class="card-body mx-auto">
            <div class="col-md-7">
              <img src="admin/assets/img/est.png" alt="Estancia Logo" class="img-fluid rounded d-block mx-auto" width="100px">
            </div>
            <h1 class="card-title">ENHS <small>Payment System</small></h1>
            <?php
            if (isset($_SESSION['message'])) : ?>
              <section id="breadcrumb mb-0">
                <div class="alert alert-dismissible fade show alert-<?= $_SESSION['msg_type'] ?>" role="alert">
                  <?php
                  echo $_SESSION['message'];
                  unset($_SESSION['message']);
                  ?>
                  <button type="button" class="close" data-dismiss="alert" arial-label="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </section>
            <?php endif ?>
            <?php
            if (isset($_POST['submit'])) {
              $username = $_POST['username'];
              $pass = $_POST['password'];

              $sql = "SELECT userid, user_type FROM users WHERE username='$username' AND password='$pass' GROUP BY userid ASC;";
              $result = $conn->query($sql);

              $row = $result->fetch_assoc();
              $count = $result->num_rows;

              if ($count == 1) {
                $_SESSION['alogin'] = $_POST['username'];
                if ($row['user_type'] == 'Accountant') {
                  header('location: users/acc/index.php');
                } elseif ($row['user_type'] == 'Adviser') {
                  header('location: users/adv/index.php');
                } else {
                  header('location: admin/index.php');
                }
              } else {
                echo "<div class='col-md-8 pl-0'><div class='alert alert-warning alert-dismissible fade show mb-0' role='alert'>
                      <small>Username or Password is incorrect.</small>
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span> </button>
                      </div></div>";
              }
            }

            if(isset($_POST['addUser'])){

              $username = $_POST['rusername'];
              $ufname = $_POST['ufname'];
              $umname = $_POST['umname'];
              $ulname = $_POST['ulname'];
              $utype = $_POST['usertype'];
              $ugrade = $_POST['ugrade'];
              $usection = $_POST['usection'];
              $uphone = $_POST['uphone'];
              $uemail = $_POST['uemail'];
      
              $sql = $conn->query("INSERT INTO users
              (username, fname, mname, lname, phone, user_type, grade, section, email)
              VALUES
              ('$username', '$ufname', '$umname', '$ulname', '$uphone', '$utype', '$ugrade', '$usection', '$uemail')") or
               die($conn->error);
              
              if ($sql) {
                echo "<div class='col-md-8 pl-0'><div class='alert alert-success alert-dismissible fade show mb-0' role='alert'>
                      <small> Your account is now waiting on approval please check your email regularly.</small>
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span> </button>
                      </div></div>";
              } else {
                echo "<div class='col-md-8 pl-0'><div class='alert alert-danger alert-dismissible fade show mb-0' role='alert'>
                      <small> Registration Unsuccessful, Please try again;</small>
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span> </button>
                      </div></div>";
              }   
              $conn->close();
          }
            ?>
            <div class="row">
              <div class="col-md-7">
                <h4 class="mt-4 mb-3">Sign into your account</h4>
                <form class="needs-validation" method="POST" novalidate>
                  <div class="mb-3 form-group">
                    <input type="text" class="form-control" id="validationCustom03" name="username" placeholder="@username" required>
                    <div class="invalid-feedback">
                      Valid username is required!
                    </div>
                  </div>
                  <div class="mb-3 form-group">
                    <input type="password" name="password" class="form-control" placeholder="***********" required>
                    <div class="invalid-feedback">
                      Valid password is required!
                    </div>
                  </div>

                  <button name="submit" class="btn btn-dark btn-outline-success btn-block shadow"><strong>Sign in</strong></button>
                </form>

                <!-- <?php
                if (isset($_POST['demoSubmit'])) {
                  $userDemo = $_POST['userDemo'];
                  $passDemo = $_POST['passDemo'];

                  $sql = "SELECT userid, user_type FROM users WHERE username='$userDemo' AND password='$passDemo' GROUP BY userid ASC;";
                  $result = $conn->query($sql);

                  $row = $result->fetch_assoc();
                  $count = $result->num_rows;

                  if ($count == 1) {
                    $_SESSION['alogin'] = $_POST['userDemo'];
                    header('location: admin/index.php');
                  }
                }
                ?>

                <form method="POST">
                  INPUTS FOR DEMO
                  <input type="hidden" name="userDemo" value="admin1">
                  <input type="hidden" name="passDemo" value="admin1">
                  <button name="demoSubmit" class="btn btn-dark btn-outline-success btn-block shadow mb-4"><strong>Demo</strong></button>
                </form>  -->
                <p class="mb-1"><a href="reset_password.php">Forgot Password</a> | <a href="#" type="button" data-toggle="modal" data-target="#register">Register</a></p>
                <p class="mb-5">For inquiries <a href="#" type="button" data-toggle="modal" data-target="#message">Contact Us.</a></p>

                <p class="mb-0"><a href="DevTeamProfile/index.html" target="_blank">Powered by: IICS Thesis Group VI</a></p>
                Copyright &copy; 2019 - <script>
                    document.write(new Date().getFullYear());
                  </script> All rights reserved.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Messages -->
  <div class="modal fade" id="message" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header main-color-bg">
          <h5 class="modal-title" id="message">Send us a message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="admin/php_actions/sendinquiry.php" method="POST" class="needs-validation" novalidate>
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
              <div class="invalid-feedback">
                Please enter your full name.
              </div>
            </div>

            <div class="form-group">
              <label>Position</label>
              <select class="form-control" name="position" required>
                <option>--select--</option>
                <option>Accountant</option>
                <option>Adviser</option>
              </select>
              <div class="valid-feedback">
                Please select position.
              </div>
            </div>

            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" name="phone" placeholder="Enter your phone number" required>
              <div class="invalid-feedback">
                Please enter your valid Phone number.
              </div>
            </div>

            <div class="form-group">
              <label>Email Address</label>
              <input type="email" class="form-control" name="email" placeholder="Enter your email address" required>
              <div class="invalid-feedback">
                Please enter valid email address.
              </div>
            </div>

            <div class="form-group">
              <label>Subject</label>
              <input type="text" class="form-control" name="subject" placeholder="Message Subject" required>
              <div class="invalid-feedback">
                Please input subject.
              </div>
            </div>

            <div class="form-group">
              <label>Your Message</label>
              <textarea class="form-control" name="inquiry" placeholder="Type your message here..." required></textarea>
              <div class="invalid-feedback">
                Tell us your concern.
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" name="send" class="btn btn-outline-info">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="register" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header main-color-bg">
          <h5 class="modal-title" id="createAdmin">User Registration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <form class="needs-validation" method="POST" novalidate>
              <div class="row">
                <div class="col-md-2"><label>Username</label></div>
                <div class="col-md-7">
                  <div class="form-group">
                    <input type="text" class="form-control" name="rusername" maxlength="10" placeholder="Enter your desired username" required>
                    <div class="invalid-feedback">
                      Choose valid username.
                    </div>
                  </div>
                </div>
              </div>
              <hr class="col-md-11">
              <!--Guhit-->
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
                function random1() {
                  var a = document.getElementById('input').value;
                  if (a === '7') {
                    var array = ['Aguinaldo', 'Bonifacio', 'Lapu-Lapu', 'Rizal'];
                  } else if (a === '8') {
                    var array = ['Amber', 'Diamond', 'Emerald', 'Pearl'];
                  } else if (a === '9') {
                    var array = ['Eagle', 'Hawk', 'Ostrich', 'Parrot'];
                  } else if (a === '10') {
                    var array = ['Aristotle', 'Einstein', 'Newton', 'Tesla'];
                  } else if (a === 'Not Applicable') {
                    var array = ['Not Applicable'];
                  } else {
                    var array = ['Please Select'];
                  }
                  var string = "";
                  for (i = 0; i < array.length; i++) {
                    string = string + "<option>" + array[i] + "</option>";
                  }
                  string = "<select name='usection'>" + string + "</select>";
                  document.getElementById('output').innerHTML = string;
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
              <div class="row float-right">
                <div class="col-md-12">
                  <button class="btn btn-warning mt-3 mb-2" data-dismiss="modal">Cancel</button>
                  <button class="btn btn-info mt-3 mb-2" type="submit" name="addUser">Register</button>
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

  <script src="admin/assets/js/validation.js"></script>
  <script src="admin/libraries/jquery/jquery-3.5.1.min.js"></script>
  <script src="admin/assets/js/bootstrap.bundle.js"></script>
  <script src="admin/assets/js/bootstrap.bundle.min.js"></script>
  <script src="admin/assets/js/bootstrap.min.js"></script>
</body>

</html>