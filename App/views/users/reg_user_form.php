
<form class="container mt-4" action="index.php?action=attempt_register" method="POST">

    <h3>Registrar usuario</h3>

    <input type="hidden" name="register" value="1">

    <div class="mb-3 mt-4">
        <label for="name" class="form-label">Nombre:</label>
        <input required type="name" name="name" class="form-control" id="name" placeholder="Jose">
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label">Apellidos:</label>
        <input required type="surname" name="surname" class="form-control" id="surname" placeholder="Martinez">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <div class="input-group">
            <input required type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="josem">
            <span class="input-group-text" id="emailHelp">@dmail.com</span>
        </div>
        <div id="emailHelp" class="form-text">Elige un nick para tu mail, no es necessario establecer el dominio.</div>
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input required type="password" name="pass" class="form-control" id="password">
    </div>
    <div class="mb-3">
        <label for="password2" class="form-label">Repite contraseña:</label>
        <input required type="password" name="pass2" class="form-control" id="password2">
    </div>

    <!-- <div class="mb-3">
        <label for="codefa" class="form-label">Code:</label>
        <input required type="text" name="codefa" class="form-control" id="password2">
    </div> -->

        
    <button type="submit" class="btn btn-primary w-100 p-2">Register</button>
</form>