<?php

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/forum">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
         Top Categories
        </a>
        <div class="dropdown-menu">';
        $sql="SELECT category_name, category_id FROM `categories` WHERE top_cat=1";
        $result=mysqli_query($conn, $sql);
          while($row=mysqli_fetch_assoc($result)){

          echo '<a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id']. '">' . $row['category_name']. '</a>';
          
          }
        echo '</div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>
    <div class="row mx-2">';
    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
    {
      echo'<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search" id="search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      <a class="text-light my-0 mx-2" style="text-decoration:none;" href="userprofile.php">Welcome '. $_SESSION['username']. '</a>
      <a href="partials/_logout.php" class="btn btn-outline-success ml-2">Logout</a>
      </form>';  
    }
    else
    {
      echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" id="search">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal" id="login_btn">Login</button>
        <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">Signup</button>';
    }
    echo'</div>
    
  </div>
</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
<strong>Success!</strong> You can now login
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
}
?>