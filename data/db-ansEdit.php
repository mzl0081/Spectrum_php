<?php

session_start();

if (isset($_POST['update']))
{
	include_once 'db-conn.php';

	// $_SESSION["askQuesTime"] = time();
	$ans = mysqli_real_escape_string($conn, $_POST['ansDescription']);
	$ansId = mysqli_real_escape_string($conn, $_POST['thisAnsId']);
	$nowTime = date("Y-m-d h:i:sa");

	$sql = "UPDATE spectrum_topic_reply SET replyContent='$ans', replyTime='$nowTime' WHERE topicReplyID='$ansId';";
	mysqli_query($conn, $sql);
	header("Location: ../discussion/myAnswers.php");
	exit();

}
else
{
	header("Location:../discussion/myAnswers.php");
	exit();
}



