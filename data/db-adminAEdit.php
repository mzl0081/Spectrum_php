<?php

if (isset($_POST['updateAns']))
{
	include_once 'db-conn.php';

	date_default_timezone_set("America/Chicago");

	$replyContent = mysqli_real_escape_string($conn, $_POST['newAnswer']);
	$ansId = mysqli_real_escape_string($conn, $_POST['updateAnsId']);
	$nowTime = date("Y-m-d h:i:sa");

	$sql = "SELECT * FROM spectrum_topic_reply WHERE topicReplyID='$ansId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 0)
	{
		$row = mysqli_fetch_assoc($result);
		$userId = $row["userID"];
		$quesId = $row["topicID"];
	}

	$sql = "UPDATE spectrum_topic_reply SET replyContent='$replyContent', replyTime='$nowTime' WHERE topicReplyID='$ansId';";
	mysqli_query($conn, $sql);
	
	header("Location: ../admin/studentADetails.php?quesId=$quesId&stuId=$userId");
	exit();

}
else
{
	header("Location: ../admin/studentDisc.php");
	exit();
}



