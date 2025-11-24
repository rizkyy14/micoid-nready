<?php
    // session start
    if(!empty($_SESSION)){ }else{ session_start(); }
    require 'proses/panggil.php';
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Detail Order</title>
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
                            <a href="index.php" class="btn btn-success btn-sm shadow-md"><span class="fa fa-arrow-left"></span> Kembali</a>
                            <a href="datamenu.php" class="btn btn-warning btn-sm shadow-md"><span class="fa fa-plus"></span> Data Menu</a>
                        </div>
                        <a href="logout.php" class="btn btn-danger btn-sm float-right"><span class="fa fa-sign-out"></span> Logout</a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Order</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="mytable" style="margin-top: 10px">
                                    <thead>
                                        <tr>
                                            <th width="50px">Id Order</th>
                                            <th>Kode Menu</th>
                                            <th>QTY</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $no=1;
                                        $hasil = $proses->tampil_data('detail_pesanan');
                                        foreach($hasil as $isi){
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $isi['id_order']?></td>
                                            <td><?php echo $isi['kode_menu']?></td>
                                            <td><?php echo $isi['qty'];?></td>
                                            <td><?php echo $isi['harga'];?></td>

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
