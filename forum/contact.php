<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/forum/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Welcome to iDiscuss - Coding Forum</title>
    <style>
      .container{
        min-height:80vh;
      }
    </style>
  </head>
  <body>
  <?php include 'partials/_dbconnect.php'?>
  <?php
  session_start();
  include 'partials/_header.php';
  ?>

 
<?php
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST')
    {
        

    if(isset($_POST['email']) && isset($_POST['query']) && $_POST['email']!=null && $_POST['query']!=null)
    {
   
    //Insert into thread db
    $email=$_POST['email'];
    $query=$_POST['query'];

    
    $query=str_replace("<","&lt;",$query);
    $query=str_replace(">","&gt;",$query);
    $query=str_replace("'","''",$query);


    if (filter_var($email, FILTER_VALIDATE_EMAIL))
    {
    
    $sql="INSERT INTO `queries` (`user_email`, `query`, `submitted_on`) VALUES ('$email', '$query', current_timestamp())";
    $result=mysqli_query($conn, $sql);
    $showAlert=true;
    if($showAlert)
    {          
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your query has been submitted!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
    }
    
    }
    else
    {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Entered email is not valid!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>';
    }


  }
    else
    {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> Your query has not been submitted!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>';        
    }
}

?>


  <div class="container my-3">
  <h1 class="text-center">Contact Us</h1>
  <form name="contact" onsubmit="return validateForm()" method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">Your Email address</label>
    <input type="email" class="form-control" name="email" 
    <?php

      if((isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true))
      {
        echo 'value="'.$_SESSION['useremail'].'"';
      }

    ?>
    >
     <span id="email_err_msg" class="text-danger"></span>
  </div>
  
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Your Query</label>
    <textarea class="form-control" rows="4" name="query"></textarea>
    <span id="query_err_msg" class="text-danger"></span>
  </div>

  <button class="btn btn-success">Submit</button>
</form>

  </div>
    <?php include 'partials/_footer.php'?>

   
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="/forum/js/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="/forum/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    
<script>
    function validateForm() {
        let x = document.forms["contact"]["email"].value;
        let y = document.forms["contact"]["query"].value;
        document.getElementById("email_err_msg").innerHTML="";
        document.getElementById("query_err_msg").innerHTML="";
        if (x == "" && y == "") {
        document.getElementById("email_err_msg").innerHTML="Error! Email Box Empty.";
        document.getElementById("query_err_msg").innerHTML="Error! Query Box Empty.";
        return false;
        }
        else if (x == "") {
        document.getElementById("email_err_msg").innerHTML="Error! Email Box Empty.";
        return false;
        }
        else if (y == "") {
        document.getElementById("query_err_msg").innerHTML="Error! Query Box Empty.";
        return false;
        }
  }

</script>

  </body>
</html>