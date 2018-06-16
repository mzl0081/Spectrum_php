<?php
include_once '../data/db-conn.php'; 

$sql = "SELECT * FROM spectrum_case;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
$caseList = array();

if ($resultCheck > 0)
{
	while ($row = mysqli_fetch_assoc($result)) 
	{
		$caseId = $row["caseID"];
		array_push($caseList, $caseId);
	}
}
sort($caseList);

?>
<!DOCTYPE html>
<html>
<head>
	<title>adminIndex</title>
</head>
<body>
	<h1><a href="./adminIndex.php">Admin Index</a></h1>
	<h2><a href="./cases.php">Cases</a></h2>
	<table>
		<caption>Cases List</caption>
		<thead>
			<tr>
				<th>Case Number</th>
				<th>Case Title</th>
				<!-- <th>Case Chapter</th> -->
				<th>Case Details</th>
				<th>Questions/Reflection Details</th>
			</tr>
		</thead>
		<tbody>
			<?php
			for ($i = 0; $i < count($caseList); $i++)
			{
				$sql = "SELECT * FROM spectrum_case WHERE caseID='$caseList[$i]';";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
				if ($resultCheck > 0)
				{
					while ($row = mysqli_fetch_assoc($result)) 
					{
						$caseName = $row["caseName"];								
					}
				}
				echo "<tr><td>".$caseList[$i]."</td>";
				echo "<td>".$caseName."</td>";
				echo "<td><a href='./caseDetails.php?caseId=$caseList[$i]'>Case Details</a></td>";
				echo "<td><a href='./quizDetails.php?caseId=$caseList[$i]'>Questions/Reflection Details</a></td>";
			}
			?>
		</tbody>
	</table>

	<form name="addCase" action="../admin/addCase.php" method="POST">
		<input type="submit" name="addCase" value="Add Case">
	</form>

</body>
</html>