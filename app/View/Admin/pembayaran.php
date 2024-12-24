<div class="container">
    <a class="btn btn-primary mt-4 mb-4" href="/admin/cetaklaporan">Cetak</a>
<table class="table ">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Tanggal Ambil</th>
      <th scope="col">Jenis Kain</th>
      <th scope="col">Berat</th>
      <th scope="col">Bayar</th>
      <th scope="col">Status</th>
      <th scope="col">Bukti</th>
    </tr>
    <?php
    function format_rupiah($angka) {
      $rupiah = "Rp " . number_format($angka, 0, ',', '.');
      return $rupiah;
  }
    $no = 1;
    $models = 0;
if(isset($model['data'])){
foreach ($model['data'] as $customer) { $models = $models + $customer['total_amount'];?>
    
    
    <tr>
      <th scope="row"><?= $no++; ?></th>
      <td><?= $name = $customer['name']; ?></td>
      <td><?= $phone = $customer['order_date']; ?></td>
      <td><?= $address = $customer['item_name']; ?></td>
      <td><?= $address = $customer['quantity']; ?></td>
      <td><?= format_rupiah($customer['total_amount']); ?></td>
      <td><?= $address = $customer['status']; ?></td>
      <td><a class="btn btn-danger" href="/admin/laporan?idc=<?= $customer['idc'] ?>&&ido=<?= $customer['ido'] ?>&&idd=<?= $customer['idd'] ?>">Cetak</a></td>
    </tr>
<?php } ?>
<?php }
    
?>
  </thead>
  <tbody>
  </tbody>
  </table>
  <h2>Total Pendapatan: <?php echo format_rupiah($models); ?></h2>
</div>