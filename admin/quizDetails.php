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
$quesExpList = array();

if ($resultCheck > 0)
{
  $msg = "yes";
  while($row = mysqli_fetch_assoc($result))
  {
    $quesId = $row["questionID"];
    $quesContent = $row["questionContent"];
    $quesExp = $row["explanation"];

    array_push($quesIdList, $quesId);
    array_push($quesList, $quesContent);
    array_push($quesExpList, $quesExp);
  }
}
else
{
  $msg = "No Questions/Reflection for This Case. Please Create it.";
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

	<form name="admin_quizDetails" action="../data/db-adminQuiz.php" method="POST">
		<table style="width:1000px; border="0">
          <tr>
            <td colspan="5">&nbsp;</td>
          </tr>

          <?php

          if ($msg != "yes")
          {
            echo '<tr><td colspan="5">'.$msg.'</td></tr>';
          }
          else
          {

            $optionIdList = array();
            $optContentList = array();
            $optCorrectList = array();

            for ($i = 0; $i < count($quesIdList); $i++)
            {
              $sql = "SELECT * FROM spectrum_option WHERE questionID='$quesIdList[$i]';";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);

              unset($optionIdList);
              $optionIdList = array();
              unset($optContentList);
              $optContentList = array();
              unset($optCorrectList);
              $optCorrectList = array();

              if ($resultCheck > 0)
              {
                while($row = mysqli_fetch_assoc($result))
                {
                  $optId = $row["optionID"];
                  $optContent = $row["optionContent"];
                  $optCorrect = $row["isCorrect"];

                  array_push($optionIdList, $optId);
                  array_push($optContentList, $optContent);
                  array_push($optCorrectList, $optCorrect);
                }
              }

              echo '<tr>';
              echo '<td><a href="#" id="qEdit" onclick="qFields()">Edit</a>&nbsp;&nbsp;<a href="">Delete</a></td>';
              echo '<td>Question '.($i+1).' : </td>';
              echo '<td colspan="3" >'.$quesList[$i].'</td>';
              echo '</tr>';
              echo '<tr><td colspan="5">&nbsp;</td></tr>';

              for ($j = 0; $j < count($optionIdList); $j++)
              {
                if ($optCorrectList[$j] == "1")
                {
                  $isCorrect = "Correct";
                }
                else
                {
                  $isCorrect = "Wrong";
                }

                echo '<tr>';
                echo '<td><a href="">Edit</a>&nbsp;&nbsp;<a href="">Delete</a></td>';
                echo '<td></td>';
                echo '<td>Option '.($j+1).' : </td>';
                echo '<td>'.$optContentList[$j].'</td>';
                echo '<td>'.$isCorrect.'</td>';
                echo '</tr>';
                echo '<tr><td colspan="5">&nbsp;</td></tr>';
              }
              

              echo '<tr>';
              echo '<td><a href="oneExpEdit.php?quesId='.$quesIdList[$i].'">Edit</a>&nbsp;&nbsp;<a href="">Delete</a></td>';
              echo '<td>Explanation :</td>';
              echo '<td colspan="3">'.$quesExpList[$i].'</td>';
              echo '</tr>';
              echo '<tr><td colspan="5">&nbsp;</td></tr>';

            }
          }

          ?>

          <tr>
            <td>
            	<?php
	              echo "<input type='hidden' name='thisCaseId' value='$caseId'>";
	            ?>
            	<input type="submit" name="add" value="Add Question" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">
            </td>
            <td>
				      <input type="submit" name="edit" value="Edit All" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">
            </td>
            <td>
              <input type="submit" name="delete" value="Delete All" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">
            </td>
            <td colspan="2">&nbsp;</td>
          </tr>
          
        </table>
	</form>


</body>
</html>

<script type='text/javascript'>
function qFields()
{
  // Number of inputs to create
  var optionNum = document.getElementById("optionNum").value;
  // Container <div> where dynamic content will be placed
  var container1 = document.getElementById("container1");
  var container2 = document.getElementById("container2");
  var container3 = document.getElementById("container3");
  var container4 = document.getElementById("container4");



}
</script>