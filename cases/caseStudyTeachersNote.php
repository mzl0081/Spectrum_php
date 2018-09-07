<?php
session_start();
include_once '../data/db-conn.php';

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getCaseId = explode("=", $actual_link);
$caseID = $getCaseId[1];

$sql = "SELECT * FROM spectrum_case WHERE caseID='$caseID';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    $caseName = $row["caseName"];
  }
}

$sql = "SELECT * FROM spectrum_case WHERE caseID>=$caseID LIMIT 1, 1;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    $nextCaseId = $row["caseID"];
  }
}

$sql = "SELECT * FROM spectrum_teachersNote WHERE caseID='$caseID';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    $tNoteName = $row["noteVideo"];
    $tNoteCover = $row["noteCover"];
  }
}


?>
<!DOCTYPE html>
<html>
<head>
<title>
Spectrum Educational tool

</title>
<link rel="stylesheet" href="http://www.auburn.edu/template/styles/stretchSidebar.css" media="screen" type="text/css" />
<!--#include virtual="/template/includes/head.html" -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<link rel="stylesheet" href="../files/colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="../files/jquery.colorbox.js"></script>
<script>
  $(document).ready(function(){
    //Examples of how to assign the ColorBox event to elements
    $(".inline").colorbox({inline:true, width:"50%", height:"80%"});
  });
</script>
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
      <h4><a class="upLink" href="../home.php" target="_self" title="Home">Home</a></h4>
      <div class="orangeDecorBar" style="width: 200px"></div>
      <a href="./caseIndex.php" target="_self" title="Case Select">Case select</a>
      <?php
      echo '<a href="./caseStudy.php?caseID='.$caseID.'" target="_self" title="caseStudy_'.$caseID.'_1">Casestudy '.$caseID.': Description & Video</a>';
      echo '<a href="./caseStudyReflections.php?caseID='.$caseID.'" target="_self" title="caseStudy_'.$caseID.'_2">Casestudy '.$caseID.': Reflections</a>';
      echo '<a href="./caseStudyAnswers.php?caseID='.$caseID.'" target="_self" title="caseStudy_'.$caseID.'_3">Casestudy '.$caseID.': Answers</a>';
      echo '<h4><a href="./caseStudyTeachersNote.php?caseID='.$caseID.'" target="_self" title="caseStudy_'.$caseID.'_4">Casestudy '.$caseID.': Teacher\'s Note</a></h4>';
      ?>
    </div>
    <div class="contentDivision">
      <p class="breadcrumb"> <!-- TemplateBeginEditable name="breadcrumb" -->
        <a  href="./caseIndex.php">Case Select</a>  &gt;Case study <?php echo $caseID; ?> <!-- TemplateEndEditable -->
      </p>
      <!-- TemplateBeginEditable name="body" -->
      <h3>
        <strong>Case study
        <?php
        echo " ".$caseID." : ".$caseName;
        ?>
        </strong>
      </h3>

      <?php
      if (empty($nextCaseId))
      {
        echo '<input type="button" align="right" style="float: right;" value="Back to Case Select" onClick="javascript: window.location.href = \'./caseIndex.php\';">';
      }
      else
      {
        echo '<input type="button" align="right" style="float: right;" value="Next Case" onClick="javascript: window.location.href = \'./caseStudy.php?caseID='.$nextCaseId.'\';">';
      }
      ?>
        <br>
    <p align ="justify">
      <div align="center">
        <h4><strong> Teacher's Note</strong></h4>
      <?php
      if (empty($tNoteName))
      {
        echo "Video coming soon!";
      }
      else
      {
        echo '<video src="./tNoteVideo/'.$tNoteName.'"  position="relative" style="margin-left:50px; margin-top:50px; height:400px;" controls="controls" poster="./tNoteCoverPic/'.$tNoteCover.'" height="600" width="600"></video>';
      }
      ?>
      </div>
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
