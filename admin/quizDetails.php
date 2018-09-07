<?php
session_start();
include_once '../data/db-conn.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getCaseId = explode("=", $actual_link);
$caseId = $getCaseId[1];

$sql = "SELECT * FROM spectrum_question WHERE caseID='$caseId';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
$quesIdList = array();
$quesList = array();
$quesExpList = array();

if ($resultCheck > 0)
{
  $msg = "yes";
  while($row = mysqli_fetch_assoc($result))
  {
    $quesId = $row["questionID"];
    $quesContent = $row["questionContent"];
    $quesExp = $row["explanation"];

    array_push($quesIdList, $quesId);
    array_push($quesList, $quesContent);
    array_push($quesExpList, $quesExp);
  }
}
else
{
  $msg = "No Questions/Reflection for This Case. Please Create it.";
}


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
        <p class="breadcrumb"><a href="./cases.php">Cases</a> &gt; Quiz</p>
      	<h3><strong>
          <?php
          echo "Case Number: ".$caseId;
          ?>   
        </strong></h3>
      	<form name="admin_quizDetails" action="../data/db-adminQuiz.php" method="POST">
      		<table>
                <tr>
                  <td colspan="5">&nbsp;</td>
                </tr>

                <?php

                if ($msg != "yes")
                {
                  echo '<tr><td colspan="5">'.$msg.'</td></tr>';
                }
                else
                {

                  $optionIdList = array();
                  $optContentList = array();
                  $optCorrectList = array();

                  for ($i = 0; $i < count($quesIdList); $i++)
                  {
                    $sql = "SELECT * FROM spectrum_option WHERE questionID='$quesIdList[$i]';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    unset($optionIdList);
                    $optionIdList = array();
                    unset($optContentList);
                    $optContentList = array();
                    unset($optCorrectList);
                    $optCorrectList = array();

                    if ($resultCheck > 0)
                    {
                      while($row = mysqli_fetch_assoc($result))
                      {
                        $optId = $row["optionID"];
                        $optContent = $row["optionContent"];
                        $optCorrect = $row["isCorrect"];

                        array_push($optionIdList, $optId);
                        array_push($optContentList, $optContent);
                        array_push($optCorrectList, $optCorrect);
                      }
                    }

                    echo '<tr>';
                    echo '<td><a href="#" onclick="quesFields('.$quesIdList[$i].')">Edit</a>&nbsp;&nbsp;';
                    echo '<a href="../data/db-oneQuizDel.php?quesId='.$quesIdList[$i].'" onclick="return confirm(\'Want to delete this question?\');">Delete</a><br>';
                    echo '<a href="#" onclick="addOption('.$quesIdList[$i].')">Add options</a></td>';
                    echo '<td>Question '.($i+1).' : </td>';
                    echo '<td id="quesInput'.$quesIdList[$i].'" colspan="3" >'.$quesList[$i].'</td>';
                    echo '</tr>';
                    echo '<tr><td id="addOpt'.$quesIdList[$i].'" colspan="5">&nbsp;</td></tr>';

                    for ($j = 0; $j < count($optionIdList); $j++)
                    {
                      if ($optCorrectList[$j] == "1")
                      {
                        $isCorrect = "Correct";
                      }
                      else
                      {
                        $isCorrect = "Wrong";
                      }

                      echo '<tr>';
                      echo '<td><a href="#" onclick="optFields('.$optionIdList[$j].')">Edit</a>&nbsp;&nbsp;<a href="../data/db-oneQuizDel.php?optId='.$optionIdList[$j].'" onclick="return confirm(\'Want to delete this option?\');">Delete</a></td>';
                      echo '<td></td>';
                      echo '<td>Option '.($j+1).' : </td>';
                      echo '<td id="optInput'.$optionIdList[$j].'">'.$optContentList[$j].'</td>';
                      echo '<td id="optAnsInput'.$optionIdList[$j].'">'.$isCorrect.'</td>';
                      echo '</tr>';
                      echo '<tr><td colspan="5">&nbsp;</td></tr>';
                    }
                    

                    echo '<tr>';
                    echo '<td><a href="#" onclick="expFields('.$quesIdList[$i].')">Edit</a>&nbsp;&nbsp;<a href="../data/db-oneQuizDel.php?expId='.$quesIdList[$i].'" onclick="return confirm(\'Want to delete this explanation?\');">Delete</a></td>';
                    echo '<td>Explanation :</td>';
                    echo '<td id="expInput'.$quesIdList[$i].'" colspan="3">'.$quesExpList[$i].'</td>';
                    echo '</tr>';
                    echo '<tr><td colspan="5">&nbsp;</td></tr>';

                  }
                }

                ?>

                <tr>
                  <td>
                  	<?php
      	              echo "<input type='hidden' name='thisCaseId' value='$caseId'>";
      	            ?>
                  	<input type="submit" name="add" value="Add Question" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">
                  </td>
                  <td>
      				      <input type="submit" name="edit" value="Edit All" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;">
                  </td>
                  <td>
                    <input type="submit" name="delete" value="Delete All" onMouseOver="this.style.cursor='hand'" style="width:100px; height:30px;" onclick="return confirm('Are you sure you want to delete this record?')">
                  </td>
                  <td colspan="2">&nbsp;</td>
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
function quesFields(quesNum)
{
  var x = document.getElementById("quesInput"+quesNum);
  question = x.innerHTML;
  x.innerHTML = "";

  form = document.createElement("form");
  form.name = "editOneQ";
  form.action = "../data/db-adminOneQuizEdit.php";
  form.method = "POST";
  x.appendChild(form);

  input = document.createElement("input");
  input.type = "text";
  input.name = "quesNewInput";
  input.value = question;
  input.style.width = "600px";
  input.style.marginRight = "30px";
  form.appendChild(input);

  input2 = document.createElement("input");
  input2.type = "hidden";
  input2.name = "updateQuesId";
  input2.value = quesNum;
  form.appendChild(input2);


  button = document.createElement("input");
  button.type = "submit";
  button.name = "updateQ";
  button.value = "Update";
  button.style.width = "100px";
  button.style.height = "30px";
  form.appendChild(button);

}

function optFields(optNum)
{
  var x = document.getElementById("optInput"+optNum);
  var y = document.getElementById("optAnsInput"+optNum);
  option = x.innerHTML;
  optAnswer = y.innerHTML;
  x.innerHTML = "";
  y.innerHTML = "";

  form1 = document.createElement("form");
  form1.name = "editOneOpt";
  form1.action = "../data/db-adminOneQuizEdit.php";
  form1.method = "POST";

  x.appendChild(form1);

  input = document.createElement("input");
  input.type = "text";
  input.name = "optNewInput";
  input.value = option;
  input.style.width = "400px";
  input.style.marginRight = "10px";
  form1.appendChild(input);

  input2 = document.createElement("input");
  input2.type = "hidden";
  input2.name = "updateOptId";
  input2.value = optNum;
  form1.appendChild(input2);

  input3 = document.createElement("input");
  input3.type = "text";
  input3.name = "optNewAnsInput";
  input3.value = optAnswer;
  input3.style.width = "100px";
  input3.style.marginRight = "10px";
  form1.appendChild(document.createTextNode("correct/wrong"));
  form1.appendChild(input3);

  button = document.createElement("input");
  button.type = "submit";
  button.name = "updateO";
  button.value = "Update";
  button.style.width = "100px";
  button.style.height = "30px";
  form1.appendChild(button);

}


function expFields(quesNum)
{
  var x = document.getElementById("expInput"+quesNum);
  explanation = x.innerHTML;
  x.innerHTML = "";

  form = document.createElement("form");
  form.name = "editOneE";
  form.action = "../data/db-adminOneQuizEdit.php";
  form.method = "POST";
  x.appendChild(form);

  input = document.createElement("textarea");
  input.type = "text";
  input.name = "expNewInput";
  input.value = explanation;
  input.style.width = "600px";
  input.style.height = "80px";
  input.style.marginRight = "30px";
  form.appendChild(input);

  input2 = document.createElement("input");
  input2.type = "hidden";
  input2.name = "updateExpId";
  input2.value = quesNum;
  form.appendChild(input2);


  button = document.createElement("input");
  button.type = "submit";
  button.name = "updateE";
  button.value = "Update";
  button.style.width = "100px";
  button.style.height = "30px";
  form.appendChild(button);

}


function addOption(quesNum)
{
  var x = document.getElementById("addOpt"+quesNum);

  form = document.createElement("form");
  form.name = "addOneOpt";
  form.action = "../data/db-quizAddOpt.php";
  form.method = "POST";
  x.appendChild(form);

  input = document.createElement("input");
  input.type = "text";
  input.name = "newOptContent";
  input.style.width = "400px";
  input.style.marginRight = "30px";
  form.appendChild(document.createTextNode("option content:"));
  form.appendChild(input);

  input2 = document.createElement("input");
  input2.type = "hidden";
  input2.name = "addOptQuesId";
  input2.value = quesNum;
  form.appendChild(input2);

  input3 = document.createElement("input");
  input3.type = "text";
  input3.name = "optAns";
  input3.style.width = "100px";
  input3.style.marginRight = "10px";
  form.appendChild(document.createTextNode("correct/wrong:"));
  form.appendChild(input3);


  button = document.createElement("input");
  button.type = "submit";
  button.name = "addNewOpt";
  button.value = "Add Option";
  button.style.width = "100px";
  button.style.height = "30px";
  form.appendChild(button);
}



</script>