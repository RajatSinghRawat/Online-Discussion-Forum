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
    #ques {
        min-height: 433px;
    }

    .page a {
        color: black;
        padding-left: 0.1cm;
        padding-bottom: 2px;
        margin:2px;
        text-decoration: none;       
    }

    .page a.active {   
            background-color: #28a745;   
    }
    .page a:hover:not(.active) {   
        background-color: skyblue;   
    }
    </style>
    <title>Welcome to iDiscuss - Coding Forum</title>
</head>

<body>

    <?php include 'partials/_dbconnect.php'?>
    <?php 
    session_start();
    if(isset($_SESSION['adminloggedin']) && ($_SESSION['adminloggedin']=="true"))
    {
        include 'partials/_adminheader.php';

        if(isset($_GET['catupdated']) && $_GET['catupdated']=="true")
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Category has been updated!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
        }
        else if(isset($_GET['catupdated']) && $_GET['catupdated']=="false")
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> Category has not been updated!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>';
        }
    }
    else
    {
        include 'partials/_header.php';
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
            echo '<div class="container mt-1">

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
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
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
           else
           {              
                $catname=$row['category_name']; 
                $catdesc=$row['category_description']; 
           }   
    ?>


    <?php
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST')
    {

    if(isset($_POST['title']) && isset($_POST['desc']) && $_POST['title']!=null && $_POST['desc']!=null)
    {
    //Insert into thread db
    $th_title=$_POST['title'];
    $th_desc=$_POST['desc'];

    $th_title=str_replace("<","&lt;",$th_title);
    $th_title=str_replace(">","&gt;",$th_title);
    $th_title=str_replace("'","''",$th_title);

    $th_desc=str_replace("<","&lt;",$th_desc);
    $th_desc=str_replace(">","&gt;",$th_desc);
    $th_desc=str_replace("'","''",$th_desc);

    $sno=$_SESSION['sno'];
    $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
    $result=mysqli_query($conn, $sql);
    $showAlert=true;
    if($showAlert)
    {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your query has been added! Please wait for community to respond
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
    }
    }
    else
    {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong> Your query has not been added!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
    }
}
?>

    <!-- Category container starts here -->
    <div class="container my-4">

        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. Keep it friendly. Be courteous and respectful. Appreciate that others may
                have an opinion different from yours.
                Stay on topic. Share your knowledge. Refrain from demeaning, discriminatory, or harassing behaviour and
                speech.
            </p>
        </div>
    </div>

    <?php


if(!isset($_SESSION['adminloggedin']))
{
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
  echo  '<div class="container">
        <h1 class="py-2">Start a Discussion</h1>
        <form action="'. $_SERVER['REQUEST_URI'] .'" name="thread" onsubmit="return validateForm()" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                    possible</small>
                    <span id="title_err_msg" class="text-danger"></span>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Elaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                <span id="desc_err_msg" class="text-danger"></span>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
}
    else
    {
        echo '<div class="container">
                <h1 class="py-2">Start a Discussion</h1>
                <p class="lead">You are not logged in. Please <a href="#" data-toggle="modal" data-target="#loginModal" class="text-primary">login</a> to be able to start a discussion.</p>
            </div>';
    }
}
?>

    <div class="container mb-5" id="ques">
        <h1 class="py-2">Browse Questions</h1>

        <?php
          $per_page_record = 5;
          $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
          $result=mysqli_query($conn, $sql);
          $count=mysqli_num_rows($result);


        // Number of pages required.   
        $total_pages = ceil($count / $per_page_record);

        if (isset($_GET["page"]) && (is_int((int)$_GET["page"])))
         {      
            if($_GET["page"]>=1 && $_GET["page"]<=$total_pages)         
            {
                $page  = (int)$_GET["page"];
            }
            else if($_GET["page"]<1)
            {
                $page=1;
            }
            else if($_GET["page"]>$total_pages)
            {
                $page=$total_pages;
            }
         }
        else
         {    
            $page=1;    
        }

        $start_from = ($page-1) * $per_page_record;

        $sql3="SELECT * FROM `threads` WHERE thread_cat_id=$id ORDER BY netvotes DESC LIMIT $start_from, $per_page_record";
        $result3 = mysqli_query($conn, $sql3);

          $noResult=true;
          while($row=mysqli_fetch_assoc($result3)){
            $noResult=false;
        $thread_id=$row['thread_id']; 
        $title=$row['thread_title'];
        $desc=$row['thread_desc']; 

        $string = strip_tags($desc);
        if (strlen($string) > 500) {

        // truncate string
        $stringCut = substr($string, 0, 500);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
        }
        
        $thread_time=$row['timestamp'];
        $thread_user_id=$row['thread_user_id'];
        $netvotes=$row['netvotes'];
        $total_answers=$row['total_answers'];
        $sql2="SELECT username FROM `users` WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn, $sql2);
        $row2=mysqli_fetch_assoc($result2);

    
      echo  '<div class="row">
      <div class="col-3 mt-3 text-center">
      <div>'.$netvotes;
      if($netvotes==1)
      {
        echo ' vote';
      }
      else
      {
        echo ' votes';
      }
      echo '</div>
      <hr class="col-7 my-0">
      <div>'.$total_answers;
      if($total_answers==1)
      {
        echo ' answer';
      } 
      else
      {
        echo ' answers';
      }
      echo '</div>
      </div>
      <div class="col-9 media mt-3">'.
            '<div class="media-body"> 
                <h5 class="my-0"><a class="text-dark" href="thread.php?threadid='. $thread_id .'">'. $title .'</a></h5>'.'<div>'. $string .'</div>
                </div>
                </div>
                </div>
                <div class="row">
                <div class="col-12 my-0 text-right" style="font-size:12px;"> Asked by: <img src="img/userdefault.png" width="24px" alt="...">'. $row2['username'] . ' on '. $thread_time. '</div>';
                echo '</div>
                <hr class="dark mb-0 mt-1" style="border-top: 0.5px solid #A9A9A9">';
            }
          if($noResult)
          {
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Questions Found</p>
                        <p class="lead">Be the first person to ask a question</p>
                    </div>
                  </div>';
          }
          ?>
    </div>

    <div class="text-center pb-2 page">    
      <?php       
        echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($count / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2&&(!$noResult)){   
            echo "<a class='rounded' href='threadlist.php?catid=".$id."&page=".($page-1)."'> Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active rounded' href='threadlist.php?catid=".$id."&page="  
                                                .$i."'> ".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a class='rounded'  href='threadlist.php?catid=".$id."&page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a class='rounded'  href='threadlist.php?catid=".$id."&page=".($page+1)."'> Next </a>";   
        }   
  
      ?>    
      </div>

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
        let x = document.forms["thread"]["title"].value;
        let y = document.forms["thread"]["desc"].value;
        document.getElementById("title_err_msg").innerHTML="";
        document.getElementById("desc_err_msg").innerHTML="";
        if (x == "" && y == "") {
        document.getElementById("title_err_msg").innerHTML="Error! Title Box Empty.";
        document.getElementById("desc_err_msg").innerHTML="Error! Description Box Empty.";
        return false;
        }
        else if (x == "") {
        document.getElementById("title_err_msg").innerHTML="Error! Title Box Empty.";
        return false;
        }
        else if (y == "") {
        document.getElementById("desc_err_msg").innerHTML="Error! Description Box Empty.";
        return false;
        }
  }
      
  if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    </script>
</body>

</html>