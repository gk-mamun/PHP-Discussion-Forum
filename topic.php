<?php require 'config/config.php'; ?>
<?php

  $database = new Database;

  if(isset($_GET['topicid'])){
    $topicid = $_GET['topicid'];
  }


  $database->query('SELECT * FROM topics WHERE id= :topic_id');
  $database->bind('topic_id', $topicid);
  $database->execute();
  $single_topic = $database->singleresult();


  $database->query('SELECT * FROM topics');
  $database->execute();
  $topic_count = $database->rowCount();
  $topics = $database->resultset();
  

  $database->query('SELECT * FROM categories');
  $database->execute();
  $category_count = $database->rowCount();
  $categories = $database->resultset();

  $database->query('SELECT * FROM users');
  $database->execute();
  $users = $database->resultset();


  $database->query('SELECT * FROM replies WHERE topic_id = :id_topic');
  $database->bind('id_topic', $topicid);
  $database->execute();
  $reply_count = $database->rowCount();
  $replies = $database->resultset();


?>
<?php include('includes/header.php'); ?>

<main role="main" class="container">
  <div class="row">
    <!--===================================== Sidebar================================================-->
    <div class="col-md-4">
      <div id="side-bar">
        
        <div class="block">
          <h3>Categories</h3>
          <div class="list-group">
            <a href="topics.php" class="list-group-item">All Topics<span class="badge badge-info float-right"><?php echo $topic_count; ?></span></a>
            <?php foreach($categories as $category) : ?>
            <a href="topics.php?catid=<?php echo $category['id'] ; ?>" class="list-group-item"><?php echo $category['name']; ?><span class="badge badge-info float-right">
              <!-- Count topics for a particular category -->
              <?php 
                $count_topics  = 0;
                foreach($topics as $topic){
                  if($topic['category_id'] == $category['id']) {
                    $count_topics = $count_topics +1;
                  }
                }
                echo $count_topics;
              ?>
            </span></a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <!--===================================== Topic Area ================================================-->
    <div class="col-md-8">
      <div class="main-col">
        <div class="block">
          <h1 class=""><?php echo $single_topic['title']; ?></h1>
          <h4 class="">Feel free to discuss on the topic</h4>
          <div class="clearfix"></div>
          <hr>
          <ul id="topic">
            <li id="main-topic" class="topic-inner">
              <div class="row">
                <div class="col-md-2">
                  <div class="user-info">
                    <ul class="text-center">
                      <li>
                          <?php 
                            $database->query('SELECT * FROM users WHERE id = :user_id');
                            $database->bind(':user_id', $single_topic['user_id']);
                            $database->execute();
                            $user = $database->singleresult();
                            echo '<img src="handlers/uploads/'. $user['avatar'] . '?>" alt="" class="avatar pull-left" width="90px" height="90px">';
                          ?>
                      </li>
                      <li><strong>
                      <!-- Find the name who created the topic -->
                      <?php
                        foreach ($users as $user) {
                          if($single_topic['user_id'] == $user['id']){
                            echo $user['username'];
                          }
                        }
                      ?>
                      </strong></li>
                      <li><a class="btn btn-primary" href="profile.php">Profile</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class=" text-center topic-content float-right">
                    <p><?php echo $single_topic['body']; ?></p>
                  </div>
                </div>
              </div>
              <div class="col-md-12 text-center bg-light m-2">
                <p class="text-info"><span><?php echo $reply_count; ?></span> Replies for this topic</p>
              </div>
            </li>
            <?php foreach($replies as $reply) : ?>
            <li class="topic-inner">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="user-info text-center">
                        <ul>
                          <li><strong>
                          <!-- Find user that replie -->
                          <?php
                            foreach ($users as $user) {
                              if($reply['user_id'] == $user['id']){
                                echo $user['username'];
                              }
                            }
                          ?>
                          </strong></li>
                          <li><a class="btn btn-primary" href="profile.php">Profile</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-md-10">
                      <div class="topic-content float-right">
                        <p><?php echo $reply['body']; ?></p>
                      </div>
                    </div>
                  </div>
              </li>
              <?php endforeach; ?>
          </ul>
          <?php if(isset($_SESSION['user-name'])) : ?>
              <h3>Reply To The Topic</h3>
              <form action="handlers/reply.inc.php" role="form" method="post">
                <div class="form-group">
                  <textarea name="body" class="form-control" cols="30" rows="10"></textarea>
                  <script>CKEDITOR.replace('body');</script>
                </div>
                <input type="hidden" name="topic-id" value="<?php echo $topicid; ?>">
                <input type="hidden" name="user-id" value="<?php echo $_SESSION['id']; ?>">
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
              </form>
          <?php else : ?>
              <h3 class="text-center">Login To Reply To The Topic.</h3>
              <h3 class="text-center"><a href="login.php">Login</a></h3>
          <?php endif; ?>
          
        </div>
      </div>
    </div>
  </div>

</main><!-- /.container -->


<?php include('includes/footer.php'); ?>
