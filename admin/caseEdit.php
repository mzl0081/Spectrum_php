<?php

include_once '../data/db-conn.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getCaseId = explode("=", $actual_link);
$caseId = $getCaseId[1];

$sql = "SELECT * FROM spectrum_case WHERE caseID='$caseId';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0)
{
     while($row = mysqli_fetch_assoc($result))
     {
       $caseName = $row["caseName"];
       $caseDescription = $row["caseDescription"];
     }
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>adminIndex</title>
</head>
<body>
	<h1><a href="./adminIndex.php">Admin Index</a></h1>
	<h2><a href="./cases.php">Cases</a></h2>
	<p>Edit a case</p>

	<form name="admin_caseEdit" action="../data/db-adminCaseEdit.php?caseId=$caseId" method="POST" enctype="multipart/form-data">
		<table>
          <tr>
          	<td>
          		<strong>Case Number: </strong>
          	</td>
               <?php
          	echo '<td>'.$caseId.'</td>';
               ?>
          </tr>

          <tr>
          	<td>
          		<strong>Case Name: </strong>
          	</td>
               <?php
          	echo '<td><input type="text" name="caseName" value="'.$caseName.'"></td>'
               ?>
          </tr>

          <tr>
          	<td>
          		<strong>Case Description: </strong>
          	</td>
               <?php
          	echo '<td><textarea name="caseDescription" rows="15" style="width:400px; text-transform:none;">'.$caseDescription.'</textarea></td>'
               ?>
          </tr>

          <tr>
          	<td>
          		<strong>Case Cover Picture (only one): </strong>
          	</td>
          	<td>
          		<input type="file" name="caseCoverPic" accept="image/*">
          	</td>
          </tr>

          <tr>
          	<td>
          		<strong>Case Video Screenshot (only one): </strong>
          	</td>
          	<td>
          		<input type="file" name="caseVideoScreenshot" accept="image/*">
          	</td>
          </tr>

          <tr>
          	<td>
          		<strong>Case Video (only one): </strong>
          	</td>
          	<td>
          		<input type="file" name="caseVideo" accept="video/*" >
          	</td>
          </tr>

		  <tr>
          	<td>
          		<strong>Teacher's Note Cover Picture (only one): </strong>
          	</td>
          	<td>
          		<input type="file" name="tNoteCoverPic" accept="image/*">
          	</td>
          </tr>

          <tr>
          	<td>
          		<strong>Teacher's Note Video (only one): </strong>
          	</td>
          	<td>
          		<input type="file" name="tNote" accept="video/*" >
          	</td>
          </tr>

          <tr>
          	<td>
                    <?php
                   echo "<input type='hidden' name='thisCaseId' value='$caseId'>";
                    ?>
          		<input type="submit" name="update" value="Update Case">
          	</td>
          	<td></td>
          </tr>

      </table>
		
	</form>


</body>
</html>