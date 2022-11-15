<?php
    require_once('../../controllers/SerieController.php');
    require_once('../../controllers/LanguageController.php');
    include('../../menu.html');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <title>Eliminar idiomas</title>
    </head>
    <body>
        <div class="container">
            <?php
            $idLanguage = $_POST['languageId'];
            $languageDeleted = deleteLanguage($idLanguage);
            if ($languageDeleted)
            {
                ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Idioma eliminado correctamente.<br><a href="list.php">Volver al listado de idiomas</a>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        El idioma no se ha eliminado correctamente porque es un audio o subtítulo disponible en una o varias series.<br>
                        Para eliminar el idioma, primero deberá eliminarlo de las series en las que interviene.<br>
                        <a href="list.php">Volver a intentarlo</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>
