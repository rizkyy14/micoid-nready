<?php
class prosesUser {
    private $db; // PDO instance

    public function __construct(PDO $db) {
        $this->db = $db;
        // set error mode PDO
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Tambah pesanan
     * @param array $customerData ['nama', 'alamat', 'nohp', 'total']
     * @param array $items [['kode_menu', 'qty', 'harga'], ...]
     * @return int|false id_order jika berhasil, false jika gagal
     */
    public function tambahPesanan($customerData, $items) {
        try {
            // mulai transaksi
            $this->db->beginTransaction();

            // 1. Insert ke tabel pesanan
            $stmt = $this->db->prepare("
                INSERT INTO pesanan (namacust, address, nohp, total, tanggalOrder) 
                VALUES (:namacust, :address, :nohp, :total, NOW())
            ");
            $stmt->execute([
                ':namacust' => $customerData['namacust'],
                ':address' => $customerData['address'],
                ':nohp' => $customerData['nohp'],
                ':total' => $customerData['total']
            ]);

            $id_order = $this->db->lastInsertId();

            // 2. Insert detail pesanan
            $stmtDetail = $this->db->prepare("
                INSERT INTO detail_pesanan (id_order, kode_menu, qty, harga)
                VALUES (:id_order, :kode_menu, :qty, :harga)
            ");

            foreach ($items as $item) {
                $stmtDetail->execute([
                    ':id_order' => $id_order,
                    ':kode_menu' => $item['kode_menu'],
                    ':qty' => $item['qty'],
                    ':harga' => $item['harga']
                ]);
            }

            // commit transaksi
            $this->db->commit();

            return $id_order;

        } catch (PDOException $e) {
            // rollback jika gagal
            $this->db->rollBack();
            return $e->getMessage();
        }
    }
}
?>
