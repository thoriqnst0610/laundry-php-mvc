<div class="container mt-4">
<form action="/admin/edit" method="POST">
<div class="mt-3">
<input type="hidden" id="inputName" name="id" class="form-control"
value="<?= $model['id'] ?>">
</div>
<div class="mt-3">
<label for="inputName" class="form-label">Name</label>
<input type="text" id="inputName" name="name" class="form-control"
value="<?= $model['name'] ?>">
</div>
<div class="mt-3">
<label for="inputPhone" class="form-label">Phone</label>
<input type="text" id="inputPhone" name="phone" class="form-control"
value="<?= $model['phone'] ?>">
</div>
<div class="mt-3">
<label for="inputAddres" class="form-label">Addres</label>
<input type="text" id="inputAddress" name="address" class="form-control"
value="<?= $model['address'] ?>">
</div>
<button class="btn btn-primary mt-2" type="submit">Simpan</button>
</form>
</div>