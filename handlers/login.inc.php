<?php require '../config/config.php'; ?>
<?php 

  $database = new Database;

  if(isset($_POST['do-login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    if(empty($username) || empty($password)) {
      $error = 'empty';
      header("Location: ../login.php?error=".$error);
      exit();
    }
    else {
      $database->query('SELECT * FROM users WHERE username = :uname');
      $database->bind(':uname', $username);
      $result = $database->singleresult();

      if($result == true) {
        $validPassword = password_verify($password, $result['password']);
        if($validPassword == true) {
          session_start();
          $_SESSION['user-name'] = $result['username'];
          $_SESSION['id'] = $result['id'];
          header("Location: ../index.php?login=success");
          exit();
        }
        else {
          $error = 'Invalidpass';
          header("Location: ../login.php?error=".$error);
          exit();
        }
      }
      else {
        $error = 'notuser';
        header("Location: ../login.php?error=".$error);
        exit();
      }
    }
  } else {
    header("Location: ../login.php");
  }

