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


    session_start();
    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
    {
        include 'partials/_header.php';
        $user_id=$_SESSION['sno'];
        $username=$_SESSION['username'];
        $useremail=$_SESSION['useremail'];
        
        $sql="SELECT COUNT(*) FROM `threads` WHERE thread_user_id='$user_id'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_row($result);
        $total_threads=$row[0];

        $sql="SELECT COUNT(*) FROM `comments` WHERE comment_by='$user_id'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_row($result);
        $total_comments=$row[0];
  
        $sql="SELECT COUNT(*) FROM `commentsonthreads` WHERE comment_by='$user_id'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_row($result);
        $total_cmnts_on_thds=$row[0];

        $sql="SELECT COUNT(*) FROM `commentsonanswers` WHERE comment_by='$user_id'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_row($result);
        $total_cmnts_on_ans=$row[0];
    }
    else if(isset($_SESSION['adminloggedin']) && ($_SESSION['adminloggedin']==true) && isset($_GET['uid']) && $_GET['uid']!=null)
    {            
        include 'partials/_adminheader.php';
        
        $user_id=$_GET['uid'];

        $sql="SELECT * FROM `users` WHERE sno='$user_id'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        if($row!=null)
        {
        $username=$row['username'];
        $useremail=$row['user_email'];

        $adminmode=true;
                
        $sql="SELECT COUNT(*) FROM `threads` WHERE thread_user_id='$user_id'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_row($result);
        $total_threads=$row[0];

        $sql="SELECT COUNT(*) FROM `comments` WHERE comment_by='$user_id'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_row($result);
        $total_comments=$row[0];
  
        $sql="SELECT COUNT(*) FROM `commentsonthreads` WHERE comment_by='$user_id'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_row($result);
        $total_cmnts_on_thds=$row[0];

        $sql="SELECT COUNT(*) FROM `commentsonanswers` WHERE comment_by='$user_id'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_row($result);
        $total_cmnts_on_ans=$row[0];
        }
        else
        {
            pagenotfound();
        }
    
    }
    else
    {
        include 'partials/_header.php';
        pagenotfound();
    }
  ?>  
    <div class="container my-4">
        <div style="display: flex; flex-flow: row wrap;" class="jumbotron">
            <div class="p-0" style="flex-grow: 1;">
                <img src="img/userdefault.png" class="img-fluid" width="356px" alt="...">
            
            </div>
            <div class="" style="flex-grow: 20;">
                <h1 class="display-4"><?php echo $username; ?></h1>
                <hr>
                <p class="font-weight-normal ml-1" style="font-size:18px">Email: <span class="text-success"><?php echo $useremail; ?></span></p>
                <p class="font-weight-normal ml-1" style="font-size:18px">Total Questions Posted: <span class="text-success"><?php echo $total_threads; ?></span></p>
                <p class="font-weight-normal ml-1" style="font-size:18px">Total Answers Posted: <span class="text-success"><?php echo $total_comments; ?></span></p>
                <p class="font-weight-normal ml-1" style="font-size:18px">Total Comments Posted On Questions: <span class="text-success"><?php echo $total_cmnts_on_thds; ?></span></p>
                <p class="font-weight-normal ml-1" style="font-size:18px">Total Comments Posted On Answers: <span class="text-success"><?php echo $total_cmnts_on_ans; ?></span></p>
            </div>
        </div>
    </div>
  
        <?php
        
        $sql="SELECT * FROM `threads` WHERE thread_user_id=$user_id ORDER BY netvotes DESC LIMIT 2";
        $result = mysqli_query($conn, $sql);
        ?>

        <div class="container mb-5" id="ques">

        <h1 class="pt-2 mt-5">
        <?php
        if(isset($adminmode) && $adminmode==true)
        {
          echo "User's ";
        }
        else
        {
          echo 'Your ';
        }
        ?>
        Top Voted Questions</h1>

        <?php
          
          $noResult=true;
          while($row=mysqli_fetch_assoc($result)){
          $noResult=false;
          $thread_id=$row['thread_id'];
          $title=$row['thread_title']; 
          $thread_time=$row['timestamp'];
          $netvotes=$row['netvotes'];
          $total_answers=$row['total_answers'];
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
                <div class="col-12 my-0 text-right" style="font-size:12px;"> Asked on: ' . $thread_time. '</div>';
                echo '</div>
                <hr class="dark mb-0 mt-1" style="border-top: 0.5px solid #A9A9A9">';
            }
          if($noResult)
          {
            echo '<div class="jumbotron py-4">
                    <div class="container">
                        <p class="display-4">No Questions Found</p>';
                        if(isset($adminmode) && $adminmode==true)
                        {
                          echo '<p class="lead">User has not asked any question</p>';
                        }
                        else
                        {
                          echo '<p class="lead">You have not asked any question</p>';
                        }
                        
                   echo '</div>
                  </div>';
          }
          if($total_threads>2)
                {
                   echo '<div class="row" id="loadthdcmnts">

                   <div style="font-size:14px" class="col-12 media">'
                   .'<div class="media-body">';

                   if(isset($adminmode) && $adminmode==true)
                   {
                     echo '<a class="mt-0 pt-0" href="records.php?records=questions&uid='.$user_id.'">View all questions</a>';
                   }
                   else
                   {
                     echo '<a class="mt-0 pt-0" href="records.php?records=questions">View all questions</a>';
                   }
                                    
                  echo '</div>
                   </div>           
                   </div>';
                }
          ?>

    <?php
        
        $sql="SELECT * FROM `comments` WHERE comment_by=$user_id ORDER BY netvotes DESC LIMIT 2";
        $result = mysqli_query($conn, $sql);       
        ?>

        <h1 class="pt-2 mt-5">
          
        <?php
        if(isset($adminmode) && $adminmode==true)
        {
          echo "User's ";
        }
        else
        {
          echo 'Your ';
        }
        ?>

        Top Voted Answers</h1>

        <?php
          
          $per_page_record=2;
          $noResult=true;
          while($row=mysqli_fetch_assoc($result)){
            $counter=0;
            $position=0;
            $page=0;
            $noResult=false;
          $comment_id=$row['comment_id'];
          $thread_id=$row['thread_id']; 
          $answer_content=$row['comment_content']; 
          $answer_time=$row['comment_time'];
          $netvotes=$row['netvotes'];

          $sql="SELECT * FROM `comments` WHERE thread_id=$thread_id ORDER BY netvotes DESC";
          $result2 = mysqli_query($conn, $sql);
          while($row2=mysqli_fetch_assoc($result2))
          {
            if($row2['comment_id']==$comment_id)
            {
              $position=$counter+1;
              break;
            }
            $counter++;
          }
          $page = ceil($position / $per_page_record);
          
          $string = strip_tags($answer_content);
          if (strlen($string) > 100) {
  
          // truncate string
          $stringCut = substr($string, 0, 100);
          $endPoint = strrpos($stringCut, ' ');
  
          //if the string doesn't contain any space then it will cut without word basis.
          $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
          $string .= '...';
          }
            
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
      
      </div>
      
      <div class="col-9 media mt-3">'.
            '<div class="media-body"> 
                <h5 class="my-0"><a class="text-dark" href="thread.php?threadid='. $thread_id .'&page='.$page.'&cmtid='.$comment_id.'">'. $string .'</a></h5>'.
                '</div>
                </div>
                </div>
                <div class="row">
                <div class="col-12 my-0 text-right" style="font-size:12px;"> Answered on: ' . $answer_time. '</div>';
                echo '</div>
                <hr class="dark mb-0 mt-1" style="border-top: 0.5px solid #A9A9A9">';
            }
          if($noResult)
          {
            echo '<div class="jumbotron py-4">
                    <div class="container">
                        <p class="display-4">No Answers Found</p>';
                        if(isset($adminmode) && $adminmode==true)
                        {
                          echo '<p class="lead">User has not answered any question</p>';
                        }
                        else
                        {
                          echo '<p class="lead">You have not answered any question</p>';
                        }
                        
                   echo '</div>
                  </div>';
          }

          if($total_comments>2)
                {
                   echo '<div class="row" id="loadthdcmnts">

                   <div style="font-size:14px" class="col-12 media">'
                   .'<div class="media-body">';

                   if(isset($adminmode) && $adminmode==true)
                   {
                     echo '<a class="mt-0 pt-0" href="records.php?records=answers&uid='.$user_id.'">View all answers</a>';
                   }
                   else
                   {
                     echo '<a class="mt-0 pt-0" href="records.php?records=answers">View all answers</a>';
                   }                  
                  
                  echo '</div>
                   </div>           
                   </div>';
                }
          ?>

<?php       
        $sql="SELECT * FROM `commentsonthreads` WHERE comment_by=$user_id LIMIT 2";
        $result = mysqli_query($conn, $sql);
        ?>

        <h1 class="pt-2 mt-5">
          
        <?php
        if(isset($adminmode) && $adminmode==true)
        {
          echo "User's ";
        }
        else
        {
          echo 'Your ';
        }
        ?>
        
        Posted Comments On Questions</h1>

        <?php
          
          $noResult=true;
          while($row=mysqli_fetch_assoc($result)){
          $noResult=false;
          $cmtonthd_id=$row['cmtonthd_id'];
          $thread_id=$row['thread_id']; 
          $comment_content=$row['comment_content']; 
          $comment_time=$row['comment_time'];


          $string = strip_tags($comment_content);
          if (strlen($string) > 100) {
  
          // truncate string
          $stringCut = substr($string, 0, 100);
          $endPoint = strrpos($stringCut, ' ');
  
          //if the string doesn't contain any space then it will cut without word basis.
          $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
          $string .= '...';
          }

    
      echo  '<div class="row">
      <div class="col-1 mt-3">
      
      </div>
      
      <div class="col-11 media mt-3">'.
            '<div class="media-body"> 
                <h5 class="my-0"><a class="text-dark" href="thread.php?threadid='.$thread_id.'&thdcmtid='.$cmtonthd_id.'">'. $string .'</a></h5>'.
                '</div>
                </div>
                </div>
                <div class="row">
                <div class="col-12 my-0 text-right" style="font-size:12px;"> Commented on: ' .$comment_time. '</div>';
                echo '</div>
                <hr class="dark mb-0 mt-1" style="border-top: 0.5px solid #A9A9A9">';
            }
          if($noResult)
          {
            echo '<div class="jumbotron py-4">
                    <div class="container">
                        <p class="display-4">No Comments Found</p>';
                        if(isset($adminmode) && $adminmode==true)
                        {
                          echo '<p class="lead">User has not commented on any question</p>';
                        }
                        else
                        {
                          echo '<p class="lead">You have not commented on any question</p>';
                        }

                   echo '</div>
                  </div>';
          }

          if($total_cmnts_on_thds>2)
                {
                   echo '<div class="row" id="loadthdcmnts">

                   <div style="font-size:14px" class="col-12 media">'
                   .'<div class="media-body">';

                   if(isset($adminmode) && $adminmode==true)
                   {
                     echo '<a class="mt-0 pt-0" href="records.php?records=cmtsonques&uid='.$user_id.'">View all comments</a>';
                   }
                   else
                   {
                     echo '<a class="mt-0 pt-0" href="records.php?records=cmtsonques">View all comments</a>';
                   }
                                   
                  echo '</div>
                   </div>           
                   </div>';
                }
          ?>

<?php
        
        $sql="SELECT * FROM `commentsonanswers` WHERE comment_by=$user_id LIMIT 2";
        $result = mysqli_query($conn, $sql);
        ?>

        <h1 class="pt-2 mt-5">
          
        <?php
        if(isset($adminmode) && $adminmode==true)
        {
          echo "User's ";
        }
        else
        {
          echo 'Your ';
        }
        ?>
        
        Posted Comments On Answers</h1>

        <?php
          
          $per_page_record=2;
          $noResult=true;
          while($row=mysqli_fetch_assoc($result)){
            $counter=0;
            $position=0;
            $page=0;
          $noResult=false;
          $cmtonans_id=$row['cmtonans_id']; 
          $comment_id=$row['comment_id'];
          $comment_content=$row['comment_content']; 
          $comment_time=$row['comment_time'];

          $string = strip_tags($comment_content);
          if (strlen($string) > 100) {
  
          // truncate string
          $stringCut = substr($string, 0, 100);
          $endPoint = strrpos($stringCut, ' ');
  
          //if the string doesn't contain any space then it will cut without word basis.
          $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
          $string .= '...';
          }

          $sql="SELECT thread_id FROM `comments` WHERE comment_id=$comment_id";
          $result2 = mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result2);
          $thread_id=$row['thread_id'];

          $sql="SELECT * FROM `comments` WHERE thread_id=$thread_id ORDER BY netvotes DESC";
          $result2 = mysqli_query($conn, $sql);
          while($row2=mysqli_fetch_assoc($result2))
          {
            if($row2['comment_id']==$comment_id)
            {
              $position=$counter+1;
              break;
            }
            $counter++;
          }
          $page = ceil($position / $per_page_record);
    
      echo  '<div class="row">
      <div class="col-1 mt-3">      
      </div>
      
      <div class="col-11 media mt-3">'.
            '<div class="media-body"> 
                <h5 class="my-0"><a class="text-dark" href="thread.php?threadid='.$thread_id.'&commentid='.$comment_id.'&anscmtid='.$cmtonans_id.'&page='.$page.'">'. $string .'</a></h5>'.
                '</div>
                </div>
                </div>
                <div class="row">
                <div class="col-12 my-0 text-right" style="font-size:12px;"> Commented on: ' . $comment_time. '</div>';
                echo '</div>
                <hr class="dark mb-0 mt-1" style="border-top: 0.5px solid #A9A9A9">';
            }
          if($noResult)
          {
            echo '<div class="jumbotron py-4">
                    <div class="container">
                        <p class="display-4">No Comments Found</p>';
                        if(isset($adminmode) && $adminmode==true)
                        {
                          echo '<p class="lead">User has not commented on any answer</p>';
                        }
                        else
                        {
                          echo '<p class="lead">You have not commented on any answer</p>';
                        }
                        
                   echo '</div>
                  </div>';
          }

          if($total_cmnts_on_ans>2)
                {
                   echo '<div class="row" id="loadthdcmnts">

                   <div style="font-size:14px" class="col-12 media">'
                   .'<div class="media-body">';

                   if(isset($adminmode) && $adminmode==true)
                        {
                          echo '<a class="mt-0 pt-0" href="records.php?records=cmtsonans&uid='.$user_id.'">View all comments</a>';
                        }
                        else
                        {
                          echo '<a class="mt-0 pt-0" href="records.php?records=cmtsonans">View all comments</a>';
                        }
                 
                  echo '</div>
                   </div>           
                   </div>';
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

</body>

</html>