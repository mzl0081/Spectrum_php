<?php

include_once '../data/db-conn.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getQuesId = explode("=", $actual_link);
$quesId = $getQuesId[1];

