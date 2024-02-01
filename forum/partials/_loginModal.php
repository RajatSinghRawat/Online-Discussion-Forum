<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to iDiscuss</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" id="loginEmail" name="loginEmail" aria-describedby="emailHelp">
                        <small id="emailErr" class="form-text text-danger mt-0"></small>
                    </div>
                    <div class="form-group mb-0">
                        <input type="password" class="form-control" placeholder="Password" id="loginPass" name="loginPass">
                        
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" onclick="togglePass()" value="" id="flexCheckDefault">
                        <small class="form-text" for="flexCheckDefault">Show Password</small>                        
                      </div>
                      <small id="pswdErr" class="form-text text-danger mt-0 mb-4"></small>
                    <button onclick="login()" class="btn btn-primary">Login</button>                
            </div>            
        </div>
    </div>
</div>


<script>
    
    function login()
    {
      let alert_msg = document.getElementById("alert");
      if(alert_msg!=null)
      {
        alert_msg.parentNode.removeChild(alert_msg);
      }

      let email = document.getElementById("loginEmail");
      let pswd = document.getElementById("loginPass");
               
        document.getElementById("emailErr").innerHTML="";
        document.getElementById("pswdErr").innerHTML="";
          
        var xmlhttp=new XMLHttpRequest();
            xmlhttp.onload=function()
            {   
                  let login_data = JSON.parse(this.responseText);
                  if(login_data.err_exist==true)
                  {
                    if(login_data.email_err != null)
                    {
                      document.getElementById("emailErr").innerHTML=login_data.email_err;
                    }
                    if(login_data.pswd_err != null)
                    {
                      document.getElementById("pswdErr").innerHTML=login_data.pswd_err;
                    }
                    if(login_data.login_err != null)
                    {
                      let showmsg='<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">'+
                                 '<strong>Error!</strong> '+login_data.login_err+
                                 '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                 '<span aria-hidden="true">&times;</span>'+
                                 '</button>'+
                                 '</div>';
            
                     document.getElementById("loginEmail").insertAdjacentHTML("beforebegin", showmsg);
                     email.value="";
                     pswd.value="";
                    }  
                  
                  }
                  else if(login_data.err_exist==false)
                  {                    
                    location.reload();
                  }
            }
            xmlhttp.open("POST","partials/_handleLogin.php?action=userlogin&loginEmail="+email.value+"&loginPassword="+pswd.value, true);
            xmlhttp.send();
    }


    function togglePass()
    {
      var x = document.getElementById("loginPass");
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