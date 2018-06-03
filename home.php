<?php
session_start();
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
    <div class="contentDivision" style="left: 0px; top: 0px"> 
      <p class="breadcrumb" style="font-size:16px"> <!-- TemplateBeginEditable name="breadcrumb" --> Home <!-- TemplateEndEditable --> </p>
			<!-- TemplateBeginEditable name="body" -->
     
 <h3><strong>Spectrum Educational Tool</strong></h3>
    <p>
    <br>
Innovative teacher training introduces a new set of demanding challenges and issues.
Teaching has become a very complex and demanding process.

Teachers with little exposure to digital media and with little preparation with digital media may face
 difficulties in dealing with the complexity of classroom teacing.
 These new teachers may often find the demands of the classroom too challenging and quckily become 
 discourages or adopt a simplisitc view of teaching where 'Tricks &amp; Trade' serve as a 
 substitute for thoughtful process.</p>
      <h3><strong>Why Spectrum Educational Tool</strong></h3>
      <br>
     <p> By using Spectrum Education tool, it provides extensive training of teachers which will help them 
     in understanding digital Media and know better strategies for successful classroom management. 
     The teachers will be well versed with teaching skills,instructional strategies,curricula and 
     assessment practices.

Our goal is to reinforce best practices for classroom management and to create an online learning environment 
to support pre-service and in-dervice teachers.</p>



    </div>
    <div class="sidebar"> <!-- TemplateBeginEditable name="sidebar" -->
        <p class="sidebarTitle"><a href="./home.php" target="_self" title="Home">Home</a></p>      
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
          <p class="sidebarTitle"><a href="" target="_self" title="My Progrss">My Progress</a></p>
          <br>
          <p class="sidebarTitle"><a href="./cases/caseIndex.php" target="_self" title="Case Select">CaseSelect</a></p>
          <br>
          <p class="sidebarTitle"><a href="./discussion/discussionIndex.php" target="_self" title="Discussion">Discussion</a></p>
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