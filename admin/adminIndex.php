<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Spectrum Admin Home</title>
<link rel="stylesheet" href="https://www.auburn.edu/template/styles/stretchSidebar.css" media="screen" type="text/css" />
<!--#include virtual="/template/includes/head.html" -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
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
            <a href="./studentDisc.php">Discussions</a>
          </div>
    		<div class="contentDivision">
            <p class="breadcrumb"><a href="./adminIndex.php">Home</a>&gt; Introduction</p> 
			<!-- TemplateBeginEditable name="body" -->
     
 				<h3><strong>User Management</strong></h3>
    			<br>
    			<p>Administrators are allowed to manage user information. They could see all the information of registered users except the passwords. They can add new user information into database or delete any existed users from the database. In addition, administrators can update user information but have no right to change passwords. The passwords can only be reset to the specific default value.</p>
      		<h3><strong>Case Management</strong></h3>
          <br>
     			<p>Administrators are also allowed to manage cases including classroom cases and life cases. In the section of Cases, they can upload, delete or replace the videos. They have the authority to edit the content of reflections and answers.</p>
     			<h3><strong>Discussion Management</strong></h3>
          <br>
     			<p>Besides, administrators could check the questions and answers in the section of Discussions. They have the authority to delete or edit the existed questions and answers. But they only modify the questions when requested by the users who asked those questions. However, inappropriate content will be deleted immediately.</p>

   		 	</div>

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
 	 <!--#include virtual="/template/includes/gatc.html" --> 
	</div>
</body>
</html>
