<?php 
session_start();

if ($_SESSION['id'] == 0) {
  header('Location:login.php');
}

require 'includes/conn.php';
$alert = "";

// delete code

if(isset($_POST['delete'])){
  $delete = $_POST['delete_id'];
  $sql = "DELETE FROM studendetail WHERE id={$delete}";
  if(mysqli_query($conn,$sql)){
    $alert = "Data Has Been Delete Successfully";
  }else{
    $alert = "Unable To Delete Data"; 
  }
}

?>

<?php require('includes/header.php') ?>

    <!-- header start -->
    <div class="container" id="header">
      <nav class="navbar navbar-expand-md py-4">
        <h2>Student Database Management System</h2>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="#" class="nav-link mx-4 disabled"><?php echo $_SESSION['name'] ?></a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link border">LogOut</a>
          </li>
        </ul>
      </nav>
    </div>
    <!-- header end -->
    
    
    <!-- Student Detail Form Start -->
    <div class="container">
      <div class="d-flex h-100  justify-content-center align-items-center">
          <div class="student w-75">
              <form action=""  method="post">
                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="">Unique Id No.</label>
                      <input type="text" name="unique" class="form-control">
                      <small class="text-muted">Kindly Enter The Unique Id No. To Search For Student</small>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="" class="">Search</label>
                      <button type="submit" name="submit" class="btn btn-primary form-control">Search</button>
                    </div>
                  </div>
                </div>
                <?php 

                if(isset($_POST['submit'])){
                  if(!empty($_POST['unique'])){
                    $id = mysqli_real_escape_string($conn,$_POST['unique']);

                    $sql = "SELECT * FROM studendetail WHERE id={$id}";

                    $result = mysqli_query($conn,$sql);
                    
                    if(mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                      
                ?>
                  <div class="form-group">
                    <label for="">ID Of Student</label>
                    <input type="text" name="id" class="form-control" placeholder="Name" value="<?php echo $row['id']?>" readonly>
                  </div>
                <div class='row'>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $row['name']?>" readonly>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Last Name</label>
                      <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo $row['lastname']?>" readonly>
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                    <label for="">Father Name</label>
                    <input type="text" name="fathername" class="form-control" placeholder="Father Name" value="<?php echo $row['father']?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="">Mother Name</label>
                    <input type="text" name="mothername" class="form-control" placeholder="Mother Name" value="<?php echo $row['mother']?>" readonly>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Class</label>
                        <input type="text" name="class" class="form-control" placeholder="Class" value="<?php echo $row['class']?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Division</label>
                        <input type="text" name="division" class="form-control" placeholder="Division" value="<?php echo $row['division']?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Religion</label>
                        <input type="text" name="religion" class="form-control" placeholder="Class" value="<?php echo $row['religion']?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Date Of Birth</label>
                        <input type="text" name="dob" class="form-control" placeholder="Division" value="<?php echo $row['dob']?>" readonly>
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
                        <label for="">Date Of Admission</label>
                        <input type="text" name="dateofaddmission" class="form-control" placeholder="Division" value="<?php echo $row['dateofaddmission']?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">PinCode</label>
                        <input type="text" name="pincode" class="form-control" placeholder="Class" value="<?php echo $row['pincode']?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Address</label>
                    <textarea name="address" id="" class="form-control" cols="20" rows="5" placeholder="Address" readonly><?php echo $row['address']?></textarea>
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
                      <img src="<?php echo $row['image']?>" width="300" height="300" class="d-block m-auto" alt="Image of Student">
                    </div>
                  </div>
                  <div class="form-group pt-5 d-flex justify-content-around">
                    <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-primary btn-custom">Update</a>
                      <form action="">
                        <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                        <button type="submit" name="delete" class="btn btn-primary btn-custom" onclick="alert('Do You Really Want To Delete ?')">
                          Delete
                        </button>
                      </form>
                      
                  </div>
              </form>
              <?php 
                      }
                    }else{
                        $alert = "Unable To Find Data In DataBase";
                      }
                  }else{
                    $alert = "Unique Id Key Is Empty";
                  }
                }   
              ?>
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