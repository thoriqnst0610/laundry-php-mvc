<div class="container">
    <a class="btn btn-primary mt-4 mb-4" href="/admin/tambah">Tambah</a>
<table class="table ">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Phone</th>
      <th scope="col">Alamat</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php
  function format_rupiah($angka) {
    $rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $rupiah;
}
  $no = 1;
if(isset($model['message'])){
foreach ($model['message'] as $customer) {?>
    
    
    <tr>
      <th scope="row"><?= $no++; ?></th>
      <td><?= $name = $customer['name']; ?></td>
      <td><?= $phone = $customer['phone']; ?></td>
      <td><?= $address = $customer['address']; ?></td>
      <td><a class="btn btn-danger" href="/admin/transaksi?idc=<?= $customer['idc'] ?>">Transaksi</a> || <a class="btn btn-success" href="/admin/edit?idc=<?= $customer['idc'] ?>">Edit</a> || <a class="btn btn-danger" href="/admin/hapus?idc=<?= $customer['idc'] ?>">Hapus</a></td>
    </tr>
<?php } ?>
<?php }
    
?>
  </tbody>
</table>
</div>
