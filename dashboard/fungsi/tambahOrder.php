<?php
session_start();
require '../../koneksi.php';

// Ambil data dari POST
$meja = htmlspecialchars($_POST['meja']);
$id_order = htmlspecialchars($_POST['id_order']);
$keterangan = htmlspecialchars($_POST['keterangan']);
$user_id = $_SESSION['id_user'];
$tanggal = time(); // Timestamp (tanggal_order)
$tanggal2 = date('d-m-Y'); // Format tanggal (aTanggal_order)

// Validasi input
if ($meja < 1) {
    $_SESSION['pesan'] = '
        <div class="alert alert-warning mb-2 alert-dismissible text-small" role="alert">
            <b>Maaf!</b> Meja belum dipilih.
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    header('Location: ../index.php');
    exit;
}

// Update status pesanan
mysqli_query($kon, "UPDATE tb_pesanan SET status_dorder = 1 WHERE id_order = '$id_order'");

// Update status meja jadi terpakai
mysqli_query($kon, "UPDATE tb_meja SET status = 1 WHERE meja_id = '$meja'");

// Cek apakah id_order sudah ada di tb_pelanggan
$cek = mysqli_query($kon, "SELECT id_order FROM tb_pelanggan WHERE id_order = '$id_order'");

if (mysqli_num_rows($cek) == 0) {
    // Jika belum ada, insert data baru
    $query = mysqli_query($kon, "INSERT INTO tb_pelanggan (
        id_order, meja_order, tanggal_order, aTanggal_order, id_user, keterangan_order, status_order
    ) VALUES (
        '$id_order', '$meja', '$tanggal', '$tanggal2', '$user_id', '$keterangan', 0
    )");
} else {
    // Jika sudah ada, update datanya
    $query = mysqli_query($kon, "UPDATE tb_pelanggan SET 
        meja_order = '$meja', 
        tanggal_order = '$tanggal', 
        aTanggal_order = '$tanggal2', 
        id_user = '$user_id', 
        keterangan_order = '$keterangan', 
        status_order = 0 
        WHERE id_order = '$id_order'");
}

// Pesan notifikasi
if ($query) {
    $_SESSION['pesan'] = '
        <div class="alert alert-success mb-2 alert-dismissible text-small" role="alert">
            <b>Yoi!</b> Pesanan sedang diproses, mohon tunggu sampai masakan datang.
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
} else {
    $_SESSION['pesan'] = '
        <div class="alert alert-danger mb-2 alert-dismissible text-small" role="alert">
            <b>Maaf!</b> Pesanan gagal diproses.
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
}

header('Location: ../index.php');
exit;
?>
