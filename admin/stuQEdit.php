<?php
session_start();
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
    <title>Spectrum Educational tool</title>
    <link rel="stylesheet" href="https://www.auburn.edu/template/styles/stretchSidebar.css" media="screen" type="text/css" />
<!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>  -->
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