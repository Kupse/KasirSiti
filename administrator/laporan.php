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
            <h1 class="m-0">Laporan</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
<div class="card bg-primary mt-2">
    <div class="card-body">
        <h3>Laporan Penjualan</h3>
    <div class="container mt-3">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="get" name="form10" target="_self">                                                           
        <div class="row">
          <div class="col-lg-3">
            <input name="awal" type="date" class="form-control" value="<?php echo $tgl_awal; ?>" size="10" /> 
          </div>
          <div class="col-lg-3">
           <input name="akhir" type="date" class="form-control" value="<?php echo  $tgl_akhir; ?>" size="10" />
          </div>

          <div class="col-lg-3">            
          <input name="Tampilkan" class="btn btn-success" type="submit" value="Tampilkan" />
          </div>      
        </div>
        </form>
    </div>
    <br>
    <?php
    include '../koneksi.php';
        if(isset($_GET['Tampilkan'])) {
                $tgl_awal=mysqli_real_escape_string($koneksi,$_GET['awal']);
                $tgl_akhir=mysqli_real_escape_string($koneksi,$_GET['akhir']);
                echo"Dari tanggal " .$tgl_awal. " Sampai tanggal ".$tgl_akhir.""; 
            }
    ?>
    <div class="table table-bordered">
        <table style="width: 100%;">
            <thead>
                <tr style="background-color: #f7caca;" class="fw-bold" align="center">
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jumlah beli</th>
            <th>Subtotal</th>
            <th>Tanggal Penjualan</th>
        </tr>
    </thead>
    <?php
     include '../koneksi.php';
            $no = 1;
           if(isset($_GET['Tampilkan'])){
                $tgl_awal=mysqli_real_escape_string($koneksi,$_GET['awal']);
                $tgl_akhir=mysqli_real_escape_string($koneksi,$_GET['akhir']);
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
        <?php }?>
    </table>
</div>
    <br>
    <div class="row">
      <div class="col-lg-3">
        <a href="cetak_laporan.php" class="btn btn-primary">Cetak Laporan</a>
       </div>
    </div> 
</div>
</div>
</section>
<?php
include "footer.php";
?>