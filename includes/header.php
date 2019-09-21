<?php 
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>PHP Forum | Welcome</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar  navbar-expand-md navbar-light fixed-top" style="background-color: #4DD2FF;">
      <a class="navbar-brand" href="index.php">PHP Forum</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <?php 
            if(isset($_SESSION['user-name'])) {
              echo '
              <li class="nav-item">
                <a class="nav-link" href="create.php">Create A Topic</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="profile.php">My Profile</a>
              </li>
              ';
            }
            else {
              echo '
              <li class="nav-item">
                <a class="nav-link" href="register.php">Create An Account</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
              ';
            }
          ?>
        </ul>
        <?php 
          if(isset($_SESSION['user-name'])) {
            echo '
              <div id="logout-btn">
                <form action="handlers/logout.inc.php" method="post">
                  <button class="btn btn-danger" type="submit" name="logout-submit">Logout</button>
                </form>
              </div>
            ';
          }
          else {
            echo '';
          }
        ?>
      </div>
    </nav>
