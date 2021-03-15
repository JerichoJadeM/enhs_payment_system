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
        body{
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
      .card-img{
          border-top-left-radius: 5%;
          border-bottom-left-radius: 5%;
      }
      .card{
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
                <img src="admin/assets/img/hs.jpg" class="card-img" height="64%" alt="display picture">
              </div>
              <div class="col-md-7 mt-4">
                <div class="card-body mx-auto">
                    <div class="col-md-7">
                        <img src="admin/assets/img/est.png" alt="Estancia Logo" class="img-fluid rounded d-block mx-auto" width="100px">
                    </div>
                  <h1 class="card-title">ENHS <small>Payment System</small></h1>
                  <?php
                    if(isset($_SESSION['message'])): ?>
                      <section id="breadcrumb mb-0">
                          <div class="alert alert-dismissible fade show alert-<?=$_SESSION['msg_type']?>" role="alert">
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
                            if(isset($_POST['submit'])){
                              $username = $_POST['username'];
                              $pass = $_POST['password'];

                              $sql = "SELECT userid, user_type FROM users WHERE username='$username' AND password='$pass' GROUP BY userid ASC;";
                              $result = $conn->query($sql);

                              $row = $result->fetch_assoc();
                              $count = $result->num_rows;

                              if($count == 1){
                                $_SESSION['alogin'] = $_POST['username'];
                                  if($row['user_type']=='Accountant'){
                                    header('location: users/acc/index.php');
                                  }
                                  elseif($row['user_type']=='Adviser'){
                                    header('location: users/adv/index.php');
                                  }
                                  else{
                                    header('location: admin/index.php');
                                  }  
                              }
                              else{
                                echo "<div class='col-md-8 pl-0'><div class='alert alert-warning alert-dismissible fade show mb-0' role='alert'>
                                <small>Username or Password is incorrect.</small>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div></div>";
                              }
                              
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
                            <button name="submit" class="btn btn-dark btn-outline-success btn-block shadow mb-4"><strong>Sign in</strong></button>
                        </form>
                        
                        <p class="mb-0">Forgot password?</p>
                        <p class="mb-5">Don't you have an account? <a href="#" type="button" data-toggle="modal" data-target="#message">Contact Us.</a></p>

                        <p class="mb-0"><a href="DevTeamProfile/index.html" target="_blank"><small>Powered by:</small> IICS Thesis Group VI</a></p>
                        <small>Copyright &copy; 2019 - <script>document.write(new Date().getFullYear());</script> All rights reserved.</small>
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

<script src="admin/assets/js/validation.js"></script>
<script src="admin/libraries/jquery/jquery-3.5.1.min.js"></script>
<script src="admin/assets/js/bootstrap.bundle.js"></script>
<script src="admin/assets/js/bootstrap.bundle.min.js"></script>
<script src="admin/assets/js/bootstrap.min.js"></script>
</body>
</html>
