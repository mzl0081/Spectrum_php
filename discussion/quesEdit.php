<?php
session_start();
include_once '../data/db-conn.php';

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
<!DOCTYPE html>
<html>
<head>
<title>Discussion</title>
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
                        echo "</td>";
            echo '<td style="font-style:inherit;text-align:middle;font-size:14px;"><a href="../logout.php">Logout</a></td>';
          }
          ?>
    </table>
  </div>
  <div id="contentArea">
    <div class="sidebar"> <!-- TemplateBeginEditable name="sidebar" -->
      <h4><a href="../home.php" target="_self" title="Home">Home</a></h4>
      <div class="orangeDecorBar" style="width: 200px"></div>
      <a href="./discussionIndex.php" target="_self" title="Discussion">Discussions</a>
      <a href="./askQuestions.php" target="_self" title="My Progrss">Ask Questions</a>
      <h4><a href="./myQuestions.php" target="_self" title="My Progrss">My Questions</a></h4>
      <a href="./myAnswers.php" target="_self" title="My Answers">My Answers</a>
    </div>
    <div class="contentDivision" style="left: 0px; top: 0px;">
    	<p class="breadcrumb">
    		<a href="../home.php">Home</a> &gt; My Questions
    	</p>
  		<h3><strong>Edit Questions</strong></h3>
  		  <form name="myQues_edit" action="../data/db-quesEdit.php" method="POST">
          <center>
            <table style="width:700px; border="0">
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>

              <tr>
                <td width="100" align="right">
                  <strong>Topic Title:</strong>
                </td>
                <td width="245" align="left">
                  <?php
                  echo '<input type="text" name="quesTitle" value="'.$quesTitle.'" maxlength="125" style="width:400px; text-transform:none;">';
                  ?>
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
                <td>
                  <?php
                  echo "<input type='hidden' name='thisQuesId' value='$quesId'>";
                  ?>
                </td>
                <td>
                  <input type="submit" name="update" value="Update" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">
                </td>
              </tr>
            </table>
          </center>
      </form>
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
