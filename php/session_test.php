<?php 
session_start();

if (time() < $_SESSION['endLoginExpiration'] ) {
	echo $_SESSION['username'];
	echo "<br>".$_SESSION['startLoginExpiration'];
	echo "<br>".$_SESSION['endLoginExpiration'];
	echo "<br>".time();
	# code...
}else
{
	session_destroy();
	echo $_SESSION['username'];
	echo "<br>".$_SESSION['startLoginExpiration'];
	echo "<br>".$_SESSION['endLoginExpiration'];
	echo "<br>".time();
}




 ?>