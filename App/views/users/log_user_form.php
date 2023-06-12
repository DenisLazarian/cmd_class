



<form class="container mt-4" action="index.php?action=attempt_login" method="POST">

    <h3>Autenticar usuario</h3>

    <input type="hidden" name="login" value="1">

    <input type="hidden" name="register" value="1">
    <div class="mb-3 mt-4">
        <label for="email" class="form-label">Email:</label>
        <div class="input-group">
            <input required type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="josem">
        </div>
    </div>

    
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input required type="password" name="pass" class="form-control" id="password">
    </div>
    <div class="mt-5">

        <!-- <?=$inlineUrl; ?> -->
    </div>

    <label for="">Type your code</label>
    <input type="text" class="mb-5" name="2FACode">
    
    <button type="submit" class="btn btn-primary w-100 p-2">Login</button>
</form>