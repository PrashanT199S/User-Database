<?php
require_once "config.php";
session_start();
$username = $password = $confirm_password = $firstname =$lastname =$mobilenumber =$gender= "";
$username_err = $password_err = $confirm_password_err = $firstname_err =$lastname_err =$mobilenumber_err=$gender_err= "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $username_err = "Email cannot be blank";
    }
    else{
      $username = trim($_POST["email"]);
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
      $username_err = "Invalid email format";
    }
    else{
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['email']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This email is already taken"; 
                }
                else{
                    $username = trim($_POST['email']);
                }
            }
            else{
                echo "Something went wrong";
                
            }
          }
            mysqli_stmt_close($stmt);
        }  
    }

   // Check for mobile number
if(empty(trim($_POST['mobilenumber']))){
  $mobilenumber_err = "mobilenumber cannot be blank";
}
elseif(strlen(trim($_POST['mobilenumber'])) >10 || strlen(trim($_POST['mobilenumber'])) <10 )
{
  $mobilenumber_err = "Wrong mobile number";
} 
else{
  $mobilenumber = trim($_POST['mobilenumber']);
}
    
// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 6){
    $password_err = "Password cannot be less than 6 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $confirm_password_err = "Passwords not match";
}

// Check for firstname
if(empty(trim($_POST['firstname']))){
  $firstname_err = "firstname cannot be blank";
}
else{
  $firstname = trim($_POST['firstname']);
}

// Check for lastname
if(empty(trim($_POST['lastname']))){
  $lastname_err = "lastname cannot be blank";
}
else{
  $lastname = trim($_POST['lastname']);
}
// Check for gender
if(empty(trim($_POST['gender']))){
  $gender_err = "gender cannot be blank";
}
else{
  $gender = trim($_POST['gender']);
}
$tm=md5(time());
$fnm=$_FILES["f1"]["name"];
$dst="./images/".$tm.$fnm;
$dst1="images/".$tm.$fnm;
move_uploaded_file($_FILES["f1"]["tmp_name"],$dst);


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err) && empty($lastname_err) && empty($mobilenumber_err) && empty($gender_err))
{
    $sql = "INSERT INTO users (email, password, firstname, lastname, mobilenumber, gender, picture) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sssssss", $param_username, $param_password, $param_firstname, $param_lastname, $mobilenumber, $gender, $dst1);
        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_firstname = $firstname;
        $param_lastname = $lastname;
        $param_mobilenumber= $mobilenumber;
        $param_gender= $gender;
      

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        { echo " Register Done";
        
          ?>
          <script type="text/javascript">
 window.location = "lndex.php";
</script>

<?php
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
else{
  echo " $username_err <br>";
  echo "$mobilenumber_err <br>";
  echo " $password_err <br>";
  echo " $confirm_password_err <br>";
  
}
mysqli_close($conn);
}

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PHP user login system!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">User Login System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      

      
     
    </ul>
  </div>
</nav>

<div class="container mt-4">
<h3>Please Register Here:</h3>
<hr>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-col">
  <div class="form-group col-md-6">
      <label for="inputpicture4">Profile Picture</label>
      <input type="file" class="form-control" name="f1">
    </div>
    <div class="form-group col-md-6">
      <label for="inputName4">Name</label>
      <input type="text" class="form-control" name="firstname" id="inputfirstname4" placeholder="Enter First Name" required>
    </div>
    <div class="form-group col-md-6">
      <input type="text" class="form-control" name="lastname" id="inputlastname4" placeholder="Enter Last Name" required>
    </div>
    <div class="form-group col-md-6">
           <label for="input Gender4"> Gender:</label>
           <br>
                 <input type="radio" name="gender" value="Female">Female
                 <input type="radio" name="gender" value="Male">Male
                 <input type="radio" name="gender" value="Other">Other
                 </div>
    
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="text" class="form-control" name="email" id="inputEmail4" placeholder="Enter Email" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputName4">Mobile Number</label>
      <input type="text" class="form-control" name="mobilenumber" id="inputMnumber4" placeholder="Enter Mobile Number" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name ="password" id="inputPassword4" placeholder="Enter Password" required>
    </div>
  </div>
  <div class="form-group col-md-6">
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" class="form-control" name ="confirm_password" id="inputPassword" placeholder="Confirm Password" required>
    </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck" required>
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
