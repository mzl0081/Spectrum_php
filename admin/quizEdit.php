<?php
session_start();
include_once '../data/db-conn.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getCaseId = explode("=", $actual_link);
$caseId = $getCaseId[1];

$sql = "SELECT * FROM spectrum_question WHERE caseID='$caseId';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

$quesIdList = array();
$quesList = array();
$expList = array();

if ($resultCheck > 0)
{
	while ($row = mysqli_fetch_assoc($result)) 
	{
		$quesId = $row["questionID"];
		$ques = $row["questionContent"];
		$exp = $row["explanation"];
		array_push($quesIdList, $quesId);
		array_push($quesList, $ques);
		array_push($expList, $exp);
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
                <p class="breadcrumb"><a href="./cases.php">Cases</a> &gt; 
				<?php
				echo '<a href="quizDetails.php?caseId='.$caseId.'">';  
				?>
                Quiz</a> &gt; Edit</p>
                <h3><strong>Edit Quiz</strong></h3>
                <br>
				<h3><strong>
				<?php
				    echo "Case Number: ".$caseId;
				    ?>	
				</strong></h3>

    <form name="admin_quizEditAllQ" action="../data/db-adminQuizEdit.php" method="POST">
    	<table style="width:1200px; border:0px;">

    	<?php
    	$optIdList = array();
		$optContentList = array();
		$isCorrectList = array();

    	for ($i = 0; $i < count($quesIdList); $i++)
    	{
    		echo '<tr>';
    		echo '<td><strong>Question '.($i+1).' :<strong></td>';
    		echo '<td colspan="3"><input type="text" name="qid'.$quesIdList[$i].'" value="'.$quesList[$i].'" style="width:400px;"></td>';
    		echo '</tr>';

    		$sql = "SELECT * FROM spectrum_option WHERE questionID='$quesIdList[$i]';";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);

			unset($optIdList);
			unset($optContentList);
			unset($isCorrectList);
			$optIdList = array();
			$optContentList = array();
			$isCorrectList = array();

			if ($resultCheck > 0)
			{
				while ($row = mysqli_fetch_assoc($result)) 
				{
					$optId = $row["optionID"];
					$optContent = $row["optionContent"];
					$isCorrect = $row["isCorrect"];

					if ($isCorrect == "1")
					{
						$isCorrect = "correct";
					}
					else
					{
						$isCorrect = "wrong";
					}

					array_push($optIdList, $optId);
					array_push($optContentList, $optContent);
					array_push($isCorrectList, $isCorrect);
				}
			}

			for ($j = 0; $j < count($optIdList); $j++)
			{
				echo '<tr>';
    			echo '<td><strong>Option '.($j+1).' :</strong><td>';
    			echo '<td><input type="text" name="opt'.$optIdList[$j].'" value="'.$optContentList[$j].'" style="width:400px;"></td>';
    			echo '<td><strong>Answer(correct or wrong) :</strong><td>';
    			echo '<td><input type="text" name="ans'.$optIdList[$j].'" value="'.$isCorrectList[$j].'" style="width:400px;"></td>';
    			echo '</tr>';

			}

			echo '<tr>';
    		echo '<td><strong>Explanation :<strong></td>';
    		echo '<td colspan="3"><textarea name="exp'.$quesIdList[$i].'" rows="15" style="width:400px; text-transform:none;">'.$expList[$i].'</textarea></td>';
    		echo '</tr>';
    		echo '<tr><td colspan="4">&nbsp;</td></tr>';

    	}

    	?>
          <tr>
            <td>
              <?php
              echo '<input type="hidden" name="thisCaseId" value="'.$caseId.'">';
              ?>
              <input type="submit" name="update" value="Update All">
            </td>
            <td colspan="3">
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