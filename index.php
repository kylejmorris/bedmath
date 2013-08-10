<?php
ob_start(); 
require 'libs/loader.php'; 
error_reporting(0);
$app = new Bootstrap(); 
$app->init();
$app->loadController();
$app->loadModel();
ob_flush(); 
?>