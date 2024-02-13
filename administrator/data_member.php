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
            <h1 class="m-0">Data Member</h1>
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
							<th>No</th>
							<th>NIK</th>
							<th>Nama Member</th>
							<th>Jenis Kelamin</th>
							<th>Alamat</th>
							<th>No. Telp</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						include '../koneksi.php';
						$no = 1;
						$data = mysqli_query($koneksi,"SELECT*FROM member");
						while($d = mysqli_fetch_array($data)){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $d['nik']; ?></td>
							<td><?php echo $d['nama']; ?></td>
							<td><?php echo $d['jenkel']; ?></td>
							<td><?php echo $d['alamat']; ?></td>
							<td><?php echo $d['notelp']; ?></td>
							<td>
								<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['nik']; ?>"><i class="fas fa-edit"></i>
						  			Edit
								</button>
								<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['nik']; ?>"><i class="fas fa-trash-alt"></i>
						  			Hapus
								</button>
							</td>
						</tr>

						<!-- Modal Edit Data -->
						<div class="modal fade" id="edit-data<?php echo $d['nik']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <form action="proses_update_member.php" method="post">
							      <div class="modal-body">
							        	<div class="form-group">
							        		<label>NIK</label>
							        		<input type="text" name="nik" value="<?php echo $d['nik']; ?>" class="form-control" autocomplete="off">
							        	</div>
							        	<div class="form-group">
							        		<label>Nama Member</label>
							        		<input type="text" name="nama" value="<?php echo $d['nama']; ?>" class="form-control" autocomplete="off">
							        	</div>
							        	<div class="form-group">
							        		<label>Jenis Kelamin</label>
							        		<select name="jenkel" class="form-control">
							        			<option> --- Jenis Kelamin --- </option>
							        			<option value="Laki-Laki" <?php if ($d['jenkel'] == 'Laki-Laki') { echo "selected"; } ?>>Laki-Laki</option>
							        			<option value="Perempuan" <?php if ($d['jenkel'] == 'Perempuan') { echo "selected"; } ?>>Perempuan</option>
							        		</select>
							        	</div>
							        	<div class="form-group">
							        		<label>Alamat</label>
							        		<input type="text" name="alamat" value="<?php echo $d['alamat']; ?>" class="form-control" autocomplete="off">
							        	</div>
							        	<div class="form-group">
							        		<label>No. Telp</label>
							        		<input type="text" name="notelp" value="<?php echo $d['notelp']; ?>" class="form-control" autocomplete="off">
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
						<div class="modal fade" id="hapus-data<?php echo $d['nik']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <form method="post" action="proses_hapus_member.php">
							      <div class="modal-body">
							      	<input type="hidden" name="nik" value="<?php echo $d['nik']; ?>">
							        Apakah Anda yakin akan menghapus data <b><?php echo $d['nama']; ?></b>
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
<?php
include "footer.php";
?>