<?php
session_start();
include_once '../data/db-conn.php';

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getQuesId = explode("=", $actual_link);
$quesId = $getQuesId[1];

$username = $_SESSION["loginUser"];

$sql = "SELECT * FROM spectrum_users WHERE userAccount='$username';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0)
{
  $row = mysqli_fetch_assoc($result);
  $userId = $row["userID"];
}

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
<title>Discussions---My Answer Details</title>
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
      <a href="./myQuestions.php" target="_self" title="My Progrss">My Questions</a>
      <h4><a href="./myAnswers.php" target="_self" title="My Answers">My Answers</a></h4>
    </div>
    <div class="contentDivision" style="left: 0px; top: 0px;">
    	<p class="breadcrumb">
    		<a href="../home.php">Home</a> &gt; My Answers
    	</p>
  		<h3><strong>My Answers</strong></h3>
  		<br>
      <center>
        <table style="width:800px; border="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>

          <tr>
            <td width="100" align="right">
              <strong>Question Title: </strong>
            </td>
            <td width="245" align="left">
              <?php
              echo "<p>".$quesTitle."</p>";
              ?>

            </td>
          </tr>

          <tr>
            <td width="100" align="right">
              <strong>Description: </strong>
            </td>
            <td width="245" align="left">
              <?php
              echo "<p>".$description."</p>";
              ?>
            </td>
          </tr>

          <?php
          $sql = "SELECT * FROM spectrum_topic_reply WHERE topicID='$quesId' AND userID!='$userId';";
          $result1 = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result1);
          if ($resultCheck > 0)
          {
            while($row = mysqli_fetch_assoc($result1))
            {
              $quesAnswer = $row["replyContent"];
              $ansId = $row["topicReplyID"];
              $otherUserId = $row["userID"];

              $sql = "SELECT * FROM spectrum_users WHERE userID='$otherUserId';";
              $result2 = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result2);

              if ($resultCheck > 0)
              {
                while ($row = mysqli_fetch_assoc($result2))
                {
                  $otherUserName = $row["userDisplayName"];
                }
              }

              echo "<tr>";
              echo "<td width='100' align='right'>".$otherUserName." : </td>";
              echo "<td width='245' align='left'>".$quesAnswer."</td>";
              echo "</tr>";
            }

          }
          ?>

          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>

          <?php

          $myAnsCount = 0;
          $sql = "SELECT * FROM spectrum_topic_reply WHERE topicID='$quesId' AND userID='$userId';";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          if ($resultCheck > 0)
          {
            while($row = mysqli_fetch_assoc($result))
            {
              $myAnsCount++;
              $quesAnswer = $row["replyContent"];
              $ansId = $row["topicReplyID"];

              echo "<tr>";
              echo "<td width='100' align='right'><a href='#' onclick='editReply(".$ansId.")'>Edit</a>&nbsp;&nbsp;&nbsp;<strong>My Answer ".$myAnsCount.": </strong></td>";
              echo "<td id='ansInput".$ansId."' width='245' align='left'>".$quesAnswer."</td>";
              echo "</tr>";
            }

          }
          ?>

        </table>
      </center>
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

<script type='text/javascript'>
function editReply(ansNum)
{
  var x = document.getElementById("ansInput"+ansNum);
  answer = x.innerHTML;
  x.innerHTML = "";

  form = document.createElement("form");
  form.name = "editAns";
  form.action = "../data/db-ansEdit.php";
  form.method = "POST";
  x.appendChild(form);

  input = document.createElement("textarea");
  input.type = "text";
  input.name = "newAnswer";
  input.value = answer;
  input.style.width = "350px";
  input.style.height = "100px";
  input.style.marginRight = "30px";
  form.appendChild(input);

  input2 = document.createElement("input");
  input2.type = "hidden";
  input2.name = "updateAnsId";
  input2.value = ansNum;
  form.appendChild(input2);

  button = document.createElement("input");
  button.type = "submit";
  button.name = "updateAns";
  button.value = "Update";
  button.style.width = "100px";
  button.style.height = "30px";
  form.appendChild(button);

}


</script>
