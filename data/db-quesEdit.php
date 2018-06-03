<?php

session_start();

if (isset($_POST['update']))
{
	include_once 'db-conn.php';

	// $_SESSION["askQuesTime"] = time();

	$username = $_SESSION["loginUser"];
	// $userId = $_SESSION["loginUserId"];
	$quesTitle = mysqli_real_escape_string($conn, $_POST['quesTitle']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$quesId = mysqli_real_escape_string($conn, $_POST['thisQuesId']);


	$sql = "SELECT * FROM spectrum_users WHERE userAccount='$username';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0)
	{
		$row = mysqli_fetch_assoc($result);
		$userId = $row["userID"];
	}

	$sql = "UPDATE spectrum_topics SET topicTitle='$quesTitle', topicContent='$description' WHERE topicID='$quesId';";
	mysqli_query($conn, $sql);
	header("Location: ../discussion/myQuestions.php");
	exit();

}
else
{
	header("Location:../discussion/myQuestions.php");
	exit();
}



