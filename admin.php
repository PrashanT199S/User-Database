<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PHP login system!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Users Database</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>

      
     
    </ul>

  <div class="navbar-collapse collapse">
  <ul class="navbar-nav ml-auto">
  <li class="nav-item active">
        <a class="nav-link" href=""> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Admin Panel";?></a>
      </li>
  </ul>
  </div>


  </div>
</nav>

<div class="container mt-4">
<center>
<h3><?php echo "Welcome "?></h3>
<hr>
</center>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Profile Picture</th>
        <th>First Name </th>
       <th>Last Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>10th Grade</th>
         <th>12th Grade</th>
        <th>Graduation Grade</th>
        <th>Created At</th>
        <th>Update Data</th>
        <th>Delete Data</th>
      </tr>
    </thead>

<?php

 require_once "config.php";
  session_start();
$query=mysqli_query($conn,"SELECT * FROM users");
// while($row = mysqli_fetch_array($query)){
   // echo $row['firstname']." ".$row['lastname']."<br>";
    //echo "<table style='text-align:left;width:100%'>";
    //echo "<tr  style='background:gray;color:white;'><th><pre>Id  </pre></th><th><pre>First Name   </pre></th><th><pre>Last Name   </pre></th><th><pre>Gender   </pre></th><th><pre>          Email   </pre></th><th><pre>Mobile Number   </pre></th><th><pre>10th Grade   </pre></th><th><pre>12th Grade   </pre></th><th><pre>Graduation Grade   </pre></th><th><pre>Created At  </pre></th></tr>";
    while ($row = mysqli_fetch_assoc($query)) 
    {
  echo "<tr><th>" . ($row['id']) . '</th>';
  echo "<th>"; ?> <img src="<?php echo $row["picture"]; ?>" height="50" width="50"><?php echo "</th>";
      echo "<th>" . ($row['firstname']) . '</th>';
      echo "<th>" . ($row['lastname']) . "</th>";
      echo "<th>" . ($row['gender']) . '</th>';
      echo "<th>" . ($row['email']) . '</th>';
      echo "<th>" . ($row['mobilenumber']) . "</th>";
      echo "<th>" . ($row['school10']) . '</th>';
      echo "<th>" . ($row['school12']) . '</th>';
      echo "<th>" . ($row['graduation']) . '</th>';
      echo "<th>" . ($row['created_at']) . '</th>';
      echo "<th>"; ?> <a href="update.php?id=<?php echo $row["id"]; ?> "> <button type="submit" class="btn btn-success">Update</button> <?php echo "</th>";
      echo "<th>"; ?> <a href="delete.php?id=<?php echo $row["id"]; ?> "> <button type="submit"class="btn btn-danger">Delete</button> <?php echo "</th>";
      echo "</tr>";
    }
    
    echo "</tr></table>";

?>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
