<?php
    // session start
    if(!empty($_SESSION)){ }else{ session_start(); }
    //session
	if(!empty($_SESSION['ADMIN'])){ }else{ header('location:login.php'); }
    // panggil file
    require 'proses/panggil.php';
	if (empty($_GET["role"])) {
		header("Location: index.php"); die();
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title><?= ($_GET["role"] == "user") ? "Tambah User" : "Tambah Menu" ?></title>
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
			<br/><br/>
			<div class="row mb-5">
				<div class="col-sm-3"></div>
				<div class="col-lg-6">
					<br/>
					<?php 
					if ($_GET["role"] == "user") {
						?>
						<div class="card">
							<div class="card-header text-center">
							<h4 class="card-title">Tambah User</h4>
							</div>
							<div class="card-body">
								<form action="proses/crud.php?aksi=tambah_user" method="POST">
									<div class="form-group mb-3">
										<label>Nama </label>
										<input type="text" value="" class="form-control" name="nama" required>
									</div>
									<div class="form-group mb-3">
										<label>Telepon</label>
										<input type="number" value="" class="form-control" name="telepon" required>
									</div>
									<div class="form-group mb-3">
										<label>Email</label>
										<input type="email" value="" class="form-control" name="email" required>
									</div>
									<div class="form-group mb-3">
										<label>Alamat</label>
										<textarea name="alamat" class="form-control" required></textarea>
									</div>
									<div class="form-group mb-3">
										<label>Username</label>
										<input type="text" value="" class="form-control" name="user" required>
									</div>
									<div class="form-group mb-3">
										<label>Password</label>
										<input type="password" value="" class="form-control" name="pass" required>
									</div>
									<button class="btn btn-primary btn-md" name="create"><i class="fa fa-plus"> </i> Tambah User</button>
								</form>
							</div>
						</div>
						<?php
					} else if ($_GET["role"] == "menu") {
						?>
						<div class="card">
							<div class="card-header text-center">
							<h4 class="card-title">Tambah Menu</h4>
							</div>
							<div class="card-body">
								<form action="proses/crud.php?aksi=tambah_menu" method="POST" enctype="multipart/form-data">
									<div class="form-group mb-3">
										<label>Kode Menu</label>
										<input type="text" value="" class="form-control" name="kode_menu" placeholder="ex: M-1" required>
									</div>
									<div class="form-group mb-3">
										<label>Nama Menu</label>
										<input type="text" value="" class="form-control" name="nama_menu" placeholder="ex: Buritto" required>
									</div>
									<div class="form-group mb-3">
										<label>Deskripsi</label>
										<input type="text" value="" class="form-control" name="deskripsi" placeholder="ex: Kuliner Mexico dengan perpaduan rempah rempah" required>
									</div>
									<div class="form-group mb-3">
										<label>Harga</label>
										<input type="number" value="" class="form-control" name="harga" placeholder="ex: 500000" required>
									</div>
									<div class="form-group mb-3">
										<label>Gambar</label>
										<input type="file" class="form-control" name="gambar" required>
									</div>
									<button class="btn btn-primary btn-md" name="create"><i class="fa fa-plus"> </i> Tambah Menu</button>
								</form>
							</div>
						</div>
					<?php
					} else {
						echo "
							<script>location.href = './'</script>
						"; die();
					}
					?>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
		<!-- Modal Bootstrap -->


	</body>
</html>