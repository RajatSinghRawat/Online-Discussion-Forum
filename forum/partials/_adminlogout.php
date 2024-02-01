<?php
include '_dbconnect.php';
session_start();
$admin_id=$_SESSION['sno'];
echo "Logging you out. Please wait...";
$sql="UPDATE admins SET loggedin='0' WHERE sno='$admin_id'";
mysqli_query($conn, $sql);
session_destroy();
header("Location: /forum");
?>