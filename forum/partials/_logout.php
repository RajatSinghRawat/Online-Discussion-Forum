<?php
include '_dbconnect.php';
session_start();
$user_id=$_SESSION['sno'];
echo "Logging you out. Please wait...";
$sql="UPDATE users SET loggedin='0' WHERE sno='$user_id'";
mysqli_query($conn, $sql);
session_destroy();
header("Location: /forum");
?>