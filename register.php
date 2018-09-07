<?php
session_start();

if (isset($_SESSION["loginUser"]))
{
  if ($_SESSION["loginUser"] == "Administrator")
  {
    header("Location: ./admin/adminIndex.php");
    exit();
  }
  else
  {
    header("Location: ./home.php");
    exit();
  }
  
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Spectrum Educational Tool Register</title>
<link rel="stylesheet" href="http://www.auburn.edu/template/styles/stretchSidebar.css" media="screen" type="text/css" />
<!--#include virtual="/template/includes/head.html" -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>
<body>
<div id="pageWrap"> 
  <div id="headerWrap">
    <div id="header">
      <div id="logo">
      <a href="http://www.auburn.edu/"><img src="http://www.auburn.edu/template/styles/images/headerLogo2.png" alt="Auburn University Homepage"></a>
        
      </div>
      <div id="headerTitle">
        <div class="titleArea" style="position: relative;left: 230px;top:40px">
          <span class="mainHeading"><!-- TemplateBeginEditable name="unitTitle" -->Spectrum Educational Tool<!-- TemplateEndEditable --></span>
          <span class="subHeading"><!-- TemplateBeginEditable name="unitSubTitle" -->an online resource training for student 
      teachers<!-- TemplateEndEditable --></span>
        </div>
      </div>
    </div>
  </div>
  <div id="contentArea">
    <div class="sidebar">
      <h4><a href="./home.php" target="_self" title="Home">Home</a></h4>
      <div class="orangeDecorBar" style="width: 200px"></div>
      <a href="./login.php">Log in</a>
      <h4><a href="./register.php">Register</a></h4>
    </div>
    <div class="contentDivision"> 
      <p class="breadcrumb"> <!-- TemplateBeginEditable name="breadcrumb" --> <a href="./home.php">Home</a> &gt; Register <!-- TemplateEndEditable --> </p>
      <!-- TemplateBeginEditable name="body" -->

   <form name="register_details" action="./data/db-register.php" method="POST" onsubmit="return Validate()">
    <center>
        <table style="width:600px; border="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>

          <tr>
            <td width="139" align="right">
              <strong>User Account/Username:</strong>
            </td>
            <td width="245" align="left">
              <input type="text" name="username" value="" maxlength="50" style="width:175px; text-transform:none;">                
              <div id="uname_error" style="color:#f44336;">
                <?php
                if(empty($_SESSION["regMsg"]))
                {
                  echo "";
                }
                else
                {  
                  echo "*Username exists";
                  //$_SESSION["regMsg"] = ""; 
                }
                ?>
              </div>
              
            </td>
          </tr>

          <tr>
            <td width="139" align="right">
              <strong>User Real Name:</strong>
            </td>
            <td width="245" align="left">
              <input type="text" name="userRealName" value="" maxlength="50" style="width:175px; text-transform:none;">
              <div id="urealn_error" style="color:#f44336;"></div>
            </td>
          </tr>

          <tr>
            <td width="139" align="right">
              <strong>Email:</strong>
            </td>
            <td width="245" align="left">
              <input type="text" name="email" value="" maxlength="50" style="width:175px; text-transform:none;">
              <div id="email_error" style="color:#f44336;"></div>
            </td>
          </tr>

          <tr>
            <td align="right">
              <strong>Password:<strong> 
            </td>
            <td align="left">
              <input type="password" name="password" value="" maxlength="30" style="width:175px; text-transform:none;">
              <div id="password_error" style="color:#f44336;"></div>
            </td>
          </tr>

          <tr>
            <td align="right">
              <strong>Comfirm Password:<strong>
            </td>
            <td align="left">
              <input type="password" name="confPwd" value="" maxlength="30" style="width:175px; text-transform:none;">
              <div id="confPwd_error" style="color:#f44336;"></div>
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <br />
              <input type="submit" name="submit" value="Sign Up" onMouseOver="this.style.cursor='hand'" style="width:88px; height:30px;">      
              <input type="reset" value="Reset" onMouseOver="this.style.cursor='hand'" style="width:88px; height:30px;">
              <br /><br />
            </td>
          </tr>
        </table>
      </center>
    </form>

    </div>
  </div>
  <div id="contentArea_bottom"></div>
  <div id="footerWrap">
    <div id="footer">
    
    </div>  
    <div id="subfooter">
      Auburn University | Auburn, Alabama 36849 | (334) 844-4000  | <script type="text/javascript">emailE='gmail.com'; emailE=('spectrumeduteam' + '@' + emailE); document.write("<a href='mailto:" + emailE + "'>" + emailE + "</a>");</script>
      <br />
      <a href="https://fp.auburn.edu/ocm/auweb_survey">Website Feedback</a> | <a href="http://www.auburn.edu/privacy">Privacy</a> | <a href="http://www.auburn.edu/oit/it_policies/copyright_regulations.php">Copyright &copy; 
      <script type="text/javascript">date = new Date(); document.write(date.getFullYear());</script></a>
    </div>
  </div>
  <!--#include virtual="/template/includes/gatc.html" --> 
</div>
</body>
</html>


<script type="text/javascript">
  //getting all input objects
  var uname = document.forms["register_details"]["username"];
  var userRealName = document.forms["register_details"]["userRealName"];
  var email = document.forms["register_details"]["email"];
  var password = document.forms["register_details"]["password"];
  var confPwd = document.forms["register_details"]["confPwd"];
  var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  //getting all error display objects
  var  uname_error= document.getElementById("uname_error");
  var  urealn_error= document.getElementById("urealn_error");
  var  email_error= document.getElementById("email_error");
  var  password_error= document.getElementById("password_error");
  var  confPwd_error= document.getElementById("confPwd_error");

  //setting all event listeners
  uname.addEventListener("blur", unameVerify, true);
  userRealName.addEventListener("blur", urealnVerify, true);
  email.addEventListener("blur", emailVerify, true);
  password.addEventListener("blur", passwordVerify, true);

  function Validate()
  {
    if(uname.value == "")
    {
      uname.style.border = "1px solid #f44336";
      uname_error.textContent = "*User name is required";
      uname.focus();
      return false;
    }

    if(userRealName.value == "")
    {
      userRealName.style.border = "1px solid #f44336";
      urealn_error.textContent = "*User Real Name is required";
      userRealName.focus();
      return false;
    }
  
    if(email.value == "")
    {
      email.style.border = "1px solid #f44336";
      email_error.textContent = "*Email is required";
      email.focus();
      return false;
    }
    else
    {
      if(!email.value.match(emailFormat))
      {
        email.style.border = "1px solid #f44336";
        email_error.textContent = "*Email Format is wrong";
        email.focus();
        return false;
      }
    }

    if(password.value == "")
    {
      password.style.border = "1px solid #f44336";
      password_error.textContent = "*Password is required";
      password.focus();
      return false;
    }

//check if the two passwords match
    if(password.value != confPwd.value)
    {
      password.style.border = "1px solid #f44336";
      confPwd.style.border = "1px solid #f44336";
      confPwd_error.innerHTML = "*The two passwords do not match";
      return false;
    }

  }

  // event handler functions
  function unameVerify()
  {
    if(uname.value !="" )
    {
      uname.style.border = "1px solid black";
      uname_error.innerHTML = "";
      return true;
    }
  }

  function urealnVerify()
  {
    if(userRealName.value !="" )
    {
      userRealName.style.border = "1px solid black";
      urealn_error.innerHTML = "";
      return true;
    }
  }

    function emailVerify()
  {
    if(email.value !="" )
    {
      email.style.border = "1px solid black";
      email_error.innerHTML = "";
      return true;
    }
  }

    function passwordVerify()
  {
    if(password.value !="" )
    {
      password.style.border = "1px solid black";
      password_error.innerHTML = "";
      return true;
    }
  }
  
</script>