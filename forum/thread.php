
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
            #ques{
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

    <?php include 'partials/_dbconnect.php'?>
    <?php 
    session_start();
    if(isset($_SESSION['adminloggedin']) && ($_SESSION['adminloggedin']==true))
    {
        include 'partials/_adminheader.php';
    }
    else
    {
        include 'partials/_header.php';
    }
    ?>
    
    <?php 
          $count=NULL; 
          if(isset($_GET['threadid']))
          {
          $thread_id=(int)$_GET['threadid'];
          $sql="SELECT * FROM `threads` WHERE thread_id=$thread_id";
          $result=mysqli_query($conn, $sql);
          $count=mysqli_num_rows($result);
          }
          if($count==null || !isset($_GET['threadid']))
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

         
        if(isset($_GET['cmtid']) && (is_int((int)$_GET["cmtid"])))
        {       
                $cmt_id=(int)$_GET['cmtid'];       
                $sql="SELECT COUNT(*) FROM `comments` WHERE thread_id='$thread_id' AND comment_id='$cmt_id'";
                $result2=mysqli_query($conn, $sql);
                $row=mysqli_fetch_row($result2);
                if($row[0]==1)
                {   
                    echo '<body onload="scrolltoElement('.$cmt_id.',null)">';
                }
                else
                {
                    echo '<body>';
                }
        }  
        else if(isset($_GET['thdcmtid']) && (is_int((int)$_GET["thdcmtid"])))
        {       
                $thd_cmt_id=(int)$_GET['thdcmtid'];       
                $sql="SELECT COUNT(*) FROM `commentsonthreads` WHERE thread_id='$thread_id' AND cmtonthd_id='$thd_cmt_id'";
                $result2=mysqli_query($conn, $sql);
                $row=mysqli_fetch_row($result2);
                if($row[0]==1)
                {

                    $sql="SELECT COUNT(*) FROM `commentsonthreads` WHERE thread_id='$thread_id'";
                    $result2=mysqli_query($conn, $sql);
                    $row=mysqli_fetch_row($result2);
                    $total_thd_cmts=$row[0];

                    echo '<body onload="ldallthdcmnts('.$_GET['thdcmtid'].','.$total_thd_cmts.')">';
                }
                else
                {
                    echo '<body>';
                }
        }
        else if(isset($_GET['anscmtid']) && (is_int((int)$_GET["anscmtid"])))
        {
            if(isset($_GET['commentid']) && (is_int((int)$_GET["commentid"])))
            {
                $ans_cmt_id=(int)$_GET["anscmtid"];
                $cmt_id=(int)$_GET["commentid"];
                $sql="SELECT COUNT(*) FROM `commentsonanswers` WHERE cmtonans_id='$ans_cmt_id' AND comment_id='$cmt_id'";
                $result2=mysqli_query($conn, $sql);
                $row=mysqli_fetch_row($result2);
                if($row[0]==1)
                {

                    $sql="SELECT COUNT(*) FROM `comments` WHERE comment_id='$cmt_id' AND thread_id='$thread_id'";
                    $result2=mysqli_query($conn, $sql);
                    $row=mysqli_fetch_row($result2);
                    if($row[0]==1)
                    {
                        $sql="SELECT COUNT(*) FROM `commentsonanswers` WHERE comment_id='$cmt_id'";
                        $result2=mysqli_query($conn, $sql);
                        $row=mysqli_fetch_row($result2);
                        $total_ans_cmts[$cmt_id]=$row[0];
                        echo '<body onload="ldallanscmnts('.$cmt_id.','.$total_ans_cmts[$cmt_id].','.$_GET['anscmtid'].')">';
                    }
                    else
                    {
                        echo '<body>';
                    }               
                }  
                else
                {
                    echo '<body>';
                }  
            }
            else
            {
                echo '<body>';
            }
        }
        else
        {
            echo '<body>';
        }

          while($row = mysqli_fetch_assoc($result)){
        $title=$row['thread_title']; 
        $desc=$row['thread_desc']; 
        $netvotes=$row['netvotes'];
        $thread_user_id=$row['thread_user_id'];
        //Query the users table to find out the name of OP
        $sql2="SELECT username FROM `users` WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn, $sql2);
        $row2=mysqli_fetch_assoc($result2);
        $posted_by=$row2['username'];
        $votevalue=0;
        
        if(!isset($_SESSION['adminloggedin']))
        {
            if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
            {
                $user_id=$_SESSION['sno'];
                $sql3="SELECT vote_value FROM `uservotesonthreads` WHERE thread_id='$thread_id' AND user_id='$user_id'";
                $result3=mysqli_query($conn,$sql3);
                $row3=mysqli_fetch_assoc($result3);
                $canCmtOnAnswer=true;
                $canCmtOnThread=true;
                if($row3!=null)
                {
                    $votevalue=$row3['vote_value'];
                }
            }
            else
            {
                $canCmtOnAnswer=false;
                $canCmtOnThread=false;
            }
        }  
    }

    ?>


<?php
$showAlert=false;
$method=$_SERVER['REQUEST_METHOD'];
if($method=='POST')
{
    //Insert into comment db
    if(isset($_POST['answer']) && $_POST['answer']!=null)
    {
    $answer=$_POST['answer'];
    $answer=str_replace("<","&lt;",$answer);
    $answer=str_replace(">","&gt;",$answer);
    $answer=str_replace("'","''",$answer);
    $sno=$_SESSION['sno'];
    $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$answer', '$thread_id', '$sno', current_timestamp());";
    $result=mysqli_query($conn, $sql);
    $sql="SELECT total_answers FROM `threads` WHERE thread_id='$thread_id'";
    $result=mysqli_query($conn, $sql);
    $row8=mysqli_fetch_assoc($result);
    $total_answers=$row8['total_answers'];
    $total_answers=$total_answers+1;
    $sql="UPDATE threads SET total_answers=$total_answers WHERE thread_id='$thread_id'";
    $result=mysqli_query($conn, $sql);
    $showAlert=true;
    if($showAlert)
    {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your comment has been added!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
    }
    }
    else
    {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong> Your comment has not been added!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
    }
}
?>


<!-- Category container starts here -->
<div class="container my-4">
        
    <div class="jumbotron py-4">
        <div class="row">
            <div class="col-2 pr-0 pl-1 text-center">
                          
            <?php
            if(!isset($_SESSION['adminloggedin']))
            {
                echo '<div>
                <button type="button" class="btn '; 
                if($votevalue<=0)
                {
                    echo "btn-outline-dark";
                }
                else if($votevalue>0)
                {
                    echo "btn-success btn-outline-dark";
                }               
                echo ' p-0" value="1" id="vote_up" onclick="getVote(this.value, this.id)">
                <img src="img/caret-up-fill.svg" width="36" height="36">
                </button> </div>';
            }
            ?>
            
                    <?php
                    if(!isset($_SESSION['adminloggedin']))
                    {
                        echo '<div class="mt-1">';
                    }
                    else
                    {
                        echo '<div class="mt-3">';
                    }                   
                    ?>
                    
                        <h2 class="font-weight-light" id="vote"><?php echo $netvotes; ?>
                        </h2>
                    </div>

                    <?php

                        if(!isset($_SESSION['adminloggedin']))
                        {
                           echo '<div>  
                    
                            <button type="button" class="btn '; 
                            if($votevalue>=0)
                            {
                                echo "btn-outline-dark";
                            }
                            else if($votevalue<0)
                            {
                                echo "btn-success btn-outline-dark";
                            }               
                            echo ' p-0" value="-1" id="vote_down" onclick="getVote(this.value, this.id)">
                            <img src="img/caret-down-fill.svg" width="36" height="36">
                        </button></div>';
                        }

                    ?>
                
            </div>
            <div class="col-10">
                <h1 class="display-4 my-0 mt-0"><?php echo $title; ?></h1>
                <p class="lead"><?php echo $desc; ?></p>
                <hr class="my-4">
                <p>Posted by: <em><?php echo $posted_by; ?></em></p>
            </div>
    </div>

</div>
<hr class="dark" style="border-top: 0.5px solid #A9A9A9" class="mb-0 pb-0">

<?php
$sql6="SELECT COUNT(*) FROM `commentsonthreads` WHERE thread_id='$thread_id'";
$result6=mysqli_query($conn, $sql6);
$row6=mysqli_fetch_row($result6);
$total_thd_cmts=$row6[0];

$sql6="SELECT * FROM `commentsonthreads` WHERE thread_id=$thread_id LIMIT 2" ;
                $result6=mysqli_query($conn, $sql6);
                while($row6=mysqli_fetch_assoc($result6)){
                $cmt_user_id=$row6['comment_by'];
                $sql7="SELECT username FROM `users` WHERE sno='$cmt_user_id'";
                $result7=mysqli_query($conn, $sql7);
                $row7=mysqli_fetch_assoc($result7);
                
          echo '<div class="row" id="thdcmt['.$row6['cmtonthd_id'].']">
                
                <div style="font-size:14px" class="col-12 media">'
                .'<div class="media-body">
                <span class="my-0"> '.$row6['comment_content'].'</span>
                –&nbsp;
                <span class="my-0 text-success">'.$row7['username'].'</span>'.'<span class="my-0 text-secondary"> commented on '. $row6['comment_time']. '</span>
                
                </div>
                </div>           
                </div>
                
                                
                <div class="row">
                
                <div class="col-12">
                <hr class="my-1">
                </div>                
                </div>';
                
                }

                if($total_thd_cmts>2)
                {
                   echo '<div class="row" id="loadthdcmnts">

                   <div style="font-size:14px" class="col-12 media">'
                   .'<div class="media-body">
                   <a class="mt-0 pt-0" href="javascript:ldallthdcmnts(null,'.$total_thd_cmts.')">Load all comments</a>
                  
                  
                   </div>
                   </div>           
                   </div>';
                }
?>

<?php

if(!isset($_SESSION['adminloggedin']))
{
if($canCmtOnThread==true)
{
            echo  '<div class="row" id="addcmtonthd" style="font-size:14px">
            <div class="col-9">
            <textarea class="form-control border-top-0 border-right-0 border-left-0 p-0 mt-3" id="cmtonthd" name="comment" rows="1" placeholder="Type your comment..."></textarea>
            <span id="cmt_thd_err_msg" class="text-danger"></span>
            </div>
            <div class="col-3">
            <button onclick="cmtonthread()" class="btn btn-success btn-sm p-1 mt-2">Post Comment</button>
            </div>
                                             
            </div>
        </div>';
}
else
{
    echo '<div class="container mt-2 media-body pl-0" style="font-size:14px">
            <h6 class="mb-0">Post a Comment</h6>
            <p class="my-0">You are not logged in. Please <a href="#" data-toggle="modal" data-target="#loginModal" class="text-primary">login</a> to be able to post comments.</p>
          </div>
          </div>';
}

}
else
{
    echo '</div>';
}
?>


<?php

if(!isset($_SESSION['adminloggedin']))
{
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
  echo  '<div class="container pt-4">
    <h1 class="pt-2">Your Answer</h1>
    <form name="answerform" action="'. $_SERVER['REQUEST_URI'] .'" onsubmit="return validateForm()" method="post">
            <div class="form-group">
                <textarea class="form-control" name="answer" rows="3" placeholder="Type your answer here..."></textarea>
                <span id="ans_err_msg" class="text-danger"></span>
            </div>
            <button type="submit" class="btn btn-success">Post Your Answer</button>
        </form>
            </div>';
}
else
{
    echo '<div class="container pt-4">
            <h1>Post Your Answer</h1>
            <p class="lead">You are not logged in. Please <a href="#" data-toggle="modal" data-target="#loginModal">login</a> to be able to post comments.</p>
          </div>';
}
}
?>
    <div class="container mb-0" id="ques">
        
          <?php
        
        // Number of entries to show in a page.
        $per_page_record = 2;  

            $sql="SELECT total_answers FROM `threads` WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn, $sql);
            $row8=mysqli_fetch_assoc($result);
            $count=$row8['total_answers'];

        // Number of pages required.   
        $total_pages3 = ceil($count / $per_page_record);

        if (isset($_GET["page"]) && (is_int((int)$_GET["page"])))
         {      
            if($_GET["page"]>=1 && $_GET["page"]<=$total_pages3)         
            {
                $page  = (int)$_GET["page"];
            }
            else if($_GET["page"]<1)
            {
                $page=1;
            }
            else if($_GET["page"]>$total_pages3)
            {
                $page=$total_pages3;
            }
         }
        else
         {    
            $page=1;    
        }

        $start_from = ($page-1) * $per_page_record;

        $sql8="SELECT * FROM `comments` WHERE thread_id=$thread_id ORDER BY netvotes DESC LIMIT $start_from, $per_page_record";
        $result8 = mysqli_query($conn, $sql8);

          echo '<h1 class="py-4">'.$count;
           if($count==1)
           {
                echo ' Answer</h1>';
           }
           else
           {
                echo ' Answers</h1>';
           }
          $noResult=true;
          while($row=mysqli_fetch_assoc($result8)){
            $noResult=false;
        $comment_id=$row['comment_id']; 
        $comment_netvotes=$row['netvotes'];
        $content=$row['comment_content'];
        $comment_time=$row['comment_time'];
        $thread_user_id=$row['comment_by'];
        $sql2="SELECT username FROM `users` WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn, $sql2);
        $row2=mysqli_fetch_assoc($result2); 
        $cmt_vote_value=0;

        if(!isset($_SESSION['adminloggedin']))
        {
        if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
        {
            $user_id=$_SESSION['sno'];
            $sql3="SELECT vote_value FROM `uservotesoncomments` WHERE comment_id='$comment_id' AND user_id='$user_id'";
            $result3=mysqli_query($conn,$sql3);
            $row3=mysqli_fetch_assoc($result3);
            if($row3!=null)
            {
                $cmt_vote_value=$row3['vote_value'];
            }
        }
        }   

      echo  '<div id="'.$comment_id.'">
      
      <div class="row">

      <div class="col-2 pr-0 pl-1 mt-1 text-center">';
           
      if(!isset($_SESSION['adminloggedin']))
      {
      echo '<div>
      <button type="button" class="btn '; 
      if($cmt_vote_value<=0)
      {
          echo "btn-outline-dark";
      }
      else if($cmt_vote_value>0)
      {
          echo "btn-success btn-outline-dark";
      }               
      echo ' p-0" value="1" id="cmt_vote_up['.$comment_id.']" onclick="getCmtVote(this.value, this.id, '.$comment_id.')">
      <img src="img/arrow-up-short.svg" width="26" height="26">
      </button> </div>'; 
    }
         echo '<div class="mt-1">
              <h6 class="font-weight-light" id="cmt_vote['.$comment_id.']">'.$comment_netvotes.'</h6>
          </div>';

      if(!isset($_SESSION['adminloggedin']))
      {
        echo '<div>  
          
        <button type="button" class="btn ';
        if($cmt_vote_value>=0)
        {
            echo "btn-outline-dark";
        }
        else if($cmt_vote_value<0)
        {
            echo "btn-success btn-outline-dark";
        }               
        echo ' p-0" value="-1" id="cmt_vote_down['.$comment_id.']" onclick="getCmtVote(this.value, this.id, '.$comment_id.')">
        <img src="img/arrow-down-short.svg" width="26" height="26">
       </button></div>';
      }
      

  echo '</div>
                <div class="col-10 media mt-1">
                    <img src="img/userdefault.png" width="54px" class="mr-3" alt="...">
                    <div class="media-body">
                    <p class="font-weight-bold my-0">' .$row2['username']. '<span class="font-weight-normal text-secondary"> answered on '. $comment_time. '</span></p>
                    <p>'. $content .'</p>                  
                    </div>                    
                </div>                
                </div>';
                

                $sql4="SELECT COUNT(*) FROM `commentsonanswers` WHERE comment_id='$comment_id'";
                $result4=mysqli_query($conn, $sql4);
                $row4=mysqli_fetch_row($result4);
                $total_ans_cmts[$comment_id]=$row4[0];
                

                $sql4="SELECT * FROM `commentsonanswers` WHERE comment_id=$comment_id LIMIT 2" ;
                $result4=mysqli_query($conn, $sql4);
                while($row4=mysqli_fetch_assoc($result4)){
                $cmt_user_id=$row4['comment_by'];
                $sql5="SELECT username FROM `users` WHERE sno='$cmt_user_id'";
                $result5=mysqli_query($conn, $sql5);
                $row5=mysqli_fetch_assoc($result5);
                
                echo '<div class="row">
                <div class="col-3">  
                </div>
                <div class="col-9">
                <hr class="my-1">
                </div>                
                </div>
                

                <div class="row">
                <div class="col-3">  
                </div>
                <div style="font-size:14px" class="col-9 media" id="anscmt['.$row4['cmtonans_id'].']">
                <div class="media-body">
                
                <span class="my-0"> '.$row4['comment_content'].'</span>
                –&nbsp;
                <span class="my-0 text-success">'.$row5['username'].'</span>'.'<span class="my-0 text-secondary"> commented on '. $row4['comment_time']. '</span>

                </div>
                </div>           
                </div>';
                
                }

                echo '<div class="row" >
                <div class="col-3">  
                </div>
                <div class="col-9">
                <hr class="my-1">
                </div>                
                </div>';
                
                if($total_ans_cmts[$comment_id]>2)
                {
                   echo '<div class="row" id="loadanscmnts['.$comment_id.']">
                         <div class="col-3">
                         </div>

                   <div style="font-size:14px" class="col-9 media">'
                   .'<div class="media-body">
                   <a class="mt-0 pt-0" href="javascript:ldallanscmnts('.$comment_id.','.$total_ans_cmts[$comment_id].',null)">Load all comments</a>
                   </div>
                   </div>           
                   </div>';
                }
                
                
                echo '<div class="row" id="addcmtonans['.$comment_id.']">
                <div class="col-3">  
                </div>
                <div style="font-size:14px" class="col-9">';
                
if(!isset($_SESSION['adminloggedin']))
{
                if($canCmtOnAnswer==true)
{
            echo  '<div class="row">
                   <div class="col-8">
                   <textarea class="form-control border-top-0 border-right-0 border-left-0 p-0 mt-3" id="cmtonans['.$comment_id.']" name="cmtonans" rows="1" placeholder="Type your comment..."></textarea>
                   <span id="cmt_err_msg['.$comment_id.']" class="text-danger"></span>
                   </div>
                   <div class="col-4">
                   <button onclick="cmtonanswer('.$comment_id.')" class="btn btn-success btn-sm p-1 mt-2">Post Comment</button>
                   </div>
                   </div>';
}
else
{
    echo '<div class="container media-body pl-0 mt-2" style="font-size:14px">
    <h6 class="mb-0">Post a Comment</h6>
    <p class="my-0">You are not logged in. Please <a href="#" data-toggle="modal" data-target="#loginModal" class="text-primary">login</a> to be able to post comments.</p>
    </div>';
}
}

             echo '</div>           
                </div>
             
              <hr class="dark" style="border-top: 0.5px solid #A9A9A9"></div>';
              
          }

          if($noResult)
          {
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Answers Found</p>
                        <p class="lead">Be the first person to answer</p>
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
            echo "<a class='rounded' href='thread.php?threadid=".$thread_id."&page=".($page-1)."'> Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active rounded' href='thread.php?threadid=".$thread_id."&page="  
                                                .$i."'> ".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a class='rounded'  href='thread.php?threadid=".$thread_id."&page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a class='rounded'  href='thread.php?threadid=".$thread_id."&page=".($page+1)."'> Next </a>";   
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

function getVote(int,clicked)
 {
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function()
   {
    if (this.readyState==4 && this.status==200)
    {      
        if(this.responseText!='notloggedin')
        {
            if(document.getElementById(clicked).className=="btn btn-outline-dark p-0")
            {
                document.getElementById(clicked).className="btn btn-success btn-outline-dark p-0";
                if(clicked=="vote_up")
                {
                  document.getElementById("vote_down").className="btn btn-outline-dark p-0";
                }
                else if(clicked=="vote_down")
                {
                  document.getElementById("vote_up").className="btn btn-outline-dark p-0";
                }
            }
            else if(document.getElementById(clicked).className=="btn btn-success btn-outline-dark p-0")
            {
                 document.getElementById(clicked).className="btn btn-outline-dark p-0";                    
            }
                 document.getElementById("vote").innerHTML=this.responseText;
        }
        else if(this.responseText=='notloggedin')
        {
            document.getElementById("login_btn").click();
        }
    }

  }
  xmlhttp.open("POST","partials/_vote.php?vote="+int+"&thread_id="+<?php echo '"'.$thread_id.'&action=voteonthread"'; ?>,true);
  xmlhttp.send();
}

function getCmtVote(int,clicked,cmt_id)
 {
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function()
   {
    if (this.readyState==4 && this.status==200)
    {      
        if(this.responseText!='notloggedin')
        {
            if(document.getElementById(clicked).className=="btn btn-outline-dark p-0")
            {
                document.getElementById(clicked).className="btn btn-success btn-outline-dark p-0";
                if(clicked=="cmt_vote_up"+"["+cmt_id+"]")
                {
                  document.getElementById("cmt_vote_down"+"["+cmt_id+"]").className="btn btn-outline-dark p-0";
                }
                else if(clicked=="cmt_vote_down"+"["+cmt_id+"]")
                {
                  document.getElementById("cmt_vote_up"+"["+cmt_id+"]").className="btn btn-outline-dark p-0";
                }
            }
            else if(document.getElementById(clicked).className=="btn btn-success btn-outline-dark p-0")
            {
                 document.getElementById(clicked).className="btn btn-outline-dark p-0";                    
            }
                 document.getElementById("cmt_vote"+"["+cmt_id+"]").innerHTML=this.responseText;
        }
        else if(this.responseText=='notloggedin')
        {
            document.getElementById("login_btn").click();
        }
    }

  }
  xmlhttp.open("POST","partials/_vote.php?vote="+int+"&comment_id="+cmt_id+"&action=voteoncomment", true);
  xmlhttp.send();
}

function cmtonanswer(int)
{
  let comment=document.getElementById("cmtonans["+int+"]").value;
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onload=function()
  {   
        let cmt_data = JSON.parse(this.responseText);
        if(cmt_data.cmtboxempty == false)
        {                  
            let showcomment='<div class="row">'+
                '<div class="col-3">'+  
                '</div>'+
                '<div style="font-size:14px" class="col-9 media">'+
                '<div class="media-body">'+
                
                '<span class="my-0">'+cmt_data.comment_content+'</span>'+
                '–&nbsp;'+
                '<span class="my-0 text-success">'+cmt_data.username+'</span><span class="my-0 text-secondary"> commented on ' +cmt_data.comment_time+ '</span>'+

                '</div>'+
                '</div>'+           
                '</div>'+
            
                       
            '<div class="row">'+
                '<div class="col-3">'+  
                '</div>'+
                '<div class="col-9">'+
                '<hr class="my-1">'+
                '</div>'+                
                '</div>';
            
            document.getElementById("addcmtonans["+int+"]").insertAdjacentHTML("beforebegin", showcomment);
            document.getElementById("cmtonans["+int+"]").value="";
            document.getElementById("cmt_err_msg["+int+"]").innerHTML="";
        }
        else if(cmt_data.cmtboxempty == true)
        {
            document.getElementById("cmt_err_msg["+int+"]").innerHTML="Error! Comment Box Empty.";
        }         
  }
  xmlhttp.open("POST","partials/_comment.php?cmt_id="+int+"&comment="+comment+"&action=cmtonanswer", true);
  xmlhttp.send();
}


function cmtonthread()
{
  let comment=document.getElementById("cmtonthd").value;
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onload=function()
  {   
        let cmt_data = JSON.parse(this.responseText);
        if(cmt_data.cmtboxempty == false)
        {                  
            let showcomment='<div class="row">'+
                '<div style="font-size:14px" class="col-12 media">'+
                '<div class="media-body">'+
                '<span class="my-0"> '+cmt_data.comment_content+'</span>'+
                '–&nbsp;'+
                '<span class="my-0 text-success">'+cmt_data.username+'</span><span class="my-0 text-secondary"> commented on '+cmt_data.comment_time+ '</span>'+
                
                '</div>'+
                '</div>'+           
                '</div>'+
                
                               
                '<div class="row">'+
                
                '<div class="col-12">'+
                '<hr class="my-1">'+
                '</div>'+                
                '</div>';
            
            document.getElementById("addcmtonthd").insertAdjacentHTML("beforebegin", showcomment);
            document.getElementById("cmtonthd").value="";
            document.getElementById("cmt_thd_err_msg").innerHTML="";
        }
        else if(cmt_data.cmtboxempty == true)
        {
            document.getElementById("cmt_thd_err_msg").innerHTML="Error! Comment Box Empty.";
        }         
  }
  xmlhttp.open("POST","partials/_comment.php?thd_id="+<?php echo '"'.$thread_id.'&action=cmtonthread"'; ?>+"&comment="+comment, true);
  xmlhttp.send();

}


function ldallthdcmnts(cmt_id, ttl_cmnts)
{   
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onload=function()
            {
            if(ttl_cmnts>2)
            {                
                let cmt_data = JSON.parse(this.responseText);
                const myElement = document.getElementById("loadthdcmnts");
        
                for(let i=0;i<cmt_data.total_records;i++)
                    {
                        let rem_comments='<div class="row" id="thdcmt['+cmt_data.cmtonthd_id[i]+']">'+
                        '<div style="font-size:14px" class="col-12 media">'+
                        '<div class="media-body">'+
                        '<span class="my-0"> '+cmt_data.comment_content[i]+'</span>'+
                        '–&nbsp;'+
                        '<span class="my-0 text-success">'+cmt_data.username[i]+'</span><span class="my-0 text-secondary"> commented on '+cmt_data.comment_time[i]+ '</span>'+
                        
                        '</div>'+
                        '</div>'+           
                        '</div>'+
                        
                                                           
                        '<div class="row">'+               
                        '<div class="col-12">'+
                        '<hr class="my-1">'+
                        '</div>'+                
                        '</div>';
                                            
                        myElement.insertAdjacentHTML("beforebegin", rem_comments);
                    }
                    myElement.parentNode.removeChild(myElement);

                    if(cmt_id != null)
                    {                       
                        scrolltoElement(cmt_id, "thdcmt");
                    }
            }
            else if((ttl_cmnts<=2) && (cmt_id != null))
            {
                scrolltoElement(cmt_id, "thdcmt");
            }         
    }
     
  xmlhttp.open("POST","partials/_loadComments.php?thd_id="+<?php echo $thread_id; ?>+"&action=loadthdcmnts&ttl_cmnts="+ttl_cmnts, true);
  xmlhttp.send();
}


function ldallanscmnts(cmt_id, ttl_cmnts, cmtonans_id)
{   
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onload=function()
  {          
    if(ttl_cmnts>2)
    {
        let cmt_data = JSON.parse(this.responseText);
        const myElement = document.getElementById("loadanscmnts["+cmt_id+"]");

            for(let i=0;i<cmt_data.total_records;i++)
            {
                let rem_comments='<div class="row">'+
                '<div class="col-3">'+  
                '</div>'+
                '<div style="font-size:14px" class="col-9 media" id="anscmt['+cmt_data.cmtonans_id[i]+']">'+
                '<div class="media-body">'+
                
                '<span class="my-0">'+cmt_data.comment_content[i]+'</span>'+
                '–&nbsp;'+
                '<span class="my-0 text-success">'+cmt_data.username[i]+'</span><span class="my-0 text-secondary"> commented on ' +cmt_data.comment_time[i]+ '</span>'+

                '</div>'+
                '</div>'+           
                '</div>'+
                                    
                       
                '<div class="row">'+
                '<div class="col-3">'+  
                '</div>'+
                '<div class="col-9">'+
                '<hr class="my-1">'+
                '</div>'+                
                '</div>';
            
                
                myElement.insertAdjacentHTML("beforebegin", rem_comments);
            }
            myElement.parentNode.removeChild(myElement);

            if(cmtonans_id != null)
            {                       
                scrolltoElement(cmtonans_id, "anscmt");
            }           
        }
        else if((ttl_cmnts<=2) && (cmtonans_id != null))
        {
            scrolltoElement(cmtonans_id, "anscmt");
        }
  }
  xmlhttp.open("POST","partials/_loadComments.php?cmt_id="+cmt_id+"&action=loadanscmnts&ttl_cmnts="+ttl_cmnts, true);
  xmlhttp.send();
}


function scrolltoElement(id, category)
{
    let element=null;
    
    if(category=="anscmt")
    {
        element = document.getElementById("anscmt["+id+"]");      
    }
    else if(category=="thdcmt")
    {
        element = document.getElementById("thdcmt["+id+"]");
    }
    else if(category==null)
    {
        element = document.getElementById(id);
    }
        let color = element.style.backgroundColor;
        element.scrollIntoView({ behavior: 'smooth'});
        element.style.backgroundColor="#D0E7CF";
        setTimeout(function() {element.style.backgroundColor = color}, 2000);   
}


function scrolltoAnswer(ans_id)
{
    if(window.onload)
    {
        scrolltoElement(ans_id, null);
    }
}

function validateForm() {
  let x = document.forms["answerform"]["answer"].value;
  if (x == "") {
    document.getElementById("ans_err_msg").innerHTML="Error! Answer Box Empty.";
    return false;
  }
}


if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>
</body>
</html>