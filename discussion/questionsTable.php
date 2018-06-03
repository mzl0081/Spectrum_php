<!DOCTYPE html>
<html>
<head>
<title>Discussion Table</title>
</head>
<body>
	<?php
	include_once '../data/db-conn.php';
	?>
<table>
	<thead>
		<tr>
			<th>Answers</th>
			<th>Question Title</th>
			<th>Asked by</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT * FROM spectrum_topics;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		$quesIdList = array();
		$quesList = array();
		$authorIdList = array();

		if ($resultCheck > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$questionId = $row["topicID"];
				$quesTitle = $row["topicTitle"];
				$authorId = $row["userID"];
				array_push($quesIdList, $questionId);
				array_push($quesList, $quesTitle);
				array_push($authorIdList, $authorId);
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
					array_push($authorList, $row["userAccount"]);
				}

			}

		}
		
		?>

		<?php
		for ($i = 0; $i < count($quesIdList); $i++)
		{
			echo "<tr><td>".$ansCountList[$i]."</td>";
			echo "<td>"."<a href='questionDetails.php?quesId=$quesIdList[$i]'>".$quesList[$i]."</td>";
			echo "<td>".$authorList[$i]."</td></tr>";
		}
		?>
	</tbody>
</table>
</body>
</html>