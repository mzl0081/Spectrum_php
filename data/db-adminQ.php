<?php

if (isset($_POST['edit']))
{
	include_once 'db-conn.php';
	$quesId = mysqli_real_escape_string($conn, $_POST['thisQId']);

	header("Location:../admin/stuQEdit.php?quesId=$quesId");
	exit();
}
elseif (isset($_POST['delete']))
{
	include_once 'db-conn.php';

	$quesId = mysqli_real_escape_string($conn, $_POST['thisQId']);
	$sql = "SELECT * FROM spectrum_topics WHERE topicID='$quesId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0)
	{
		$row = mysqli_fetch_assoc($result);
		$userId = $row["userID"];
	}

	$sql = "DELETE FROM spectrum_topics WHERE topicID='$quesId';";
	mysqli_query($conn, $sql);
	$sql = "DELETE FROM spectrum_topic_reply WHERE topicID='$quesId';";
	mysqli_query($conn, $sql);
	header("Location: ../admin/studentDiscQ.php?stuId=$userId");
	exit();

}
else
{
	header("Location:../admin/studentDisc.php");
	exit();
}



