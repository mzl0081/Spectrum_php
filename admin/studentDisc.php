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
					<th>Username/User Account</th>
					<th>Questions</th>
					<th>Answers</th>
				</tr>
			</thead>
			<tbody>
					<?php
					$sql = "SELECT * FROM spectrum_users;";
					$result = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);

					if ($resultCheck > 0)
					{
						while ($row = mysqli_fetch_assoc($result))
						{
							$username = $row["userAccount"];
							$userId = $row["userID"];

							echo "<tr><td>".$username."</td>";
							echo "<td><a href='./studentDiscQ.php?stuId=$userId'>Questions</a></td>";
							echo "<td><a href='./studentDiscA.php?stuId=$userId'>Answers</a></td></tr>";
						}
					}

					?>
			</tbody>
		</table>

</body>
</html>