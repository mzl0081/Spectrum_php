<?php
session_start();
include_once '../data/db-conn.php';

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(isset($_POST['update']))
{
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$userRealName = mysqli_real_escape_string($conn, $_POST['userRealName']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$uid = $_SESSION["uid"];

	$sql = "UPDATE spectrum_users SET userAccount='$username', userPassword='$password', userEmail='$email', userDisplayName='$userRealName' WHERE userID='$uid';";
	mysqli_query($conn, $sql);
	header("Location: ./stuInfoDetail.php?stu=$username");
	
}
else
{
	if(isset($_POST['edit']))
	{
		$getUname = explode("?", $actual_link);
		$username = explode("=", $getUname[1])[1];
		//print_r($username);
	}
	else
	{
		$getUname = explode("=", $actual_link);
		$username = $getUname[1];
	}
	
	$sql = "SELECT * FROM spectrum_users WHERE userAccount='$username';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 0)
	{
		while ($row = mysqli_fetch_assoc($result)) 
		{
			$_SESSION["uid"] = $row["userID"];
			$email = $row["userEmail"];
			$password = $row["userPassword"];
			$userRealName = $row["userDisplayName"];
		}
	}	
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Info</title>
</head>
<body>
	<h1><a href="./adminIndex.php">Admin Index</a></h1>
	<h2><a href="./studentInfo.php">Go back</a></h2>
	<h1>Hello user!</h1>
	<table>
		<caption>User Information</caption>
		<thead>
			<tr>
				<th>Username/User Account</th>
				<th>User Real Name</th>
				<th>Email</th>
				<th>Password</th>
				<th>Progress</th>
				<th>Edit/Update</th>
			</tr>
		</thead>
		<tbody>

			<?php

			if(isset($_POST['edit']))
			{
				echo "<form action='./stuInfoDetail.php?stu=$username?update' method='POST'><tr>";
				echo "<td><input type='text' name='username' value='".$username."'></td>";
				echo "<td><input type='text' name='userRealName' value='".$userRealName."'></td>";
				echo "<td><input type='text' name='email' value='".$email."'></td>";
				echo "<td><input type='text' name='password' value='".$password."'></td>";
				echo "<td>Progress</td>";		
				echo "<td><input type='submit' name='update' value='Update'></td>";
				echo "</tr></form>";
			}
			else
			{
				echo "<tr>";
				echo "<td>".$username."</td>";
				echo "<td>".$userRealName."</td>";
				echo "<td>".$email."</td>";
				echo "<td>".$password."</td>";
				echo "<td>Progress</td>";
				echo "<td><form action='./stuInfoDetail.php?stu=$username?edit' method='POST'>"."<input type='submit' name='edit' value='Edit'>"."</form></td>";
				echo "</tr>";

			}

			?>

		</tbody>
	</table>
</body>
</html>