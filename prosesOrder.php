<?php
require_once 'panggil.php'; // pastikan koneksi PDO sudah tersedia di $koneksi

if (isset($_GET['aksi']) && $_GET['aksi'] === 'tambah_order') {
    if (!empty($_POST['items']) && !empty($_POST['namacust']) && !empty($_POST['address']) && !empty($_POST['nohp'])) {

        $customerData = [
            'namacust' => $_POST['namacust'],
            'alamat'   => $_POST['address'],
            'nohp'     => $_POST['nohp']
        ];

        $items = [];
        $total = 0;
        foreach ($_POST['items'] as $item) {
            if (isset($item['kode_menu'], $item['qty'], $item['harga'])) {
                $items[] = [
                    'kode_menu' => $item['kode_menu'],
                    'qty'       => $item['qty'],
                    'harga'     => $item['harga']
                ];
                $total += $item['qty'] * $item['harga'];
            }
        }

        try {
            $koneksi->beginTransaction();

            // Insert pesanan utama
            $stmt = $koneksi->prepare("INSERT INTO pesanan (namacust, address, nohp, total) VALUES (?, ?, ?, ?)");
            $stmt->execute([$customerData['namacust'], $customerData['alamat'], $customerData['nohp'], $total]);
            $id_order = $koneksi->lastInsertId();

            // Insert detail pesanan
            $stmtDetail = $koneksi->prepare("INSERT INTO detail_pesanan (id_order, kode_menu, qty, harga) VALUES (?, ?, ?, ?)");
            foreach ($items as $i) {
                $stmtDetail->execute([$id_order, $i['kode_menu'], $i['qty'], $i['harga']]);
            }

            $koneksi->commit();
            echo '
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Berhasil!</h5>
      </div>
      <div class="modal-body">
        Pesanan berhasil! ID Order: `$id_order`);
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
    window.location.href="index.php";
}, 2000);
</script>
';


        } catch (Exception $e) {
            $koneksi->rollBack();
            echo "Terjadi error: " . $e->getMessage();
        }

    } else {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        exit;
    }
} else {
    echo "Aksi tidak valid!";
}
