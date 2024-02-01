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
    }
    else
    {
        include 'partials/_header.php';
    }
    
    ?>
       
    <!-- Search Results -->
    <div class="container my-3" id="maincontainer">
    
        <div class="jumbotron py-4 my-4">
            <div class="container">
                
                <h1 class="py-3">Search results for <em>
                <?php 
                    if(isset($_GET['search']))  
                    {              
                        echo '"'.$_GET['search'];
                    }
                    else
                    {
                        echo '';
                    }
                ?>"</em></h1>
        
            </div>
        </div>

    <hr class="dark my-2" style="border-top: 0.5px solid #A9A9A9">
            
<?php

if(!isset($_GET['search']))  
{              
    echo '<div class="jumbotron jumbotron-fluid">
              <div class="container">
                  <p class="display-4">No Results Found</p>
                  <p class="lead">Suggestions:<ul>
                               <li> Make sure that all words are spelled correctly.</li>
                               <li>Try different keywords.</li>
                               <li>Try more general keywords.</li>
                               <li>Try fewer keywords.</li></ul>
                  </p>
              </div>
            </div>
            </div>';
            include 'partials/_footer.php';
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

        $noResults=true;
        $query=$_GET["search"];
        $per_page_record = 5;  // Number of entries to show in a page.   
        
        if(isset($_SESSION['adminloggedin']) && ($_SESSION['adminloggedin']=="true"))
        {
            $query3 = "SELECT COUNT(*) FROM `users` WHERE match (username, user_email) against ('$query')";    
        }
        else
        {
            $query3 = "SELECT COUNT(*) FROM `threads` WHERE match (thread_title, thread_desc) against ('$query')";
        }
             
        $rs_result = mysqli_query($conn, $query3);     
        $row3 = mysqli_fetch_row($rs_result);     
        $total_records3 = $row3[0];     
      
        // Number of pages required.   
        $total_pages3 = ceil($total_records3 / $per_page_record);

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

        if(isset($_SESSION['adminloggedin']) && ($_SESSION['adminloggedin']=="true"))
        {
            $query2 = "SELECT * FROM `users` WHERE match (username, user_email) against ('$query') LIMIT $start_from, $per_page_record";    
        }
        else
        {
            $query2 = "SELECT * FROM `threads` WHERE match (thread_title, thread_desc) against ('$query') LIMIT $start_from, $per_page_record";
        }

        $rs_result = mysqli_query ($conn, $query2);

        if(isset($_SESSION['adminloggedin']) && ($_SESSION['adminloggedin']=="true"))
        {
        while($row=mysqli_fetch_assoc($rs_result)){
            $noResults=false;  
            $user_id=$row['sno'];
            $username=$row['username']; 
            $user_email=$row['user_email'];
            $timestamp=$row['timestamp'];
                
        echo '<div class="row">
              <div class="col-9 media mt-3">'.
              '<div class="media-body"> 
              
                  <h5 class="my-0"><a class="text-dark" href="userprofile.php?uid='. $user_id .'">'. $username .'</a></h5>
                      
                  <span style="font-size:14px;">Email: <span class="text-success">'. $user_email .'</span></span>
                
                  &nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:14px;">Profile Created On: <span class="text-success">'. $timestamp .'</span></span>
                                    
                  </div>
                  </div>
                  </div>                                                    
                  <hr class="my-1">';
              }

            }
            else
            {

        while($row2=mysqli_fetch_array($rs_result))
        {
            $title=$row2['thread_title']; 
            $desc=$row2['thread_desc'];
            $thread_id=$row2['thread_id']; 
            $url="thread.php?threadid=". $thread_id;
            $noResults=false;

            $string = strip_tags($desc);
            if (strlen($string) > 500) {

            // truncate string
            $stringCut = substr($string, 0, 500);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
            }

            //Display the search result
            echo '<div class="result">
            <h5><a href="'. $url. '" class="text-dark">'. $title. '</a></h5>
            <p class="my-1">'. $string .'</p>
            </div>
            <hr class="my-1">';
        }
    }

        if($noResults)
        {
          echo '<div class="container">
                <div class="jumbotron my-4 py-4">
                  <div class="container">
                      <p class="display-4">No Results Found</p>
                      <p class="lead">Suggestions:<ul>
                                   <li> Make sure that all words are spelled correctly.</li>
                                   <li>Try different keywords.</li>
                                   <li>Try more general keywords.</li>
                                   <li>Try fewer keywords.</li></ul>
                      </p>
                  </div>
                </div>
                </div>';
        }

    ?>
           
    </div>

    <div class="page text-center pb-2">    
      <?php       
  
        echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records3 / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2&&(!$noResults)){   
            echo "<a class='rounded' href='search.php?search=".$query."&page=".($page-1)."'> Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active rounded' href='search.php?search=".$query."&page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a class='rounded' href='search.php?search=".$query."&page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a class='rounded' href='search.php?search=".$query."&page=".($page+1)."'> Next </a>";   
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