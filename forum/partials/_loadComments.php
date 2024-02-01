<?php
error_reporting(0);
session_start();
include '_dbconnect.php';
     
      if($_REQUEST['action']=="loadthdcmnts")
      {
            $thread_id = intval($_REQUEST['thd_id']);
            $total_thd_cmnts = intval($_REQUEST['ttl_cmnts']);
            $cmnts_to_load = $total_thd_cmnts-2;

            $sql="SELECT * FROM `threads` WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);

            if($row!=null)
            {

            $sql="SELECT * FROM `commentsonthreads` WHERE thread_id='$thread_id' LIMIT $cmnts_to_load OFFSET 2";
            $result=mysqli_query($conn,$sql);
            $i=0;
            
                  while($row=mysqli_fetch_assoc($result))
                  {                
                  $user_id=$row['comment_by'];
                  $sql2="SELECT username FROM `users` WHERE sno='$user_id'";
                  $result2=mysqli_query($conn,$sql2);
                  $row2=mysqli_fetch_assoc($result2);
                  $data->username[$i] = $row2['username'];
                  $data->comment_time[$i] = $row['comment_time'];
                  $data->comment_content[$i] = $row['comment_content'];
                  $data->cmtonthd_id[$i] = $row['cmtonthd_id'];
                  $i++;                          
                  }
                  $data->total_records=$i;
                  $myJSON=json_encode($data);
                  echo $myJSON;            
            }   
      }
      else if($_REQUEST['action']=="loadanscmnts")
      {
            $comment_id = intval($_REQUEST['cmt_id']);
            $total_ans_cmnts = intval($_REQUEST['ttl_cmnts']);
            $cmnts_to_load = $total_ans_cmnts-2;

            $sql="SELECT * FROM `comments` WHERE comment_id='$comment_id'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);

            if($row!=null)
            {

            $sql="SELECT * FROM `commentsonanswers` WHERE comment_id='$comment_id' LIMIT $cmnts_to_load OFFSET 2";
            $result=mysqli_query($conn,$sql);
            $i=0;
            
                  while($row=mysqli_fetch_assoc($result))
                  {                
                  $user_id=$row['comment_by'];
                  $sql2="SELECT username FROM `users` WHERE sno='$user_id'";
                  $result2=mysqli_query($conn,$sql2);
                  $row2=mysqli_fetch_assoc($result2);
                  $data->username[$i] = $row2['username'];
                  $data->comment_time[$i] = $row['comment_time'];
                  $data->comment_content[$i] = $row['comment_content'];
                  $data->cmtonans_id[$i] = $row['cmtonans_id'];
                  $i++;                          
                  }
                  $data->total_records=$i;
                  $myJSON=json_encode($data);
                  echo $myJSON;            
            }   
      }     
?>