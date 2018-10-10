<?php

//Change the working directory to this file
chdir(__DIR__);
set_include_path (__DIR__);

require 'environment.php';

/**MODELS **/
require 'models/Project.php';
require 'models/Task.php';
require 'models/Team.php';
require 'models/Work.php';
require 'models/WorkHoursReport.php';
