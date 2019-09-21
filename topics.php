<?php include('includes/header.php'); ?>
<?php require 'config/config.php'; ?>
<?php 

  $database = new Database;


  $database->query('SELECT * FROM categories');
  $database->execute();
  $category_count = $database->rowCount();
  $categories = $database->resultset();

  if(isset($_GET['catid'])) {
    $database->query('SELECT * FROM topics WHERE category_id = :category_id');
    $database->bind(':category_id', $_GET['catid']);
    $database->execute();
    $topics = $database->resultset();
  } 
  else {
    $database->query('SELECT * FROM topics');
    $database->execute();
    $topics = $database->resultset();
  }

  $database->query('SELECT * FROM topics');
  $database->execute();
  $topic_count = $database->rowCount();
  

  $database->query('SELECT * FROM users');
  $database->execute();
  $user_count = $database->rowCount();

  $database->query('SELECT * FROM replies');
  $database->execute();
  $replies = $database->resultset();


?>

<main role="main" class="container">
  <div class="row">
    <!--===================================== Topic Area ================================================-->
    <div class="col-md-8">
      <div class="main-col">
        <div class="block">
          <h1 class="">Welcome To Dev Forum</h1>
          <h5 class="">A Forum for developer and designer</h5>
          <div class="clearfix"></div>
          <hr>
          <ul id="topics">
            <?php foreach($topics as $topic) : ?>
            <li class="topic">
              <div class="row">
                <div class="col-md-2">
                  <?php 
                    $database->query('SELECT * FROM users WHERE id = :user_id');
                    $database->bind(':user_id', $topic['user_id']);
                    $database->execute();
                    $user = $database->singleresult();
                    echo '<img src="handlers/uploads/'. $user['avatar'] . '?>" alt="" class="avatar pull-left" width="90px" height="90px">';
                  ?>
                </div>
                <div class="col-md-10">
                  <div class="topic-content">
                    <h3><a href="topic.php?topicid=<?php echo $topic['id']; ?>"><?php echo $topic['title'] ; ?></a></h3>
                    <div class="topic-info">
                      <a href="category.html">
                        <?php 
                          $database->query('SELECT name FROM categories WHERE id = :uid');
                          $database->bind(':uid', $topic['category_id']);
                          $category = $database->singleresult();
                          echo $category['name'] ;
                        ?>
                        </a> || 
                      <a href="profile.html">
                        <?php 
                          $database->query('SELECT name FROM users WHERE id = :uid');
                          $database->bind(':uid', $topic['user_id']);
                          $author = $database->singleresult();
                         echo $author['name'] ; ?>
                      </a>
                      <span class="badge float-right">
                        <!-- Count total replies for this topic -->
                        <?php 
                          $total_replies = 0;
                          foreach ($replies as $reply) {
                            if($reply['topic_id'] == $topic['id']){
                              $total_replies = $total_replies + 1;
                            }
                          }
                          echo $total_replies;
                        ?>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <!--===================================== Sidebar================================================-->
    <div class="col-md-4">
      <div id="side-bar">
        <div class="block">
          <h3>Categories</h3>
          <div class="list-group">
            <a href="topics.php" class="list-group-item">All Topics<span class="badge badge-info float-right"><?php echo $topic_count; ?></span></a>
            <?php foreach($categories as $category) : ?>
            <a href="topics.php?catid=<?php echo $category['id'] ; ?>" class="list-group-item"><?php echo $category['name']; ?><span class="badge badge-info float-right">
             <!-- Count topics in a particular category-->
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
        <div class="block">
          <!--================================= Forum Stats============================================-->
          <h3>Forum Statistics</h3>
          <ul>
            <li>Total Users: <strong><?php echo $user_count; ?></strong></li>
            <li>Total Topics: <strong><?php echo $topic_count; ?></strong></li>
            <li>Total Categories: <strong><?php echo $category_count; ?></strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</main><!-- /.container -->

<footer>
  <p>Copyright &copy; 2019, PHP Projects</p>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
      <script src="js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
      <script src="js/bootstrap.js"></script>
  </body>
</html>
