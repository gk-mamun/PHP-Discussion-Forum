<?php require '../config/config.php'; ?>
<?php 

  $database = new Database;

  if(isset($_POST['submit'])) {

    $folder ="uploads/"; 

    $image = $_FILES['image']['name']; 

    $path = $folder . $image ; 

    $target_file=$folder.basename($_FILES["image"]["name"]);


    $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

    $allowed=array('jpeg','png' ,'jpg'); 
    $filename=$_FILES['image']['name']; 
    $ext=pathinfo($filename, PATHINFO_EXTENSION);

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password1 = $_POST['password'];
    $password2 = $_POST['confirm-password'];
    $about = $_POST['about'];

    $database->query('SELECT * FROM users WHERE username = :username OR email = :email');
    $database->bind(':username', $username);
    $database->bind(':email', $email);
    $database->execute();
    $result = $database->resultset();

    if(empty($name) || empty($username) || empty($email) || empty($password1) || empty($password2) || empty($image) || empty($about)) {
      $error = 'empty';
      header("Location: ../register.php?error=".$error);
      exit();
    }
    else if ($password1 !== $password2) {
      $error = 'checkpass';
      header("Location: ../register.php?error=".$error);
      exit();
    }
    else if($result) {
      $error = 'userexists';
      header("Location: ../register.php?error=".$error);
      exit();
    }
    else if (!in_array($ext,$allowed)){
      $error = 'invalidImg';
      header("Location: ../register.php?error=".$error);
      exit();
    }
    else {

      move_uploaded_file( $_FILES['image'] ['tmp_name'], $path);

      $hashedPass = password_hash($password1, PASSWORD_DEFAULT);
      $database->query('INSERT INTO users (name, email, username, password, avatar,  about) VALUES (:name, :email, :username, :password, :profile_pic, :about)');
      $database->bind(':name', $name);
      $database->bind(':email', $email);
      $database->bind(':profile_pic', $image);
      $database->bind(':username', $username);
      $database->bind(':password', $hashedPass);
      $database->bind(':about', $about);
      $database->execute();
      header("Location: ../login.php?register=success");
    }
  } else {
    header("Location: ../register.php");
  }