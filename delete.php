<?php
require_once "config.php";
session_start();
$id=$_GET["id"];
mysqli_query($conn,"DELETE FROM users WHERE id=$id");
?>

<script type="text/javascript">
            window.location = "admin.php";
        </script>