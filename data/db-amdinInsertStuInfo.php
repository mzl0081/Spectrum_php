<?php

include_once 'db-conn.php';

if (isset($_POST["user_account"], $_POST["user_name"], $_POST["user_email"], $_POST["user_pwd"]))
{

	$userAccount = mysqli_real_escape_string($conn, $_POST['user_account']);
	$userPassword = mysqli_real_escape_string($conn, $_POST['user_pwd']);
	$userDisplayName = mysqli_real_escape_string($conn, $_POST['user_name']);
	$userEmail = mysqli_real_escape_string($conn, $_POST['user_email']);

	if ($userAccount == '' || $userPassword == '' || $userDisplayName == '' || $userEmail == '')
	{
		echo 'Please complete this form!';
		exit();
	}

	$sql = "SELECT * FROM spectrum_users WHERE userAccount='$userAccount';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 0)
	{
		echo 'This Account has already been used!';
		exit();
	}
	else
	{
		if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL))
		{
  			echo 'Invalid email format!';
				exit();
		}
		else
		{
			$sql = "INSERT INTO spectrum_users (userAccount, userPassword, userEmail, userDisplayName, userAvatar) VALUES ('$userAccount', '$userPassword', '$userEmail', '$userDisplayName', 'default_avatar');";
			mysqli_query($conn, $sql);
			echo 'Success! This record has been added.';
		}
	}

}
else
{
	echo 'Please complete this form!';
	exit();
}
