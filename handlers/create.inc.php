<?php require '../config/config.php'; ?>
<?php 
  session_start();
  if(isset($_POST['create-topic'])) {
    $title = $_POST['title'];
    $category_id = $_POST['category'];
    $body = $_POST['topic-body'];
    $user_id = $_SESSION['id'];

  /*  echo $title . '<br>'. $category_id . '<br>' . $body . '<br>' .$user_id; */

 
  $database = new Database;

  $database->query('INSERT INTO topics (category_id, user_id, title, body) VALUES (:category_id, :user_id, :title, :body)');
  $database->bind(':category_id', $category_id);
  $database->bind(':user_id', $user_id);
  $database->bind(':title', $title);
  $database->bind(':body', $body);
  $database->execute();
  header("Location: ../create.php?post_created_msg=created");
  


  } else {
    header("Location: ../create.php");
  }