<?php

if (isset($_POST['update']))
{
	include_once 'db-conn.php';

	$quesTitle = mysqli_real_escape_string($conn, $_POST['quesTitle']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$quesId = mysqli_real_escape_string($conn, $_POST['thisQuesId']);

	$sql = "UPDATE spectrum_topics SET topicTitle='$quesTitle', topicContent='$description' WHERE topicID='$quesId';";
	mysqli_query($conn, $sql);
	
	header("Location: ../admin/studentQDetails.php?quesId=$quesId");
	exit();

}
else
{
	header("Location: ../admin/studentDisc.php");
	exit();
}



