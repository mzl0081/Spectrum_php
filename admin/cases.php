<?php
session_start();
include_once '../data/db-conn.php'; 

$sql = "SELECT * FROM spectrum_case;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
$caseList = array();

if ($resultCheck > 0)
{
	while ($row = mysqli_fetch_assoc($result)) 
	{
		$caseId = $row["caseID"];
		array_push($caseList, $caseId);
	}
}
sort($caseList);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Case Management</title>
	<link rel="stylesheet" href="https://www.auburn.edu/template/styles/stretchSidebar.css" media="screen" type="text/css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
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
      		<div class="contentDivision"> 
            <p class="breadcrumb"><a href="./adminIndex.php">Home</a> &gt; Cases</p>
                <form name="addCase" action="../admin/addCase.php" method="POST" style="height: 30px">
                <input type="submit" name="addCase" value="Add Case"  style="width: 80px">
                </form>
			          <table class="hover" id="example" style="width:100%;font-family:Georgia;text-align: center;">
        	        <caption style="text-align: center;color:#000000;font-weight: bold;font-size:18px;">Case List</caption>
          			<tbody>
          				<?php
          				for ($i = 0; $i < count($caseList); $i++)
          				{
          					$sql = "SELECT * FROM spectrum_case WHERE caseID='$caseList[$i]';";
          					$result = mysqli_query($conn, $sql);
          					$resultCheck = mysqli_num_rows($result);
          					if ($resultCheck > 0)
          					{
          						while ($row = mysqli_fetch_assoc($result)) 
          						{
          							$caseName = $row["caseName"];								
          						}
          					}
          					echo "<tr><td>".$caseList[$i]."</td>";
          					echo "<td>".$caseName."</td>";
          					echo "<td><a href='./caseDetails.php?caseId=$caseList[$i]'>Case Details</a></td>";
          					echo "<td><a href='./quizDetails.php?caseId=$caseList[$i]'>Questions/Reflection Details</a></td>";
          				}
          				?>
          			</tbody>
          		</table>
	<!-- end contentDivision -->
		  </div>
          <div class="sidebar" style="position: absolute;top:0px;"> <!-- TemplateBeginEditable name="sidebar" -->
            <h4><a class="upLink" href="./adminIndex.php">Home</a></h4>
            <div class="orangeDecorBar" style="width: 200px"></div>
            <a href="./stuInfoDetail.php">User Information</a>
            <h4><a href="./cases.php">Cases</a></h4>
            <a href="./studentDisc.php">Discussions</a>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        var columnDefs = [{
          title: "Case Number"
        }, {
          title: "Case Title"
        },{
          title: "Case Details"
        },{
          title: "Questions/Reflection Details"
        }];

        var myTable;

        myTable = $('#example').DataTable({
          "sPaginationType": "full_numbers",
          // data: dataSet,
          columns: columnDefs,
        });
        
      });
    </script>

</body>
</html>