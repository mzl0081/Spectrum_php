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

$sql = "SELECT * FROM spectrum_topics WHERE userID='$userId';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

$quesIdList = array();
$quesList = array();
$replyNumList = array();
$timeList = array();

if ($resultCheck > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$questionId = $row["topicID"];
		$quesTitle = $row["topicTitle"];
		$replyNum = $row["topicNumberOfReplies"];
		$askTime = date_format(date_create($row["topicTime"]),"Y-m-d");
		array_push($replyNumList, $replyNum);
		array_push($quesIdList, $questionId);
		array_push($quesList, $quesTitle);
		array_push($timeList, $askTime);
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
			print <<<MYQ
			<div class="main">
			<a href="myQuesDetails.php?quesId=$quesIdList[$i]">
            	<div class="index">
                    <div class="index_box">
                        <div class="index_icon">
                            <div class="icon_h"><img src="../images/icon2.png"></div>
                                <div class="titl">
                                	<p>$quesList[$i]</p>  
                                    <div class="titl_h">	
                                     	<time title="#">$timeList[$i]</time>
                                      	<floor title="#">Author: <span>Myself</span></floor>
                                      	<I>Replies<span>($replyNumList[$i])</span></I>	
                                    </div>
                                </div>	
                            </div>   
                    </div>
            	</div>
    		</a>
    	</div>
MYQ;
		}
		?>

</body>
</html>