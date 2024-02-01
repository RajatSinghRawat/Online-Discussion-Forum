
<?php
    
    include '_dbconnect.php';
    $username=$_REQUEST['signupUsername'];
    $user_email=$_REQUEST['signupEmail'];
    $pass=$_REQUEST['signupPassword'];
    $cpass=$_REQUEST['signupcPassword'];
    $is_valid=true;
    $data = new stdClass();
    $data->err_exist = false;


    if(empty($username))
    {
        $data->uname_err = "Username field empty";
        $data->err_exist = true;
        $is_valid=false;
    }
    else
    {
        //Check whether this username exists
        $existSql="select * from `users` where username='$username'";
        $result=mysqli_query($conn,$existSql);
        $numRows=mysqli_num_rows($result);
        if($numRows>0)
        {          
            $data->uname_err = "Username already in use";
            $data->err_exist = true;
            $is_valid=false;
        }
    }
    

    if(empty($user_email))
    {
        $data->email_err = "Email field empty";
        $data->err_exist = true;
        $is_valid=false; 
    }
    else
    {
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) 
        {
            $data->email_err = "Invalid email format";
            $data->err_exist = true;
            $is_valid=false;
        }
        else
        {
            //Check whether this email exists
            $existSql="select * from `users` where user_email='$user_email'";
            $result=mysqli_query($conn,$existSql);
            $numRows=mysqli_num_rows($result);
            if($numRows>0)
            {
                $data->email_err = "Email already in use";
                $data->err_exist = true;
                $is_valid=false;
            }
        }
    }
    
    

    if(empty($pass) || empty($cpass))
    {
        if(empty($pass))
        {
            $data->pswd_err = "Password field empty";
            $data->err_exist = true;
            $is_valid=false;
        }

        if(empty($cpass))
        {
            $data->cpswd_err = "Confirm Password field empty";
            $data->err_exist = true;
            $is_valid=false;
        }
    }   
    else if($pass != $cpass)
    {
        $data->cpswd_err = "Passwords do not match";
        $data->err_exist = true;
        $is_valid=false;
    }
                  
    
    if(!$is_valid)
    {
        $myJSON=json_encode($data);
        echo $myJSON;
    }
    else
    {
        $hash=password_hash($pass,PASSWORD_DEFAULT);
        $sql="INSERT INTO `users` (`username`, `user_email`, `user_pass`, `timestamp`) VALUES ('$username', '$user_email', '$hash', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        if($result)
        {
            $myJSON=json_encode($data);
            echo $myJSON;
        }
    }
?>