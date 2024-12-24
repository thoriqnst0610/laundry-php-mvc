<div class="container">
    <div class="row m-auto">
        <div class="col-6 m-auto">
        <div class="login-container">
            <h2 class="text-center mb-4 mt-5">Login</h2>
            <form method="post" action="/users/login">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="id" required  value="<?= $_POST['id'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="mt-3 text-center">
                <p>Belum punya akun? <a href="/users/register" class="btn btn-link">Register</a></p>
            </div>
        </div>
        </div>
    </div>
    </div>