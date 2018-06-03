<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Discussion</title>
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
		    <td width="600"></td>
            <td style="font-style:italic;width:150;text-align:right;font-size:14px; color:#FFFFFF; padding-top:5px;">
              <?php
              if (($_SESSION["loginUser"]==null)||($_SESSION["loginUser"]==""))
              {
                echo "";
              }
              else
              {
                echo "Welcome back! ".$_SESSION["loginUser"];
              }
              ?>
            </td>

    </table>
  </div>
  <div id="contentArea">
    <div class="contentDivision" style="left: 0px; top: 0px;">
    	<p class="breadcrumb">
    		<a href="../home.php">Home</a> &gt; Discussion 
    	</p>
  		<h3><strong>You've successfully uploaded your answer for this question!</strong></h3>

    </div>
    <div class="sidebar"> <!-- TemplateBeginEditable name="sidebar" -->
        <p class="sidebarTitle"><a href="../home.php" target="_self" title="Home">Home</a></p>      
        <br>
        <?php
        if (($_SESSION["loginUser"] == null)||($_SESSION["loginUser"] == ""))
        {
        ?>
          <p class="sidebarTitle"><a href="./login.php" target="_self" title="My Progrss">Log in</a></p>
          <br>
          <p class="sidebarTitle"><a href="./register.php" target="_self" title="My Progrss">Register</a></p>
        <?php
        }
        else
        {
        ?>
          <p class="sidebarTitle"><a href="discussionIndex.php" target="_self" title="Discussion">Discussion</a></p>
          <br>
          <p class="sidebarTitle"><a href="./askQuestions.php" target="_self" title="My Progrss">Ask Questions</a></p>
          <br>
          <p class="sidebarTitle"><a href="" target="_self" title="My Progrss">My Questions</a></p>
          <br>
          <p class="sidebarTitle"><a href="" target="_self" title="Case Select">My Answers</a></p>
          <br>        
          <p class="sidebarTitle"><a href="./logout.php" target="_self" title="Log out">Log out</a></p>
        <?php
        }
        ?>
        
        
      </div>
  </div>
  <div id="contentArea_bottom"></div>
  <div id="footerWrap">
    <div id="footer">
    
    </div>  
    <div id="subfooter">
      Auburn University | Auburn, Alabama 36849 | (334) 844-4000  | <script type="text/javascript">emailE='auburn.edu'; emailE=('YourEmailAddress' + '@' + emailE); document.write("<a href='mailto:" + emailE + "'>" + emailE + "</a>");</script>
      <br />
      <a href="https://fp.auburn.edu/ocm/auweb_survey">Website Feedback</a> | <a href="http://www.auburn.edu/privacy">Privacy</a> | <a href="http://www.auburn.edu/oit/it_policies/copyright_regulations.php">Copyright &copy; 
      <script type="text/javascript">date = new Date(); document.write(date.getFullYear());</script></a>
    </div>
  </div>
  <!--#include virtual="/template/includes/gatc.html" --> 
</div>
</body>
</html>