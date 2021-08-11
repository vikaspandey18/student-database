<?php 
session_start();
if ($_SESSION['id'] == 0) {
  header('Location:login.php');
}
require 'includes/conn.php';
$alert = "";

// update code

$id =$_GET['id'];

if (isset($_POST['update'])){
  if (!empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['fathername']) && !empty($_POST['mothername']) && !empty($_POST['class']) && !empty($_POST['division']) && !empty($_POST['optradio']) && !empty($_POST['religion']) && !empty($_POST['dob']) && !empty($_POST['pincode']) && !empty($_POST['address'])){
    
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
    $fathername = mysqli_real_escape_string($conn,$_POST['fathername']);
    $mothername = mysqli_real_escape_string($conn,$_POST['mothername']);
    $admclass = mysqli_real_escape_string($conn,$_POST['class']);
    $division = mysqli_real_escape_string($conn,$_POST['division']);
    $gender = mysqli_real_escape_string($conn,$_POST['optradio']);
    $religion = mysqli_real_escape_string($conn,$_POST['religion']);
    $dob = mysqli_real_escape_string($conn,$_POST['dob']);
    $pincode = mysqli_real_escape_string($conn,$_POST['pincode']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);

    $target_dir = "image/";
    $target_file = $target_dir.basename($_FILES['filename']['name']);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if($_FILES['filename']['size'] < 20000000 && ($imageFileType =='jpg' || $imageFileType =='gif' || $imageFileType =='png' || $imageFileType =='jpeg')){

      if(move_uploaded_file($_FILES['filename']['tmp_name'],$target_file)){

        $sql = "UPDATE `studendetail` SET `name`='{$name}',`lastname`='{$lastname}',`father`='{$fathername}',`mother`='{$mothername}',`class`='{$admclass}',`division`='{$division}',`gender`='{$gender}',`religion`='{$religion}',`dob`='{$dob}',`pincode`='{$pincode}',`image`='{$target_file}',`address`='{$address}' WHERE id=$id";

        if(mysqli_query($conn,$sql)){
          $alert = "Data Has Updated Successfully";
        }else{
          $alert = "Failed To Updated Data";
        }
      }else{
        $alert = "Unable To Update Image To DataBase";
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
        <h2>Student Database Management System</h2>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#demo">
          <i class="bi bi-sliders"></i>
        </button>
        <div class="collapse navbar-collapse" id="demo">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="#" class="nav-link disabled"><?php echo $_SESSION['name'] ?></a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link">LogOut</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- header end -->
    
    
    <!-- Student Detail Form Start -->
    <div class="container">
      <div class="d-flex h-100 justify-content-center align-items-center">
          <div class="student w-75">
              <form action="" method="post" enctype="multipart/form-data">
                <?php 

                    $sql = "SELECT * FROM studendetail WHERE id={$id}";

                    $result = mysqli_query($conn,$sql);
                    
                    if(mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){ 
                ?>
          <div class="form-group">
            <label>ID Of Student</label>
            <input type="text" name="id" class="form-control" placeholder="Id" value="<?php echo $row['id']?>">
          </div>

            <div class='row'>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $row['name']?>">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo $row['lastname']?>">
                </div>
              </div>
            </div>

              <div class="form-group">
                <label>Father Name</label>
                <input type="text" name="fathername" class="form-control" placeholder="Father Name" value="<?php echo $row['father']?>">
              </div>

              <div class="form-group">
                <label>Mother Name</label>
                <input type="text" name="mothername" class="form-control" placeholder="Mother Name" value="<?php echo $row['mother']?>">
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Class</label>
                    <input type="text" name="class" class="form-control" placeholder="Class" value="<?php echo $row['class']?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Division</label>
                    <input type="text" name="division" class="form-control" placeholder="Division" value="<?php echo $row['division']?>">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Religion</label>
                    <input type="text" name="religion" class="form-control" placeholder="Class" value="<?php echo $row['religion']?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Date Of Birth</label>
                    <input type="text" name="dob" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $row['dob']?>">
                  </div>
                </div>
              </div>

              <label>Gender:</label>
              <div class="form-check-inline mb-3">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" <?php if (isset($row['gender']) && $row['gender'] == 'Male') echo "checked"; ?> name="optradio" value="Male">Male
                </label>
              </div>

              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="optradio" <?php if (isset($row['gender']) && $row['gender'] == 'Female') echo "checked"; ?> value="Female">Female
                </label>
                <br>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Date Of Admission</label>
                    <input type="text" name="dateofaddmission" class="form-control" placeholder="Division" value="<?php echo $row['dateofaddmission']?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>PinCode</label>
                    <input type="text" name="pincode" class="form-control" placeholder="Class" value="<?php echo $row['pincode']?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control" cols="20" rows="5" placeholder="Address"><?php echo $row['address']?></textarea>
              </div>

              <label>Image Of Student</label>
                <div class="form-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="filename">
                    <label for="customeFile" class="custom-file-label">Choose Student Image</label>
                  </div>
                </div>

              <div class="form-group">
                <div>
                  <img src="<?php echo $row['image'];?>" width="300" height="300" class="d-block m-auto" alt="Image of Student">
                </div>
              </div>

              <div class="form-group pt-5 d-flex justify-content-around">
                <button type="submit" name="update" class="btn btn-primary btn-custom" onclick="alert('Do You Want To Update ?')">
                  Update
                </button>
              </div>
            <?php }
             }; ?>
          </form>
      </div>
        
  </div>
      <div class="my-4 w-75 text-center mx-auto">
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
    </div>
    
    <!-- Student Detail Form End -->
    
    <?php require('includes/footer.php') ?>
  </body>
</html>