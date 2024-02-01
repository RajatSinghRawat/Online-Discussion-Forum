<?php
error_reporting(0);
session_start();
 include '_dbconnect.php';
 if($_REQUEST['action']=="voteonthread")
 { 
   if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
   {   
      $vote = intval($_REQUEST['vote']);
      $thread_id=intval($_REQUEST['thread_id']);
      $user_id=$_SESSION['sno'];
      if($vote==1)
      {
         $sql="SELECT vote_value FROM `uservotesonthreads` WHERE thread_id='$thread_id' AND user_id='$user_id'";
         $result=mysqli_query($conn,$sql);
         $row=mysqli_fetch_assoc($result);
         if($row!=null)
         {                      
           if($row['vote_value']==0)
           {
             $sql="UPDATE uservotesonthreads SET vote_value='1' WHERE thread_id=$thread_id AND user_id='$user_id'"; 
           }  
           else if($row['vote_value']==-1)
           {
             $sql="UPDATE uservotesonthreads SET vote_value='1' WHERE thread_id=$thread_id AND user_id='$user_id'";
             $vote=2;
           } 
           else if($row['vote_value']==1)
           {
             $sql="UPDATE uservotesonthreads SET vote_value='0' WHERE thread_id=$thread_id AND user_id='$user_id'";                           
             $vote=-1;
           }
            $result=mysqli_query($conn, $sql);
            $sql="SELECT netvotes FROM `threads` WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
            $netvotes=$row['netvotes'];
            $netvotes=$netvotes+$vote;
            $sql="UPDATE threads SET netvotes=$netvotes WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn, $sql);
         }                      
         else if($row==null)
         {
            $sql="INSERT INTO `uservotesonthreads` (`user_id`, `thread_id`, `vote_value`) VALUES ('$user_id', '$thread_id', '$vote');";
            $result=mysqli_query($conn, $sql);    
            $sql="SELECT netvotes FROM `threads` WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
            $netvotes=$row['netvotes'];
            $netvotes=$netvotes+$vote;
            $sql="UPDATE threads SET netvotes=$netvotes WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn, $sql);
         }                            
      }
      else if($vote==-1)
      {
         $sql="SELECT vote_value FROM `uservotesonthreads` WHERE thread_id='$thread_id' AND user_id='$user_id'";
         $result=mysqli_query($conn,$sql);
         $row=mysqli_fetch_assoc($result);
         if($row!=null)
         {                      
            if($row['vote_value']==0)
            {
               $sql="UPDATE uservotesonthreads SET vote_value='-1' WHERE thread_id=$thread_id AND user_id='$user_id'"; 
            }   
            else if($row['vote_value']==1)
            {
               $sql="UPDATE uservotesonthreads SET vote_value='-1' WHERE thread_id=$thread_id AND user_id='$user_id'";
               $vote=-2;
            }
            else if($row['vote_value']==-1)
            {
               $sql="UPDATE uservotesonthreads SET vote_value='0' WHERE thread_id=$thread_id AND user_id='$user_id'";                           
               $vote=1;
            }
            $result=mysqli_query($conn, $sql);
            $sql="SELECT netvotes FROM `threads` WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
            $netvotes=$row['netvotes'];
            $netvotes=$netvotes+$vote;
            $sql="UPDATE threads SET netvotes=$netvotes WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn, $sql);
         }                     
         else if($row==null)
         {
            $sql="INSERT INTO `uservotesonthreads` (`user_id`, `thread_id`, `vote_value`) VALUES ('$user_id', '$thread_id', '$vote');";
            $result=mysqli_query($conn, $sql);    
            $sql="SELECT netvotes FROM `threads` WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
            $netvotes=$row['netvotes'];
            $netvotes=$netvotes+$vote;
            $sql="UPDATE threads SET netvotes=$netvotes WHERE thread_id='$thread_id'";
            $result=mysqli_query($conn, $sql);
         }
      }
                        
         $sql="SELECT netvotes FROM `threads` WHERE thread_id='$thread_id'";
         $result=mysqli_query($conn, $sql);
         $row=mysqli_fetch_assoc($result);
         $netvotes=$row['netvotes'];
         echo $netvotes;
   }
   else
   {
      echo 'notloggedin';   
   }
   
 }
 else if($_REQUEST['action']=="voteoncomment")
 {
   if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
   {   
      $vote = intval($_REQUEST['vote']);
      $comment_id=intval($_REQUEST['comment_id']);
      $user_id=$_SESSION['sno'];

      $sql="SELECT * FROM `comments` WHERE comment_id='$comment_id'";
      $result=mysqli_query($conn,$sql);
      $row=mysqli_fetch_assoc($result);
      if($row!=null)
      {

      if($vote==1)
      {
         $sql="SELECT vote_value FROM `uservotesoncomments` WHERE comment_id='$comment_id' AND user_id='$user_id'";
         $result=mysqli_query($conn,$sql);
         $row=mysqli_fetch_assoc($result);
         if($row!=null)
         {                      
           if($row['vote_value']==0)
           {
             $sql="UPDATE uservotesoncomments SET vote_value='1' WHERE comment_id=$comment_id AND user_id='$user_id'"; 
           }  
           else if($row['vote_value']==-1)
           {
             $sql="UPDATE uservotesoncomments SET vote_value='1' WHERE comment_id=$comment_id AND user_id='$user_id'";
             $vote=2;
           } 
           else if($row['vote_value']==1)
           {
             $sql="UPDATE uservotesoncomments SET vote_value='0' WHERE comment_id=$comment_id AND user_id='$user_id'";                           
             $vote=-1;
           }
            $result=mysqli_query($conn, $sql);
            $sql="SELECT netvotes FROM `comments` WHERE comment_id='$comment_id'";
            $result=mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
            $netvotes=$row['netvotes'];
            $netvotes=$netvotes+$vote;
            $sql="UPDATE comments SET netvotes=$netvotes WHERE comment_id='$comment_id'";
            $result=mysqli_query($conn, $sql);
         }                      
         else if($row==null)
         {
            $sql="INSERT INTO `uservotesoncomments` (`user_id`, `comment_id`, `vote_value`) VALUES ('$user_id', '$comment_id', '$vote');";
            $result=mysqli_query($conn, $sql);    
            $sql="SELECT netvotes FROM `comments` WHERE comment_id='$comment_id'";
            $result=mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
            $netvotes=$row['netvotes'];
            $netvotes=$netvotes+$vote;
            $sql="UPDATE comments SET netvotes=$netvotes WHERE comment_id='$comment_id'";
            $result=mysqli_query($conn, $sql);
         }                            
      }
      else if($vote==-1)
      {
         $sql="SELECT vote_value FROM `uservotesoncomments` WHERE comment_id='$comment_id' AND user_id='$user_id'";
         $result=mysqli_query($conn,$sql);
         $row=mysqli_fetch_assoc($result);
         if($row!=null)
         {                      
            if($row['vote_value']==0)
            {
               $sql="UPDATE uservotesoncomments SET vote_value='-1' WHERE comment_id=$comment_id AND user_id='$user_id'"; 
            }   
            else if($row['vote_value']==1)
            {
               $sql="UPDATE uservotesoncomments SET vote_value='-1' WHERE comment_id=$comment_id AND user_id='$user_id'";
               $vote=-2;
            }
            else if($row['vote_value']==-1)
            {
               $sql="UPDATE uservotesoncomments SET vote_value='0' WHERE comment_id=$comment_id AND user_id='$user_id'";                           
               $vote=1;
            }
            $result=mysqli_query($conn, $sql);
            $sql="SELECT netvotes FROM `comments` WHERE comment_id='$comment_id'";
            $result=mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
            $netvotes=$row['netvotes'];
            $netvotes=$netvotes+$vote;
            $sql="UPDATE comments SET netvotes=$netvotes WHERE comment_id='$comment_id'";
            $result=mysqli_query($conn, $sql);
         }                     
         else if($row==null)
         {
            $sql="INSERT INTO `uservotesoncomments` (`user_id`, `comment_id`, `vote_value`) VALUES ('$user_id', '$comment_id', '$vote');";
            $result=mysqli_query($conn, $sql);    
            $sql="SELECT netvotes FROM `comments` WHERE comment_id='$comment_id'";
            $result=mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
            $netvotes=$row['netvotes'];
            $netvotes=$netvotes+$vote;
            $sql="UPDATE comments SET netvotes=$netvotes WHERE comment_id='$comment_id'";
            $result=mysqli_query($conn, $sql);
         }
      }
                        
         $sql="SELECT netvotes FROM `comments` WHERE comment_id='$comment_id'";
         $result=mysqli_query($conn, $sql);
         $row=mysqli_fetch_assoc($result);
         $netvotes=$row['netvotes'];
         echo $netvotes;   
      }        
   }
   else
   {
      echo 'notloggedin';   
   }
 }
?>