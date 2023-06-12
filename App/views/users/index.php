
<h2 class="mt-4 mb-5">
    Gestion de usuarios
</h2>

<a href="#" class="btn btn-success" role="button" data-bs-toggle="modal" data-bs-target="#new-user-modal">Nuevo usuario</a>
<a href="index.php?action=mail-list" class="btn btn-primary" role="button">Inicio</a>

<?php if($users){?>
    <table class="table table-stripped mt-5">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Mail</th>
            <th>Edat</th>
            <th>Nivel</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user){?>
            <tr>
                <td>
                    <?=$user['nombre']?> &#45; <?=$user['apellido']; ?>
                </td>
                <td>
                    <?=$user['mail']?>
                </td>
                <td>
                    <?=$user['edat']?>
                </td>
                <td>
                    <?=$user['nivel']?>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <!-- <a href="index.php?action=show_user&id=<?=$user['id']?>" class="btn btn-primary"><i class="bi bi-eye"></i></a> -->
                        <a href="index.php?action=edit_user&id=<?=$user['id']?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                        
                        <?php if($_SESSION['user']['id'] != $user['id']){?>
                            <form action="index.php" method="post">
                                <input type="hidden" name="id" value="<?=$user['id']; ?>">
                                <input type="hidden" name="action" value="delete_user">
                                <button onclick="return confirm('Estas seguro de borrar el usuario con correo <?=$user['mail']; ?>')" type="submit" role="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        <?php }?>
                    </div>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>
<?php }else{?>
<div class="alert alert-warning">
    No hay usuarios.
</div>
<?php }?>


<div class="modal fade" id="new-user-modal" tabindex="-1" aria-labelledby="new-user-modalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="new-user-modalLabel">Nuevo usuario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="index.php" method="POST">
            <div class="modal-body">
                <input type="hidden" name="action" value="create_user">
                <div class="mb-3">
                    <label for="email" class="col-form-label">Email:</label>
                    <div class="input-group">
                        <input type="mail" required name="mail" class="form-control" id="email">
                        <div class="input-group-text">
                            @dmail.com
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="col-form-label">Nombre:</label>
                    <input required type="text" name="name" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="surname" class="col-form-label">Apellido:</label>
                    <input required type="text" name="surname" class="form-control" id="surname">
                </div>
                <div class="mb-3">
                    <label for="age" class="col-form-label">Edad:</label>
                    <input required type="number" name="age" class="form-control" id="age">
                </div>
                <div class="mb-3">
                    <label for="level" class="col-form-label">Nivel:</label>
                    <input required type="number" name="level" class="form-control" id="level">
                </div>
                <div class="mb-3">
                    <label for="pass" class="col-form-label">Contraseña:</label>
                    <input required type="password" name="pass" class="form-control" id="pass">
                </div>
                <div class="mb-3">
                    <label for="pass2" class="col-form-label">Confirma contraseña:</label>
                    <input required type="password" name="pass2" class="form-control" id="pass2">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>

    </div>
</div>
</div>
