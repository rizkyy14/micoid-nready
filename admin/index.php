<?php
    // session start
    if(!empty($_SESSION)){ }else{ session_start(); }
    require 'proses/panggil.php';
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Data Order</title>
		<!-- BOOTSTRAP 4-->
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/gallery/css/lightgallery.min.css">
        <!-- DATATABLES BS 4-->
        <link rel="stylesheet" href="assets/datatables/css/dataTables.bootstrap5.min.css" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="assets/fonts/css/all.min.css">

        <!-- jQuery -->
        <script type="text/javascript" src="assets/jquery/jquery.min.js"></script>
        <!-- DATATABLES BS 4-->
        <script src="assets/datatables/js/jquery.dataTables.min.js"></script>
        <!-- BOOTSTRAP 4-->
        <script src="assets/datatables/js/dataTables.bootstrap5.min.js"></script>

	</head>
    <body style="background:#586df5;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">

                    <?php if(!empty($_SESSION['ADMIN'])){?>
                    <br/>
                    <span style="color:#fff">Selamat Datang, <?php echo $sesi['nama_pengguna'];?></span>
                    <br/><br/>
                    <div class="w-100 mb-2 mt-3 d-flex justify-content-between">
                        <div class="d-flex gap-2">
                            <a href="tambah.php?role=user" class="btn btn-success btn-sm shadow-md"><span class="fa fa-plus"></span> Tambah user</a>
                            <a href="datamenu.php" class="btn btn-warning btn-sm shadow-md"><span class="fa fa-plus"></span> Data Menu</a>
                        </div>
                        <a href="logout.php" class="btn btn-danger btn-sm float-right"><span class="fa fa-sign-out"></span> Logout</a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Order</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="mytable" style="margin-top: 10px">
                                    <thead>
                                        <tr>
                                            <th width="50px">Id Order</th>
                                            <th>Nama Customer</th>
                                            <th>Address</th>
                                            <th>No HP</th>
                                            <th>Total</th>
                                            <th>Tanggal</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $no=1;
                                        $hasil = $proses->tampil_data('pesanan');
                                        foreach($hasil as $isi){
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $isi['id_order']?></td>
                                            <td><?php echo $isi['namacust']?></td>
                                            <td><?php echo $isi['address'];?></td>
                                            <td><?php echo $isi['nohp'];?></td>
                                            <td>Rp<?php echo $isi['total'];?></td>
                                            <td><?php echo $isi['tanggalOrder'];?></td>
                                            <td class="text-center">
                                                <a href="detail.php" class="btn btn-primary btn-sm">
                                                <span class="fa fa-file"></span></a>
                                                <a onclick="return confirm('Apakah yakin data akan di hapus?')" href="proses/crud.php?aksi=hapus&hapusid=<?php echo $isi['kode_menu'];?>" 
                                                class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                                 <a href="print.php?id=<?php echo $isi['id_order'];?>" class="btn btn-warning btn-sm" target="_blank">
    <span class="fa fa-print"></span>
</a>

                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php }else{?>
                        <br/>
                        <div class="alert alert-info">
                            <h3> Maaf Anda Belum Dapat Akses CRUD, Silahkan Login Terlebih Dahulu !</h3>
                            <hr/>
                            <p><a href="login.php">Login Disini</a></p>
                        </div>
                    <?php }?>
			    </div>
			</div>
		</div>
        <script src="assets/gallery/js/lightgallery.min.js"></script>
        <script>
            lightGallery(document.getElementById('lightgallery'));
        </script>
        <script>
            $('#mytable').dataTable();
        </script>
        
	</body>
</html>
