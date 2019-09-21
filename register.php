<?php include('includes/header.php'); ?>
<?php 

  if(isset($_GET['error'])){
    $error = $_GET['error'];
  } else {
    $error = '';
  }

?>

<main role="main" class="container">
  <div class="row">
    <!--===================================== Topic Area ================================================-->
    <div class="col-md-12">
      <!-- error msg -->
      <?php 
        if($error == 'empty') {
          echo '<div class="alert alert-danger">Please fill up all fields</div>';
        }
        else if($error == 'checkpass') {
          echo '<div class="alert alert-danger">Passwords must be matched</div>';
        }
        else if($error == 'userexists') {
          echo '<div class="alert alert-danger">User already exist</div>';
        }
        else if($error == 'invalidImg') {
          echo '<div class="alert alert-danger">Invalid image formate</div>';
        }
        else {
          echo '';
        }
      ?>
      <div class="main-col">
        <div class="block">
          <h1 class="">Create An Account</h1>
          <h4 class="">A Forum for developer and designer</h4>
          <div class="clearfix"></div>
          <hr>
          <form role="form" enctype="multipart/form-data" action="handlers/register.inc.php" method="post">
            <div class="form-group">
              <label>Your Name</label>
              <input name="name" type="text" class="form-control"placeholder="Enter Name">
            </div>
            <div class="form-group">
              <label>User Name</label>
              <input name="username" type="text" class="form-control"placeholder="Choose Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" class="form-control"placeholder="Enter Email">
              </div>
            <div class="form-group">
              <label>Password</label>
              <input name="password" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
              <label>Confirm Password</label>
              <input name="confirm-password" type="password" class="form-control" placeholder="Confirm Password">
            </div>
            <div class="form-group">
              <label for="exampleFormControlFile1">Upload Avatar</label>
              <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group">
               <label>Say Something About You</label>
              <textarea name="about" class="form-control" cols="30" rows="10"></textarea>
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            <a href="login.php" class="btn btn-default">Already a user? Login</a>
          </form>
        </div>
      </div>
    </div>
  </div>

</main><!-- /.container -->

<script> 
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });
 </script>  

<?php include('includes/footer.php'); ?>