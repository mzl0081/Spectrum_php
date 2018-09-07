<?php
session_start();
include_once '../data/db-conn.php';

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getCaseId = explode("=", $actual_link);
$caseId = $getCaseId[1];

$sql = "SELECT * FROM spectrum_case WHERE caseID='$caseId';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    $caseName = $row["caseName"];
    $caseChapter = $row["caseChapter"];
    $caseDescription = $row["caseDescription"];
    $caseVideoName = $row["caseVideoName"];
    $caseCoverPic = $row["caseCoverPic"];
    $caseVideoScreenshot = $row["caseVideoScreenshot"];
  }
}

$sql = "SELECT * FROM spectrum_teachersNote WHERE caseID='$caseId';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    $noteCover = $row["noteCover"];
    $noteVideo = $row["noteVideo"];
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Case Management</title>
     <link rel="stylesheet" href="https://www.auburn.edu/template/styles/stretchSidebar.css" media="screen" type="text/css" />
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
              <?php
               if (!isset($_SESSION["loginUser"]))
               {
                 header("Location: ../login.php");
                 exit();
               }
               else
               {
                 echo '<td style="font-style:italic;width:150;text-align:right;font-size:14px; color:#FFFFFF;">';
                 echo "Hello! ".$_SESSION["loginUser"];
                 echo '</td>';
               }
               ?>
              <td style="font-style:inherit;text-align:middle;font-size:14px;"><a href="../logout.php">Logout</a></td>
        </table>
     </div>
     <div id="contentArea">
          <div class="sidebar"> <!-- TemplateBeginEditable name="sidebar" -->
               <h4><a class="upLink" href="./adminIndex.php">Home</a></h4>
               <div class="orangeDecorBar" style="width: 200px"></div>
               <a href="./stuInfoDetail.php">User Information</a>
               <h4><a href="./cases.php">Cases</a></h4>
               <a href="./studentDisc.php">Discussions</a>
               </div>
          <div class="contentDivision">
               <p class="breadcrumb"><a href="./cases.php">Cases</a> &gt; Details</p>
              	<h4><strong>
              		<?php
              		echo "Case Number: ".$caseId;
              		?>
              	</strong></h4>

              	<form name="admin_caseDetails" action="../data/db-adminCaseEditDelete.php" method="POST">
              		<table style="width:800px; border="0">
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                          <td>
                            <strong>Case Chapter: </strong>
                          </td>
                          <td>
                            <?php
                            if (empty($caseChapter))
                            {
                              echo "None. Please add the chapter number.";
                            }
                            else
                            {
                              echo $caseChapter;
                            }                            
                            ?>          
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <strong>Case Name: </strong>
                          </td>
                          <td>
                            <?php
                            if (empty($caseName))
                            {
                              echo "None. Please add the case name.";
                            }
                            else
                            {
                              echo $caseName;
                            }
                            ?>          
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <strong>Case Description: </strong>
                          </td>
                          <td>
                            <?php
                            if (empty($caseDescription))
                            {
                              echo "None. Please add the case description.";
                            }
                            else
                            {
                              echo $caseDescription;
                            }
                            ?>             
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <strong>Case Cover Picture: </strong>
                          </td>
                          <td>
                            <?php
                            if (empty($caseCoverPic))
                            {
                              echo "None. Please uopload the case cover picture.";
                            }
                            else
                            {
                              echo "<img src='../cases/caseCoverPic/".$caseCoverPic."' alt='case Cover Picture' width='400' height='275'>";
                            }
                            ?>             
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <strong>Case Video Screenshot: </strong>
                          </td>
                          <td>
                            <?php
                            if (empty($caseVideoScreenshot))
                            {
                              echo "None. Please uopload the case video screenshot.";
                            }
                            else
                            {
                              echo "<img src='../cases/caseVideoScreenshot/".$caseVideoScreenshot."' alt='Case Video Screenshot' width='400' height='275'>";
                            }
                            ?>             
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <strong>Case Video: </strong>
                          </td>
                          <td>
                            <?php
                            if (empty($caseVideoName))
                            {
                              echo "None. Please uopload the case video.";
                            }
                            else
                            {
                              echo "<video width='320' height='240' controls>"."<source src='../cases/caseVideo/".$caseVideoName."'></video>";
                            }
                            ?>             
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <strong>Teacher's Note Cover Picture: </strong>
                          </td>
                          <td>
                            <?php
                            if (empty($noteCover))
                            {
                              echo "None. Please uopload the cover picture of teacher's note.";
                            }
                            else
                            {
                              echo "<img src='../cases/tNoteCoverPic/".$noteCover."' alt='Teacher's Note Cover Picture' width='400' height='275'>";
                            }
                            ?>             
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <strong>Teacher's Note: </strong>
                          </td>
                          <td>
                            <?php
                            if (empty($noteVideo))
                            {
                              echo "None. Please uopload the video of teacher's note.";
                            }
                            else
                            {
                              echo "<video width='320' height='240' controls>"."<source src='../cases/tNoteVideo/".$noteVideo."'></video>";
                            }
                            ?>             
                          </td>
                        </tr>

                        <tr>
                          <td>
                          	<?php
              	              echo "<input type='hidden' name='thisCaseId' value='$caseId'>";
              	            ?>
                              &emsp; <input type="submit" name="edit" value="Edit" onMouseOver="this.style.cursor='hand'" style="width:100px">
                          	<br />
                          </td>
                          <td>
              				        <br />&emsp; <input type="submit" name="delete" value="Delete" onMouseOver="this.style.cursor='hand'" onclick="return confirm('Are you sure you want to delete this case?')" style="width:100px">
              				      <br />
                          </td>
                        </tr>
                        
                      </table>
              	</form>
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
<!-- end pagewrap -->
</div>

</body>
</html>