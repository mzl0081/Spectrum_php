<?php
session_start();
include_once '../data/db-conn.php';

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getChapId = explode("=", $actual_link);
if (count($getChapId) <= 1)
{
    $chapterNow = 1;
}
else
{
    $chapterNow = end($getChapId);
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Spectrum Educational tool Case Select
    </title>
    <link rel="stylesheet" href="http://www.auburn.edu/template/styles/stretchSidebar.css" media="screen" type="text/css" />
    <!--#include virtual="/template/includes/head.html" -->
    <!-- TemplateBeginEditable name="head" -->
    <!-- TemplateEndEditable -->
    <script type="text/JavaScript">

    function imageOut(caseId)
    { //v3.0
        var id = caseId;
        var img = document.getElementById('caseImg'+id);
        var outImg = document.getElementById('outImg'+id);
        //var thisCaseId = img.value;

        //document.getElementById("demo").innerHTML = outImg.src;
        img.src = outImg.src;
        img.style.width = "280px";
        img.style.height = "170px";
        img.style.border = "3px";
    }


    function imageOver(caseId)
    { //v3.0
        var id = caseId;
        var img = document.getElementById('caseImg'+id);
        var overImg = document.getElementById('overImg'+id);
        img.src = overImg.src;
        img.style.width = "280px";
        img.style.height = "170px";
        img.style.border = "3px";

    }
//
    </script>
    <style type="text/css">

        .STYLE1 {
            color: #000000;
            font-size: 20px;
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
                <td style="font-style:italic;width:150;text-align:right;font-size:14px; color:#FFFFFF">
                    <?php
                    if (!isset($_SESSION["loginUser"]))
                    {
                        header("Location: ../login.php");
                        exit();
                    }
                    elseif ($_SESSION["loginUser"] == "Administrator")
                    {
                      header("Location: ../admin/adminIndex.php");
                      exit();
                    }
                    else
                    {
                        echo "Welcome back! ".$_SESSION["loginUser"];
                    }
                    ?>
                </td>
                <td style="font-style:inherit;text-align:middle;font-size:14px;"><a href="../logout.php">Logout</a></td>
            </table>
        </div>

        <div id="contentArea">
        	<div class="sidebar">
                <!-- TemplateBeginEditable name="sidebar" -->
                <h4><a class="uplink" href="../home.php" target="_self" title="Home">Home</a></h4>
                <div class="orangeDecorBar" style="width: 200px"></div>
                <?php
                $sql = "SELECT DISTINCT caseChapter FROM spectrum_case ORDER BY caseChapter ASC";
                $chapResult = mysqli_query($conn, $sql);
                $chapResultCheck = mysqli_num_rows($chapResult);
                if ($chapResultCheck > 0)
                {
                    while ($row = mysqli_fetch_assoc($chapResult))
                    {
                        $chapter = $row["caseChapter"];
                        if ($chapterNow == $chapter)
                        {
                            echo '<h4><a href="./caseIndex.php?chapter='.$chapter.'" target="_self" title="Chapter '.$chapter.'">Chapter '.$chapter.'</a></h4>';
                        }
                        else
                        {
                            echo '<a href="./caseIndex.php?chapter='.$chapter.'" target="_self" title="Chapter '.$chapter.'">Chapter '.$chapter.'</a>';
                        }

                    }
                }
                ?>
                <!-- <h4><a href="./caseIndex.php" target="_self" title="Case Select" method="GET">Case Studies</a></h4>
                <a href="" target="_self" title="Chapter 2">Life Cases</a> -->
            </div>
            <div class="contentDivision">
                <p class="breadcrumb"><a href="../home.php">Home</a> &gt;<a href="./caseIndex.php">Case Select</a> &gt;Chapter 1</p>
                <table border="0" cellspacing="70" cellpadding="1">

                    <?php

                    $sql = "SELECT * FROM spectrum_case WHERE caseChapter='$chapterNow';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    $caseList = array();
                    $caseCPList = array();
                    $caseVSList = array();

                    if ($resultCheck > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $caseID = $row["caseID"];
                            $caseCoverPic = $row["caseCoverPic"];
                            $caseVideoScreenshot = $row["caseVideoScreenshot"];
                            array_push($caseList, $caseID);
                            array_push($caseCPList, $caseCoverPic);
                            array_push($caseVSList, $caseVideoScreenshot);
                        }
                    }

                    $colCount = 1;
                    $rowCount = 1;
                    $caseCount = 0;

                    if ((count($caseList) % 3) != 0)
                    {
                        $allRow = floor(count($caseList) / 3) + 1;
                    }
                    else
                    {
                        $allRow = count($caseList) / 3;
                    }

                    $lastRowCase = count($caseList) - ($allRow - 1) * 3;

                    while ($caseCount < count($caseList))
                    {
                        if ($colCount == 1)
                        {
                            echo '<tr>';
                            $colCount++;
                            continue;
                        }

                        if ($colCount == 5)
                        {
                            echo '</tr>';
                            $colCount = 1;

                            if (($rowCount % 2) != 0)
                            {
                                $caseCount = $caseCount - 3;
                            }
                            $rowCount++;
                            continue;
                        }

                        if (($rowCount % 2) != 0)
                        {
                            echo "<td>";
                            echo "<a href=\"./caseStudy.php?caseID=".$caseList[$caseCount]."\" onmouseout=\"imageOut('".$caseList[$caseCount]."')\" onmouseover=\"imageOver('".$caseList[$caseCount]."')\">";
                            echo "<img src='./caseVideoScreenshot/".$caseVSList[$caseCount]."' id='caseImg".$caseList[$caseCount]."' name='caseImg' width='280' height='170' border='3'>";
                            echo "</a>";
                            echo "<img src='./caseVideoScreenshot/".$caseVSList[$caseCount]."' id='outImg".$caseList[$caseCount]."' hidden>";
                            echo "<img src='./caseCoverPic/".$caseCPList[$caseCount]."' id='overImg".$caseList[$caseCount]."' hidden>";
                            echo "</td>";

                            $colCount++;
                            $caseCount++;

                            if ($caseCount == count($caseList))
                            {
                                echo '</tr>';
                                $caseCount = $caseCount - $lastRowCase;
                                $colCount = 1;
                                $rowCount++;
                                continue;
                            }
                        }
                        else
                        {
                            echo '<td><div align="center" class="STYLE1">Case '.($caseCount+1).'</div></td>';
                            $colCount++;
                            $caseCount++;

                            if ($caseCount == count($caseList))
                            {
                                echo '</tr>';
                                $colCount = 1;
                                break;
                            }
                        }
                    }


                    ?>

                </table>
<!--                 <p class="breadcrumb">
                    <br>
                </p>
                <table></table> -->
            </div>
      <!-- end contentArea       -->
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
        <!--end pageWrap -->
    </div>
</body>
</html>
