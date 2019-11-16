<?php 
require_once("proses.php");
 ?>

 <html>
<head>
	<title>DETAIL DONASI</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="card-deck" style="width : 50%; margin: 0 auto; float: none; margin-bottom: 10px;">
		<?php 
		 $id	= $_GET['id'];
		 $SQL 	= "SELECT * from tbl_donasi where id_donasi=$id";
		 $query = mysqli_query($con, $SQL);
		 while ($record=mysqli_fetch_array($query)) {
		 	echo '
	         <div class="card" style="margin-bottom: 5%">
	         <img class="card-img-top" src="data:image;base64,' . $record['gambar_donasi'] . '">
	         <div class="card-body">
			    <h5 class="card-title"> '. $record['jenis_donasi'].' </h5>
			    <p class="card-text">'.$record['alamat_donasi'].'</p>
		  	</div>
		  	</div>
			 ';
		  	}
		  	?>
	</div> 
</body>
</html>
