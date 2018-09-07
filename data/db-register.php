<?php

session_start();

if (isset($_POST['submit']))
{
	include_once 'db-conn.php';

	$userRealName = mysqli_real_escape_string($conn, $_POST['userRealName']);
	$userAccount = mysqli_real_escape_string($conn, $_POST['username']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);

	$sql = "SELECT * FROM spectrum_users WHERE userAccount='$userAccount';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0)
	{
		$_SESSION["regMsg"] = "User Account exists";
		header("Location: ../register.php");
		exit();
	}
	else
	{
		$_SESSION["regMsg"] = "success";
		$sql = "INSERT INTO spectrum_users (userAccount, userPassword, userEmail, userDisplayName, userAvatar) VALUES ('$userAccount', '$pwd', '$email', '$userRealName', 'default_avatar');";
		mysqli_query($conn, $sql);
		header("Location: ../login.php");
		exit();
	}


}
else
{
	header("Location:../register.php");
	exit();
}


