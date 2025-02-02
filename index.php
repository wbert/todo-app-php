<?php include 'helpers/not_authenticated.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Todo App</title>
  <link href="statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="statics/js/bootstrap.js"></script>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
      <div class="text-center">
        <p class="display-5 fw-bold">Todo App</p>
        <p class="fw-bold">Please enter your credentials to login!</p>
      </div>
      <div class="card p-4 shadow-lg">
        <form class="form" action="handlers/login_handler.php" method="POST">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required />
          </div>
          <div class="mb-3 text-end">
            <a href="register.php">Don't have an account? Click here to register!</a>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-success">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>

