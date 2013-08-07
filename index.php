<?php
ob_start(); 
require 'libs/loader.php'; 
error_reporting(E_ALL);
$app = new Bootstrap(); 
$app->init();
$app->loadController();
$app->loadModel();
ob_flush(); 
?>