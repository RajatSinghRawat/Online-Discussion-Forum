
<?php
    include '_dbconnect.php';
    if($_REQUEST['action']=="userlogin")
    {
        $user_email=$_REQUEST['loginEmail'];
        $pass=$_REQUEST['loginPassword'];
        $email_empty=false;
        $pass_empty=false;
        
        $data = new stdClass();
        $data->err_exist = false;

        if(empty($user_email) || empty($pass))
        {
            if(empty($user_email))
            {
                $data->email_err = "Email field empty";
                $data->err_exist = true;
                $email_empty=true;
            }

            if(empty($pass))
            {
                $data->pswd_err = "Password field empty";
                $data->err_exist = true;
                $pass_empty=true;           
            }
        }
        if((!$email_empty))
        {
            if (filter_var($user_email, FILTER_VALIDATE_EMAIL))
            {
                $sql="Select * from users where user_email='$user_email'";
                $result=mysqli_query($conn, $sql);
                $numRows=mysqli_num_rows($result);
                if($numRows==1)
                {
                    $row=mysqli_fetch_assoc($result);
                    if(!$pass_empty)
                    {
                        if(password_verify($pass,$row['user_pass']))
                        {
                            if($row['loggedin']==false)
                            {
                                session_start();
                                $_SESSION['loggedin']=true;
                                $_SESSION['sno']=$row['sno'];
                                $_SESSION['useremail']=$user_email;
                                $_SESSION['username']=$row['username']; 
                                $user_id=$row['sno'];
                                $sql="UPDATE users SET loggedin='1' WHERE sno='$user_id'";
                                mysqli_query($conn, $sql);                        
                            }
                            else
                            {
                                $data->login_err = "User already loggedin.";
                                $data->err_exist = true;
                            }
                        }
                        else
                        {
                            $data->pswd_err = "Wrong password entered";
                            $data->err_exist = true;
                        }
                    }      
                }
                else
                {
                    $data->email_err = "Entered email does not exist";
                    $data->err_exist = true;
                }
            }
            else
            {
                $data->email_err = "Invalid email format";
                $data->err_exist = true;
            }
        }
        
        $myJSON=json_encode($data);
        echo $myJSON;
    }
    else if($_REQUEST['action']=="adminlogin")
    {
        $uname=$_REQUEST['loginUsername'];
        $pass=$_REQUEST['loginPassword'];
        $uname_empty=false;
        $pass_empty=false;
        
        $data = new stdClass();
        $data->err_exist = false;

        if(empty($uname) || empty($pass))
        {
            if(empty($uname))
            {
                $data->uname_err = "Username field empty";
                $data->err_exist = true;
                $uname_empty=true;
            }

            if(empty($pass))
            {
                $data->pswd_err = "Password field empty";
                $data->err_exist = true;
                $pass_empty=true;           
            }
        }
        if((!$uname_empty))
        {           
                $sql="Select * from admins where username='$uname'";
                $result=mysqli_query($conn, $sql);
                $numRows=mysqli_num_rows($result);
                if($numRows==1)
                {
                    $row=mysqli_fetch_assoc($result);
                    if(!$pass_empty)
                    {
                        if(password_verify($pass,$row['admin_pass']))
                        {
                            if($row['loggedin']==false)
                            {
                                session_start();
                                $_SESSION['adminloggedin']=true;
                                $_SESSION['sno']=$row['sno'];
                                
                                $_SESSION['username']=$row['username']; 
                                $admin_id=$row['sno'];
                                $sql="UPDATE admins SET loggedin='1' WHERE sno='$admin_id'";
                                mysqli_query($conn, $sql);                        
                            }
                            else
                            {
                                $data->login_err = "User already loggedin.";
                                $data->err_exist = true;
                            }
                        }
                        else
                        {
                            $data->pswd_err = "Wrong password entered";
                            $data->err_exist = true;
                        }
                    }      
                }
                else
                {
                    $data->uname_err = "Entered username does not exist";
                    $data->err_exist = true;
                }           
        }        
        $myJSON=json_encode($data);
        echo $myJSON;
    }
?>
