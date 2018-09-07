<?php

include_once 'db-conn.php';

if (isset($_POST["user_account"]))
{
  $userAccount = mysqli_real_escape_string($conn, $_POST['user_account']);

  $sql = "SELECT * FROM spectrum_users WHERE userAccount='$userAccount';";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  if ($resultCheck > 0)
  {
    $row = mysqli_fetch_assoc($result);
    $userId = $row["userID"];

  }

  $sql = "DELETE FROM spectrum_case_user_relationship WHERE userID='$userId';";
  mysqli_query($conn, $sql);

  $sql = "DELETE FROM spectrum_progress WHERE userID='$userId';";
  mysqli_query($conn, $sql);

  $sql = "DELETE FROM spectrum_users WHERE userID='$userId';";
  mysqli_query($conn, $sql);

}
else
{
  exit();
}
