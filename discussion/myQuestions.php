<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Discussion---My Questions</title>
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
        <td style="font-style:italic;width:150;text-align:right;font-size:14px; color:#FFFFFF; padding-top:5px;">
          <?php
          if (!isset($_SESSION["loginUser"]))
          {
            header("Location: ../login.php");
            exit();
          }
          elseif ($_SESSION["loginUser"] == "Administrator")
          {
            header("Location: ../admin/adminIndex.php");
            exit();
          }
          else
          {
            echo "Welcome back! ".$_SESSION["loginUser"];
          }
          ?>
        </td>
        <td style="font-style:inherit;text-align:middle;font-size:14px;"><a href="../logout.php">Logout</a></td>
    </table>
  </div>
  <div id="contentArea">
    <div class="sidebar"> <!-- TemplateBeginEditable name="sidebar" -->
      <h4><a href="../home.php" target="_self" title="Home">Home</a></h4>
      <div class="orangeDecorBar" style="width: 200px"></div>
      <a href="./discussionIndex.php" target="_self" title="Discussion">Discussions</a>
      <a href="./askQuestions.php" target="_self" title="My Progrss">Ask Questions</a>
      <h4><a href="./myQuestions.php" target="_self" title="My Progrss">My Questions</a></h4>
      <a href="./myAnswers.php" target="_self" title="My Answers">My Answers</a><br><br><br><br>
    </div>
    <div class="contentDivision" style="left: 0px; top: 0px;">
    	<p class="breadcrumb">
    		<a href="../home.php">Home</a> &gt; My Questions
    	</p>
  		<h3><strong>My Questions</strong></h3>
  		<br>
  		<?php
  		include './myQuestionsTable.php';
  		?>

    </div>
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
