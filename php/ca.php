<?php 
require_once("connection.php");
session_start();
echo "<pre>";
print_r($_POST);
echo "</pre>";


echo md5("kepo");
 ?>