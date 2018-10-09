<?php

class Work
{
  public $id;
  public $task_id;
  public $team_id;
  public $start;
  public $stop;
  public $hours;
  public $completion_estimate;

  public function _construct($row) {
    $this->id = intval($row['id']);

    $this->task_id = intval($row['task_id']);
    $this->team_id = intval($row['team_id']);

    $this->start = $row['start_date'];
    $this->hours = floatval($row['hours']);

    //Calculate stop date
    $hours = floor($this->hours);
    $mins = intval(($this->hours - $hours) * 60);
    $interval = 'PT'. ($hours ? $hours. 'H' : '') . ($mins ? $mins. 'M' : '');

    $date = new DateTime($this->start);
    $date->add(new DateInterval($interval));
    $this->stop = $date->format('Y-m-d H:i:s');

    $this->completion_estimate = intval($row['completion_estimate']);
  }

  public static function getWorkByTaskId(int $taskId) {
    //1. Connect to the database
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);

    //2. Prepare query
    $sql = 'SELECT * FROM Work WHERE task_id = ?'; // WHERE date = ? AND ticker = ?';

    $statement = $db->prepare($sql);

    //3. Run the results
    $success = $statement->execute(
        [$taskId]
      );

    //4. Handle the results
    $arr = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      //4a. For each row, make a new work object
      $workItem = new Work($row);

      array_push($arr, $workItem);
    }

    //5. Return the array of work objects
    return $arr;
  }
}
