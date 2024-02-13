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
            <h1 class="m-0">Data Pengguna</h1>
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
							<th>Nama Petugas</th>
							<th>Username</th>
							<th>Akses Petugas</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						include '../koneksi.php';
						$no = 1;
						$data = mysqli_query($koneksi,"SELECT*FROM petugas");
						while($d = mysqli_fetch_array($data)){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $d['nama_petugas']; ?></td>
							<td><?php echo $d['username']; ?></td>
							<td>
								<?php
								if ($d['level'] == $_SESSION['level']) { ?>
									Adminitrator
								<?php } else { ?>
									Petugas
								<?php } ?>

							</td>
							<td>
								<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['id_petugas']; ?>"><i class="fas fa-edit"></i>
		  							Edit
								</button>
								<?php
								if ($d['level'] == '1') { ?>
								<?php } else { ?>
									<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['id_petugas']; ?>"><i class="fas fa-trash-alt"></i>
		  							Hapus
								</button>
							</td>
								<?php } ?>
						</tr>

						<!-- Modal Edit Data -->
						<div class="modal fade" id="edit-data<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <form action="proses_update_petugas.php" method="post">
						      <div class="modal-body">
						        <div class="form-group">
					        		<label>Nama Petugas</label>
					        		<input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas']; ?>">
					        		<input type="text" name="nama_petugas" class="form-control" autocomplete="off" value="<?php echo $d['nama_petugas']; ?>" autocomplete="off">
					        	</div>
					        	<div class="form-group">
					        		<label>Username</label>
					        		<input type="text" name="username" class="form-control" autocomplete="off" value="<?php echo $d['username']; ?>" autocomplete="off">
					        	</div>
					        	<div class="form-group">
					        		<label>Password</label>
					        		<input type="password" name="password" class="form-control" value="">
					        		<small class="text-danger text-sm">* Kosongkan Kalau Anda tidak merubah password</small>
					        	</div>
					        	<div class="form-group">
					        		<select name="level" class="form-control">
					        			<label>Akses Petugas</label>
					        			<option> --- Pilih Akses --- </option>
					        			<option value="1" <?php if ($d['level'] == '1') { echo "selected"; } ?>>Administrator</option>
					        			<option value="2" <?php if ($d['level'] == '2') { echo "selected"; } ?>>Petugas</option>
					        		</select>
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
						<div class="modal fade" id="hapus-data<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <form method="post" action="proses_hapus_petugas.php">
							      <div class="modal-body">
							      	<input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas']; ?>">
							        Apakah Anda yakin akan menghapus data <b><?php echo $d['nama_petugas']; ?></b>
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
		      <form action="proses_simpan_petugas.php" method="post">
			      <div class="modal-body">
			        	<div class="form-group">
			        		<label>Nama Petugas</label>
			        		<input type="text" name="nama_petugas" class="form-control" autocomplete="off">
			        	</div>
			        	<div class="form-group">
			        		<label>Username</label>
			        		<input type="text" name="username" autocomplete="off" class="form-control">
			        	</div>
			        	<div class="form-group">
			        		<label>Password</label>
			        		<input type="password" name="password" class="form-control">
			        	</div>
			        	<div class="form-group">
			        		<label>Akses Petugas</label>
			        		<select name="level" class="form-control">
			        			<option> --- Akses Petugas --- </option>
			        			<option value="1">Administrator</option>
			        			<option value="2">Petugas</option>
			        		</select>
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