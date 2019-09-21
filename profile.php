<?php require 'config/config.php' ; ?>
<?php include('includes/header.php') ; ?>
<?php 

  $database = new Database;

  if(isset($_GET['topicid'])) {
    $topicId = $_GET['topicid'];
    $database->query('SELECT * FROM topics WHERE id = :t_id');
    $database->bind(':t_id', $topicId);
    $database->execute();
    $topicUser = $database->singleresult();

    $userId = $topicUser['user_id'];
  } else {
    $userId = $_SESSION['id'];
  }

  $database->query('SELECT * FROM users WHERE id = :user_id');
  $database->bind(':user_id', $userId);
  $database->execute();
  $user = $database->singleresult();


  $database->query('SELECT * FROM topics WHERE user_id = :u_id');
  $database->bind(':u_id', $userId);
  $database->execute();
  $numTopics = $database->rowCount();




?>

<main class="jumbotron m-5 p-5">
<section class="row">
  <div class="col-md-4 col-sm-12 text-center m-auto">
    <img src="handlers/uploads/<?php echo $user['avatar']; ?>" width="100" height="100">
  </div>
  <div class="col-md-8 col-sm-12">
    <h1><?php echo $user['name']; ?></h1>
    <h3>Email: <i><?php echo $user['email']; ?></i></h3>
  </div>
</section>
<hr>
<section class="row">
  <div class="col-md-12">
    <h3>About</h3>
    <p><?php echo $user['about']; ?></p>
  </div>
</section>
<hr>
<section class="row">
  <div class="col-md-12">
    <h3>Topic Created: <span class="badge"><?php echo $numTopics; ?></span></h3>
  </div>
</section>


</main>




<?php include('includes/footer.php') ; ?>