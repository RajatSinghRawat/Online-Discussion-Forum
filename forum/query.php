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
    #maincontainer{
                min-height: 80vh;
            }    
    </style>
    <title>Welcome to iDiscuss - Coding Forum</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'?>
    <?php
        function pagenotfound()
        {
            echo '<div class="container mt-1" >
            <div class="jumbotron">
                <div class="row">
                    <div class="col-10">
                        <h1 class="display-4">Page Not Found</h1>
                        <p class="lead">We'."'".'re sorry, we couldn'."'".'t find the page you requested.</p>
                    </div>
                    <div class="col-2">
                    <img src="img/exclamation-diamond-fill.svg" width="100%" height="100%">
                    </div>
                </div>
                <hr class="my-4">
                <p>Try <a href="#search">searching for similar questions.</a></p>
                <p>Browse our <a href="index.php">categories.</a></p>
                <p>If you feel something is missing that should be here, <a href="contact.php"> contact us.</a></p>                
            </div>
            </div>
            <div class="container-fluid bg-dark text-light fixed-bottom">
            <p class="text-center py-3 mb-0">Copyright iDiscuss Coding Forums 2022 | All rights reserved</p>
            </div>';
            echo '<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
            <script src="/forum/js/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
            </script>
            <script src="/forum/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
            </script>
            </body>
            </html>';
            exit();
        }         
    ?>
<?php
    session_start();        
    if(isset($_SESSION['adminloggedin'])&&$_SESSION['adminloggedin']==true)        
    {
    include 'partials/_adminheader.php';
    }
    else
    {
        pagenotfound();
    }
?>   
  <?php                  
            if(isset($_GET['queryid']))
            {           
                $id=(int)$_GET['queryid'];
                $sql="SELECT * FROM `queries` WHERE query_id=$id";
                $result=mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            }
            if($row==null || !isset($_GET['queryid']))
            {
                pagenotfound();
            }
            else
            {
               $query=$row['query'];
               $user_email=$row['user_email'];
               $submitted_on=$row['submitted_on'];
               $seen=$row['seen'];                             
               if($seen==0)
               {
                    $sql="UPDATE queries SET seen='1' WHERE query_id='$id'";
                    $result=mysqli_query($conn, $sql);               
                    if($result)
                    {
                            echo '<div class="container my-4" id="maincontainer">
                            <div class="jumbotron">                            
                            <span style="font-size:26px;">'.$query.'</span>
                            <hr class="my-3">
                            <p><span class="font-weight-bold">Submitted by: </span><em>' .$user_email. '</em><span class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;on: </span>'.$submitted_on.'</p>
                            </div>
                            </div>';
                    }
                    else
                    {
                        pagenotfound();
                    }
               } 
               else
               {
                    echo '<div class="container my-4" id="maincontainer">
                    <div class="jumbotron">
                    <span style="font-size:26px;">'.$query.'</span>
                    <hr class="my-3">
                    <p><span class="font-weight-bold">Submitted by: </span><em>' .$user_email. '</em><span class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;on: </span>'.$submitted_on.'</p>       
                    </div>
                    </div>';
               }
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