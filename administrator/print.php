<!DOCTYPE html>
<html>
<head>
  <title>CETAK PRINT LAPORAN KASIR BERLIAN</title>
</head>
<body>
 
  <center>
 
    <h2>DATA LAPORAN BARANG</h2>
  </center>
 
  <?php 
  include '../koneksi.php';
  ?>
 
  <table border="1" style="width: 100%">
    <tr>
      <th width="1%">No</th>
      <th>Nama Produk</th>
      <th>Jumlah Produk</th>
      <th width="5%">Total Harga</th>
    </tr>
    <?php 
    $no = 1;
    $sql = mysqli_query($koneksi,"select * from produk INNER JOIN penjualan INNER JOIN detailpenjualan");

    while($data = mysqli_fetch_array($sql)){
    ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo $data['NamaProduk']; ?></td>
      <td><?php echo $data['JumlahProduk']; ?></td>
      <td><?php echo $data['TotalHarga']; ?></td>
    </tr>
    <?php 
    }
    ?>
  </table>
 
  <script>
    window.print();
  </script>
 
</body>
</html>