<?php

//Change the working directory to this file.
chdir(_DIR_);
set_include_path (_DIR_);

if ($_SERVER['REQUEST_METHOD'] == 'POST'
&& stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== false ) {
  $_POST = json_decode(file_get_contents('php://input'), true);
}

require 'environment.php';

// TODO: Require object files
require 'models/Work.php';
