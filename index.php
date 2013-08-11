<?php
require 'libs/loader.php'; 
ob_start(); 
error_reporting(0);
$app = new Bootstrap(); 
$app->init();
$app->loadController();
$app->loadModel();
ob_flush(); 
?>