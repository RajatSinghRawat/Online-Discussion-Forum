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
        <a class="nav-link" href="/forum/adminpanel.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
      
      
    </ul>
    <div class="row mx-2">';
    
      echo'<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search for a user" aria-label="Search" id="search">
      
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <span class="text-light mt-2 mx-2" style="text-decoration:none;">Welcome '. $_SESSION['username']. '</span>
      <a href="partials/_adminlogout.php" class="btn btn-outline-success ml-2">Logout</a>
      
      </div>
      </div>
      </div>
      </nav>';

      ?>