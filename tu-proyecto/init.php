<?php

if(!file_exists('config.php')){
  die('ERROR: No existe config.php');
}

session_start();

require('config.php');

$app_db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT);
if($app_db == false) {
  die('Error al conectar con la base de datos');
}

require('inc/posts.php');
require('inc/helpers.php');

if(isset($_GET['logout'])) {
  logout();
}