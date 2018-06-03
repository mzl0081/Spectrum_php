<?php

session_start();

if (isset($_POST['submit']))
{
	include_once 'db-conn.php';

	$username = $_SESSION["loginUser"];
	// $userId = $_SESSION["loginUserId"];
	$quesId = mysqli_real_escape_string($conn, $_POST['thisQuesId']);
	$newAns = mysqli_real_escape_string($conn, $_POST['newAnswer']);
	$nowTime = date("Y-m-d h:i:sa");


	$sql = "SELECT * FROM spectrum_users WHERE userAccount='$username';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0)
	{
		$row = mysqli_fetch_assoc($result);
		$userId = $row["userID"];
	}

	$sql = "INSERT INTO spectrum_topic_reply (topicID, userID, replyContent, replyTime) VALUES ('$quesId', '$userId', '$newAns', '$nowTime');";
	mysqli_query($conn, $sql);
	header("Location: ../discussion/updateNewAns.php");
	exit();

}
else
{
	header("Location:../discussion/discussionIndex.php");
	exit();
}



