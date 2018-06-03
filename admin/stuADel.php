<?php
include_once '../data/db-conn.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>adminIndex</title>
</head>
<body onload="myFunction()">

  <h3 id="showMessage"></h3>
  <?php

  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $getAnsId = explode("=", $actual_link);
  $ansId = $getAnsId[1];

  $sql = "DELETE FROM spectrum_topic_reply WHERE topicReplyID='$ansId';";
  mysqli_query($conn, $sql);
  header("Location:./studentDisc.php");
  exit();

  ?>

	
</body>
</html>

<script>
function myFunction() 
{
    var txt;
    var inputPwd = prompt("Please enter your password:", "");
    if (inputPwd == "admin") {
        txt = "Password correct.";
    } else {
        txt = "Password wrong";
        var myVar = setInterval(directToPage, 5000);        
    }
    document.getElementById("showMessage").innerHTML = txt;
}


function directToPage()
{
  window.location.href = "./studentDisc.php";
}
</script>