<?php  
session_start();
include '../../koneksi.php';
include '../fungsi/rupiah.php';

$laporan = mysqli_query($kon, "SELECT * FROM tb_transaksi ORDER BY id_transaksi DESC");
?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Print Laporan</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-10 mx-auto mt-5">
          <div class="text-center">
            <h3>Laporan Transaksi Penjualan</h3>
            <h5><img src="../assets/image/logo.png" width="50" alt="">Chicken House</h5>
            <p>WA : 089676244639 | Email : aprilio842@gmail.com</p>
          </div>
          <div class="card">
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Id Order</th>
                    <th>Pelanggan</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total</th>
                    <th>Diskon</th>
                    <th>Total (Diskon)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($laporan)) :
                      // Get user
                      $user = ['nama_user' => 'Unknown'];
                      $user_query = mysqli_query($kon, "SELECT * FROM tb_user WHERE id_user = '{$row['id_user']}'");
                      if ($user_query && mysqli_num_rows($user_query) > 0) {
                          $user = mysqli_fetch_assoc($user_query);
                      }

                      // Get order
                      $tgl_transaksi = '-';
                      $order_query = mysqli_query($kon, "SELECT * FROM tb_pelanggan WHERE id_order = '{$row['id_order']}'");
                      if ($order_query && mysqli_num_rows($order_query) > 0) {
                          $oq = mysqli_fetch_assoc($order_query);
                          if (isset($oq['tanggal_order'])) {
                              $timestamp = $oq['tanggal_order'];
                              $tgl_transaksi = is_numeric($timestamp) ? date('d-m-Y H:i', $timestamp) : date('d-m-Y H:i', strtotime($timestamp));
                          }
                      }
                  ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= htmlspecialchars($row['id_order']) ?></td>
                      <td><?= htmlspecialchars($user['nama_user']) ?></td>
                      <td><?= $tgl_transaksi ?></td>
                      <td>Rp. <?= rupiah($row['hartot_transaksi']) ?></td>
                      <td><?= $row['diskon_transaksi'] ?>%</td>
                      <td>Rp. <?= rupiah($row['totbar_transaksi']) ?></td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
      window.print();
    </script>
  </body>
</html>
