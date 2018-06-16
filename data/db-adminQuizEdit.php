<?php

include_once './db-conn.php';

if (isset($_POST['update']))
{
	$caseId = mysqli_real_escape_string($conn, $_POST['thisCaseId']);

	$sql = "SELECT * FROM spectrum_question WHERE caseID='$caseId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	$quesIdList = array();

	if ($resultCheck > 0)
	{
		while ($row = mysqli_fetch_assoc($result)) 
		{
			$quesId = $row["questionID"];
			array_push($quesIdList, $quesId);
		}
	}

	$optIdList = array();

	for ($i = 0; $i < count($quesIdList); $i++)
    {
    	$question = mysqli_real_escape_string($conn, $_POST['qid'.$quesIdList[$i]]);
    	$explanation = mysqli_real_escape_string($conn, $_POST['exp'.$quesIdList[$i]]);

    	$sql = "UPDATE spectrum_question SET questionContent='$question', explanation='$explanation' WHERE questionID='$quesIdList[$i]';";
		mysqli_query($conn, $sql);


		$sql = "SELECT * FROM spectrum_option WHERE questionID='$quesIdList[$i]';";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		unset($optIdList);
		$optIdList = array();

		if ($resultCheck > 0)
		{
			while ($row = mysqli_fetch_assoc($result)) 
			{
				$optId = $row["optionID"];
				array_push($optIdList, $optId);
			}
		}

		for ($j = 0; $j < count($optIdList); $j++)
		{
			$option = mysqli_real_escape_string($conn, $_POST['opt'.$optIdList[$j]]);
			$isCorrect = mysqli_real_escape_string($conn, $_POST['ans'.$optIdList[$j]]);

			if (strtolower($isCorrect) == "correct")
			{
				$isCorrect = "1";
			}
			else
			{
				$isCorrect = "0";
			}

			$sql = "UPDATE spectrum_option SET optionContent='$option', isCorrect='$isCorrect' WHERE questionID='$quesIdList[$i]' AND optionID='$optIdList[$j]';";
			mysqli_query($conn, $sql);

		}

    }


	header("Location:../admin/quizDetails.php?caseId=$caseId");
	exit();
}
else
{
	header("Location:../admin/cases.php");
	exit();
}