<?php

include_once './db-conn.php';

if (isset($_POST['edit']))
{
	$caseId = mysqli_real_escape_string($conn, $_POST['thisCaseId']);
	header("Location:../admin/caseEdit.php?caseId=$caseId");
	exit();
}
elseif (isset($_POST['delete'])) 
{
	$caseId = mysqli_real_escape_string($conn, $_POST['thisCaseId']);

	$sql = "SELECT * FROM spectrum_case WHERE caseID='$caseId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
		  $caseVideoName = $row["caseVideoName"];
		  $caseCoverPic = $row["caseCoverPic"];
		  $caseVideoScreenshot = $row["caseVideoScreenshot"];
		}
	}

	$sql = "SELECT * FROM spectrum_teachersNote WHERE caseID='$caseId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
		  $noteCover = $row["noteCover"];
		  $noteVideo = $row["noteVideo"];
		}
	}

	$path = "../cases/caseCoverPic/".$caseCoverPic;
	unlink($path);
	$path = "../cases/caseVideoScreenshot/".$caseVideoScreenshot;
	unlink($path);
	$path = "../cases/caseVideo/".$caseVideoName;
	unlink($path);
	$path = "../cases/tNoteCoverPic/".$noteCover;
	unlink($path);
	$path = "../cases/tNoteVideo/".$noteVideo;
	unlink($path);


	$sql = "DELETE FROM spectrum_case_user_relationship WHERE caseID='$caseId';";
	mysqli_query($conn, $sql);

	$sql = "DELETE FROM spectrum_question WHERE caseID='$caseId';";
	mysqli_query($conn, $sql);

	$sql = "DELETE FROM spectrum_quiz_records WHERE caseID='$caseId';";
	mysqli_query($conn, $sql);

	$sql = "DELETE FROM spectrum_teachersNote WHERE caseID='$caseId';";
	mysqli_query($conn, $sql);

	$sql = "DELETE FROM spectrum_case WHERE caseID='$caseId';";
	mysqli_query($conn, $sql);

	header("Location: ../admin/cases.php");
	exit();

}
else
{
	header("Location: ../admin/cases.php");
	exit();
}