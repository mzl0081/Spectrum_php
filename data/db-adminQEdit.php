<?php

if (isset($_POST['update']))
{
	include_once 'db-conn.php';

	$quesTitle = mysqli_real_escape_string($conn, $_POST['quesTitle']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$quesId = mysqli_real_escape_string($conn, $_POST['thisQuesId']);

	$sql = "SELECT * FROM spectrum_topics WHERE topicID='$quesId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 0)
	{
		$row = mysqli_fetch_assoc($result);
		$userId = $row["userID"];
	}

	$sql = "UPDATE spectrum_topics SET topicTitle='$quesTitle', topicContent='$description' WHERE topicID='$quesId';";
	mysqli_query($conn, $sql);
	header("Location: ../admin/studentDiscQ.php?stuId=$userId");
	exit();

}
else
{
	header("Location: ../admin/studentDisc.php");
	exit();
}



