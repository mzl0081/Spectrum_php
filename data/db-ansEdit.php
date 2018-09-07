<?php

session_start();

if (isset($_POST['updateAns']))
{
	include_once 'db-conn.php';

	$ans = mysqli_real_escape_string($conn, $_POST['newAnswer']);
	$ansId = mysqli_real_escape_string($conn, $_POST['updateAnsId']);
	date_default_timezone_set("America/Chicago");
	$nowTime = date("Y-m-d h:i:sa");

	$sql = "UPDATE spectrum_topic_reply SET replyContent='$ans', replyTime='$nowTime' WHERE topicReplyID='$ansId';";
	mysqli_query($conn, $sql);

	$sql = "SELECT * FROM spectrum_topic_reply WHERE topicReplyID='$ansId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 0)
	{
	  while($row = mysqli_fetch_assoc($result))
	  {
	    $quesId = $row["topicID"];
	  }
	}


	header("Location: ../discussion/myAnsDetails.php?quesId=$quesId");
	exit();

}
else
{
	header("Location:../discussion/myAnswers.php");
	exit();
}



