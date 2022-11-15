<?php
    require_once('../../controllers/SerieController.php');
    require_once('../../controllers/LanguageController.php');
    include('../../menu.html');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <title>Crear idiomas</title>
    </head>
    <body>
        <div class="container">
            <?php
            $sendData = false;
            $languageCreated = false;
            if(isset($_POST['createBtn']))
            {
                $sendData = true;
            }
            if($sendData)
            {
                if(isset($_POST['languageName']) and isset($_POST['isoCode']))
                {
                    $languageCreated = storeLanguage($_POST['languageName'], $_POST['isoCode']);
                }
            }
            if(!$sendData){
                ?>
                <div class="row">
                    <div class="col-12">
                        <h1>Crear idiomas</h1>
                    </div>
                    <div class="col-12">
                        <form name="create_language" action="" method="POST">
                            <div class="mb-3">
                                <label for="languageName" class="form-label">Nombre del idioma</label>
                                <input id="languageName" name="languageName" type="text" placeholder="Introduzca el nombre del idioma" class="form-control" required/>
                                <label for="isoCode" class="form-label">ISO Code</label>
                                <input id="isoCode" name="isoCode" type="text" placeholder="Introduzca el ISO Code" class="form-control" required/>
                                </div>
                            <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
                        </form>
                    </div>
                </div>
                <?php
            } else {
                if($languageCreated){
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Idioma creado correctamente.<br><a href="list.php">Volver al listado de idiomas</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El idioma no se ha creado correctamente.No pueden existir dos lenguajes con la misma información.<br><a href="create.php">Volver a intentarlo</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>
