<?php
include_once '../data/db-conn.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getAnsId = explode("=", $actual_link);
$ansId = $getAnsId[1];

$sql = "SELECT * FROM spectrum_topic_reply WHERE topicReplyID='$ansId';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0)
{
  $row = mysqli_fetch_assoc($result);
  $userId = $row["userID"];
  $quesId = $row["topicID"];
}

$sql = "DELETE FROM spectrum_topic_reply WHERE topicReplyID='$ansId';";
mysqli_query($conn, $sql);

header("Location: ../admin/studentADetails.php?quesId=$quesId&stuId=$userId");
exit();


