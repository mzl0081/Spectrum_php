<?php
include_once '../data/db-conn.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>adminIndex</title>
</head>
<body>

<?php

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
		  $caseVideoName = $row["caseVideoName"];
		  $caseCoverPic = $row["caseCoverPic"];
		  $caseVideoScreenshot = $row["caseVideoScreenshot"];
		}
	}

	$sql = "SELECT * FROM spectrum_teachersnote WHERE caseID='$caseId';";
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

?>

	<h1><a href="./adminIndex.php">Admin Index</a></h1>
	<h2><a href="./cases.php">Cases</a></h2>
	<h1>
		<?php
		echo "Case Number: ".$caseId;
		?>
	</h1>

	<form name="admin_QDetail" action="../data/db-adminQ.php" method="POST">
		<table style="width:800px; border="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>

          <tr>
            <td>
              <strong>Case Name: </strong>
            </td>
            <td>
              <?php
              echo "<p>".$caseName."</p>";
              ?>          
            </td>
          </tr>

          <tr>
            <td>
              <strong>Case Description: </strong>
            </td>
            <td>
              <?php
              echo "<p>".$caseDescription."</p>";
              ?>             
            </td>
          </tr>

          <tr>
            <td>
              <strong>Case Cover Picture: </strong>
            </td>
            <td>
              <?php
              echo "<img src='../cases/caseCoverPic/".$caseCoverPic."' alt='case Cover Picture' width='400' height='275'>";
              ?>             
            </td>
          </tr>

          <tr>
            <td>
              <strong>Case Video Screenshot: </strong>
            </td>
            <td>
              <?php
              echo "<img src='../cases/caseVideoScreenshot/".$caseVideoScreenshot."' alt='Case Video Screenshot' width='400' height='275'>";
              ?>             
            </td>
          </tr>

          <tr>
            <td>
              <strong>Case Video: </strong>
            </td>
            <td>
              <?php
              echo "<video width='320' height='240' controls>"."<source src='../cases/caseVideo/".$caseVideoName."'></video>";
              ?>             
            </td>
          </tr>

          <tr>
            <td>
              <strong>Teacher's Note Cover Picture: </strong>
            </td>
            <td>
              <?php
              echo "<img src='../cases/tNoteCoverPic/".$noteCover."' alt='Teacher's Note Cover Picture' width='400' height='275'>";
              ?>             
            </td>
          </tr>

          <tr>
            <td>
              <strong>Case Video: </strong>
            </td>
            <td>
              <?php
              echo "<video width='320' height='240' controls>"."<source src='../cases/tNoteVideo/".$noteVideo."'></video>";
              ?>             
            </td>
          </tr>

          <tr>
            <td>
            	<?php
	              echo "<input type='hidden' name='thisCaseId' value='$caseId'>";
	            ?>
            	<input type="submit" name="edit" value="Edit" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">
            	<br />
            </td>
            <td>
				<input type="submit" name="delete" value="Delete" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">
				<br />
            </td>
          </tr>
          
        </table>
	</form>


</body>
</html>