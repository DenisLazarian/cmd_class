

<h2>Lista de menajes</h2>

<div class="mt-4">
    <a id="show-modal" href="index.php?action=redactar_mail" class="btn btn-success mb-4" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Redactar</a>
    <?php if($mails != null && ($mails) != []){
    ?>
        <table class="table table-strippeds">
            <thead>
                <tr>
                    <th>Emisor</th>
                    <th>Contenido</th>
                    <th>Fecha</th>
                    <th>Acciones</th>      
                </tr>
            </thead>
            <tbody>
                <?php foreach($mails as $mail){?>
                    <tr>
                        <td>
                            <?=$mail['propietario'] ?>
                        </td>
                        <td>
                            <div class="d-sm-flex gap-sm-2">
                                <span class="fw-semibold">
                                    <?=$mail["asunto"]; ?>
                                </span>
                                &#45;
                                <span class="text-secondary">
                                    <?=$mail["cuerpo"]; ?>
                                </span>
                                <div class="justify-content-end">
                                    <?php if($mail['visto'] === '0' && $mail['propietario_id'] != $_SESSION['user']['id']){?>
                                        <span class="text-end small text-secondary p-2 alert alert-warning" style="border: 1px solid black">
                                            Nuevo
                                        </span>
                                    <?php }?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?=$mail["fecha"]; ?>
                        </td>
                        <td>
                            <a href="index.php?action=show_mail&id=<?=$mail['id']?>" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                            <!-- <a href="index.php?action=borrar_mail&id=<?=$mail['id']?>" class="btn btn-danger">Borrar</a> -->
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    <?php }else{?>
        <div class="alert alert-warning">
            No hay mensajes.
        </div>
    <?php } ?>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo mensaje</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="index.php?action=redactar_mail" method="post">
            <div class="modal-body">
                <input type="hidden" name="send-message" value="1">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Destinatario:</label>
                    <input type="mail" required name="destinatario" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Asunto:</label>
                    <input required type="text" name="asunto" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Cuerpo:</label>
                    <textarea name="body" class="form-control" id="message-text"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send message</button>
            </div>
        </form>
    </div>
</div>
</div>