<?php
session_start();
include_once '../data/db-conn.php';

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$seperate = explode("=", $actual_link);
$getQuesId = explode("&", $seperate[1]);
$quesId = $getQuesId[0];
$userId = $seperate[2];
$str = 'Are you sure you want to delete this record?';

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

<!DOCTYPE html>
<html>
<head>
  <title>Spectrum Educational tool</title>
  <link rel="stylesheet" href="https://www.auburn.edu/template/styles/stretchSidebar.css" media="screen" type="text/css" />
</head>
<body>
  <div id="pageWrap"> 
      <div id="headerWrap">
        <div id="header">
            <div id="logo">
              <a href="http://www.auburn.edu/"><img src="http://www.auburn.edu/template/styles/images/headerLogo2.png" alt="Auburn University Homepage"></a>
            </div>
            <div id="headerTitle">
              <div class="titleArea" style="position: relative;left: 230px;top:40px">
                <span class="mainHeading"><!-- TemplateBeginEditable name="unitTitle" -->Spectrum Educational Tool<!-- TemplateEndEditable --></span>
                <span class="subHeading"><!-- TemplateBeginEditable name="unitSubTitle" -->an online resource training for student teachers<!-- TemplateEndEditable --></span>
              </div>
            </div>
        </div>
        <table class="nav">
          <td width="600"></td>
              <?php
               if (!isset($_SESSION["loginUser"]))
               {
                 header("Location: ../login.php");
                 exit();
               }
               else
               {
                 echo '<td style="font-style:italic;width:150;text-align:right;font-size:14px; color:#FFFFFF;">';
                 echo "Hello! ".$_SESSION["loginUser"];
                 echo '</td>';
               }
               ?>
              <td style="font-style:inherit;text-align:middle;font-size:14px;"><a href="../logout.php">Logout</a></td>
        </table>
      </div>
      <div id="contentArea">
        <div class="sidebar"> <!-- TemplateBeginEditable name="sidebar" -->
          <h4><a class="upLink" href="./adminIndex.php">Home</a></h4>
          <div class="orangeDecorBar" style="width: 200px"></div>
          <a href="./stuInfoDetail.php">User Information</a>
          <a href="./cases.php">Cases</a>
          <h4><a href="./studentDisc.php">Discussions</a></h4>
        </div>
         <div class="contentDivision">
<!--             To do: get the corresponding userId  -->
            <p class="breadcrumb"><a href="./studentDisc.php">Discussions</a> &gt;
             <?php
                    echo 
                    "<a href='./studentDiscA.php?stuId=$userId'>Replied Topics</a> &gt; Replies";
                    ?>
            </p></br></br></br></br>
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
                echo '<td width="100" align="right"><a href="#" onclick="editReply('.$ansIdList[$i].')">Edit</a>&nbsp;&nbsp;';
                echo '<a href="../data/db-adminADel.php?ansId='.$ansIdList[$i].'" onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a>&nbsp;&nbsp;';
                echo '<strong>Reply '.($i+1).': </strong></td>';
                echo '<td id="ansInput'.$ansIdList[$i].'" width="245" align="left">'.$ansList[$i].'</td>';
                echo '</tr>';
              }
              ?>
            </table>
      </br></br></br></br></br></br></br></br></br>
    <!-- end contentDivision -->
    </div>
  <!-- end contentArea -->
  </div>
      <div id="contentArea_bottom"></div>
    <div id="footerWrap">
        <div id="footer"></div>  
        <div id="subfooter">
            Auburn University | Auburn, Alabama 36849 | (334) 844-4000  | <script type="text/javascript">emailE='gmail.com'; emailE=('spectrumeduteam' + '@' + emailE); document.write("<a href='mailto:" + emailE + "'>" + emailE + "</a>");</script><br />
            <a href="https://fp.auburn.edu/ocm/auweb_survey">Website Feedback</a> | <a href="http://www.auburn.edu/privacy">Privacy</a> | <a href="http://www.auburn.edu/oit/it_policies/copyright_regulations.php">Copyright &copy; 
            <script type="text/javascript">date = new Date(); document.write(date.getFullYear());</script></a>
        </div>
      </div>
<!-- end pagewrap -->
</body>
</html>

<script type='text/javascript'>
function editReply(ansNum)
{
  var x = document.getElementById("ansInput"+ansNum);
  answer = x.innerHTML;
  x.innerHTML = "";

  form = document.createElement("form");
  form.name = "editAns";
  form.action = "../data/db-adminAEdit.php";
  form.method = "POST";
  x.appendChild(form);

  input = document.createElement("textarea");
  input.type = "text";
  input.name = "newAnswer";
  input.value = answer;
  input.style.width = "350px";
  input.style.height = "100px";
  input.style.marginRight = "30px";
  form.appendChild(input);

  input2 = document.createElement("input");
  input2.type = "hidden";
  input2.name = "updateAnsId";
  input2.value = ansNum;
  form.appendChild(input2);

  button = document.createElement("input");
  button.type = "submit";
  button.name = "updateAns";
  button.value = "Update";
  button.style.width = "100px";
  button.style.height = "30px";
  form.appendChild(button);

}


</script>

