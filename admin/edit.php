<?php
    // session start
    if(!empty($_SESSION)){ }else{ session_start(); }
    //session
	if(!empty($_SESSION['ADMIN'])){ }else{ header('location:login.php'); }
    // panggil file
    require 'proses/panggil.php';
    
    // tampilkan form edit
    $idGet = strip_tags($_GET['id']);
    $hasil = $proses->tampil_data_id('data_menu','kode_menu',$idGet);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Edit Menu</title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/fonts/css/all.min.css">
	</head>
    <body style="background:#586df5;">
		<div class="container">
			<br/>
            <span style="color:#fff";>Selamat Datang, <?php echo $sesi['nama_pengguna'];?></span>
			<div class="text-end">	
				<a href="index.php" class="btn btn-success btn-md" style="margin-right:1pc;"><span class="fa fa-home"></span> Kembali</a> 
				<a href="logout.php" class="btn btn-danger btn-md float-right"><span class="fa fa-sign-out"></span> Logout</a>
			</div>		
			<br/>
			<div class="row mb-5">
				<div class="col-sm-3"></div>
				<div class="col-lg-6">
					<br/>
					<div class="card">
							<div class="card-header text-center">
							<h4 class="card-title">Edit Menu</h4>
							</div>
							<div class="card-body">
								<form action="proses/crud.php?aksi=edit" method="POST" enctype="multipart/form-data">
									<div class="form-group mb-3">
										<label>Nama Menu</label>
										<input type="text" class="form-control" value="<?= $hasil["nama_menu"] ?>" name="nama_menu" placeholder="ex: macbook" required>
									</div>
									<div class="form-group mb-3">
										<label>Harga</label>
										<input type="number" value="<?= $hasil["harga"] ?>" class="form-control" name="harga" placeholder="ex: 500000" required>
									</div>

									<div class="form-group mb-3">
										<label>Deskripsi</label>
										<input type="text" value="<?= $hasil["deskripsi"] ?>" class="form-control" name="deskripsi" placeholder="ex: Kuliner....." required>
									</div>
									<div class="form-group mb-3">
										<label>Gambar</label>
										<input type="file" class="form-control" name="gambar">
									</div>
									<input type="hidden" value="<?= $hasil["kode_menu"] ?>" name="kode_menu">
									<button class="btn btn-primary btn-md" name="create"><i class="fa fa-edit"> </i> Edit Menu</button>
								</form>
							</div>
						</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</body>
</html>