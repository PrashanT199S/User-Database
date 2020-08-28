<!DOCTYPE html>
<html lang="en">
  <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Users Database!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">User Profile</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="login.php">Home <span class="sr-only">(current)</span></a>
      </li>>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>

      
      
    </ul>

  <div class="navbar-collapse collapse">
  <ul class="navbar-nav ml-auto">
  <li class="nav-item active">
        <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> </a>
      </li>
  </ul>
  </div>


  </div>
</nav>
  <?php
 require_once "config.php";
 $username = $gender = $school10 = $firstname =$lastname =$mobilenumber =$school12 =$graduation =$picture= "";
  session_start();
$id=$_GET["id"];
$query=mysqli_query($conn,"SELECT * FROM users where id='$id'");
$row=mysqli_fetch_array($query);
  ?>
  <div class="container mt-4">
  <hr>
  <div class="profile-input-field">
        
        <form method="post" action="#"  enctype="multipart/form-data">
          <div class="form-group col-md-6">
          <label><h5>Personal Details:</h5</label>
          <h6>Profile picture</h6>
          <img src="<?php echo $row["picture"]; ?>" height="150" width="150">
          <input type="file" class="form-control" name="f1">
          </div>
          <div class="form-group col-md-6">
            <label><h6>Firstname</h6></label>
            <input type="text" class="form-control" name="firstname" style="width:20em;" placeholder="Enter your Firstname" value="<?php echo $row['firstname']; ?>" required />
          </div>
          <div class="form-group col-md-6">
            <label><h6>Lastname</h6></label>
            <input type="text" class="form-control" name="lastname" style="width:20em;" placeholder="Enter your Lastname" value="<?php echo $row['lastname']; ?>" required />
          </div>
          <div class="form-group col-md-6">
            <label><h6>Gender:</h6></label>
            <?php 
            echo "<strong>"; 
            echo $row['gender'];
            echo "</strong>";  ?>

            <br> 
                 <input type="radio" name="gender" value="Female">Female
                 <input type="radio" name="gender" value="Male">Male
                 <input type="radio" name="gender" value="Other">Other
          </div>
          <div class="form-group col-md-6">
            <h6>Email</h6>
            <input type="text" class="form-control" name="email" style="width:20em;" placeholder="Enter your Email" value="<?php echo $row['email']; ?>" required />
          </div>
          <div class="form-group col-md-6"> 
          <label><h6>Mobile number</h6></label>
            <input type="text" class="form-control" name="mobilenumber" style="width:20em;" placeholder="Enter your Mobile number" value="<?php echo $row['mobilenumber']; ?>" required />
          </div>
          <div class="form-group col-md-6">
            <h6>10th Percentage</h6>
            <input type="text" class="form-control" name="school10" style="width:20em;" placeholder="Enter your Percentage" value="<?php echo $row['school10']; ?>">
          </div>
          <div class="form-group col-md-6">
          <h6>12th Percentage</h6>
            <input type="text" class="form-control" name="school12" style="width:20em;" required placeholder="Enter your Percentage" value="<?php echo $row['school12']; ?>"></textarea>
          </div>
          <div class="form-group col-md-6">
            <h6>Graduation Percentage</h6>
            <input type="text" class="form-control" name="graduation" style="width:20em;" placeholder="Enter your Percentage" value="<?php echo $row['graduation']; ?>">
          </div>
          <div class="form-group col-md-6">
            <input type="submit" name="submit" class="btn btn-primary" style="width:20em; margin:0;"><br><br>
      
          </div>
        </form>
      </div>
      
      <?php
      if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['email'];
        $mobilenumber = $_POST['mobilenumber'];
        $gender = $_POST['gender'];
        $school10 = $_POST['school10'];
        $school12 = $_POST['school12'];
        $graduation = $_POST['graduation'];
       
        $tm=md5(time());
        $fnm=$_FILES["f1"]["name"];

       if($fnm=="")
 { 
  $dst="./images/".$tm.$fnm;
  $dst1="images/".$tm.$fnm;
  move_uploaded_file($_FILES["f1"]["tmp_name"],$dst);
         
        $query = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$username', mobilenumber = '$mobilenumber', school10 = '$school10', school12 = '$school12', graduation = '$graduation', gender = '$gender'
                        WHERE id = '$id'";
                      $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    
}
else
{
  $dst="./images/".$tm.$fnm;
  $dst1="images/".$tm.$fnm;
  move_uploaded_file($_FILES["f1"]["tmp_name"],$dst);
         
        $query = "UPDATE users SET firstname = '$firstname',
                        lastname = '$lastname', email = '$username', mobilenumber = '$mobilenumber', school10 = '$school10', school12 = '$school12', graduation = '$graduation', gender = '$gender', picture= '$dst1'
                        WHERE id = '$id'";
                      $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                      
                      
}
?>
<script type="text/javascript">
              window.location = "admin.php";
          </script>

        <?php
             }               
?>
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>