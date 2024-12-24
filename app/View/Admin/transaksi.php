<div class="container mt-4">
<form action="/admin/transaksi" method="POST">
<div class="mt-3">
<label for="inputName" class="form-label">Id</label>
<input type="number" name="customer" class="form-control"
value="<?= $model['id'] ?>" aria-label="Disabled input example">
</div>
<div class="mt-3">
<label for="inputName" class="form-label">Nama</label>
<input type="text" id="inputName" name="name" class="form-control"
value="<?= $model['name'] ?>" aria-label="Disabled input example" disabled readonly>
</div>
<div class="mt-3">
<label for="inputPhone" class="form-label">Pengembalian</label>
<input type="date" id="inputPhone" name="order_date" class="form-control"
placeholder="Phone">
</div>
<div class="mt-3">
<label for="exampleDataList" class="form-label">Jenis Pakaian</label>
<input class="form-control" list="datalistOptions" id="exampleDataList" name="item_name" placeholder="Type to search...">
<datalist id="datalistOptions">
  <option value="Sarung">
  <option value="Kain">
  <option value="Kasur">
</datalist>
</div>
<div class="mt-3">
<label for="inputAddres" class="form-label">Jumlah(Kg)</label>
<input type="number" id="inputAddress" name="quantity" class="form-control"
placeholder="Kg">
</div>
<button class="btn btn-primary mt-2" type="submit">Simpan</button>
</form>
</div>