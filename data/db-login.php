<?php

session_start();

if (isset($_POST['submit']))
{
	if (isset($_POST['userType']))
	{
		include_once 'db-conn.php';

		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$pwd = mysqli_real_escape_string($conn, $_POST['password']);
		$userType = $_POST['userType'];

		if ($userType == "student")
		{
			$sql = "SELECT * FROM spectrum_users WHERE userAccount='$username';";
		}
		else
		{
			$sql = "SELECT * FROM spectrum_admins WHERE adminAccount='$username';";
		}

		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		if ($resultCheck == 0)
		{
			$_SESSION["loginMsg"] = "user doesn't exist";
			header("Location: ../login.php");
			exit();
		}
		else
		{
			//$_SESSION["loginMsg"] = "";
			$row = mysqli_fetch_assoc($result);			
			if ($userType == "student")
			{
				if ($pwd == $row["userPassword"])
				{
					$_SESSION["loginUser"] = $username;
					$_SESSION["loginMsg"] = "";
					header("Location: ../home.php");
					exit();
				}
				else
				{
					$_SESSION["loginMsg"] = "password incorrect";
					header("Location: ../login.php");
					exit();
				}
				
			}
			else
			{
				if ($pwd == $row["adminPassword"])
				{
					$_SESSION["loginUser"] = "Administrator";
					$_SESSION["loginMsg"] = "";
					header("Location: ../admin/adminIndex.php");
					exit();
				}
				else
				{
					$_SESSION["loginMsg"] = "password incorrect";
					header("Location: ../login.php");
					exit();
				}
					
			}
				
		}
	}
	else
	{
		header("Location:../login.php");
		exit();
	}
	
}
else
{
	header("Location:../login.php");
	exit();
}



