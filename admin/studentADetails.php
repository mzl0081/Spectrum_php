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
	$seperate = explode("=", $actual_link);
  $getQuesId = explode("&", $seperate[1]);
	$quesId = $getQuesId[0];
  $userId = $seperate[2];

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

  $sql = "SELECT * FROM spectrum_topic_reply WHERE topicID='$quesId' AND userID='$userId';";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  $ansIdList = array();
  $ansList = array();

  if ($resultCheck > 0)
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $ansId = $row["topicReplyID"];
      array_push($ansIdList, $ansId);
    }
  }

  for ($i = 0; $i < count($ansIdList); $i++)
  {
    $sql = "SELECT * FROM spectrum_topic_reply WHERE topicReplyID='$ansIdList[$i]';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0)
    {
      while($row = mysqli_fetch_assoc($result))
      {
        $ansContent = $row["replyContent"];
        array_push($ansList, $ansContent);
      }
      
    }
    
  }


	?>
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

          <?php
          for ($i = 0; $i < count($ansIdList); $i++)
          {
            //$count = $i + 1;
            echo '<tr>';
            echo '<td width="100" align="right"><a href="./stuAEdit.php?ansId='.$ansIdList[$i].'">Edit</a>&nbsp;&nbsp;<a href="./stuADel.php?ansId='.$ansIdList[$i].'">Delete</a>&nbsp;&nbsp;<strong>Reply '.($i+1).': </strong></td>';
            echo '<td width="245" align="left">'.$ansList[$i].'</td>';
            echo '</tr>';

          }


          ?>


 				<br />
            </td>
          </tr>
          
        </table>

</body>
</html>

