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
	<h2><a href="./cases.php">Cases</a></h2>
	<p>Add A New Case</p>

	<form name="admin_addCase" action="../data/db-adminAddCase.php" method="POST" enctype="multipart/form-data">
		<table>
          <tr>
          	<td>
          		<strong>Case Number: </strong>
          	</td>
          	<td>
          		<input type="text" name="caseNumber" value="">
          	</td>
          </tr>

          <tr>
          	<td>
          		<strong>Case Name: </strong>
          	</td>
          	<td>
          		<input type="text" name="caseName" value="">
          	</td>
          </tr>

          <tr>
          	<td>
          		<strong>Case Description: </strong>
          	</td>
          	<td>
          		<textarea name="caseDescription" rows="15" style="width:400px; text-transform:none;"></textarea>
          	</td>
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
          		<input type="submit" name="upload" value="Upload Case">
          	</td>
          	<td></td>
          </tr>

      </table>
		
	</form>


</body>
</html>