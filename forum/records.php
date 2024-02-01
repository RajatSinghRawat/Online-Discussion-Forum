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
                min-height: 30vh;
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


        function top_heading($heading, $data)
        {
            echo '<div class="container my-4">

                    <div class="jumbotron">
                        <h1 class="display-4">'.$heading.'</h1>
                        
                        <hr class="my-3">
                        <p class="lead">'.$data.'</p>
                        
                    </div>
                  </div>';
        }

        function get_starting_row($total_records, $num_of_records, $action)
        {
            $total_pages = ceil($total_records / $num_of_records);
            if (isset($_GET["page"]) && (is_int((int)$_GET["page"])))
            {      
               if($_GET["page"]>=1 && $_GET["page"]<=$total_pages)         
               {
                   $page_number = (int)$_GET["page"];
               }
               else if($_GET["page"]<1)
               {
                   $page_number=1;
               }
               else if($_GET["page"]>$total_pages)
               {
                   $page_number=$total_pages;
               }
            }
            else
            {    
               $page_number=1;    
            }
   
           $starting_row = ($page_number-1) * $num_of_records;

           if($action=="startingpoint")
           {
            return $starting_row;
           }
           else if($action=="page")
           {
            return $page_number;
           }
        }


        function shorten_string($data, $length)
        {
            $string = strip_tags($data);
                if (strlen($string) > $length) {
                    
                // truncate string
                $stringCut = substr($string, 0, $length);
                $endPoint = strrpos($stringCut, ' ');
                    
                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $string .= '...';
                }
                return $string;
        }
         
    ?>
   
  <?php
        session_start(); 
        if((isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true) || (isset($_SESSION['adminloggedin'])&&$_SESSION['adminloggedin']==true && isset($_GET['uid'])))        
        {

            if(isset($_GET['uid']))
            {
                $user_id=$_GET['uid'];
                $sql="SELECT * FROM `users` WHERE sno='$user_id'";
                $result=mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($result);
                if($row==null)
                {
                    pagenotfound();
                }
                else
                {
                    $adminmode=true;
                    include 'partials/_adminheader.php';
                }
            }
            else
            {
                $user_id=$_SESSION['sno'];
                include 'partials/_header.php';
            }




            
            if(isset($_GET['records']))
            {
                $per_page_record = 5;
                $records_table=$_GET['records'];
                
                if($records_table=="questions")
                {
                    $sql="SELECT COUNT(*) FROM `threads` WHERE thread_user_id=$user_id";
                    $result=mysqli_query($conn, $sql);
                    $row=mysqli_fetch_row($result);
                    $count=$row[0];
                    if($count>0)
                    {

                        if(isset($adminmode) && $adminmode==true)
                        {
                            top_heading("User's Posted Questions", null);
                        }
                        else
                        {
                            top_heading('Your Posted Questions', null);
                        }
                        

                        echo '<div class="container mb-5" id="maincontainer">';

                        $start_from = get_starting_row($count, $per_page_record, "startingpoint");
                        $page = get_starting_row($count, $per_page_record, "page");
                        $sql="SELECT * FROM `threads` WHERE thread_user_id=$user_id ORDER BY netvotes DESC LIMIT $start_from, $per_page_record";
                        $result = mysqli_query($conn, $sql);
                        
                        $noResult=true;
                        while($row=mysqli_fetch_assoc($result)){
                            $noResult=false;  
                            $thread_id=$row['thread_id'];
                            $title=$row['thread_title']; 
                            $thread_time=$row['timestamp'];
                            $netvotes=$row['netvotes'];
                            $total_answers=$row['total_answers'];
                            $desc=$row['thread_desc']; 
                            $desc=shorten_string($desc,500);
                               
                      
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
                                  <h5 class="my-0"><a class="text-dark" href="thread.php?threadid='. $thread_id .'">'. $title .'</a></h5>'.'<div>'. $desc .'</div>
                                  </div>
                                  </div>
                                  </div>
                                  <div class="row">
                                  <div class="col-12 my-0 text-right" style="font-size:12px;"> Asked on: ' . $thread_time. '</div>';
                                  echo '</div>
                                  <hr class="dark mb-0 mt-1" style="border-top: 0.5px solid #A9A9A9">';
                              }
                        
                        echo '</div>';
                    }
                    else
                    {

                        if(isset($adminmode) && $adminmode==true)
                        {
                            top_heading('No Questions Found', 'User has not asked any question');
                        }
                        else
                        {
                            top_heading('No Questions Found', 'You have not asked any question');
                        }

                    }
                }
                else if($records_table=="answers")
                {
                    $sql="SELECT COUNT(*) FROM `comments` WHERE comment_by=$user_id";
                    $result=mysqli_query($conn, $sql);
                    $row=mysqli_fetch_row($result);
                    $count=$row[0];
                    if($count>0)
                    {

                        if(isset($adminmode) && $adminmode==true)
                        {
                            top_heading("User's Posted Answers", null);
                        }
                        else
                        {
                            top_heading('Your Posted Answers', null);    
                        }
                        
                        echo '<div class="container mb-5" id="maincontainer">';

                        $start_from = get_starting_row($count, $per_page_record, "startingpoint");
                        $page = get_starting_row($count, $per_page_record, "page");
                        $sql="SELECT * FROM `comments` WHERE comment_by=$user_id ORDER BY netvotes DESC LIMIT $start_from, $per_page_record";
                        $result = mysqli_query($conn, $sql);

                        $noResult=true;
                        while($row=mysqli_fetch_assoc($result)){
                            $counter=0;
                            $position=0;
                            $page_num=0;
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
                        $page_num = ceil($position / 2);

                        $answer_content= shorten_string($answer_content,100);
                                              
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
                                    <h5 class="my-0"><a class="text-dark" href="thread.php?threadid='. $thread_id .'&page='.$page_num.'&cmtid='.$comment_id.'">'. $answer_content .'</a></h5>'.
                                    '</div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-12 my-0 text-right" style="font-size:12px;"> Answered on: ' . $answer_time. '</div>';
                                    echo '</div>
                                    <hr class="dark mb-0 mt-1" style="border-top: 0.5px solid #A9A9A9">';
                        }
                                                              
                        echo '</div>';

                    }
                    else
                    {
                        if(isset($adminmode) && $adminmode==true)
                        {
                            top_heading('No Answers Found', 'User has not answered any question');
                        }
                        else
                        {
                            top_heading('No Answers Found', 'You have not answered any question');    
                        }
                    }
                }
                else if($records_table=="cmtsonques")
                {
                    $sql="SELECT COUNT(*) FROM `commentsonthreads` WHERE comment_by=$user_id";
                    $result=mysqli_query($conn, $sql);
                    $row=mysqli_fetch_row($result);
                    $count=$row[0];
                    if($count>0)
                    {
                        if(isset($adminmode) && $adminmode==true)
                        {
                            top_heading("User's Posted Comments On Questions", null);
                        }
                        else
                        {
                            top_heading('Your Posted Comments On Questions', null);    
                        }
                        echo '<div class="container mb-5" id="maincontainer">';

                        $start_from = get_starting_row($count, $per_page_record, "startingpoint");
                        $page = get_starting_row($count, $per_page_record, "page");
                        $sql="SELECT * FROM `commentsonthreads` WHERE comment_by=$user_id LIMIT $start_from, $per_page_record";
                        $result = mysqli_query($conn, $sql);


                        $noResult=true;
                        while($row=mysqli_fetch_assoc($result)){
                        $noResult=false;
                        $cmtonthd_id=$row['cmtonthd_id'];
                        $thread_id=$row['thread_id']; 
                        $comment_content=$row['comment_content']; 
                        $comment_time=$row['comment_time'];

                        $comment_content=shorten_string($comment_content,100);

                        echo  '<div class="row">
                        <div class="col-1 mt-3">
                        
                        </div>
                        
                        <div class="col-11 media mt-3">'.
                                '<div class="media-body"> 
                                    <h5 class="my-0"><a class="text-dark" href="thread.php?threadid='.$thread_id.'&thdcmtid='.$cmtonthd_id.'">'. $comment_content .'</a></h5>'.
                                    '</div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-12 my-0 text-right" style="font-size:12px;"> Commented on: ' .$comment_time. '</div>';
                                    echo '</div>
                                    <hr class="dark mb-0 mt-1" style="border-top: 0.5px solid #A9A9A9">';
                                }

                                echo '</div>';
                    }
                    else
                    {
                        if(isset($adminmode) && $adminmode==true)
                        {
                            top_heading('No Comments Found', 'User has not commented on any question');
                        }
                        else
                        {
                            top_heading('No Comments Found', 'You have not commented on any question');        
                        }
                        
                    }
                }
                else if($records_table=="cmtsonans")
                {
                    $sql="SELECT COUNT(*) FROM `commentsonanswers` WHERE comment_by=$user_id";
                    $result=mysqli_query($conn, $sql);
                    $row=mysqli_fetch_row($result);
                    $count=$row[0];
                    if($count>0)
                    {
                        if(isset($adminmode) && $adminmode==true)
                        {
                            top_heading("User's Posted Comments On Answers", null);
                        }
                        else
                        {
                            top_heading('Your Posted Comments On Answers', null);        
                        }

                        echo '<div class="container mb-5" id="maincontainer">';

                        $start_from = get_starting_row($count, $per_page_record, "startingpoint");
                        $page = get_starting_row($count, $per_page_record, "page");
                        $sql="SELECT * FROM `commentsonanswers` WHERE comment_by=$user_id LIMIT $start_from, $per_page_record";
                        $result = mysqli_query($conn, $sql);

                        $noResult=true;
                        while($row=mysqli_fetch_assoc($result)){
                        $counter=0;
                        $position=0;
                        $page_num=0;
                        $noResult=false;
                        $cmtonans_id=$row['cmtonans_id'];
                        $comment_id=$row['comment_id']; 
                        $comment_content=$row['comment_content']; 
                        $comment_time=$row['comment_time'];

                        $comment_content=shorten_string($comment_content,100);

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
                        $page_num = ceil($position / 2);
                        
                        echo  '<div class="row">
                        <div class="col-1 mt-3">
                        
                        </div>
                        
                        <div class="col-11 media mt-3">'.
                                '<div class="media-body"> 
                                    <h5 class="my-0"><a class="text-dark" href="thread.php?threadid='.$thread_id.'&commentid='.$comment_id.'&anscmtid='.$cmtonans_id.'&page='.$page_num.'">'. $comment_content .'</a></h5>'.
                                    '</div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-12 my-0 text-right" style="font-size:12px;"> Commented on: ' .$comment_time. '</div>';
                                    echo '</div>
                                    <hr class="dark mb-0 mt-1" style="border-top: 0.5px solid #A9A9A9">';
                                }

                                echo '</div>';
                    }
                    else
                    {
                        if(isset($adminmode) && $adminmode==true)
                        {
                            top_heading('No Comments Found', 'User has not commented on any answer');
                        }
                        else
                        {
                            top_heading('No Comments Found', 'You have not commented on any answer');            
                        }                        
                    }
                }
                else
                {
                     pagenotfound();
                }          
            }
            else
            {
                 pagenotfound();
            }
        }
        else
        {
             pagenotfound();
        }
  ?>


<div class="text-center pb-2 page">    
      <?php       
        echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($count / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2&&(!$noResult)){   
            echo "<a class='rounded' href='records.php?records=".$records_table."&page=".($page-1)."'> Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active rounded' href='records.php?records=".$records_table."&page="  
                                                .$i."'> ".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a class='rounded'  href='records.php?records=".$records_table."&page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a class='rounded'  href='records.php?records=".$records_table."&page=".($page+1)."'> Next </a>";   
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