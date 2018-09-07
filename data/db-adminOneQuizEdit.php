<?php

include_once './db-conn.php';

if (isset($_POST['updateQ']))
{
	$quesId = mysqli_real_escape_string($conn, $_POST['updateQuesId']);
	$questionContent = mysqli_real_escape_string($conn, $_POST['quesNewInput']);

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

	$sql = "UPDATE spectrum_question SET questionContent='$questionContent' WHERE questionID='$quesId';";
	mysqli_query($conn, $sql);

	header("Location:../admin/quizDetails.php?caseId=$caseId");
	exit();
}
elseif (isset($_POST['updateO'])) 
{
	$optId = mysqli_real_escape_string($conn, $_POST['updateOptId']);
	$optContent = mysqli_real_escape_string($conn, $_POST['optNewInput']);
	$optAns = mysqli_real_escape_string($conn, $_POST['optNewAnsInput']);

	$sql = "SELECT * FROM spectrum_option WHERE optionID='$optId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0)
	{
		while ($row = mysqli_fetch_assoc($result)) 
		{
			$quesId = $row["questionID"];
		}
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

	if (strtolower($optAns) == "correct")
	{
		$isCorrect = "1";
	}
	else
	{
		$isCorrect = "0";
	}

	$sql = "UPDATE spectrum_option SET optionContent='$optContent', isCorrect='$isCorrect' WHERE optionID='$optId';";
	mysqli_query($conn, $sql);

	header("Location:../admin/quizDetails.php?caseId=$caseId");
	exit();
}
elseif (isset($_POST['updateE'])) 
{
	$quesId = mysqli_real_escape_string($conn, $_POST['updateExpId']);
	$explanation = mysqli_real_escape_string($conn, $_POST['expNewInput']);

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

	$sql = "UPDATE spectrum_question SET explanation='$explanation' WHERE questionID='$quesId';";
	mysqli_query($conn, $sql);

	header("Location:../admin/quizDetails.php?caseId=$caseId");
	exit();
}
else
{
	header("Location:../admin/cases.php");
	exit();
}