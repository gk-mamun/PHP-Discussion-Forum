<?php include('includes/header.php'); ?>
<?php require 'config/config.php'; ?>
<?php 

  $database = new Database;

  $database->query('SELECT * FROM topics');
  $database->execute();
  $topic_count = $database->rowCount();
  $topics = $database->resultset();
  

  $database->query('SELECT * FROM categories');
  $database->execute();
  $category_count = $database->rowCount();
  $categories = $database->resultset();
  


?>

<main role="main" class="container">
  <div class="row">
    <!--===================================== Sidebar================================================-->
    <div class="col-md-4">
      <div id="side-bar">
        
        <div class="block">
          <h3>Categories</h3>
          <div class="list-group">
            <a href="topics.php?" class="list-group-item">All Topics<span class="badge badge-info float-right"><?php echo $topic_count; ?></span></a>
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
      <!-- Topic Created message-->
        <?php 
          if(isset($_GET['post_created_msg'])){
            $post_created_msg = $_GET['post_created_msg'];

            if($post_created_msg == 'created'){
              echo '<div class="alert alert-success">Topic Created Successfully</div>';
            }
          }
        
        ?>
      <div class="main-col">
        <div class="block">
          <h1 class="">Create A Topic</h1>
          <h4 class="">A Forum for developer and designer</h4>
          <div class="clearfix"></div>
          <hr>
          <form action="handlers/create.inc.php" role="form" method="post">
            <div class="form-group">
              <label>Topic Title</label>
              <input name="title" type="text" class="form-control" placeholder="Enter Topic Title">
            </div>
            <div class="form-group">
                <label>Category</label>
                  <select name="category" class="form-control">
                    <?php foreach($categories as $category) : ?>
                      <option value="<?php echo $category['id'] ; ?>"><?php echo $category['name'] ; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Topic Body</label>
                <textarea name="topic-body" class="form-control" cols="30" rows="10"></textarea>
                <script>CKEDITOR.replace('body');</script>
            </div>
            <input name="user_id" type="hidden" value="<?php $_SESSION['id']; ?>">
            <button name="create-topic" type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</main><!-- /.container -->


<?php include('includes/footer.php'); ?>