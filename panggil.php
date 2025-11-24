<?php
// pastikan cuma di-include sekali
require_once 'admin/proses/koneksi.php';
require_once 'prosesUser.php';

$db = new Koneksi();
$koneksi = $db->DBConnect();   // ini PDO
$proses = new prosesUser($koneksi);

?>
