<?php
//Other
require 'bootstrap.php';
foreach (glob("libs/config/*.php") as $file) {
  require_once $file;
}
require 'database.php';
require 'error.php';
require 'session.php';
require 'category.php';
require 'user.php';
require 'pass.php';
require 'email.php';
require 'writing.php';
require 'form.php';
require 'points.php';
require 'report.php';
require 'ban.php';
require 'image.php'; 
require 'pagination.php'; 
//Unique to bedmath
require 'question.php';
require 'answer.php';
require 'reputation.php';

//Model Includes 
require 'model.php';

//Controller Includes
require 'controller.php';

//View Includes
require 'view.php';
?>
