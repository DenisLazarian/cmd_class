
<header class="bg-light">
    <nav class="navbar navbar-expand-lg bg-light container">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?php if(checkS("user", $_SESSION['user'])){?>
                            <a class="nav-link active" aria-current="page" href="index.php?action=mail-list">Home</a>
                        
                        <?php }else{ ?>
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        <?php } ?>
                    </li>
                    <?php if(checkRole('admin')){?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=users-list">Users</a>
                        </li>
                    <?php }?>
                    <?php if(checkLog()){?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="index.php?action=browser">Browser</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="index.php?action=mail-list">Messages</a>
                        </li>
                    <?php }?>
                </ul>
                <?php if(checkLog()){?>
                    <span class="me-3"><?=$_SESSION['user']['nombre']; ?></span>
                <?php }?>
                <div class="">
                <?php if(checkLog()){?>
                    <a href="index.php?action=logout" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i> logout</a>
                <?php }else{?>
                    <a href="index.php?action=login" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> login</a>
                    <a href="index.php?action=register" class="btn btn-warning">Registrarse</a>
                <?php }?>
                </div>
            </div>
        </div>
    </nav>
</header>