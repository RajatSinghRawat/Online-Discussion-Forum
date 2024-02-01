<?php
error_reporting(0);
session_start();
include '_dbconnect.php';
 
   if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
   {   
      
            $thread_id = intval($_REQUEST['thd_id']);
            $answer=$_REQUEST['answer'];
            $user_id=$_SESSION['sno'];

            $sql="SELECT * FROM `threads` WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            if($row!=null)
            {
               if($answer!=null)
               {
                  $answer=str_replace("<","&lt;",$answer);
                  $answer=str_replace(">","&gt;",$answer);
                  $answer=str_replace("'","''",$answer);
                  $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$answer', '$thread_id', '$user_id', current_timestamp());";
                  $result=mysqli_query($conn,$sql);


                  $sql="SELECT COUNT(*) FROM `comments` WHERE thread_id='$thread_id'";
                  $result=mysqli_query($conn,$sql);

                  $row=mysqli_fetch_assoc($result);

                                   
                  $data->ansboxempty = false;
                  $data->totalanswers = $row;
                  
                  $myJSON=json_encode($data);
                  echo $myJSON;                          
               }
               else
               {
                  $data->ansboxempty = true;
                  $myJSON=json_encode($data);
                  echo $myJSON;
               }
            }
      
   }  
?>