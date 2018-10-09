<?php

require '../../app/common.php';


//1. Go to the database and get all work associated with the $taskId
$teams = Team::fetchAll();

//2. Convert to Json
$json = json_encode($teams, JSON_PRETTY_PRINT);

//3. Print
echo $json;
