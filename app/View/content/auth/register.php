<main class="container main-content mt-5">
    <h1 class="text-center text-primary mb-4">Register</h1>
    <div class="row justify-center">
        <div class="col-12 col-md-6">
            <form action="/register" method="POST" class="bg-dark p-4 rounded-lg shadow-lg">
                <div class="mb-3">
                    <label for="username" class="text-white">Username</label>
                    <input type="text" id="username" name="username" required class="w-100 rounded border border-muted p-2">
                </div>
                <div class="mb-3">
                    <label for="email" class="text-white">Email</label>
                    <input type="email" id="email" name="email" required class="w-100 rounded border border-muted p-2">
                </div>
                <div class="mb-3">
                    <label for="password" class="text-white">Password</label>
                    <input type="password" id="password" name="password" required class="w-100 rounded border border-muted p-2">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="text-white">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required class="w-100 rounded border border-muted p-2">
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
        </div>
    </div>
</main>