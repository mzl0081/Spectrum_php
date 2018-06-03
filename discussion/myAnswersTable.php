<!DOCTYPE html>
<html>
<head>
<title>My Answers Table</title>
</head>
<body>
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


	?>
<table>
	<thead>
		<tr>
			<th>Question Title</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM spectrum_topic_reply WHERE userID='$userId';";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		// $ansIdList = array();
		// $ansList = array();
		$allQuesIdList = array();
		$quesIdList = array();
		$quesList = array();

		if ($resultCheck > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$quesId = $row["topicID"];
				// $ansId = $row["answer_id"];
				// $ans = $row["answer"];
				array_push($allQuesIdList, $quesId);
				// array_push($ansIdList, $ansId);
				//array_push($ansList, $ans);

			}
		}

		$getQId = array_count_values($allQuesIdList);
		foreach ($getQId as $x => $x_value) 
		{
			array_push($quesIdList, $x);
		}

		//print_r($quesIdList);
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
					array_push($quesList, $quesName);
				}
				
			}
			
		}
	
		?>

		<?php
		for ($i = 0; $i < count($quesIdList); $i++)
		{
			echo "<tr><td>";
			echo "<a href='myAnsDetails.php?quesId=$quesIdList[$i]'>".$quesList[$i]."</td></tr>";
		}
		?>
	</tbody>
</table>
</body>
</html>