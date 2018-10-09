<?php

class team
{
  public $id;
  public $name;
  public $hourly_rate;

  public function __construct($data) {
    $this->id = inval($data['id']);
    $this->name = $data['name'];
    $this->hourly_rate = floatval($data['hourly_rate']);
  }

  public static function fetchAll() {
    //1. Connect to the database
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);

    //2. Prepare query
    $sql = 'SELECT * FROM Teams';
    $statement = $db->prepare($sql);

    //3. Run the results
    $success = $statement->execute;

    //4. Handle the results
    $arr = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      //4a. For each row, make a new work object
      $theItem = new Team($row);
      array_push($arr, $theTeam);
    }

    //5. Return the array of work objects
    return $arr;
  }


}
