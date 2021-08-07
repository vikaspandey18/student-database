<?php
session_start();
include('includes/conn.php');
$alert = "";
if (isset($_POST['submit'])) {
  if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username =  mysqli_real_escape_string($conn,$_POST['username']);
    $password =  mysqli_real_escape_string($conn,$_POST['password']);

    $sql = "SELECT * FROM admin WHERE username='{$username}' AND password='{$password}'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
      $_SESSION['id'] = $row['id'];
      $_SESSION['name'] = $row['username'];
      header('Location:index.php');
    }else {
      $alert = "Unable To Login -> <b>Recheck Username And Password</b>";
    }
  }else{
    $alert = "Kindly Check All The Fields Has Been Fill";
  }
}
?>
<?php require('includes/header.php') ?>
     <div class="container h-100 w-50">
       <div class="row h-100 d-flex justify-content-center align-items-center">
          <div class="col-12 py-5">
            <form action="" method="post">
              <h3 class="text-center">LogIn Form</h3>
              <hr>
              <div class="form-group pt-5">
                <label for="">UserName:</label>
                <input type="text" name="username" class="form-control" placeholder="Username">
              </div>
              <div class="form-group pt-3">
                <label for="">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
              <div class="form-group pt-3 d-flex justify-content-around">
                <button type="submit" name="submit" class="btn btn-primary btn-custom ">Login</button>
                <a href="register.php" class="btn btn-primary btn-custom">Add Student</a>
              </div>
            </form>
          </div>
       </div>

       <?php 
       if($alert){
       ?>
       <div class="alert alert-primary alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert">
           <span>&times;</span>
         </button>
         <strong class="text-center"><?php echo $alert; ?></strong>
       </div>
       <?php  } ?>
     </div>

    <?php require('includes/footer.php') ?>
  </body>
</html>
