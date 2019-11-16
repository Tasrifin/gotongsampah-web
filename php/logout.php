<?php 
session_start();
if(isset($_SESSION['username']))
{
	//do
	if(session_destroy())
	{
		?>
		<script>
        window.location = '../index.php';
        alert("Berhasil logout!");
   		</script>
   		<?php
	}
	else
	{
		echo "gagal logout";
	}
}
else
{
	?>
		<script>
        window.location = '../login.php';
        alert("Login terlebih dahulu!");
   		</script>
   		<?php
}


 ?>