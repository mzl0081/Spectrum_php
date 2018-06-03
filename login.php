<?php
session_start();
$_SESSION["regMsg"] = "";
?>
<!DOCTYPE html>
<html>
<head>
<title>
Spectrum Educational tool

</title>
<link rel="stylesheet" href="http://www.auburn.edu/template/styles/sidebar.css" media="screen" type="text/css" />
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
        <div class="titleArea">
          <span class="mainHeading"><!-- TemplateBeginEditable name="unitTitle" -->Spectrum Educational Tool<!-- TemplateEndEditable --></span>
          <span class="subHeading"><!-- TemplateBeginEditable name="unitSubTitle" -->an online resource training for student 
      teachers<!-- TemplateEndEditable --></span>
        </div>
      </div>
    </div>
    <table class="nav">
      
    </table>
  </div>
  <div id="contentArea">
    <div class="contentDivision"> 
      <p class="breadcrumb"> <!-- TemplateBeginEditable name="breadcrumb" --> <a href="./home.php">Home</a> &gt; Log in <!-- TemplateEndEditable --> </p>
      <!-- TemplateBeginEditable name="body" -->
     
 <h3><strong>Log in</strong></h3>
   <form name="login_details" action="./data/db-login.php" method="post" onsubmit="return Validate()">
    <center>
        <table style="width:400px; border="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>

          <tr>
            <td width="139" align="right">
              <strong>User Account:</strong>

            </td>
            <td width="245" align="left">
              <input type="text" name="username" value="" maxlength="50" style="width:175px; text-transform:none;">
              <div id="uname_error" style="color:#f44336;">
              <?php
              $_SESSION["loginMsg"];
              if($_SESSION["loginMsg"]==null)
              {
                $_SESSION["loginMsg"] = "";
              }
              else
              {
                if($_SESSION["loginMsg"] == "user doesn't exist")
                {
                  echo "*User doesn't exist";
                  $_SESSION["loginMsg"] = "";
                }
              }
              ?>
            </div>
            </td>
          </tr>

          <tr>
            <td align="right">
              <strong>Password:<strong> 
            </td>
            <td align="left">
              <input type="password" name="password" value="" maxlength="16" style="width:175px; text-transform:none;">
              <div id="password_error" style="color:#f44336;">
              <?php
              if($_SESSION["loginMsg"]==null)
              {
                $_SESSION["loginMsg"] = "";
              }
              else
              {
                if($_SESSION["loginMsg"] == "password incorrect")
                {
                  echo "*Password incorrect";
                  $_SESSION["loginMsg"] = "";
                }
              }
              ?>
            </div>
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <br />
              <input type="radio" name="userType" value="student" style="margin-right: 5px;">
              <font size="2" face="arial">Student</font>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" name="userType" value="admin" style="margin-right: 5px;">
              <font size="2" face="arial">Admin</font>
              <br /><br />
            </td>
          </tr>

          <!-- <tr>
            <td align="right">
              <td align="left">
                <a href="forgotPassword.html">Forgot password?</a>
              </td>
          </tr> -->

          <tr>
            <td></td>
            <td>
              <br />
              <input type="submit" name="submit" value="Log In" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">      
              <input type="reset" value="Reset" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">
              <br /><br />
            </td>
          </tr>
        </table>
        
      </center>
    </form>



    </div>
   <div class="sidebar"> <!-- TemplateBeginEditable name="sidebar" -->
      <p class="sidebarTitle"><a href="./home.php" target="_self" title="Home">Home</a></p>
      <p></p>
      <p class="sidebarTitle"><a href="./login.php">Log in</a></p>
      <p></p>
      <p class="sidebarTitle"><a href="./register.php">Register</a></p>
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
  var username = document.forms["login_details"]["username"];
  var password = document.forms["login_details"]["password"];
  
  var uname_error = document.getElementById("uname_error");
  var password_error = document.getElementById("password_error");
  
  username.addEventListener("blur", unameVerify, true);
  password.addEventListener("blur", passwordVerify, true);

  function Validate()
  {
    if ((username.value == "")||(username.value == " "))
    {
      username.style.border = "1px solid #f44336";
      uname_error.textContent = "*User name is required.";
      username.focus();
      return false;
    }
    
    if (password.value == "")
    {
      password.style.border = "1px solid #f44336";
      password_error.textContent = "*Password is required.";
      password.focus();
      return false;
    }
    
  }
  
  function unameVerify()
  {
    if((username.value !="")&&(username.value !=" "))
    {
      username.style.border = "1px solid black";
      uname_error.innerHTML = "";
      return true;
    }
  }
  
  function passwordVerify()
  {
    if(password.value !="")
    {
      password.style.border = "1px solid black";
      password_error.innerHTML = "";
      return true;
    }
  }

</script>