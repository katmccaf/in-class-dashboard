<?php

class Work{

  public $work_id;
  public $start_date; //'YYYY-MM-DD'
  public $end_date; //'YYYY-MM-DD'
  public $task_id;
  public $team_id;
  public $hours;

  public function_construct($row) {
      $this->id = $row['id'];

      $this->start_date = $row['start_date'];
      $this->start_date = $row['end_date'];

      // TODO Where should this be calculated? $this->hours = 0;
  }

  public static function getAllWorkBtTask(int $taskId) {
    //1. Connect to the Database
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);
    var_dump($db);

    die;
    
    //2. Prepare SQL statement
    //3. Read the results
    //4. For each row, make a new work object
    //5. Return the array of work object
    return [];
  }

}
