
<div class="container mt-4">

    
    <h2>
        <?=$mail['asunto']; ?>
    </h2>
    <span class="small text-secondary">
         <?=$mail['fecha']; ?> by <?=$mail['propietario']; ?> 
    </span>
    <p class="mt-3">
        <?=$mail['cuerpo']; ?>
    </p>

    <div class="mt-5">
        <a href="index.php?action=respond_mail&emisor_id=<?=$mail['propietario_id']; ?>" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#respond_mail" data-bs-whatever="<?=$mail['propietario_mail']; ?>">Responder</a>

    </div>
</div>


<div class="modal fade" id="respond_mail" tabindex="-1" aria-labelledby="respondModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="respondModal">New message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="respond_mail">
                    <input type="hidden" name="resend-message" value="1">
                    <input type="hidden" name="referencia" value="<?=$mail['id']; ?>">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Destinatario:</label>
                        <input type="mail" required name="destinatario" class=" form-control" id="recipient-name" disabled="disabled" value="<?=$mail['propietario_mail']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Asunto:</label>
                        <input required type="text" name="asunto" class="form-control" id="recipient-name" value="<?=$mail['asunto']; ?>">
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