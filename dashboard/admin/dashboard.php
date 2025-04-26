<?php  
$date = date('d-m-Y');

$total_bayar = mysqli_query($kon, "SELECT SUM(totbar_transaksi) AS totbar FROM tb_transaksi WHERE aTanggal_transaksi = '$date' ");
$total = mysqli_fetch_assoc($total_bayar);
$sudahbayar = mysqli_query($kon, "SELECT COUNT(*) AS sudah_bayar FROM tb_pelanggan WHERE status_order = '1' AND aTanggal_order = '$date' ");
$sudah = mysqli_fetch_assoc($sudahbayar);
$belumbayar = mysqli_query($kon, "SELECT COUNT(*) AS belum_bayar FROM tb_pelanggan WHERE status_order = '0' AND aTanggal_order = '$date' ");
$belum = mysqli_fetch_assoc($belumbayar);
$jumlahmakanan = mysqli_query($kon, "SELECT COUNT(*) AS makanan FROM tb_menu ");
$makanan = mysqli_fetch_assoc($jumlahmakanan);
$jumlahpelanggan = mysqli_query($kon, "SELECT COUNT(*) AS pelanggan FROM tb_user WHERE id_level='5' ");
$pelanggan = mysqli_fetch_assoc($jumlahpelanggan);
$jumlahwaiter = mysqli_query($kon, "SELECT COUNT(*) AS waiter FROM tb_user WHERE id_level='2' ");
$waiter = mysqli_fetch_assoc($jumlahwaiter);
$jumlahkasir = mysqli_query($kon, "SELECT COUNT(*) AS kasir FROM tb_user WHERE id_level='3' ");
$kasir = mysqli_fetch_assoc($jumlahkasir);
?>

<!-- Tambahkan ini di dalam <head> jika belum -->
<style>
  body {
    background-color: #0d1117;
    color: #e6edf3;
    font-family: 'Segoe UI', sans-serif;
  }
  .card {
    background-color: #161b22;
    border: 1px solid #30363d;
    border-radius: 12px;
    transition: all 0.3s ease;
  }
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.2);
  }
  .card h6, .card p {
    color: #c9d1d9;
  }
  .icon-box {
    width: 50px;
    height: 50px;
    background: #21262d;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
  }
  .btn-light {
    background-color: #f0f6fc;
    color: #0d1117;
    border: none;
  }
  .btn-light:hover {
    background-color: #d2dae2;
  }
  .alert {
    border-radius: 10px;
  }
</style>

<div class="container mt-4">
  <div class="alert bg-dark text-light shadow-sm">
    Selamat datang, <strong><?= $_SESSION['nama_user'] ?></strong>! Anda login sebagai <strong><?= $_SESSION['level'] ?></strong>.
  </div>

  <div class="row g-4">

    <!-- Total Pendapatan -->
    <div class="col-md-6">
      <div class="card p-4 d-flex align-items-center">
        <div class="d-flex align-items-center">
          <div class="icon-box text-warning"><i class="fa fa-coins fa-lg"></i></div>
          <div>
            <h6>Total Pendapatan Hari Ini</h6>
            <p class="mb-0">Rp <?= rupiah($total['totbar']) ?> <small>(<?= $date ?>)</small></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Status Transaksi -->
    <div class="col-md-6">
      <div class="card p-4 d-flex align-items-center">
        <div class="d-flex align-items-center">
          <div class="icon-box text-success"><i class="fa fa-money-check-alt fa-lg"></i></div>
          <div>
            <h6>Status Transaksi Hari Ini</h6>
            <p class="mb-0"><?= $sudah['sudah_bayar'] ?> Sudah bayar, <?= $belum['belum_bayar'] ?> Belum bayar</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Informasi Role dan Menu -->
    <div class="col-md-3 col-sm-6">
      <div class="card text-center p-3">
        <i class="fa fa-utensils fa-2x text-warning mb-2"></i>
        <h6>Total Menu</h6>
        <p class="mb-0"><?= $makanan['makanan'] ?> item</p>
      </div>
    </div>

    <div class="col-md-3 col-sm-6">
      <div class="card text-center p-3">
        <i class="fa fa-user-tie fa-2x text-info mb-2"></i>
        <h6>Jumlah Waiter</h6>
        <p class="mb-0"><?= $waiter['waiter'] ?></p>
      </div>
    </div>

    <div class="col-md-3 col-sm-6">
      <div class="card text-center p-3">
        <i class="fa fa-cash-register fa-2x text-success mb-2"></i>
        <h6>Jumlah Kasir</h6>
        <p class="mb-0"><?= $kasir['kasir'] ?></p>
      </div>
    </div>

    <div class="col-md-3 col-sm-6">
      <div class="card text-center p-3">
        <i class="fa fa-users fa-2x text-light mb-2"></i>
        <h6>Total Pelanggan</h6>
        <p class="mb-0"><?= $pelanggan['pelanggan'] ?></p>
      </div>
    </div>

    <!-- Laporan Transaksi -->
    <div class="col-md-3">
      <div class="card bg-danger text-light text-center p-3">
        <i class="fa fa-file-alt fa-2x mb-2"></i>
        <h6>Laporan Transaksi</h6>
        <a href="index.php?laporan" class="btn btn-light btn-sm mt-2">
          <i class="fa fa-eye"></i> Lihat Laporan
        </a>
      </div>
    </div>
  </div>
</div>
