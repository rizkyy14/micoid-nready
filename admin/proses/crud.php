<?php
    require 'panggil.php';
    error_reporting(E_ALL);

    // proses tambah
    if(!empty($_GET['aksi'] == 'tambah_user'))
    {
        $nama = strip_tags($_POST['nama']);
        $telepon = strip_tags($_POST['telepon']);
        $email = strip_tags($_POST['email']);
        $alamat = strip_tags($_POST['alamat']);
        $user = strip_tags($_POST['user']);
        $pass = strip_tags($_POST['pass']);
        
        $tabel = 'tbl_user';
        # proses insert
        $data[] = array(
            'username'		=>$user,
            'password'		=>md5($pass),
            'nama_pengguna'	=>$nama,
            'telepon'		=>$telepon,
            'email'			=>$email,
            'alamat'		=>$alamat
        );
        $proses->tambah_data($tabel,$data);
        echo '<script>alert("Tambah Data Berhasil");window.location="../index.php"</script>';
    }

    // proses tambah
    if(!empty($_GET['aksi'] == 'tambah_menu'))
    {
        $kode = uniqid();

        // path gambar
        $fileg = $_FILES["gambar"];
        $names = explode(".", $fileg["name"]);
        $names = $kode.".".end($names);
        $tmp = $fileg["tmp_name"];
        
        // assets post
        $kode = strip_tags($_POST['kode_menu']);
        $nama = strip_tags($_POST['nama_menu']);
        $desc = strip_tags($_POST['deskripsi']);
        $harga = strip_tags($_POST['harga']);
        $dats = date("Y-m-d H:i:s");
        
        $tabel = 'data_menu';
        # proses insert
        $data[] = array(
            'kode_menu'	=>$kode,
            'nama_menu'	=>$nama,
            'deskripsi'		=>$desc,
            'harga'		=>$harga,
            'gambar'		=>"upload/".$names,
            'date'          =>$dats
        );
        if (move_uploaded_file($tmp, "upload/".$names)) {
    $proses->tambah_data($tabel,$data);
    echo '
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Berhasil!</h5>
      </div>
      <div class="modal-body">
        Data berhasil ditambahkan!
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const tambahModal = new bootstrap.Modal(document.getElementById("tambahModal"));
tambahModal.show();
setTimeout(() => {
    tambahModal.hide();
    window.location="../index.php";
}, 2000);
</script>
';
}

    }

    // proses edit
	if(!empty($_GET['aksi'] == 'edit'))
	{
		$fileg = $_FILES["gambar"];
        $names = $fileg["name"];
        $tmp = $fileg["tmp_name"];
        
        // assets post
        $nama = strip_tags($_POST['nama_menu']);
        $desc = strip_tags($_POST['deskripsi']);
        $harga = strip_tags($_POST['harga']);
		$gb = false;
        // jika password tidak diisi
        $data = array(
            'nama_menu'	=>$nama,
            'deskripsi'		=>$desc,
            'harga'     	=>$harga,
        );
        if ($fileg["error"] == 0) {
            $data["gambar"] = "upload/".$names;
            $gb = true;
        }
        
        $tabel = 'data_menu';
        $where = 'kode_menu';
        if ($gb) {
            move_uploaded_file($tmp, "upload/".$names);
        }
        $id = strip_tags($_POST['kode_menu']);
        $proses->edit_data($tabel,$data,$where,$id);
       echo '
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Berhasil!</h5>
      </div>
      <div class="modal-body">
        Data berhasil diedit!
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const editModal = new bootstrap.Modal(document.getElementById("editModal"));
editModal.show();
setTimeout(() => {
    editModal.hide();
    window.location="../datamenu.php";
}, 2000);
</script>
';

    }
    
    // hapus data
    if (!empty($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $tabel = 'data_menu';
    $where = 'kode_menu';
    $id = strip_tags($_GET['hapusid']);
    $proses->hapus_data($tabel, $where, $id);
        echo '
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<div class="modal fade" id="hapusModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Berhasil!</h5>
      </div>
      <div class="modal-body">
        Data berhasil dihapus!
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const hapusModal = new bootstrap.Modal(document.getElementById("hapusModal"));
hapusModal.show();
setTimeout(() => {
    hapusModal.hide();
    window.location="../datamenu.php";
}, 2000);
</script>
';
    }

    // login
    if(!empty($_GET['aksi'] == 'login'))
    {   
        // validasi text untuk filter karakter khusus dengan fungsi strip_tags()
        $user = strip_tags($_POST['user']);
        $pass = strip_tags($_POST['pass']);
        // panggil fungsi proses_login() yang ada di class prosesCrud()
        $result = $proses->proses_login($user,$pass);
        if($result == 'gagal')
        {
            echo "<script>window.location='../login.php?get=gagal';</script>";
        }else{
            // status yang diberikan 
            session_start();
            $_SESSION['ADMIN'] = $result;
            // status yang diberikan 
            echo '
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<div class="modal fade" id="hapusModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Berhasil!</h5>
      </div>
      <div class="modal-body">
        Login Berhasil!
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const hapusModal = new bootstrap.Modal(document.getElementById("hapusModal"));
hapusModal.show();
setTimeout(() => {
    hapusModal.hide();
    window.location="../datamenu.php";
}, 2000);
</script>
';
            
        }
    }
?>