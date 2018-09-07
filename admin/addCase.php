<?php
session_start();
include_once '../data/db-conn.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Case Management</title>
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
               <h4><a href="./cases.php">Cases</a></h4>
               <a href="./studentDisc.php">Discussions</a>
               </div>
          <div class="contentDivision">
               <p class="breadcrumb"><a href="./cases.php">Cases</a> &gt; Add</p>
               <h3><strong>Add A New Case</strong></h3>
               <br> 

	<form name="admin_addCase" action="../data/db-adminAddCase.php" method="POST" enctype="multipart/form-data">
		<table>
          <tr>
          	<td>
          		<strong>Case Number: </strong>
          	</td>
          	<td>
          		<input type="text" name="caseNumber" value="">
          	</td>
          </tr>

          <tr>
               <td>
                    <strong>Case Chapter: </strong>
               </td>
               <td>
                    <input type="text" name="caseChapter" value="">
               </td>
          </tr>

          <tr>
          	<td>
          		<strong>Case Name: </strong>
          	</td>
          	<td>
          		<input type="text" name="caseName" value="">
          	</td>
          </tr>

          <tr>
          	<td>
          		<strong>Case Description: </strong>
          	</td>
          	<td>
          		<textarea name="caseDescription" rows="15" style="width:400px; text-transform:none;"></textarea>
          	</td>
          </tr>

          <tr>
          	<td>
          		<strong>Case Cover Picture (only one): </strong>
          	</td>
          	<td>
          		<input type="file" name="caseCoverPic" accept="image/*">
          	</td>
          </tr>

          <tr>
          	<td>
          		<strong>Case Video Screenshot (only one): </strong>
          	</td>
          	<td>
          		<input type="file" name="caseVideoScreenshot" accept="image/*">
          	</td>
          </tr>

          <tr>
          	<td>
          		<strong>Case Video (only one): </strong>
          	</td>
          	<td>
          		<input type="file" name="caseVideo" accept="video/*" >
          	</td>
          </tr>

		  <tr>
          	<td>
          		<strong>Teacher's Note Cover Picture (only one): </strong>
          	</td>
          	<td>
          		<input type="file" name="tNoteCoverPic" accept="image/*">
          	</td>
          </tr>

          <tr>
          	<td>
          		<strong>Teacher's Note Video (only one): </strong>
          	</td>
          	<td>
          		<input type="file" name="tNote" accept="video/*" >
          	</td>
          </tr>

          <tr>
          	<td>
          		<input type="submit" name="upload" value="Upload Case">
          	</td>
          	<td></td>
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
</div>

</body>
</html>