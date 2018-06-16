<?php

include_once './db-conn.php';

if (isset($_POST['add']))
{
	$caseId = mysqli_real_escape_string($conn, $_POST['thisCaseId']);
	header("Location:../admin/quizAddQ.php?caseId=$caseId");
	exit();
}
elseif (isset($_POST['edit']))
{
	$caseId = mysqli_real_escape_string($conn, $_POST['thisCaseId']);
	header("Location:../admin/quizEdit.php?caseId=$caseId");
	exit();
}
elseif (isset($_POST['delete']))
{
	$caseId = mysqli_real_escape_string($conn, $_POST['thisCaseId']);

	$sql = "SELECT * FROM spectrum_question WHERE caseID='$caseId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	$quesIdList = array();

	if ($resultCheck > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
		  $quesId = $row["questionID"];
		  array_push($quesIdList, $quesId);	  
		}
	}

	for ($i = 0; $i < count($quesIdList); $i++)
	{
		$sql = "DELETE FROM spectrum_option WHERE questionID='$quesIdList[$i]';";
		mysqli_query($conn, $sql);

		$sql = "DELETE FROM spectrum_question WHERE questionID='$quesIdList[$i]';";
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