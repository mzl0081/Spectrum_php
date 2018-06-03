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
	<h2><a href="./studentDisc.php">Discussion</a></h2>


	<?php

	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$getQuesId = explode("=", $actual_link);
	$quesId = $getQuesId[1];

	$sql = "SELECT * FROM spectrum_topics WHERE topicID='$quesId';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
		  $quesTitle = $row["topicTitle"];
		  $description = $row["topicContent"];
		}
	}

	?>
	<form name="admin_QDetail" action="../data/db-adminQ.php" method="POST">
		<table style="width:800px; border="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>

          <tr>
            <td width="100" align="right">
              <strong>Question Title: </strong>
            </td>
            <td width="245" align="left">
              <?php
              echo "<p>".$quesTitle."</p>";
              ?>
              
            </td>
          </tr>

          <tr>
            <td width="100" align="right">
              <strong>Description: </strong>
            </td>
            <td width="245" align="left">
              <?php
              echo "<p>".$description."</p>";
              ?>             
            </td>
          </tr>

          <tr>
            <td>
            	<?php
	              echo "<input type='hidden' name='thisQId' value='$quesId'>";
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