<div class="container">
<div class="row m-auto">
<div class="col-6 m-auto">
        <div class="registration-container">
            <h2 class="text-center mb-4 mt-5">Register</h2>
            <form method="post" action="/users/register">
            <div class="mb-3">
                    <label for="username" class="form-label">Id</label>
                    <input type="text" class="form-control" id="id" name="id" required value="<?= $_POST['id'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">name</label>
                    <input type="text" class="form-control" id="name" name="name" required value="<?= $_POST['name'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div class="mt-3 text-center">
                <p>Sudah punya akun? <a href="/users/login" class="btn btn-link">Login</a></p>
            </div>
        </div>
</div>
</div>
    </div>