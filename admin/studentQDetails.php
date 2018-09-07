<?php
session_start();
include_once '../data/db-conn.php';

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getQuesId = explode("=", $actual_link);
$quesId = end($getQuesId);

$sql = "SELECT * FROM spectrum_topics WHERE topicID='$quesId';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    $quesTitle = $row["topicTitle"];
    $description = $row["topicContent"];
    $userId = $row["userID"];
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
        <<table class="nav">
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
                    "<a href='./studentDiscQ.php?stuId=$userId'>Topics</a> &gt; Description";
                    ?>
            </p></br></br></br></br>
            
          	<form name="admin_QDetail" action="../data/db-adminQ.php" method="POST">
          		<table style="width:600px; border:0px;position: relative;left:150px">
                <tr>
                  <td width="50" align="left">
                    <strong>Topic Title: </strong>
                  </td>
                  <td width="245" align="left">
                    <?php
                    echo "<p>".$quesTitle."</p>";
                    ?>
                  </td>
                </tr>

                <tr>
                  <td width="50" align="left">
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
                  	<input type="submit" name="edit" value="Edit" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px">
                  </td>
                  <!-- add confirm message -->
                  <td>
          		      <input type="submit" name="delete" value="Delete" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px" onclick="return confirm('Are you sure you want to delete this record?')">
                  </td>
                </tr>
                    
              </table>
          	</form>
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