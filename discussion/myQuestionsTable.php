<!DOCTYPE html>
<html>
<head>
<title>My Questions Table</title>
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
			<th>Answers</th>
			<th>Question Title</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM spectrum_topics WHERE userID='$userId';";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		$quesIdList = array();
		$quesList = array();

		if ($resultCheck > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$questionId = $row["topicID"];
				$quesTitle = $row["topicTitle"];
				array_push($quesIdList, $questionId);
				array_push($quesList, $quesTitle);
			}
		}

		$sql = "SELECT * FROM spectrum_topic_reply;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		$count = 0;
		$ansCountList = array();

		if ($resultCheck > 0)
		{
			$row = mysqli_fetch_assoc($result);
			for ($i = 0; $i < count($quesIdList); $i++)
			{
				$sql = "SELECT * FROM spectrum_topic_reply WHERE topicID='$quesIdList[$i]';";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
						$count++;
					}
					array_push($ansCountList, $count);
					$count = 0;
				}
				else
				{
					array_push($ansCountList, 0);
				}

			}
		}
		else
		{
			array_push($ansCountList, 0);
		}

		
		?>

		<?php
		for ($i = 0; $i < count($quesIdList); $i++)
		{
			echo "<tr><td>".$ansCountList[$i]."</td>";
			echo "<td>"."<a href='myQuesDetails.php?quesId=$quesIdList[$i]'>".$quesList[$i]."</td></tr>";
		}
		?>
	</tbody>
</table>
</body>
</html>