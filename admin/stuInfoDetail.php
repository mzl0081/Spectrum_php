<?php
session_start();
include_once '../data/db-conn.php';
?>
<!-- // $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// if(isset($_POST['update']))
// {
// 	$username = mysqli_real_escape_string($conn, $_POST['username']);
// 	$userRealName = mysqli_real_escape_string($conn, $_POST['userRealName']);
// 	$email = mysqli_real_escape_string($conn, $_POST['email']);
// 	$password = mysqli_real_escape_string($conn, $_POST['password']);
// 	$uid = $_SESSION["uid"];

// 	$sql = "UPDATE spectrum_users SET userAccount='$username', userPassword='$password', userEmail='$email', userDisplayName='$userRealName' WHERE userID='$uid';";
// 	mysqli_query($conn, $sql);
// 	header("Location: ./stuInfoDetail.php?stu=$username");

// }
// else
// {
// 	if(isset($_POST['edit']))
// 	{
// 		$getUname = explode("?", $actual_link);
// 		$username = explode("=", $getUname[1])[1];
// 		//print_r($username);
// 	}
// 	else
// 	{
// 		$getUname = explode("=", $actual_link);
// 		$username = $getUname[1];
// 	} -->

<!-- 	$sql = "SELECT * FROM spectrum_users;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$_SESSION["uid"] = $row["userID"];
			$email = $row["userEmail"];
			$password = $row["userPassword"];
			$userRealName = $row["userDisplayName"];
		}
	}
}
?> -->

<!DOCTYPE html>
<html lang="en-us">
<head>
	<title>Student Info</title>
	<link rel="stylesheet" href="https://www.auburn.edu/template/styles/stretchSidebar.css" media="screen" type="text/css" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/select/1.1.2/css/select.dataTables.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.0.2/css/responsive.dataTables.min.css"/>

      <style>
        table.dataTable tbody>tr.selected,
        table.dataTable tbody>tr>.selected {
          background-color: #A2D3F6;
        }
      </style>
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
            	<td style="font-style:italic;width:150;text-align:right;font-size:14px; color:#FFFFFF;">Hello Administrator!</td>
            	<td style="font-style:inherit;text-align:middle;font-size:14px;"><a href="../logout.php">Logout</a></td>
    		</table>
    	</div>

   		 <div id="contentArea">
      		<div class="contentDivision">
      			<p class="breadcrumb"><a href="./adminIndex.php">Home</a> &gt; User Information</p>
      			<table class="hover" id="example" style="width:100%;font-family:Georgia;text-align: center">
      				<caption style="text-align: center;color:#000000;font-weight: bold;font-size:18px;">User Information</caption>
      				<tbody>
					<?php

					// if(isset($_POST['edit']))
					// {
					// 	echo "<form action='./stuInfoDetail.php?stu=$username?update' method='POST'><tr>";
					// 	echo "<td><input type='text' name='username' value='".$username."'></td>";
					// 	echo "<td><input type='text' name='userRealName' value='".$userRealName."'></td>";
					// 	echo "<td><input type='text' name='email' value='".$email."'></td>";
					// 	echo "<td><input type='text' name='password' value='".$password."'></td>";
					// 	echo "<td>Progress</td>";
					// 	echo "<td><input type='submit' name='update' value='Update'></td>";
					// 	echo "</tr></form>";
					// }
					// else
					// {
					// 	echo "<tr>";
					// 	echo "<td>".$username."</td>";
					// 	echo "<td>".$userRealName."</td>";
					// 	echo "<td>".$email."</td>";
					// 	echo "<td>".$password."</td>";
					// 	echo "<td>Progress</td>";
					// 	echo "<td><form action='./stuInfoDetail.php?stu=$username?edit' method='POST'>"."<input type='submit' name='edit' value='Edit'>"."</form></td>";
					// 	echo "</tr>";

					// }
					$sql = "SELECT * FROM spectrum_users;";
					$result = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);

					if ($resultCheck > 0)
					{
						while ($row = mysqli_fetch_assoc($result)) {
							$username = $row["userAccount"];
							$userRealName = $row["userDisplayName"];
							$email = $row["userEmail"];
							$password = $row["userPassword"];

							print <<<EOT
							<tr>
								<td>$username</td>
								<td>$userRealName</td>
								<td>$email</td>
								<td>$password[0]*****</td>
							</tr>
EOT;
						}
					}
					?>
					</tbody>
      			</table>
   		 	</div>
          <div class="sidebar" style="position: absolute;top:0px;"> <!-- TemplateBeginEditable name="sidebar" -->
            <h4><a class="upLink" href="./adminIndex.php">Home</a></h4>
            <div class="orangeDecorBar" style="width: 200px"></div>
            <h4><a href="./stuInfoDetail.php">User Information</a></h4>
            <a href="./cases.php">Cases</a>
            <a href="./studentDisc.php">Discussions</a>
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
  	</div>

  	<script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="DataTables_altEditor.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.0.2/js/dataTables.responsive.min.js"></script>

    <script>
      $(document).ready(function() {

        // var dataSet = [];
        var columnDefs = [{
          title: "User Account"
        }, {
          title: "User Name"
        }, {
          title: "Email"
        }, {
          title: "Password"
        }];

        var myTable;

        myTable = $('#example').DataTable({
          "sPaginationType": "full_numbers",
          // data: dataSet,
          columns: columnDefs,
          dom: 'Bfrtip',        // Needs button container
          select: 'single',
          responsive: true,
          altEditor: true,     // Enable altEditor
          buttons: [{
            text: 'Add',
            name: 'add'        // do not change name
          },
          {
            extend: 'selected', // Bind to Selected row
            text: 'Edit',
            name: 'edit'        // do not change name
          },
          {
            extend: 'selected', // Bind to Selected row
            text: 'Delete',
            name: 'delete'      // do not change name
         }]

        });

      });
			</script>

			<script>
      $(document).on('click', '#addRowBtn', function(){

        //var user_account = document.getElementById('User Account').value;
        var user_name = document.getElementById('User Name').value;
        var user_email = document.getElementById('Email').value;
        var user_pwd = document.getElementById('Password').value;
				var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;


        $.ajax({
          url:"../data/db-amdinInsertStuInfo.php",
          method:"POST",
          data:{user_account:user_account, user_name:user_name, user_email:user_email, user_pwd:user_pwd},

          success:function(response)
          {
						if (response != "Success! This record has been added.")
						{
							alert(response);
						}
						else
						{
							$('#addAlert').html('<strong>'+response+'</strong>');
						}
          }

        })

      });

    </script>
		<script>
		$(document).on('click', '#editRowBtn', function(){

			var user_account = document.getElementById('User Account').value;
			var user_name = document.getElementById('User Name').value;
			var user_email = document.getElementById('Email').value;
			var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;


			$.ajax({
				url:"../data/db-adminEditStuInfo.php",
				method:"POST",
				data:{user_account:user_account, user_name:user_name, user_email:user_email},

				success:function(response)
				{
					if (response != "Success! This record has been updated.")
					{
						alert(response);
					}
					else
					{
						$('#addAlert').html('<strong>'+response+'</strong>');
					}
				}

			})

		});
		</script>

		<script>
		$(document).on('click', '#deleteRowBtn', function(){

			var user_account = document.getElementById('User Account').value;

			$.ajax({
				url:"../data/db-adminDelStuInfo.php",
				method:"POST",
				data:{user_account:user_account},

				// success:function(response)
				// {
				// 	$('#addAlert').html('<strong>'+response+'</strong>');
				// }

			})

		});
		</script>



</body>
</html>
