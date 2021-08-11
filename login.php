<?php
session_start();
include('includes/conn.php');
$alert = "";

if (isset($_POST['login'])) {
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

if(isset($_POST['register'])){
    if(!empty($_POST['etnusername']) && !empty($_POST['etpassword']) && !empty($_POST['cfpassword'])){
        if($_POST['etpassword'] == $_POST['cfpassword']){
            $username = mysqli_real_escape_string($conn,$_POST['etnusername']);
            $etpassword = mysqli_real_escape_string($conn,$_POST['etpassword']);
            $cfpassword = mysqli_real_escape_string($conn,$_POST['cfpassword']);

            $sql = "INSERT INTO admin (username,password,confirpassword) VALUES ('{$username}','{$etpassword}','{$cfpassword}')";

            if (mysqli_query($conn,$sql)) {
                $alert = "You Have Registered Successfully <br> You Can Login As Admin";
            }else {
              $alert = "Failed To Registered";
            }
        }else{
            $alert = "Password And Cofirm Password Does Not Match";
        }
    }else{
        $alert = "Kindly Check All The Fields Has Been Fill";
    }
}
?>

<?php require('includes/header.php') ?>
      
    <div class="container login-page">
        <!-- Tab panes -->
        <div class="tab-content">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#login">Login</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#register">Register</a>
                </li>
            </ul>
            <br>
            <div id="login" class="container tab-pane active">
                <form method="post">
                    <div class="form-group">
                      <label for="">UserName:</label>
                      <input type="text" name="username" class="form-control" placeholder="UserName" required>
                    </div>
                    <div class="form-group">
                      <label for="">Password:</label>
                      <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary btn-custom" name="login">Login</button>
                    </div>
                </form>
            </div>
            <div id="register" class="container tab-pane fade">
                <a href="register.php" class="btn btn-primary py-3 mb-3">Register As A Student</a>
                <form method="post">
                    <div class="form-group">
                      <label for="">Enter Username:</label>
                      <input type="text" name="etnusername" class="form-control" placeholder="New Username" required>
                    </div>
                    <div class="form-group">
                      <label for="">Password:</label>
                      <input type="password" name="etpassword" class="form-control" required placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="">Confirm Password:</label>
                      <input type="password" name="cfpassword" class="form-control" required placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary btn-custom" name="register">Register</button>
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