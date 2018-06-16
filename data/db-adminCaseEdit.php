<?php

include_once './db-conn.php';

if (isset($_POST['update']))
{
	$caseId = mysqli_real_escape_string($conn, $_POST['thisCaseId']);
	$caseName = mysqli_real_escape_string($conn, $_POST['caseName']);
	$caseDescription = mysqli_real_escape_string($conn, $_POST['caseDescription']);
	$caseNumber = $caseId;

	//case cover picture
	$caseCPFile = $_FILES['caseCoverPic'];
	$caseCPFileName = $_FILES['caseCoverPic']['name'];
	$caseCPFileTmpName = $_FILES['caseCoverPic']['tmp_name'];
	$caseCPFileSize = $_FILES['caseCoverPic']['size'];
	$caseCPFileError = $_FILES['caseCoverPic']['error'];
	$caseCPFileType = $_FILES['caseCoverPic']['type'];

	$caseCPFileExt = explode('.', $caseCPFileName);
	$caseCPFileActualExt = strtolower(end($caseCPFileExt));
	$caseCPFileAllowed = array('jpg', 'jpeg', 'png', 'bmp');

	if (in_array($caseCPFileActualExt, $caseCPFileAllowed))
	{
		if ($caseCPFileError === 0)
		{
			if ($caseCPFileSize < 3000000)
			{
				$caseCPFileNewName = "case_video_cover_".$caseNumber.".".$caseCPFileActualExt;
				$caseCPFileDestination = "../cases/caseCoverPic/".$caseCPFileNewName;
				move_uploaded_file($caseCPFileTmpName, $caseCPFileDestination);
			}
			else
			{
				echo "Your case cover picture is too big!";
			}

		}
		else
		{
			echo "There was an error uploading your case cover picture!";
		}

	}
	else
	{
		echo "Error file type for case cover picture!";
	}




//case video screenshot
	$caseVSFile = $_FILES['caseVideoScreenshot'];
	$caseVSFileName = $_FILES['caseVideoScreenshot']['name'];
	$caseVSFileTmpName = $_FILES['caseVideoScreenshot']['tmp_name'];
	$caseVSFileSize = $_FILES['caseVideoScreenshot']['size'];
	$caseVSFileError = $_FILES['caseVideoScreenshot']['error'];
	$caseVSFileType = $_FILES['caseVideoScreenshot']['type'];

	$caseVSFileExt = explode('.', $caseVSFileName);
	$caseVSFileActualExt = strtolower(end($caseVSFileExt));
	$caseVSFileAllowed = array('jpg', 'jpeg', 'png', 'bmp');

	if (in_array($caseVSFileActualExt, $caseVSFileAllowed))
	{
		if ($caseVSFileError === 0)
		{
			if ($caseVSFileSize < 3000000)
			{
				$caseVSFileNewName = "case_video_screenshot_".$caseNumber.".".$caseVSFileActualExt;
				$caseVSFileDestination = "../cases/caseVideoScreenshot/".$caseVSFileNewName;
				move_uploaded_file($caseVSFileTmpName, $caseVSFileDestination);
			}
			else
			{
				echo "Your file is too big!";
			}

		}
		else
		{
			echo "There was an error uploading your case video screenshot!";
		}

	}
	else
	{
		echo "Error file type for case video screenshot!";
	}




//case video
	$caseVideoFile = $_FILES['caseVideo'];
	$caseVideoFileName = $_FILES['caseVideo']['name'];
	$caseVideoFileTmpName = $_FILES['caseVideo']['tmp_name'];
	$caseVideoFileSize = $_FILES['caseVideo']['size'];
	$caseVideoFileError = $_FILES['caseVideo']['error'];
	$caseVideoFileType = $_FILES['caseVideo']['type'];

	$caseVideoFileExt = explode('.', $caseVideoFileName);
	$caseVideoFileActualExt = strtolower(end($caseVideoFileExt));
	$caseVideoFileAllowed = array('mp4', 'mpeg', 'flv', 'mkv', 'avi', 'm4v');

	if (in_array($caseVideoFileActualExt, $caseVideoFileAllowed))
	{
		if ($caseVideoFileError === 0)
		{
			if ($caseVideoFileSize < 30000000)
			{
				$caseVideoFileNewName = "case_video_".$caseNumber.".".$caseVideoFileActualExt;
				$caseVideoFileDestination = "../cases/caseVideo/".$caseVideoFileNewName;
				move_uploaded_file($caseVideoFileTmpName, $caseVideoFileDestination);
			}
			else
			{
				echo "Your video file is too big!";
			}

		}
		else
		{
			echo "There was an error uploading your video file!";
		}

	}
	else
	{
		echo "Error file type for case video!";
	}





//teacher's note cover picture
	$tNoteCPFile = $_FILES['tNoteCoverPic'];
	$tNoteCPFileName = $_FILES['tNoteCoverPic']['name'];
	$tNoteCPFileTmpName = $_FILES['tNoteCoverPic']['tmp_name'];
	$tNoteCPFileSize = $_FILES['tNoteCoverPic']['size'];
	$tNoteCPFileError = $_FILES['tNoteCoverPic']['error'];
	$tNoteCPFileType = $_FILES['tNoteCoverPic']['type'];

	$tNoteCPFileExt = explode('.', $tNoteCPFileName);
	$tNoteCPFileActualExt = strtolower(end($tNoteCPFileExt));
	$tNoteCPFileAllowed = array('jpg', 'jpeg', 'png', 'bmp');

	if (in_array($tNoteCPFileActualExt, $tNoteCPFileAllowed))
	{
		if ($tNoteCPFileError === 0)
		{
			if ($tNoteCPFileSize < 3000000)
			{
				$tNoteCPFileNewName = "tnote_cover_".$caseNumber.".".$tNoteCPFileActualExt;
				$tNoteCPFileDestination = "../cases/tNoteCoverPic/".$tNoteCPFileNewName;
				move_uploaded_file($tNoteCPFileTmpName, $tNoteCPFileDestination);
			}
			else
			{
				echo "Your teacher's note cover picture is too big!";
			}

		}
		else
		{
			echo "There was an error uploading your teacher's note cover picture!";
		}

	}
	else
	{
		echo "Error file type for teacher's note cover picture!";
	}






//teacher's note
	$tNoteFile = $_FILES['tNote'];
	$tNoteFileName = $_FILES['tNote']['name'];
	$tNoteFileTmpName = $_FILES['tNote']['tmp_name'];
	$tNoteFileSize = $_FILES['tNote']['size'];
	$tNoteFileError = $_FILES['tNote']['error'];
	$tNoteFileType = $_FILES['tNote']['type'];

	$tNoteFileExt = explode('.', $tNoteFileName);
	$tNoteFileActualExt = strtolower(end($tNoteFileExt));
	$tNoteFileAllowed = array('mp4', 'mpeg', 'flv', 'mkv', 'avi', 'm4v');

	if (in_array($tNoteFileActualExt, $tNoteFileAllowed))
	{
		if ($tNoteFileError === 0)
		{
			if ($tNoteFileSize < 30000000)
			{
				$tNoteFileNewName = "tnote_video_".$caseNumber.".".$tNoteFileActualExt;
				$tNoteFileDestination = "../cases/tNoteVideo/".$tNoteFileNewName;
				move_uploaded_file($tNoteFileTmpName, $tNoteFileDestination);
			}
			else
			{
				echo "Your teacher's note video is too big!";
			}

		}
		else
		{
			echo "There was an error uploading your teacher's note video!";
		}

	}
	else
	{
		echo "Error file type for teacher's note!";
	}


	$sql = "UPDATE spectrum_case SET caseName='$caseName', caseDescription='$caseDescription', caseVideoName='$caseVideoFileNewName', caseType='1', caseCoverPic='$caseCPFileNewName', caseVideoScreenshot='$caseVSFileNewName' WHERE caseID='$caseId';";
	mysqli_query($conn, $sql);	

	$sql = "UPDATE spectrum_teachersnote SET noteVideo='$tNoteFileNewName', noteCover='$tNoteCPFileNewName' WHERE caseID='$caseId';";
	mysqli_query($conn, $sql);

	header("Location:../admin/caseDetails.php?caseId=$caseId");
	exit();

}
else
{
	header("Location:../admin/cases.php");
	exit();
}