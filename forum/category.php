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
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST')
    {
        $cat_id=(int)$_GET['catid'];
    if(isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['topcat']) && $_POST['title']!=null && $_POST['desc']!=null && $_POST['topcat']!=null && $_POST['topcat']!=2 && ($_POST['topcat']==1 || $_POST['topcat']==0))
    {
    //Insert into thread db
    $th_title=$_POST['title'];
    $th_desc=$_POST['desc'];
    $th_topcat=$_POST['topcat'];
    $th_title=str_replace("<","&lt;",$th_title);
    $th_title=str_replace(">","&gt;",$th_title);
    $th_title=str_replace("'","''",$th_title);
    $th_desc=str_replace("<","&lt;",$th_desc);
    $th_desc=str_replace(">","&gt;",$th_desc);
    $th_desc=str_replace("'","''",$th_desc);
    $sql="UPDATE categories SET category_name='$th_title' , category_description='$th_desc' , top_cat='$th_topcat' WHERE category_id='$cat_id'";
    $result=mysqli_query($conn, $sql);
    $showAlert=true;
    if($showAlert)
    {          
        header("Location: /forum/threadlist.php?catid=$cat_id&catupdated=true");
        exit();
    }
    }
    else
    {
        header("Location: /forum/threadlist.php?catid=$cat_id&catupdated=false");
        exit();        
    }
}
?>   
  <?php                    
            if(isset($_GET['catid']))
            {           
                $id=(int)$_GET['catid'];
                $sql="SELECT * FROM `categories` WHERE category_id=$id";
                $result=mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            }
            if($row==null || !isset($_GET['catid']))
            {
                pagenotfound();
            }
            else
            {
               $cat_name=$row['category_name'];
               $desc=$row['category_description'];
               $top_cat=$row['top_cat'];
                echo  '<div class="container my-3" id="maincontainer">
        <h1 class="py-2">Update Category</h1>
        <form action="'. $_SERVER['REQUEST_URI'] .'" name="thread" onsubmit="return validateForm()" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Category Name</label>
                <input type="text" maxlength="255" class="form-control" id="title" value="'.$cat_name.'"  name="title" aria-describedby="emailHelp">
                    <span id="title_err_msg" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="desc" name="desc" maxlength="500" rows="3">'.$desc.'</textarea>
                <span id="desc_err_msg" class="text-danger"></span>
            </div>
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Add To Top Categories</label>
                    <select class="custom-select mt-1 mb-0 mr-sm-2" id="inlineFormCustomSelectPref" name="topcat">
                        <option value="2" >Choose...</option>
            <option value="1"'; if($top_cat==1){ echo 'selected';} echo '>Yes</option>
        <option value="0"'; if($top_cat==0){ echo 'selected';} echo '>No</option>                        
                    </select>
                    <div id="select_err_msg" class="text-danger"></div>
            <button type="submit" class="btn btn-success mt-4">Submit</button>
        </form>
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
    <script>
        function validateForm() {
                let error_exist = false;
                let x = document.forms["thread"]["title"].value;
                let y = document.forms["thread"]["desc"].value;
                let z = document.forms["thread"]["topcat"].value;
                document.getElementById("title_err_msg").innerHTML="";
                document.getElementById("desc_err_msg").innerHTML="";
                document.getElementById("select_err_msg").innerHTML="";
                if (x == "") {
                document.getElementById("title_err_msg").innerHTML="Error! Category Name Box Empty.";
                error_exist=true;
                }
                if (y == "") {
                document.getElementById("desc_err_msg").innerHTML="Error! Description Box Empty.";
                error_exist=true;
                }
                if (z != 0 && z != 1) {
                document.getElementById("select_err_msg").innerHTML="Error! Option Not Selected.";
                error_exist=true;
                }
                if(error_exist)
                {
                    return false;
                }
        }
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>    
</body>
</html>