<?php

class Work
{
  public $id;
  public $start_date;
  public $end_date;

  public function _construct($row) {
    $this->id = $row['id'];

    $this->start_date = $row['start_date'];
    $this->end_date = $row['end_date'];

    //TODO: Where shuld this be calculated? $this->hours = 0;
  }

  public static function getWorkByTask(int $taskId) {
    //1. Connect to the database
    //2. Run a query
    //3. Read the results
    //4. For each row, make a new work object
    //5. Return the array of work objects
    return [];
  }
}
