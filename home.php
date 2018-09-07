<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>
Spectrum Educational Tool
</title>
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
          <span class="subHeading"><!-- TemplateBeginEditable name="unitSubTitle" -->an online resource training for student teachers<!-- TemplateEndEditable --></span>
        </div>
      </div>
    </div>
		<table class="nav">
		    <td width="600"></td>
            <td style="font-style:italic;width:150;text-align:right;font-size:14px; color:#FFFFFF">
              <?php
              if (!isset($_SESSION["loginUser"]))
              {
                header("Location: ./login.php");
                exit();
              }
              elseif ($_SESSION["loginUser"] == "Administrator")
              {
                header("Location: ./admin/adminIndex.php");
                exit();
              }
              else
              {
                echo "Welcome back! ".$_SESSION["loginUser"];
                echo '</td>';
                echo '<td style="font-style:inherit;text-align:middle;font-size:14px;"><a href="./logout.php">Logout</a></td>';
              }
              ?>
      </table>
  </div>
  <div id="contentArea">
        <div class="sidebar"> <!-- TemplateBeginEditable name="sidebar" -->
        <h4><a href="./home.php" target="_self" title="Home">Home</a></h4>
        <div class="orangeDecorBar" style="width: 200px"></div>
        <?php
        if (empty($_SESSION["loginUser"]))
        {
        ?>
        <a href="./login.php" target="_self" title="My Progrss">Log in</a>
        <a href="./register.php" target="_self" title="Register">Register</a>
        <?php
        }
        else
        {
        ?>
        <!-- <a href="./progress/progressIndex.php" target="_self" title="My Progrss">My Progress</a> -->
        <a href="./cases/caseIndex.php" target="_self" title="Case Select">CaseSelect</a>
        <a href="./discussion/discussionIndex.php" target="_self" title="Discussion">Discussions</a>
        <?php
        }
        ?>
        <!-- end sideBar -->
        </div>

    <div class="contentDivision">
      <p style="font-size:18px;position:relative;top :5px">Home</p>
			<!-- TemplateBeginEditable name="body" -->
      <h3><strong>Spectrum Educational Tool</strong></h3>
        <br>
        <p>
        Innovative teacher training introduces a new set of demanding challenges and issues. Teaching has become a very complex and demanding process. Teachers with little exposure to digital media and with little preparation with digital media may face difficulties in dealing with the complexity of classroom teacing. These new teachers may often find the demands of the classroom too challenging and quckily become discourages or adopt a simplisitc view of teaching where 'Tricks &amp; Trade' serve as a substitute for thoughtful process.
        </p>
        <h3><strong>Why Spectrum Educational Tool</strong></h3>
        <br>
        <p>
        By using Spectrum Education tool, it provides extensive training of teachers which will help them in understanding digital Media and know better strategies for successful classroom management. The teachers will be well versed with teaching skills,instructional strategies,curricula and assessment practices. Our goal is to reinforce best practices for classroom management and to create an online learning environment to support pre-service and in-dervice teachers.
        </p>
        <!-- end contentDivision -->
      </div>
      <!-- end contentArea -->
    </div>

  <div id="contentArea_bottom"></div>

  <div id="footerWrap">
    <div id="footer"></div>

    <div id="subfooter">
        Auburn University | Auburn, Alabama 36849 | (334) 844-4000  | <script type="text/javascript">emailE='gmail.com'; emailE=('spectrumeduteam' + '@' + emailE); document.write("<a href='mailto:" + emailE + "'>" + emailE + "</a>");</script><br />
            <a href="https://fp.auburn.edu/ocm/auweb_survey">Website Feedback</a> | <a href="http://www.auburn.edu/privacy">Privacy</a> | <a href="http://www.auburn.edu/oit/it_policies/copyright_regulations.php">Copyright &copy;
            <script type="text/javascript">date = new Date(); document.write(date.getFullYear());</script></a>
    </div>
  </div>
  <!--#include virtual="/template/includes/gatc.html" -->
</div>
</body>
</html>
