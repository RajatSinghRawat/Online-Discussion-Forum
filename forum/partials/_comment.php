<?php
error_reporting(0);
session_start();
include '_dbconnect.php';
 
   if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
   {   
     if($_REQUEST['action']=="cmtonanswer")
     {
            $cmt_id = intval($_REQUEST['cmt_id']);
            $comment=$_REQUEST['comment'];
            $user_id=$_SESSION['sno'];

            $sql="SELECT * FROM `comments` WHERE comment_id='$cmt_id'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            if($row!=null)
            {
               if($comment!=null)
               {
                  $comment=str_replace("<","&lt;",$comment);
                  $comment=str_replace(">","&gt;",$comment);
                  $comment=str_replace("'","''",$comment);
                  $sql="INSERT INTO `commentsonanswers` (`comment_content`, `comment_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$cmt_id', '$user_id', current_timestamp());";
                  $result=mysqli_query($conn,$sql);

                  $sql="SELECT * FROM `commentsonanswers` WHERE comment_id='$cmt_id' ORDER BY cmtonans_id DESC LIMIT 1";
                  $result=mysqli_query($conn,$sql);

                  $row=mysqli_fetch_assoc($result);

                  
                  $user_id=$row['comment_by'];
                  $sql2="SELECT username FROM `users` WHERE sno='$user_id'";
                  $result2=mysqli_query($conn,$sql2);
                  $row2=mysqli_fetch_assoc($result2);
                  $data->cmtboxempty = false;
                  $data->username = $row2['username'];
                  $data->comment_time = $row['comment_time'];
                  $data->comment_content = $row['comment_content'];
                  $myJSON=json_encode($data);
                  echo $myJSON;                          
               }
               else
               {
                  $data->cmtboxempty = true;
                  $myJSON=json_encode($data);
                  echo $myJSON;
               }
            }
      }



      else if($_REQUEST['action']=="cmtonthread")
      {
            $thread_id = intval($_REQUEST['thd_id']);
            $comment=$_REQUEST['comment'];
            $user_id=$_SESSION['sno'];

            $sql="SELECT * FROM `threads` WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            if($row!=null)
            {
               if($comment!=null)
               {
                  $comment=str_replace("<","&lt;",$comment);
                  $comment=str_replace(">","&gt;",$comment);
                  $comment=str_replace("'","''",$comment);
                  $sql="INSERT INTO `commentsonthreads` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$thread_id', '$user_id', current_timestamp());";
                  $result=mysqli_query($conn,$sql);


                  $sql="SELECT * FROM `commentsonthreads` WHERE thread_id='$thread_id' ORDER BY cmtonthd_id DESC LIMIT 1";
                  $result=mysqli_query($conn,$sql);

                  $row=mysqli_fetch_assoc($result);

                  
                  $user_id=$row['comment_by'];
                  $sql2="SELECT username FROM `users` WHERE sno='$user_id'";
                  $result2=mysqli_query($conn,$sql2);
                  $row2=mysqli_fetch_assoc($result2);
                  $data->cmtboxempty = false;
                  $data->username = $row2['username'];
                  $data->comment_time = $row['comment_time'];
                  $data->comment_content = $row['comment_content'];
                  $myJSON=json_encode($data);
                  echo $myJSON;                          
               }
               else
               {
                  $data->cmtboxempty = true;
                  $myJSON=json_encode($data);
                  echo $myJSON;
               }
            }
      }
   }  
?>