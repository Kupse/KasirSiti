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
            <h1 class="m-0">Data Barang</h1>
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
									<th>Nama Produk</th>
									<th>Harga</th>
									<th>Stok</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								include '../koneksi.php';
								$no = 1;
								$data = mysqli_query($koneksi,"SELECT*FROM produk");
								while($d = mysqli_fetch_array($data)){
								?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $d['NamaProduk']; ?></td>
									<td>Rp. <?php echo $d['Harga']; ?></td>
									<td><?php echo $d['Stok']; ?></td>
									<td>
										<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['ProdukID']; ?>"><i class="fas fa-edit"></i>
				  							Edit
										</button>
										<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['ProdukID']; ?>"><i class="fas fa-trash-alt"></i>
				  							Hapus
										</button>
									</td>
								</tr>

								<!-- Modal Edit Data -->
								<div class="modal fade" id="edit-data<?php echo $d['ProdukID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <form action="proses_update_barang.php" method="post">
								      <div class="modal-body">
								        <div class="form-group">
							        		<label>Nama Produk</label>
							        		<input type="hidden" name="ProdukID" value="<?php echo $d['ProdukID']; ?>">
							        		<input type="text" name="NamaProduk" class="form-control" value="<?php echo $d['NamaProduk']; ?>" autocomplete="off">
							        	</div>
							        	<div class="form-group">
							        		<label>Harga Produk </label>
							        		<input type="text" name="Harga" class="form-control" value="<?php echo $d['Harga']; ?>" autocomplete="off">
							        	</div>
							        	<div class="form-group">
							        		<label>Stok Produk</label>
							        		<input type="text" name="Stok" class="form-control" value="<?php echo $d['Stok']; ?>" autocomplete="off">
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
								<div class="modal fade" id="hapus-data<?php echo $d['ProdukID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <form method="post" action="proses_hapus_barang.php">
									      <div class="modal-body">
									      	<input type="hidden" name="ProdukID" value="<?php echo $d['ProdukID']; ?>">
									        Apakah Anda yakin akan menghapus data <b><?php echo $d['NamaProduk']; ?></b>
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
					      <form action="proses_simpan_barang.php" method="post">
						      <div class="modal-body">
						        	<div class="form-group">
						        		<label>Nama Produk</label>
						        		<input type="text" name="NamaProduk" class="form-control" autocomplete="off">
						        	</div>
						        	<div class="form-group">
						        		<label>Harga Produk</label>
						        		<input type="text" name="Harga" class="form-control" autocomplete="off">
						        	</div>
						        	<div class="form-group">
						        		<label>Stok Produk</label>
						        		<input type="text" name="Stok" class="form-control" autocomplete="off">
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