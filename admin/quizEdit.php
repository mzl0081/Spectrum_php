<?php
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
  <title>adminIndex</title>
</head>
<body>
  <h1><a href="./adminIndex.php">Admin Index</a></h1>
  <h2><a href="./cases.php">Cases</a></h2>
  <h1>
    <?php
    echo "Case Number: ".$caseId;
    ?>
  </h1>


    <form name="admin_quizEditAllQ" action="../data/db-adminQuizEdit.php" method="POST">
    	<table style="width:1200px; border="0">

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


</body>
</html>