<?php //documenation for PHP: php.net

require '../../app/commom.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'workPost.php';
  exit;
}

//Get the taskId from URL params
$taskID = intval($_GET['taskID'] ?? 0);

if ($taskID < 1) {
  throw new Exception('Invalid Task ID');
}


//1. Go the the database and fetch all work associated with the $taskID
$workArr = Work::getAllWorkByTask($taskId);

//2. Convert to JSON
$json = json_encode($workArr);

//3. Print
header('Content-Type: application/json');
echo $json;
