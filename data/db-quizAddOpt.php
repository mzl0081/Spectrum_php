<?php

include_once './db-conn.php';

if (isset($_POST['addNewOpt']))
{
	$quesId = mysqli_real_escape_string($conn, $_POST['addOptQuesId']);
	$optContent = mysqli_real_escape_string($conn, $_POST['newOptContent']);
	$isCorrect = mysqli_real_escape_string($conn, $_POST['optAns']);

	if (strtolower($isCorrect) == "correct")
	{
		$isCorrect = "1";
	}
	else
	{
		$isCorrect = "0";
	}

	$sql = "SELECT * FROM spectrum_question WHERE questionID='$quesId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0)
	{
		while ($row = mysqli_fetch_assoc($result)) 
		{
			$caseId = $row["caseID"];
		}
	}

	$sql = "INSERT INTO spectrum_option (optionContent, isSelect, isCorrect, questionID) VALUES ('$optContent', '0', '$isCorrect', '$quesId');";
	mysqli_query($conn, $sql);

	header("Location:../admin/quizDetails.php?caseId=$caseId");
	exit();
}
else
{
	header("Location:../admin/cases.php");
	exit();
}