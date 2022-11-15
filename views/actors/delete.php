<?php
    require_once('../../controllers/SerieController.php');
    require_once('../../controllers/ActorController.php');
    include('../../menu.html');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <title>Eliminar actores</title>
    </head>
    <body>
        <div class="container">
            <?php
            $idActor = $_POST['actorId'];
            $actorDeleted = deleteActor($idActor);
            if ($actorDeleted)
            {
                ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Actor eliminado correctamente.<br><a href="list.php">Volver al listado de actores</a>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        El actor no se ha eliminado correctamente porque participa en una o varias series.<br>
                        Para eliminar el actor, primero deberá eliminarlo de las series en las que participa.<br>
                        <a href="list.php">Volver a intentarlo</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>