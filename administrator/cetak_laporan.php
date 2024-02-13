<?php

require "../koneksi.php";

$title = "Aplikasi Kasir Berlian";
require "header.php";
require "navbar.php";
require "sidebar.php";

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cetak Laporan</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
          <div class="card bg-primary mt-2">
            <div class="card-body">
          <div class="table table-bordered">
            <table style="width: 100%;">
              <thead>
                <tr style="background-color: #f7caca;" class="fw-bold" align="center">
                  <th width="1%">No</th>
                  <th>Nama Produk</th>
                  <th>Jumlah Produk</th>
                  <th width="5%">Subtotal</th>
                  <th>Tanggal Penjualan</th>
                </tr>
              </thead>
            <?php 
            $no = 1;
           if(isset($_POST['Tampilkan'])){
                        $tgl_awal=mysqli_real_escape_string($koneksi,$_POST['awal']);
                        $tgl_akhir=mysqli_real_escape_string($koneksi,$_POST['akhir']);
                        $data = mysqli_query($koneksi,"SELECT * from penjualan inner join detailpenjualan on penjualan.PenjualanID=detailpenjualan.PenjualanID inner join  produk on detailpenjualan.ProdukID=produk.ProdukID WHERE TanggalPenjualan BETWEEN '$tgl_awal' AND '$tgl_akhir'");
                    }
                    else  {
                        $data = mysqli_query($koneksi,"SELECT * from penjualan inner join detailpenjualan on penjualan.PenjualanID=detailpenjualan.PenjualanID inner join  produk on detailpenjualan.ProdukID=produk.ProdukID");
                    }

            while($d = mysqli_fetch_array($data)){
            ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $d['NamaProduk']; ?></td>
              <td><?php echo $d['JumlahProduk']; ?></td>
              <td><?php echo $d['Subtotal']; ?></td>
              <td><?php echo $d['TanggalPenjualan']; ?></td>
            </tr>
            <?php 
            }
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
         
          <script>
            window.print();
          </script>
<?php
include "footer.php";
?>