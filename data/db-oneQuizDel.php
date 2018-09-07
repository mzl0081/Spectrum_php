<?php
session_start();
include_once '../data/db-conn.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getVar = explode("?", $actual_link);
$getVar = end($getVar);
$varContent = explode("=", $getVar);
$varName = $varContent[0];

echo $varName;

if ($varName == "quesId")
{
	$quesId = end($varContent);
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

	$sql = "DELETE FROM spectrum_option WHERE questionID='$quesId';";
	mysqli_query($conn, $sql);

	$sql = "DELETE FROM spectrum_question WHERE questionID='$quesId';";
	mysqli_query($conn, $sql);

	header("Location:../admin/quizDetails.php?caseId=$caseId");
	exit();
}
elseif ($varName == "optId")
{
	$optId = end($varContent);
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

	$sql = "DELETE FROM spectrum_option WHERE optionID='$optId';";
	mysqli_query($conn, $sql);

	header("Location:../admin/quizDetails.php?caseId=$caseId");
	exit();

}
elseif ($varName == "expId")
{
	$expId = end($varContent);
	$sql = "SELECT * FROM spectrum_question WHERE questionID='$expId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0)
	{
		while ($row = mysqli_fetch_assoc($result)) 
		{
			$caseId = $row["caseID"];
		}
	}

	$sql = "UPDATE spectrum_question SET explanation=null WHERE questionID='$expId';";
	mysqli_query($conn, $sql);

	header("Location:../admin/quizDetails.php?caseId=$caseId");
	exit();
}
else
{
	header("Location:../admin/cases.php");
	exit();
}

