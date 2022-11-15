<?php
    require_once('../../controllers/SerieController.php');
    require_once('../../controllers/PlatformController.php');
    require_once('../../controllers/DirectorController.php');
    require_once('../../controllers/ActorController.php');
    require_once('../../controllers/LanguageController.php');
    require_once('../../controllers/DirectController.php');
    require_once('../../controllers/ParticipateController.php');
    require_once('../../controllers/AudioAvailableController.php');
    require_once('../../controllers/SubtitleAvailableController.php');
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
            $idSerie = $_POST['serieId'];
            $directDeleted = deleteDirectSerie($idSerie);
            $participeDeleted = deleteParticipateSerie($idSerie);
            $audioDeleted = deleteAudioAvailableSerie($idSerie);
            $subtitleDeleted = deleteSubtitleAvailableSerie($idSerie);
            $serieDeleted = deleteSerie($idSerie);
            if ($serieDeleted)
            {
                ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Serie eliminada correctamente.<br><a href="list.php">Volver al listado de series</a>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        La serie no se ha eliminado correctamente.<br><a href="list.php">Volver a intentarlo</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>
