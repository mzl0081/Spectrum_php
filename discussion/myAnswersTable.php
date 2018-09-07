<?php
include_once '../data/db-conn.php';

$username = $_SESSION["loginUser"];
$sql = "SELECT * FROM spectrum_users WHERE userAccount='$username';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0)
{
	$row = mysqli_fetch_assoc($result);
	$userId = $row["userID"];
}

$sql = "SELECT DISTINCT topicID FROM spectrum_topic_reply WHERE userID='$userId';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);


$quesIdList = array();
$quesList = array();
$replyNumList = array();
$authorIdList = array();
$timeList = array();

if ($resultCheck > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$quesId = $row["topicID"];
		array_push($quesIdList, $quesId);

	}
}

for ($i = 0; $i < count($quesIdList); $i++)
{
	$sql = "SELECT * FROM spectrum_topics WHERE topicID='$quesIdList[$i]';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$quesName = $row["topicTitle"];
			$replyNum = $row["topicNumberOfReplies"];
			$authorId = $row["userID"];
			$askTime = date_format(date_create($row["topicTime"]),"Y-m-d");
			array_push($replyNumList, $replyNum);
			array_push($quesList, $quesName);
			array_push($authorIdList, $authorId);
			array_push($timeList, $askTime);
		}
		
	}
	
}

$authorList = array();
for ($i = 0; $i < count($authorIdList); $i++)
{
	$sql = "SELECT * FROM spectrum_users WHERE userID='$authorIdList[$i]';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			array_push($authorList, $row["userDisplayName"]);
		}

	}
}

$myReplyNumList = array();
for ($i = 0; $i < count($quesIdList); $i++)
{
	$sql = "SELECT * FROM spectrum_topic_reply WHERE topicID='$quesIdList[$i]' AND userID='$userId';";
	$result = mysqli_query($conn, $sql);
	$replyCount = mysqli_num_rows($result);
	array_push($myReplyNumList, $replyCount);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>My Answers Table</title>
<link rel="stylesheet" type="text/css" href="../css/discussion.css">
</head>
<body>

		<?php
		for ($i = 0; $i < count($quesIdList); $i++)
		{
			print <<<MYA
			<div class="main">
			<a href="myAnsDetails.php?quesId=$quesIdList[$i]">
            	<div class="index">
                    <div class="index_box">
                        <div class="index_icon">
                            <div class="icon_h"><img src="../images/icon3.png"></div>
                                <div class="titl">
                                	<p>$quesList[$i]</p>  
                                    <div class="titl_h">	
                                     	<time title="#">$timeList[$i]</time>
                                     	<floor title="#">Asked by: <span>$authorList[$i]</span></floor>
                                      	<floor title="#">Answered by: <span>Myself</span></floor>
                                      	<I>My Replies<span>($myReplyNumList[$i])</span></I>
                                      	<I>All Replies<span>($replyNumList[$i])</span></I>	
                                    </div>
                                </div>	
                            </div>   
                    </div>
            	</div>
    		</a>
    	</div>
MYA;
		}
		?>
</body>
</html>