<?php
session_start();
include_once '../data/db-conn.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getCaseId = explode("=", $actual_link);
$caseId = $getCaseId[1];

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
            <p class="breadcrumb"><a href="./cases.php">Cases</a> &gt; 
            <?php
            echo '<a href="quizDetails.php?caseId='.$caseId.'">';?>
            Quiz</a> &gt; Add</p>
            <h3><strong>
            <?php
            echo "Case Number: ".$caseId;
            ?>
            </strong></h3>

            <form name="admin_quizAddQ" action="../data/db-adminQuizAdd.php" method="POST">
              <table style="width:1200px; border="0">
                    <tr>
                      <td>
                        <strong>Question: </strong>
                      </td>
                      <td colspan="3">
                        <input type="text" name="question" value="" style="width:400px;">
                      </td>
                    </tr>

                    
                    <tr>
                      <td>
                        <strong>Numbers of Options: </strong>
                      </td>
                      <td colspan="3">
                        <input type="text" id="optionNum" name="optionNum" value="" style="width:400px;">
                      </td>
                    </tr>

                    <tr>
                      <td colspan="4">
                         <a href="#" id="addInput" onclick="addFields()">Add Options</a>
                      </td>
                    </tr>

                     <tr >
                      <td>
                         <div id="container1" />
                      </td>
                      <td>
                         <div id="container2" />
                      </td>
                      <td>
                        <div id="container3" />
                      </td>
                      <td>
                        <div id="container4" />
                      </td>
                    </tr>

                    <tr>
                      <td colspan="4">&nbsp;</td>
                    </tr>

                    <tr>
                      <td>
                        <strong>Explanation: </strong>
                      </td>
                      <td colspan="3">
                        <textarea name="explanation" rows="15" style="width:400px; text-transform:none;"></textarea>
                      </td>
                    </tr>
                   

                    <tr>
                      <td>
                        <?php
                        echo '<input type="hidden" name="thisCaseId" value="'.$caseId.'">';
                        ?>
                        <input type="submit" name="add" value="Add Question">
                      </td>
                      <td colspan="3">
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
</div>

</body>
</html>


<script type='text/javascript'>
function addFields()
{
  // Number of inputs to create
  var optionNum = document.getElementById("optionNum").value;
  // Container <div> where dynamic content will be placed
  var container1 = document.getElementById("container1");
  var container2 = document.getElementById("container2");
  var container3 = document.getElementById("container3");
  var container4 = document.getElementById("container4");
  // Clear previous contents of the container
  while (container1.hasChildNodes()) 
  {
      container1.removeChild(container1.lastChild);
  }

  while (container2.hasChildNodes()) 
  {
      container2.removeChild(container2.lastChild);
  }

  while (container3.hasChildNodes()) 
  {
      container3.removeChild(container3.lastChild);
  }

  while (container4.hasChildNodes()) 
  {
      container4.removeChild(container4.lastChild);
  }

  for (i = 0; i < optionNum; i++)
  {

    //Append a node with a random text
    var para = document.createElement("p");
    para.innerHTML ="Option " + (i+1);
    container1.appendChild(para);
    // Create an <input> element, set its type and name attributes
    var input1 = document.createElement("input");
    input1.type = "text";
    input1.name = "opt" + (i+1);
    input1.style.width = "400px";
    input1.style.height = "18px";
    input1.style.marginBottom = "6.273px";
    container2.appendChild(input1);
    // Append a line break 
    container2.appendChild(document.createElement("br"));

    // Create an <input> element, set its type and name attributes
    var input2 = document.createElement("input");
    input2.type = "radio";
    input2.name = "ans" + (i+1);
    input2.value = "correct";
    input2.style.width = "10px";

    var input3 = document.createElement("input");
    input3.type = "radio";
    input3.name = "ans" + (i+1);
    input3.value = "wrong";
    input3.style.width = "10px";

    var para2 = document.createElement("p");
    para2.innerHTML = "Option " + (i+1) + "  correct";
    para2.appendChild(input2);
    container3.appendChild(para2);

    var para3 = document.createElement("p");
    para3.innerHTML = "wrong";
    para3.appendChild(input3);
    container4.appendChild(para3);
    
    // Append a line break 
    //container3.appendChild(document.createElement("br"));
    //container4.appendChild(document.createElement("br"));


  }


}
</script>