
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Signup for an iDiscuss Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">

                    <div class="form-group" id="uname">
                        <input type="text" class="form-control" placeholder="Username" id="signupUname" name="username" aria-describedby="emailHelp">
                          <small id="unameErr" class="form-text text-danger mt-0"></small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" id="signupEmail" name="email" aria-describedby="emailHelp">
                          <small id="emailError" class="form-text text-danger mt-0"></small>
                    </div>
                    
                    <div class="form-group mb-0">
                        <input type="password" class="form-control" placeholder="Password" id="signupPassword" name="signupPassword">
              
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" onclick="togglePassword()" value="" id="flexCheckDefault">
                        <small class="form-text" for="flexCheckDefault">Show Password</small>                        
                      </div>
                      <small id="pswdError" class="form-text text-danger mt-0 mb-4"></small>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" id="signupcPassword" name="signupcPassword">
                        <small id="cpswdErr" class="form-text text-danger mt-0"></small>
                      </div>
                    
                    <button class="btn btn-primary" onclick="signup()">Signup</button>                    
            </div>         
    </div>
  </div>
</div>
<script>

    function signup()
    {
      let alert_msg = document.getElementById("alert");
      if(alert_msg!=null)
      {
        alert_msg.parentNode.removeChild(alert_msg);
      }

      let username = document.getElementById("signupUname");
      let email = document.getElementById("signupEmail");
      let pswd = document.getElementById("signupPassword");
      let cpswd = document.getElementById("signupcPassword");
           
        document.getElementById("unameErr").innerHTML="";     
        document.getElementById("emailError").innerHTML="";
        document.getElementById("pswdError").innerHTML="";
        document.getElementById("cpswdErr").innerHTML="";
          
        var xmlhttp=new XMLHttpRequest();
            xmlhttp.onload=function()
            {   
                  let signup_data = JSON.parse(this.responseText);
                  if(signup_data.err_exist==true)
                  {
                    if(signup_data.uname_err != null)
                    {     
                      document.getElementById("unameErr").innerHTML=signup_data.uname_err;                      
                    }
                    if(signup_data.email_err != null)
                    {
                      document.getElementById("emailError").innerHTML=signup_data.email_err;
                    }
                    if(signup_data.pswd_err != null)
                    {
                      document.getElementById("pswdError").innerHTML=signup_data.pswd_err;
                    }
                    if(signup_data.cpswd_err != null)
                    {
                      document.getElementById("cpswdErr").innerHTML=signup_data.cpswd_err;
                    }  
                  }
                  else if(signup_data.err_exist==false)
                  {                    
                    let showmsg='<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">'+
                                 '<strong>Success!</strong> You can now login.'+
                                 '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                 '<span aria-hidden="true">&times;</span>'+
                                 '</button>'+
                                 '</div>';
            
                     document.getElementById("uname").insertAdjacentHTML("beforebegin", showmsg);
                     username.value="";
                     email.value="";
                     pswd.value="";
                     cpswd.value="";
                  }
            }
            xmlhttp.open("POST","partials/_handleSignup.php?signupUsername="+username.value+"&signupEmail="+email.value+"&signupPassword="+pswd.value+"&signupcPassword="+cpswd.value, true);
            xmlhttp.send();
    }


    function togglePassword()
    {
      var x = document.getElementById("signupPassword");
      if (x.type === "password") 
      {
        x.type = "text";
      } 
      else 
      {
        x.type = "password";
      }
    }

</script>