<?php

include_once 'db-conn.php';

if (isset($_POST["user_account"], $_POST["user_name"], $_POST["user_email"]))
{
	$userAccount = mysqli_real_escape_string($conn, $_POST['user_account']);
	$userDisplayName = mysqli_real_escape_string($conn, $_POST['user_name']);
	$userEmail = mysqli_real_escape_string($conn, $_POST['user_email']);

	if ($userDisplayName == '' || $userEmail == '')
	{
		echo 'Please complete this form!';
		exit();
	}


	if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL))
	{
			echo 'Invalid email format!';
			exit();
	}
	else
	{
		$sql = "UPDATE spectrum_users SET userEmail='$userEmail', userDisplayName='$userDisplayName' WHERE userAccount='$userAccount';";
		mysqli_query($conn, $sql);
		echo 'Success! This record has been updated.';
	}
}
else
{
	echo 'Please complete this form!';
	exit();
}
