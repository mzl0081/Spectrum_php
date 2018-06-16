<?php
include_once '../data/db-conn.php';

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getUId = explode("=", $actual_link);
$userId = $getUId[1];

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
			<thead>
				<tr>
					<th>Topic Id</th>
					<th>Topic Titie</th>
					<th>See Details</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql = "SELECT * FROM spectrum_topics WHERE userID='$userId';";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0)
				{
					while ($row = mysqli_fetch_assoc($result)) 
					{
						$quesTitle = $row["topicTitle"];
						$quesId = $row["topicID"];

						echo "<tr><td>".$quesId."</td>";
						echo "<td>".$quesTitle."</td>";
						echo "<td><a href='./studentQDetails.php?quesId=$quesId'>Details</a></td></tr>";
					}
				}

				?>
			</tbody>
		</table>

</body>
</html>