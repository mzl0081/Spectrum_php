<?php
include_once '../data/db-conn.php';

$sql = "SELECT * FROM spectrum_topics;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

$quesIdList = array();
$quesList = array();
$authorIdList = array();
$replyNumList = array();
$timeList = array();

if ($resultCheck > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$questionId = $row["topicID"];
		$quesTitle = $row["topicTitle"];
		$authorId = $row["userID"];
		$replyNum = $row["topicNumberOfReplies"];
		$askTime = date_format(date_create($row["topicTime"]),"Y-m-d");
		array_push($quesIdList, $questionId);
		array_push($quesList, $quesTitle);
		array_push($authorIdList, $authorId);
		array_push($replyNumList, $replyNum);
		array_push($timeList, $askTime);
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
?>

<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="../css/discussion.css">
</head>
<body>
		<?php
		for ($i = 0; $i < count($quesIdList); $i++)
		{
			print <<<FORUM
			<div class="main">
			<a href="questionDetails.php?quesId=$quesIdList[$i]">
            	<div class="index">
                    <div class="index_box">
                        <div class="index_icon">
                            <div class="icon_h"><img src="../images/icon1.png"></div>
                                <div class="titl">
                                	<p>$quesList[$i]</p>  
                                    <div class="titl_h">	
                                     	<time title="#">$timeList[$i]</time>
                                      	<floor title="#">Author: <span>$authorList[$i]</span></floor>
                                      	<I>Replies<span>($replyNumList[$i])</span></I>	
                                    </div>
                                </div>	
                            </div>   
                    </div>
            	</div>
    		</a>
    	</div>
FORUM;
		}
		?>

</body>
</html>