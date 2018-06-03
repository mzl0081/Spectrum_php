<?php
session_start();
include_once '../data/db-conn.php';
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
  <?php

  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $getQuesId = explode("=", $actual_link);
  $quesId = $getQuesId[1];

  $sql = "SELECT * FROM spectrum_topics WHERE topicID='$quesId';";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  if ($resultCheck > 0)
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $quesTitle = $row["topicTitle"];
      $description = $row["topicContent"];
    }

  }

  ?>
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
    		<a href="../home.php">Home</a> &gt; Ask Questions 
    	</p>
  		<h3><strong>Edit Questions</strong></h3>
  		  <form name="question_details" action="../data/db-quesEdit.php" method="POST">
          <center>
        <table style="width:700px; border="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>

          <tr>
            <td width="100" align="right">
              <strong>Question Title:</strong>
            </td>
            <td width="245" align="left">
              <?php
              echo '<input type="text" name="quesTitle" value="'.$quesTitle.'" maxlength="125" style="width:400px; text-transform:none;">';

              ?>
                              
              <div id="ques_error" style="color:#f44336;">
              </div>
              
            </td>
          </tr>

          <tr>
            <td width="100" align="right">
              <strong>Description:</strong>
            </td>
            <td width="245" align="left">
              <?php
              echo '<textarea name="description" rows="15" style="width:400px; text-transform:none;">';
              echo $description;
              echo '</textarea>';
                ?>
              
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <br />
              <?php
              echo "<input type='hidden' name='thisQuesId' value='$quesId'>";
              ?>
              <input type="submit" name="update" value="Update" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">      
              <br /><br />
            </td>
          </tr>
        </table>
        </center>
    </form>

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