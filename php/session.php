<?php 
$current = $_SESSION['current'];
$togo = $_SESSION['locationToGO'];
$back = $_SESSION['locationReturn'];


if (isset($_SESSION['username'])) {
	$userModes = $_SESSION['loginType'];
	$now = time();
	if ($now < $_SESSION['endLoginExpiration']) {
		if ($current=="login.php") {
			?>
			<script>
        	window.location = '<?php echo $togo ?>';
        	//alert("Session still active sini");
        	console.log("session still configured.")
   			</script>
   			<?php
		}else if ($current=="signup.php") {
			?>
			<script>
        	window.location = '<?php echo $togo ?>';
        	//alert("Session still active sini");
        	console.log("session still configured.")
   			</script>
   			<?php
		}else if ($current == "input_donasi.php" && $userModes == "mitra") {
			?>
			<script>
        	window.location = 'explore.php';
   			</script>
   			<?php
		}
		else{
			?>
			<script>
       	 	//window.location = '<?php echo $togo ?>';
       	 	//alert("Session still active");

        	console.log("session still configured.")
   			</script>
   			<?php
   			$_SESSION['endLoginExpiration'] = time() + (2 * 60 * 60); 
		}


		//check for input donasi page
		

	}else{
		session_destroy();
		?>
		<script>
        window.location = '<?php echo $back ?>';
        console.log("Session was inactive")
   		</script>
   		<?php
	}
}
else
{
	if($current=="login.php" || $current=="signup.php") {
		?>
		<script>
		//window.location = '<?php echo $back ?>';
        console.log("session not configured.")
   		</script>
   		<?php
	}
	else
	{
		?>
		<script>
		window.location = '<?php echo $back ?>';
        console.log("session not configured.")
   		</script>
   		<?php
	}






	
}

 ?>