<?php

include("includes/conn.php");

$alert = "";

if (isset($_POST['submit'])){
  if (!empty($_POST['name']) &&
   !empty($_POST['lastname']) &&
    !empty($_POST['fathername']) &&
     !empty($_POST['mothername']) &&
      !empty($_POST['admclass']) &&
       !empty($_POST['division']) &&
        !empty($_POST['optradio'])&&
         !empty($_POST['religion']) &&
          !empty($_POST['dob']) &&
            !empty($_POST['pincode']) &&
             !empty($_POST['address'])){
    
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
    $fathername = mysqli_real_escape_string($conn,$_POST['fathername']);
    $mothername = mysqli_real_escape_string($conn,$_POST['mothername']);
    $admclass = mysqli_real_escape_string($conn,$_POST['admclass']);
    $division = mysqli_real_escape_string($conn,$_POST['division']);
    $optradio = mysqli_real_escape_string($conn,$_POST['optradio']);
    $religion = mysqli_real_escape_string($conn,$_POST['religion']);
    $dob = mysqli_real_escape_string($conn,$_POST['dob']);
    $pincode = mysqli_real_escape_string($conn,$_POST['pincode']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $dateofaddmission = Date('y-m-d');

    $target_dir = "image/";
    $target_file = $target_dir.basename($_FILES['filename']['name']);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if($_FILES['filename']['size'] < 20000000 && ($imageFileType =='jpg' || $imageFileType =='gif' || $imageFileType =='png' || $imageFileType =='jpeg')){

      if(move_uploaded_file($_FILES['filename']['tmp_name'],$target_file)){
        $sql = "INSERT INTO `studendetail`(`name`, `lastname`, `father`, `mother`, `class`, `division`, `gender`, `religion`, `dob`, `pincode`, `image`, `address`, `dateofaddmission`) VALUES ('{$name}','{$lastname}','{$fathername}','{$mothername}','{$admclass}','{$division}','{$optradio}','{$religion}','{$dob}','{$pincode}','{$target_file}','{$address}','{$dateofaddmission}')";

        if(mysqli_query($conn,$sql)){
          $alert = "Data Has Uploaded Successfully";
        }else{
          $alert = "Failed To Uploade Data";
        }
      }else{
        $alert = "Unable To Unpload Image To DataBase";
      }
    }else{
      $alert = "Image Size Should Not Be More Than 2MB And Image Type Should Be JPG,GIF,PNG,JPEG";
    }
  }else{
    $alert = "Kindly Check All Input Fields";
  }
}
?>

<?php require('includes/header.php') ?>

  <!-- header start -->
  <div class="container" id="header">
    <nav class="navbar navbar-expand-md py-4">
      <h2>Student Registration Form</h2>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="login.php" class="nav-link border"> LogIn </a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- header end -->

  <!-- Student Detail Form Start -->
  <div class="container">
    <!-- message of output -->
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
       <!-- message of output end -->

    <div class="d-flex h-100  justify-content-center align-items-center">
      <div class="student w-75">
        <form action="" method="post" enctype=multipart/form-data>
          <div class='row'>
            <div class="col-sm-6">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Father Name</label>
            <input type="text" name="fathername" class="form-control" placeholder="Father Name" required>
          </div>
          <div class="form-group">
            <label>Mother Name</label>
            <input type="text" name="mothername" class="form-control" placeholder="Mother Name" required>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Admit Class Into</label>
                <input type="text" name="admclass" class="form-control" placeholder="Class" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Division To Enter</label>
                <input type="text" name="division" class="form-control" placeholder="Division" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Gender</label>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio" value="Male">Male
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio" value="Female">Female
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Religion</label>
                <input type="text" name="religion" class="form-control" placeholder="Religion" required>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Date Of Birth</label>
                <input type="date" name="dob" class="form-control" max="2021-08-31" min="2000-08-31" placeholder="Date Of Birth" required>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Pin Code</label>
                <input type="text" name="pincode" class="form-control" placeholder="Pin Code" required>
              </div>
            </div>
          </div>
          <label>Image Of Student</label>
          <div class="form-group mb-3">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile" name="filename" required>
              <label for="customeFile" class="custom-file-label">Choose Student Image</label>
            </div>
            
          </div>
          <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control" cols="20" rows="5" placeholder="Address" required></textarea>
          </div>
          <div class="form-group pt-3 d-flex justify-content-around">
            <button type="submit" name="submit" class="btn btn-primary btn-custom ">Save</button>
            <a href="register.php" class="btn btn-primary btn-custom">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Student Detail Form End -->

  <?php require('includes/footer.php') ?>
</body>
</html>