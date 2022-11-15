<?php
    require_once('../../controllers/SerieController.php');
    require_once('../../controllers/PlatformController.php');
    include('../../menu.html');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <title>Eliminar plataformas</title>
    </head>
    <body>
        <div class="container">
            <?php
                $idPlatform = $_POST['platformId'];
                $platformDeleted = deletePlatform($idPlatform);
                if ($platformDeleted)
                {
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Plataforma eliminada correctamente.<br><a href="list.php">Volver al listado de plataformas</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            La plataforma no se ha eliminado correctamente porque existen series en dicha plataforma.<br>
                            Para eliminar la plataforma, primero deberá eliminar las series que contiene.<br>
                            <a href="list.php">Volver a intentarlo</a>
                        </div>
                    </div>
                <?php
                }
                ?>
        </div>
    </body>
</html>