<?php require '../config/config.php'; ?>
<?php 
  if(isset($_POST['submit'])) {
    $topicId = $_POST['topic-id'];
    $userId = $_POST['user-id'];
    $body = $_POST['body'];

   /* echo $topicId . '<br>' . $userId . '<br>' . $body; */

    $database = new Database;

    $database->query('INSERT INTO replies (topic_id, user_id, body) VALUES (:t_id, :u_id, :t_body)');
    $database->bind(':t_id', $topicId);
    $database->bind(':u_id', $userId);
    $database->bind(':t_body', $body);
    $database->execute();
    

    header("Location: ../topic.php?topicid=".$topicId);

  } else {
    header("Location: ../topics.php");
  }