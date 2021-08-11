<?php 
session_start();

if ($_SESSION['id'] == 0) {
  header('Location:login.php');
}
$alert = "";
require 'includes/conn.php';
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
              <a href="index.php" class="nav-link">Back</a>
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
    <div class="table-responsive">
      <table class="table table-bordered text-white">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>LastName</th>
            <th>Father</th>
            <th>Mother</th>
            <th>Class</th>
            <th>Division</th>
            <th>Gender</th>
            <th>Religion</th>
            <th>DOB</th>
            <th>Pincode</th>
            <th>Image</th>
            <th>Address</th>
            <th>Date Of Addmission</th>
          </tr>
        </thead>
        <tbody>
          <?php
              $sql = "SELECT * FROM studendetail";
              $result = mysqli_query($conn,$sql) or die('Unable To Connect To The Table');
              
              if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
          ?>          
                
          <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['lastname'] ?></td>
            <td><?php echo $row['father'] ?></td>
            <td><?php echo $row['mother'] ?></td>
            <td><?php echo $row['class'] ?></td>
            <td><?php echo $row['division'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><?php echo $row['religion'] ?></td>
            <td><?php echo $row['dob'] ?></td>
            <td><?php echo $row['pincode'] ?></td>
            <td><img src="<?php echo $row['image'] ?>" alt="image of student" width="100" height="100"></td>
            <td><?php echo $row['address'] ?></td>
            <td><?php echo $row['dateofaddmission'] ?></td>
          </tr>
          <?php  }
              }else{
                $alert = "No Record Found In The Table";
              }
          ?>
        </tbody>
      </table>
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
    <!-- Student Detail Form End -->
    
    <?php require('includes/footer.php') ?>
  </body>
</html>