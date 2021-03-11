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

    <title>Admin | Students</title>

    <!-- Styling -->
<link rel="icon" href="../../admin/assets/img/est.png" type="image/gif" sizes="16x16">
<link href="../../admin/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../../admin/assets/css/style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../admin/libraries/DataTables/datatables.css">

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
      <li class="nav-item active">
        <a class="nav-link" href="students.php">Students <span class="sr-only">(current)</span></a>
      </li>
    </ul>

    <ul class="navbar-nav">
        <li class="nav-item">
        <?php
            $fetch_user = "SELECT fname, mname, lname, user_type, grade, section  FROM users WHERE username='$user';";
            $result = $conn->query($fetch_user);
            $row = $result->fetch_assoc();
            
            $fname = $row['fname'];
            $mname = $row['mname'];
            $lname = $row['lname'];
            $usertype = $row['user_type'];
            $tGrade = $row['grade'];
            $tSection = $row['section'];

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
                    <img src="../../admin/assets/icons/file-person-fill.svg" alt="" width="32" height="32" title="Bootstrap">
                    Advisee </small></h1>
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
                <li class="active">/Students</li>
            </ol>
        </div>
    </section>

    <section id="main">
        <div class="container">
                     <!--Student List || Data Tables information of students-->
                    <div class="card shadow">
                        <div class="card-heading main-color-bg">
                            <h6 class="card-title lead"><strong>Section: </strong><?php echo $row['section']?></h6>
                        </div>
                        <div class="card-body">
                          <div class="row mx-auto">
                            <div class="colmb-2 mt-0">
                              <a class="btn btn-outline-info shadow" type="button" data-toggle="modal" data-target="#addedit">
                               <strong>Add Student</strong>
                               </a>
                            </div>
                            <div class="col mb-2 mt-0">
                              <a class="btn btn-outline-info shadow" type="button" target="_blank" href="../process/ADVstudent-list.php">
                               <strong>Print Master List</strong>
                              </a>
                            </div>
                          </div>
                          <div class="table-responsive">
                            <table id="studentTable" class="table table-hover nowrap table-sm" style="width:100%">  
                              <thead>
                                  <tr>
                                    <th scope="col" class="text-center">No.</th>
                                    <th scope="col" class="text-center">LRN Number</th>
                                    <th scope="col" class="text-center">Student Name</th>
                                    <th scope="col" class="text-center">Guardian</th>
                                    <th scope="col" class="text-center">Guardian #</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $result = $conn->query("SELECT LRN_number, Lname, Mname, Fname, GradeLevel, Section, GuardianName, GuardianNum, amount FROM students
                                  INNER JOIN payment on students.LRN_number = payment.LRN WHERE GradeLevel = '$tGrade' AND Section = '$tSection'") or die($conn->error);
                                  $count = 1;
                                ?>
                                <?php while($row = $result->fetch_assoc()): 
                                  ?>
                                    <?php
                                      $payment = $row['amount'];
                                      if($payment == 700){
                                        $payStat = "<p class='text-success mb-0'>Full Paid</p>";
                                      }
                                      elseif($payment>=350){
                                        $payStat = "<p class='text-primary mb-0'>Partial Paid</p>";
                                      }
                                      elseif(($payment<=150)&&($payment>=1)){
                                        $payStat = "<p class='text-warning mb-0'>Promi</p>";
                                      }
                                      else{
                                        $payStat = "<p class='text-danger mb-0'>Not yet paid</p>";
                                      }
                                      
                                    ?>
                                  <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row['LRN_number']?></td>
                                    <td><?php echo $row['Lname'] . ", " . $row['Fname'] . " " . $row['Mname'] . "."?></td>
                                    <td><?php echo $row['GuardianName']?></td>
                                    <td><?php echo $row['GuardianNum']?></td>
                                    <td><?php echo $payStat; ?></td>
                                    <td>
                                    <a class="btn btn-info btn-sm"  type="submit" name="edit" href = "../process/ADVedit-student.php?edit=<?php echo $row['LRN_number'];?>">Edit</a>
                                      <button type="button" data-toggle="modal" class="btn btn-sm btn-danger delete">Delete</button>
                                    </td>
                                  </tr>
                                <?php $count++; endwhile;?>
                                </tbody>
                              </table>
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
          <form action="../process/process.php" method="POST">
          <div class="modal-body">
                <input type="hidden" name="LRN" id="LRN">
            Are you sure you want to delete this record? Action cannot undo.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cancel</button>
            <button type="submit" name="delete" class="btn btn-outline-danger">Proceed</a>
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
            <form action="../../includes/logout.php" method="POST">
            <button type="submit" name="logout" class="btn btn-outline-danger">Proceed</button>
            </form>
          </div>
        </div>
      </div>
    </div>

<script src="../../admin/assets/js/validation.js"></script>
<script src="../../admin/libraries/jquery/jquery-3.5.1.min.js"></script>
<script src="../../admin/libraries/DataTables/datatables.js"></script>
<script src="../../admin/assets/js/bootstrap.bundle.js"></script>
<script src="../../admin/assets/js/bootstrap.bundle.min.js"></script>
<script src="../../admin/assets/js/bootstrap.min.js"></script>

<script>
      $(document).ready( function () {
    $('#studentTable').DataTable(
      {
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 10001, targets: 4 },
            { responsivePriority: 2, targets: -2 }
        ]
    });
    } );
    </script>
    <script>
    $(document).ready(function(){
        $('.delete').on('click', function(){
          $('#delete').modal('show');
            
            
            
            $tr=$(this).closest('tr');

            var data=$tr.children('td').map(function(){
              return $(this).text();
            }).get();

            console.log(data);

            $('#LRN').val(data[1]);
        });
    });
    </script>
</body>
</html>
    <?php }?>
