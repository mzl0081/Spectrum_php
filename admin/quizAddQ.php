<?php
include_once '../data/db-conn.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getCaseId = explode("=", $actual_link);
$caseId = $getCaseId[1];

?>


<!DOCTYPE html>
<html>
<head>
  <title>adminIndex</title>
</head>
<body>
  <h1><a href="./adminIndex.php">Admin Index</a></h1>
  <h2><a href="./cases.php">Cases</a></h2>
  <h1>
    <?php
    echo "Case Number: ".$caseId;
    ?>
  </h1>


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
               <a href="#" id="addInput" onclick="addFields()">Add Inputs</a>
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
    container1.appendChild(document.createTextNode("Option " + (i+1)));
    // Create an <input> element, set its type and name attributes
    var input1 = document.createElement("input");
    input1.type = "text";
    input1.name = "opt" + (i+1);
    input1.style.width = "400px";
    container2.appendChild(input1);
    // Append a line break 
    container1.appendChild(document.createElement("br"));
    container2.appendChild(document.createElement("br"));

    container3.appendChild(document.createTextNode("correct"));
    container4.appendChild(document.createTextNode("wrong"));
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

    container3.appendChild(input2);
    container4.appendChild(input3);
    // Append a line break 
    container3.appendChild(document.createElement("br"));
    container4.appendChild(document.createElement("br"));


  }


}
</script>