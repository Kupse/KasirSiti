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
            <h1 class="m-0">Transaksi</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="container-fluid">
<div class="card bg-primary mt-2">
	<div class="card-body">
		<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
  			<i class="fas fa-plus"></i> Tambah Data
		</button>
	</div>
	<div class="card-body">
		<?php 
    	if(isset($_GET['pesan'])){
    		if($_GET['pesan']=="simpan"){
    			echo "<div class='alert bg-info' text-dark>Data Berhasil di Simpan</div>";
    		} ?>
    		<?php if($_GET['pesan']=="update"){
    			echo "<div class='alert bg-info' text-dark>Data Berhasil di Update</div>";
    		} ?>
    		<?php if($_GET['pesan']=="hapus"){
    			echo "<div class='alert bg-info' text-dark>Data Berhasil di Hapus</div>";
    		} ?>
    		<?php
    	}
    	?>
	    	<div class="table table-bordered">
				<table style="width: 100%;">
					<thead>
						<tr style="background-color: #f7caca;" class="fw-bold" align="center">
					<th>No</th>
					<th>ID Pelanggan</th>
					<th>Nama Pelanggan</th>
					<th>Alamat</th>
					<th>No. Telp</th>
					<th>Total Pembayaran</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				include '../koneksi.php';
				$no = 1;
				$data = mysqli_query($koneksi,"SELECT*FROM pelanggan INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID");
				while($d = mysqli_fetch_array($data)){
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $d['PelangganID']; ?></td>
						<td><?php echo $d['NamaPelanggan']; ?></td>
						<td><?php echo $d['Alamat']; ?></td>
						<td><?php echo $d['NomorTelepon']; ?></td>
						<td>Rp. <?php echo $d['TotalHarga']; ?></td>
						<td>
							<a class="btn btn-info btn-sm" href="detail_pembelian.php?PelangganID=<?php echo $d['PelangganID']; ?>">Detail</a>
							<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['PelangganID']; ?>"><i class="fas fa-edit"></i>
					  			Edit
							</button>
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['PelangganID']; ?>"><i class="fas fa-trash-alt"></i>
					  			Hapus
							</button>
						</td>
					</tr>
					<!-- Modal Edit Data -->
		<div class="modal fade" id="edit-data<?php echo $d['PelangganID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <form action="proses_update_pembelian.php" method="post">
			      <div class="modal-body">
			        	<div class="form-group">
			        		<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" class="form-control" hidden>
			        	</div>
			        	<div class="form-group">
			        		<label>Nama Pelanggan</label>
			        		<input type="text" name="NamaPelanggan" value="<?php echo $d['NamaPelanggan']; ?>" class="form-control" autocomplete="off">
			        	</div>
			        	<div class="form-group">
			        		<label>Alamat</label>
			        		<input type="text" name="Alamat" value="<?php echo $d['Alamat']; ?>" class="form-control" autocomplete="off">
			        	</div>
			        	<div class="form-group">
			        		<label>No. Telp</label>
			        		<input type="text" name="NomorTelepon" value="<?php echo $d['NomorTelepon']; ?>" class="form-control" autocomplete="off">
			        	</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
			        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
			      </div>
		      </form>
		    </div>
		  </div>
		</div>

		<!-- Modal hapus Data -->
						<div class="modal fade" id="hapus-data<?php echo $d['PelangganID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <form method="post" action="proses_hapus_pembelian.php">
							      <div class="modal-body">
							      	<input type="hidden" name="PelangganID" value="<?php echo $d['PelangganID']; ?>">
							        Apakah Anda yakin akan menghapus data <b><?php echo $d['NamaPelanggan']; ?></b>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
							        <button type="submit" class="btn btn-primary"><i class="far fa-trash-alt"></i> Hapus</button>
							      </div>
						 	 </form>
						    </div>
						  </div>
						</div>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
</div>
</div>
</section>

		<!-- Modal Tambah Data -->
		<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <form action="proses_pembelian.php" method="post">
			      <div class="modal-body">
			        	<div class="form-group">
			        		<label>ID Pelanggan</label>
			        		<input type="text" name="PelangganID" value="<?php echo date("dmHi") ?>" class="form-control" readonly>
			        	</div>
			        	<div class="form-group">
			        		<label>Nama Pelanggan</label>
			        		<input type="text" name="NamaPelanggan" autocomplete="off" class="form-control" autocomplete="off">
			        	</div>
			        	<div class="form-group">
			        		<label>Alamat</label>
			        		<input type="text" name="Alamat" class="form-control" autocomplete="off">
			        	</div>
			        	<div class="form-group">
			        		<label>No. Telp</label>
			        		<input type="text" name="NomorTelepon" class="form-control" autocomplete="off">
			        		<input type="hidden" name="TanggalPenjualan" value="<?php echo date("Y-m-d") ?>" class="form-control">
			        	</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
			        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
			      </div>
		      </form>
		    </div>
		  </div>
		</div>
<?php
include "footer.php";
?>