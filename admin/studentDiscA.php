<?php
include_once '../data/db-conn.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>adminIndex</title>
</head>
<body>
	<h1><a href="./adminIndex.php">Admin Index</a></h1>
	<h2><a href="./studentDisc.php">Discussion</a></h2>


		<table>
			<caption>Student Users List</caption>
			<thead>
				<tr>
					<th>Question Titie</th>
					<th>See Details</th>
				</tr>
			</thead>
			<tbody>
					<?php

					$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$getUId = explode("=", $actual_link);
					$userId = $getUId[1];

					$sql = "SELECT * FROM spectrum_topic_reply WHERE userID='$userId';";
					$result = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);
					
					$allQuesIdList = array();
					$quesIdList = array();
					$quesList = array();

					if ($resultCheck > 0)
					{
						while($row = mysqli_fetch_assoc($result))
						{
							$quesId = $row["topicID"];

							array_push($allQuesIdList, $quesId);

						}
					}

					sort($allQuesIdList);
					$getQId = array_count_values($allQuesIdList);
					foreach ($getQId as $x => $x_value) 
					{
						array_push($quesIdList, $x);
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
								array_push($quesList, $quesName);
							}
							
						}
						
					}

					?>

					<?php
					for ($i = 0; $i < count($quesIdList); $i++)
					{
						echo "<tr>";
						echo "<td>".$quesList[$i]."</td>";
						echo "<td><a href='studentADetails.php?quesId=$quesIdList[$i]&stuId=$userId'>See Details</a></td>";
						echo "</tr>";
					}
					?>


			</tbody>
		</table>

</body>
</html>