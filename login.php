<?php include('includes/header.php'); ?>

<main role="main" class="container">
  <div class="row">
    <!--===================================== Sidebar================================================-->
    <div class="col-md-12">
    <div>
    <?php 
          if(isset($_GET['error'])){
            $err = $_GET['error'];

            if($err == 'empty' ){
              echo '<div class="alert alert-danger">Please fill up all the fields</div>'; 
            }
            if($err == 'Invalidpass' ){
              echo '<div class="alert alert-danger">Invalid Password!!!</div>'; 
            }
            if($err == 'notuser' ){
              echo '<div class="alert alert-danger">You are Not a user. <a href="register.php">Register Here</a></div>'; 
            }
          }
        
    ?>
    </div>
      <div id="side-bar">
      <?php 
        if(isset($_GET['register'])){
          $acc_created = $_GET['register'];
          if($acc_created == 'success'){
            echo '<div class="alert alert-success">Account has created. Login Here</div>';
          }
        }
      ?>
        <div class="block">
          <h3>Login</h3>
          <form action="handlers/login.inc.php" method="post">
            <div class="form-group">
              <label>User Name</label>
              <input name="username" type="text" class="form-control" placeholder="User Name">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input name="password" type="password" class="form-control"placeholder="Password">
            </div>
            <button name="do-login" type="submit" class="btn btn-primary">Submit</button>
            <a href="register.php" class="btn btn-default">Register</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</main>

<?php include('includes/footer.php'); ?>