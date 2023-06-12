
<h3 class="mt-4">
    Edit User
</h3>

<a href="index.php" class="btn btn-secondary pull-right mt-4 mb-4">Go Back</a>


<form action="index.php" method="post">
    <input type="hidden" name="action" value="update_user">
    <input type="hidden" name="id" value="<?=$user['id']; ?>">
        <div class="mb-3">
            <label for="email" class="col-form-label">Email:</label>
            <div class="input-group">
                <?php 
                    $nickMail = explode("@", $user['mail'])[0];
                ?>
                <input value="<?=$nickMail; ?>" type="mail" required name="mail" class="form-control" id="email">
                <div class="input-group-text">
                    @dmail.com
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="col-form-label">Nombre:</label>
            <input value="<?=$user['nombre']; ?>" required type="text" name="name" class="form-control" id="recipient-name">
        </div>
        <div class="mb-3">
            <label for="surname" class="col-form-label">Apellido:</label>
            <input required value="<?=$user['apellido']; ?>" type="text" name="surname" class="form-control" id="surname">
        </div>
        <div class="mb-3">
            <label for="age" class="col-form-label">Edad:</label>
            <input required value="<?=$user['edat']; ?>" type="number" name="age" class="form-control" id="age">
        </div>
        <div class="mb-3">
            <label for="level" class="col-form-label">Nivel:</label>
            <input required value="<?=$user['nivel']; ?>" type="number" name="level" class="form-control" id="level">
        </div>
        <div class="mb-3">
            <label for="pass" class="col-form-label">Contraseña:</label>
            <input  type="password" name="pass" class="form-control" id="pass">
        </div>
        <div class="mb-3">
            <label for="pass2" class="col-form-label">Confirma contraseña:</label>
            <input  type="password" name="pass2" class="form-control" id="pass2">
        </div>
        <button type="submit" class="btn btn-primary w-100">Edit</button>
    </div>

</form>