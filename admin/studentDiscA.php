<?php
session_start();
include_once '../data/db-conn.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getUId = explode("=", $actual_link);
$userId = $getUId[1];

$sql = "SELECT * FROM spectrum_topic_reply WHERE userID='$userId';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

$allQuesIdList = array();
$quesIdList = array();
$quesList = array();

if ($resultCheck > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$quesId = $row["topicID"];
		array_push($allQuesIdList, $quesId);
	}
}

sort($allQuesIdList);
$getQId = array_count_values($allQuesIdList);
foreach ($getQId as $x => $x_value) 
{
	array_push($quesIdList, $x);
}


for ($i = 0; $i < count($quesIdList); $i++)
{
	$sql = "SELECT * FROM spectrum_topics WHERE topicID='$quesIdList[$i]';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$quesName = $row["topicTitle"];
			array_push($quesList, $quesName);
		}
		
	}
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Spectrum Educational tool</title>
	<link rel="stylesheet" href="https://www.auburn.edu/template/styles/stretchSidebar.css" media="screen" type="text/css" />
<!-- 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>  -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
</head>
<body>
<!-- 	<h1><a href="./adminIndex.php">Admin Index</a></h1>
	<h2><a href="./studentDisc.php">Discussion</a></h2> -->
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
          <p class="breadcrumb"><a href="./studentDisc.php">Discussions</a> &gt; Replied Topics</p> 
			<table class="hover" id="example" style="width:100%;font-family:Georgia;text-align: center;">
					<caption style="text-align: center;color:#000000;font-weight: bold;font-size:18px;">Replied Topic List</caption>
					<tbody>
						<?php
						for ($i = 0; $i < count($quesIdList); $i++)
						{
							echo "<tr>";
							echo "<td>".$quesList[$i]."</td>";
							echo "<td><a href='studentADetails.php?quesId=$quesIdList[$i]&stuId=$userId'>See Details</a></td>";
							echo "</tr>";
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
        <a href="./cases.php">Cases</a>
        <h4><a href="./studentDisc.php">Discussions</a></h4>
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
 	 <!--#include virtual="/template/includes/gatc.html" --> 
 	 <!-- end pagewrap -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
  var columnDefs = [{
    title: "Topic Title"
  }, {
    title: "Replies"
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