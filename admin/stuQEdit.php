<?php
include_once '../data/db-conn.php';

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
<!DOCTYPE html>
<html>
<head>
	<title>adminIndex</title>
</head>
<body>
	<h1><a href="./adminIndex.php">Admin Index</a></h1>
	<h2><a href="./studentDisc.php">Discussion</a></h2>
	<form name="admin_QDetailEdit" action="../data/db-adminQEdit.php" method="POST">
		<table style="width:800px; border="0">
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>

      <tr>
        <td width="100" align="right">
          <strong>Topic Title: </strong>
        </td>
        <td width="245" align="left">
          <?php
          echo '<input type="text" name="quesTitle" value="'.$quesTitle.'" maxlength="125" style="width:400px; text-transform:none;">';
          ?>  
        </td>
      </tr>

      <tr>
        <td width="100" align="right">
          <strong>Description: </strong>
        </td>
        <td width="245" align="left">
          <?php
          echo '<textarea name="description" rows="15" style="width:400px; text-transform:none;">';
          echo $description;
          echo '</textarea>';
            ?>             
        </td>
      </tr>

      <tr>
        <td>
          <?php
          echo "<input type='hidden' name='thisQuesId' value='$quesId'>";
          ?>
        </td>
        <td>
          <input type="submit" name="update" value="Update" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">      
        </td>
      </tr>
          
    </table>
	</form>

</body>
</html>