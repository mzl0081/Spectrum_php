<?php

include_once '../data/db-conn.php';

$sql = "SELECT * FROM spectrum_case WHERE caseID>=3 LIMIT 1, 1;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    $next = $row["caseID"];
    echo $next;
  }
}

?>