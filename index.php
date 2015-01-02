<?php
session_start();
error_reporting(E_ALL);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors',1);
require 'app/libs/Session.php';
require 'app/config/config.php';
require 'app/libs/mainFunctions.php';
require 'app/libs/Controller.php';
require 'app/libs/Lang.php';
require 'app/libs/App.php';
// run the Application
$app = new App();