<?php

include_once './db-conn.php';

if (isset($_POST['add']))
{
	$caseId = mysqli_real_escape_string($conn, $_POST['thisCaseId']);
	$question = mysqli_real_escape_string($conn, $_POST['question']);
	$optionNum = mysqli_real_escape_string($conn, $_POST['optionNum']);
	$explanation = mysqli_real_escape_string($conn, $_POST['explanation']);
	// echo $caseId;
	// echo '<br>';


	$sql = "INSERT INTO spectrum_question (questionContent, explanation, caseID) VALUES ('$question', '$explanation', '$caseId');";
	mysqli_query($conn, $sql);

	$sql = "SELECT * FROM spectrum_question WHERE questionContent='$question' AND caseID='$caseId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
		  $questionId = $row["questionID"];
		}
	}

	for ($i = 0; $i < $optionNum; $i++)
	{
		$option = mysqli_real_escape_string($conn, $_POST['opt'.($i+1)]);
		$ans = mysqli_real_escape_string($conn, $_POST['ans'.($i+1)]);
		// echo $option;
		// echo '<br>';
		// echo $ans;

		if (strtolower($ans) == "correct")
		{
			$isCorrect = "1";
		}
		else
		{
			$isCorrect = "0";
		}

		$sql = "INSERT INTO spectrum_option (optionContent, isSelect, isCorrect, questionID) VALUES ('$option', '0', '$isCorrect', '$questionId');";
		mysqli_query($conn, $sql);

	}

	header("Location:../admin/quizDetails.php?caseId=$caseId");
	exit();

}
else
{
	header("Location:../admin/cases.php");
	exit();
}