<?php
session_start();
include_once '../data/db-conn.php';

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getCaseId = explode("=", $actual_link);
$caseID = end($getCaseId);

$sql = "SELECT * FROM spectrum_case WHERE caseID='$caseID';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    $caseName = $row["caseName"];
    $caseDescription = $row["caseDescription"];
    $caseVideoName = $row["caseVideoName"];
    $caseVideoScreenshot = $row["caseVideoScreenshot"];
  }
}

$getCaseNameWithoutExt = explode(".", $caseVideoName);
$CaseNameWithoutExt = $getCaseNameWithoutExt[0];

?>
<!DOCTYPE html>
<html>
<head>
<title>
Spectrum Educational tool

</title>
<link rel="stylesheet" href="http://www.auburn.edu/template/styles/stretchSidebar.css" media="screen" type="text/css"  />
<!--#include virtual="/template/includes/head.html" -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<link rel="stylesheet" href="../files/colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/c/video.js"></script>
<script type="text/javascript">
function setupVideo() {
    var v = document.getElementById("media");
    <?php
    echo 'v.setAttribute("src", "./caseVideo/'.$caseVideoName.'");';
  ?>
}
</script>
</head>
<body onLoad="setupVideo();">
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
		echo '<h4><a href="./caseStudy.php?caseID='.$caseID.'" target="_self" title="caseStudy_'.$caseID.'_1">Casestudy '.$caseID.': Description & Video</a></h4>';
		echo '<a href="./caseStudyReflections.php?caseID='.$caseID.'" target="_self" title="caseStudy_'.$caseID.'_2">Casestudy '.$caseID.': Reflections</a>';
		echo '<a href="./caseStudyAnswers.php?caseID='.$caseID.'" target="_self" title="caseStudy_'.$caseID.'_3">Casestudy '.$caseID.': Answers</a>';
		echo '<a href="./caseStudyTeachersNote.php?caseID='.$caseID.'" target="_self" title="caseStudy_'.$caseID.'_4">Casestudy '.$caseID.': Teacher\'s Note</a>';
		?>
		<!-- end sideBar -->
    </div>

    <div class="contentDivision">
      <p class="breadcrumb"><a  href="./caseIndex.php">Case Select</a> &gt;Case study<?php echo $caseID; ?></p>
			<!-- TemplateBeginEditable name="body" -->
      <h3>
        <strong>Case study
        <?php
        echo " ".$caseID." : ".$caseName;
        ?>
        </strong>
      </h3>
      <br>
      <?php
      if (empty($caseVideoScreenshot))
      {
        echo "Video coming soon!";
      }
      else
      {
        echo '<video id="media" style="float:right;" controls="controls" poster="./caseVideoScreenshot/'.$caseVideoScreenshot.'" height="300" width="530" margin="0px 5px 0px 5px;"></video>';
      }
      ?>
      <!--<video id="media" style="float:right;" height="300" width="350" margin="0px 5px  0px 5px;" ></video>-->
      <p>
      <?php
      if (empty($caseDescription))
      {
        echo "Description coming soon!";
      }
      else
      {
        echo $caseDescription;
      }

      ?>
      </p>

      <table border="0" width="100%">
        <tr width="33%">
        <?php
        echo '<input type="submit" value="Discussion and Reflection" onClick="javascript:window.location.href=\'./caseStudyReflections.php?caseID='.$caseID.'\';">';
        ?>
        </tr>
      </table>
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
