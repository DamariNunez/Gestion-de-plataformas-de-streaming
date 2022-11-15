<?php
    require_once('../../controllers/SerieController.php');
    require_once('../../controllers/DirectorController.php');
    include('../../menu.html');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <title>Eliminar directores</title>
    </head>
    <body>
        <div class="container">
            <?php
            $idDirector = $_POST['directorId'];
            $directorDeleted = deleteDirector($idDirector);
            if ($directorDeleted)
            {
                ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Director eliminado correctamente.<br><a href="list.php">Volver al listado de directores</a>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        El director no se ha eliminado correctamente porque dirige en una o varias series.<br>
                        Para eliminar el director, primero deberá eliminarlo de las series que dirige.<br>
                        <a href="list.php">Volver a intentarlo</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>
