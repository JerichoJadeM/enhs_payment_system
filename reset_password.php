<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Forgot Password</title>
  <!-- CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container p-3">
    <h2 class="text-center mt-5">ENHS Miscellaneous Payment System</h2>
    <div class="card mt-5 mx-auto shadow">
      <div class="card-header text-center">
        Reset your password
      </div>
      <div class="card-body">
        <form action="admin/php_actions/reset_password.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
            <small id="emailHelp" class="form-text text-muted">Make sure your email address is valid and registered to our system</small>
          </div>
          <input type="submit" name="reset_password" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>

</body>

</html>