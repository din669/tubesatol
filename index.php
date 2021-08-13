<?php include_once ("functions.php"); ?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">APLIKASI PENDETEKSI TANAMAN</a>
    </div>
	<form action="index.php" method="post" enctype="multipart/form-data">
		
</nav>
<center>
	<h2>Input Gambar</h2>
	<input type="file" name="file" id="file">
	<br>
	<input type="submit" value="Upload" name="submit">
	<?php
			if(isset($_POST["submit"])){
			$file = $_FILES["file"]["name"];
			$tmp_name = $_FILES["file"]["tmp_name"];
			move_uploaded_file($tmp_name, "gambar/".$file);
			
		?>
	
	<div class="text-center">
		<br>
		<img src="gambar/<?= $file?>" class="rounded" alt="gambar tumbuhan" width=200 height=200>
	</div>
	</form>
	<br>
	<h3>Hasil Identifikasi</h3>
	<?php 	
			$hasilCari = identifyPlants(["gambar/".$file]);
			$listCari = $hasilCari["suggestions"];
			?>
			
			<table class="table table-success table-striped align-middle">
			<tr><th>Id</th>
				<th>Nama Tanaman</th>
				<th>Nama Ilmiah</th>
				<th>Keterangan</th>
			</tr>
			<?php	
			foreach ($listCari as $tanaman){
			?>
			<tr>
				<td><?php echo $tanaman["id"]; ?></td>
				<td><?php echo $tanaman["plant_name"]; ?></td>
				<td><?php echo $tanaman["plant_details"]["scientific_name"]; ?></td>
				<td width="1200"><?php  $kalimat = $tanaman["plant_details"]["wiki_description"]["value"];
										$terjemahkan = terjemah(json_encode($kalimat));
										echo $terjemahkan["translatedText"]; ?></td>
			</tr>
			<?php
			}
			}
	?>	

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

