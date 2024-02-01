<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/forum/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
    #maincontainer {
        min-height: 80vh;
    }
    </style>
    <title>Welcome to iDiscuss - Coding Forum</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'?>
    <?php
session_start();
if(isset($_SESSION['adminloggedin'])&&$_SESSION['adminloggedin']==true)
{
$sql="SELECT COUNT(*) FROM `users`";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_row($result);
$total_users=$row[0];
$sql="SELECT COUNT(*) FROM `users` WHERE loggedin=true";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_row($result);
$active_users=$row[0];
$sql="SELECT COUNT(*) FROM `categories`";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_row($result);
$total_ctgrs=$row[0];
$sql="SELECT COUNT(*) FROM `queries` WHERE seen=0";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_row($result);
$total_queries=$row[0];
$sql="SELECT COUNT(*) FROM `threads`";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_row($result);
$total_ques=$row[0];
$sql="SELECT COUNT(*) FROM `comments`";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_row($result);
$total_ans=$row[0];
$sql="SELECT COUNT(*) FROM `commentsonthreads`";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_row($result);
$total_cmtsonthds=$row[0];
$sql="SELECT COUNT(*) FROM `commentsonanswers`";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_row($result);
$total_cmtsonans=$row[0];
include 'partials/_adminheader.php';
    echo  '<div class="container my-4" id="ques">
      <h2 class="text-center my-4">iDiscuss - Administrator Panel</h2>
      <div class="row my-4">';
          echo  '<div class="col-md-3 my-3">
                   <div class="card border-dark" style="width: 16rem;">                
                   <div class="card-body">
                   <h3 class="card-title text-success">Total Users</h3>
                   <p class="card-text font-weight-bold lead">'.$total_users.'</p>
                   <a href="panels.php?records=ttlusers" class="btn btn-success border-dark">View All</a>
                   </div>
                 </div>
                </div>
                <div class="col-md-3 my-3">
                   <div class="card border-dark" style="width: 16rem;">                
                   <div class="card-body">
                   <h3 class="card-title text-success">Active Users</h3>
                   <p class="card-text font-weight-bold lead">'.$active_users.'</p>
                   <a href="panels.php?records=activeusers" class="btn btn-success border-dark">View All</a>
                   </div>
                 </div>
                </div>
                <div class="col-md-3 my-3">
                   <div class="card border-dark" style="width: 16rem;">
                   <div class="card-body">
                   <h3 class="card-title text-success">Total Categories</h3>
                   <p class="card-text font-weight-bold lead">'.$total_ctgrs.'</p>
                   <a href="panels.php?records=ctgrs" class="btn btn-success border-dark">View All</a>
                   </div>
                 </div>
                </div>
                <div class="col-md-3 my-3">
                   <div class="card border-dark" style="width: 16rem;">               
                   <div class="card-body">
                   <h3 class="card-title text-success">User Queries</h3>
                   <p class="card-text font-weight-bold lead">';
                   if($total_queries==1)
                   {
                    echo $total_queries.' unseen query';
                   }
                   else
                   {
                    echo $total_queries.' unseen queries';
                   }
                   echo '</p>
                   <a href="panels.php?records=queries" class="btn btn-success border-dark">View All</a>
                   </div>
                 </div>
                </div>
                <div class="col-md-3 my-3">
                   <div class="card border-dark" style="width: 16rem;">
                   <div class="card-body">
                   <h3 class="card-title text-success">Total Questions Posted</h3>
                   <p class="card-text font-weight-bold lead">'.$total_ques.'</p>
                   <a href="panels.php?records=questions" class="btn btn-success border-dark">View All</a>
                   </div>
                 </div>
                </div>
                <div class="col-md-3 my-3">
                   <div class="card border-dark" style="width: 16rem;">                
                   <div class="card-body">
                   <h3 class="card-title text-success">Total Answers Posted</h3>
                   <p class="card-text font-weight-bold lead">'.$total_ans.'</p>
                   <a href="panels.php?records=answers" class="btn btn-success border-dark">View All</a>
                   </div>
                 </div>
                </div>
                <div class="col-md-3 my-3">
                   <div class="card border-dark" style="width: 16rem;">               
                   <div class="card-body">
                   <h3 class="card-title text-success">Total Comments On Questions</h3>
                   <p class="card-text font-weight-bold lead">'.$total_cmtsonthds.'</p>
                   <a href="panels.php?records=cmtsonques" class="btn btn-success border-dark">View All</a>
                   </div>
                 </div>
                </div>
                <div class="col-md-3 my-3">
                   <div class="card border-dark" style="width: 16rem;">
                   <div class="card-body">
                   <h3 class="card-title text-success">Total Comments On Answers</h3>
                   <p class="card-text font-weight-bold lead">'.$total_cmtsonans.'</p>
                   <a href="panels.php?records=cmtsonans" class="btn btn-success border-dark">View All</a>
                   </div>
                 </div>
                </div>
                </div>
                </div>';
    }
    else
    {
        echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <h4 class="text-white my-1">Administrator Panel</h4>
        </nav>
        <div class="container my-4" id="maincontainer">
        <div class="mx-auto card border-dark mb-3" style="max-width: 28rem;">
        <div class="card-header bg-transparent border-dark my-1"><h5>Login To Administrator'."'".'s Account</h5></div>
        <div class="card-body">
        <div class="modal-body">                
        <div class="form-group">
            <input type="text" class="form-control border-dark" placeholder="Username" id="loginUname" name="loginUname" aria-describedby="emailHelp">
            <small id="unameErr" class="form-text text-danger mt-0"></small>
        </div>
        <div class="form-group mb-0">
            <input type="password" class="form-control border-dark" placeholder="Password" id="loginPass" name="loginPass">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" onclick="togglePass()" value="" id="flexCheckDefault">
            <small class="form-text" for="flexCheckDefault">Show Password</small>                        
          </div>
          <small id="pswdErr" class="form-text text-danger mt-0 mb-4"></small>
        <button onclick="login()" class="btn btn-success border-dark">Login</button>  
</div>         
      </div>        
      </div>
      </div>'; 
    }

?>
    <?php include 'partials/_footer.php'?>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="/forum/js/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="/forum/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
<script>
function togglePass() {
    var x = document.getElementById("loginPass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function login() {
    let alert_msg = document.getElementById("alert");
    if (alert_msg != null) {
        alert_msg.parentNode.removeChild(alert_msg);
    }
    let uname = document.getElementById("loginUname");
    let pswd = document.getElementById("loginPass");
    document.getElementById("unameErr").innerHTML = "";
    document.getElementById("pswdErr").innerHTML = "";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        let login_data = JSON.parse(this.responseText);
        if (login_data.err_exist == true) {
            if (login_data.uname_err != null) {
                document.getElementById("unameErr").innerHTML = login_data.uname_err;
            }
            if (login_data.pswd_err != null) {
                document.getElementById("pswdErr").innerHTML = login_data.pswd_err;
            }
            if (login_data.login_err != null) {
                let showmsg =
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">' +
                    '<strong>Error!</strong> ' + login_data.login_err +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>';
                document.getElementById("loginUname").insertAdjacentHTML("beforebegin", showmsg);
                uname.value = "";
                pswd.value = "";
            }
        } else if (login_data.err_exist == false) {
            location.reload();
        }
    }
    xmlhttp.open("POST", "partials/_handleLogin.php?action=adminlogin&loginUsername=" + uname.value +
        "&loginPassword=" + pswd.value, true);
    xmlhttp.send();
}
</script>