<?php //documenation for PHP: php.net

require '../../app/commom.php';

$taskID = intval($_GET['taskID'] ?? 0);

if ($taskID < 1) {
  throw new Exception('Invalid Task ID');
}


//1. Go the the database and get all work associated with the $taskID
$workArr = Work::getAllWorkByTask($taskId);

//2. Convert to JSON
$json = json_encode($workArr);

//3. Print
echo $json; 
