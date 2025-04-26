<div class="container mt-5 mb-5 px-3">
  <style>
    .card {
      border: none;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      transition: 0.3s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .card:hover {
      transform: translateY(-4px);
    }

    .card-img-top {
      height: 180px;
      object-fit: cover;
    }

    .card-body {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card-title {
      font-size: 1.2rem;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .card-text {
      margin-bottom: 10px;
    }

    .btn-block {
      border-radius: 8px;
    }

    h3.section-title {
      color: #ffffff;
      font-weight: 600;
      margin: 40px 0 20px;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    .badge {
      font-size: 0.8rem;
    }

    .modal-content {
      border-radius: 12px;
    }
  </style>

  <?php if (isset($_SESSION['pesan'])) : ?> 
    <?= $_SESSION['pesan'] ?>
    <?php unset($_SESSION['pesan']); endif; ?>

  <div class="card mb-4">
    <img src="assets/image/bglogo.png" class="card-img-top" height="180" style="object-fit: cover;">
    <div class="card-body">
      <h3 class="card-title">Selamat Datang di Halaman Utama</h3>
      <p class="card-text">Sistem Kasir Restoran</p>
    </div>
  </div>

  <h3 class="section-title">🍽️ Masakan</h3>
  <div class="row">
    <?php
    $query = "SELECT * FROM tb_menu WHERE kategori_masakan='Makanan' ORDER BY id_masakan LIMIT 7";
    $sql = mysqli_query($kon, $query);
    while($data = mysqli_fetch_array($sql)) :
    ?>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
        <div class="card w-100">
          <img class="card-img-top" src="assets/image/makanan/<?= $data['foto'] ?>" alt="...">
          <div class="card-body">
            <div class="mb-1">
              <?php if ($data['status_masakan']==1): ?>
                <span class="badge badge-success">Tersedia</span>
              <?php else: ?>
                <span class="badge badge-danger">Tidak Tersedia</span>
              <?php endif; ?>
            </div>
            <h4 class="card-title"><?= $data['nama_masakan'] ?></h4>
            <?php
              $harga = $data['harga_masakan'];
              if ($_SESSION['level']=="") {
                $harga += 5000;
              }
            ?>
            <p class="card-text"><strong>Rp. <?= rupiah($harga) ?></strong></p>
            <?php if ($data['status_masakan']==1): ?>
              <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#masakan_<?= $data['id_masakan']; ?>">Beli</button>
            <?php else: ?>
              <a href="#" class="btn btn-primary btn-sm btn-block disabled">Beli</a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="masakan_<?= $data['id_masakan']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <form action="fungsi/orderMakanan.php" method="POST">
              <div class="modal-header">
                <h5 class="modal-title">Tambah ke Keranjang</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/image/makanan/<?= $data['foto'] ?>" alt="" class="card-img-top">
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" name="id_masakan" value="<?= $data['id_masakan'] ?>">
                    <div class="form-group">
                      <label>Menu</label>
                      <input type="text" readonly class="form-control" value="<?= $data['nama_masakan'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Harga</label>
                      <input type="text" readonly class="form-control" value="<?= $data['harga_masakan'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Jumlah Pesanan</label>
                      <input type="number" class="form-control" name="jumlah" value="1" min="1" max="20">
                    </div>
                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea name="keterangan" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <h3 class="section-title">🥤 Minuman</h3>
  <div class="row">
    <?php
    $query2 = "SELECT * FROM tb_menu WHERE kategori_masakan='Minuman' ORDER BY id_masakan";
    $sql2 = mysqli_query($kon, $query2);
    while($data = mysqli_fetch_array($sql2)) :
    ?>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
        <div class="card w-100">
          <img class="card-img-top" src="assets/image/makanan/<?= $data['foto'] ?>" alt="...">
          <div class="card-body">
            <div class="mb-1">
              <?php if ($data['status_masakan']==1): ?>
                <span class="badge badge-success">Tersedia</span>
              <?php else: ?>
                <span class="badge badge-danger">Tidak Tersedia</span>
              <?php endif; ?>
            </div>
            <h4 class="card-title"><?= $data['nama_masakan'] ?></h4>
            <?php
              $hargi = $data['harga_masakan'];
              if ($_SESSION['level']=="") {
                $hargi += 3000;
              }
            ?>
            <p class="card-text"><strong>Rp. <?= rupiah($hargi) ?></strong></p>
            <?php if ($data['status_masakan']==1): ?>
              <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#masakan_<?= $data['id_masakan']; ?>">Beli</button>
            <?php else: ?>
              <a href="#" class="btn btn-primary btn-sm btn-block disabled">Beli</a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="masakan_<?= $data['id_masakan']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <form action="fungsi/orderMakanan.php" method="POST">
              <div class="modal-header">
                <h5 class="modal-title">Tambah ke Keranjang</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/image/makanan/<?= $data['foto'] ?>" alt="" class="card-img-top">
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" name="id_masakan" value="<?= $data['id_masakan'] ?>">
                    <div class="form-group">
                      <label>Menu</label>
                      <input type="text" readonly class="form-control" value="<?= $data['nama_masakan'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Harga</label>
                      <input type="text" readonly class="form-control" value="<?= $data['harga_masakan'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Jumlah Pesanan</label>
                      <input type="number" class="form-control" name="jumlah" value="1" min="1" max="20">
                    </div>
                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea name="keterangan" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>
