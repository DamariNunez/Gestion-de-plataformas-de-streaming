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
        <title>Editar idioma</title>
    </head>
    <body>
        <div class="container">
            <?php
            $idLanguage = $_GET['id'];
            $languageObject = getLanguageData($idLanguage);

            $sendData = false;
            $languageEdited = false;
            if(isset($_POST['editBtn']))
            {
                $sendData = true;
            }
            if($sendData)
            {
                if(isset($_POST['languageName']) and isset($_POST['isoCode']))
                {
                    $languageEdited = updateLanguage($_POST['languageId'], $_POST['languageName'], $_POST['isoCode']);
                }
            }
            if(!$sendData) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <h1>Editar idiomas</h1>
                    </div>
                    <div class="col-12">
                        <form name="create_language" action="" method="POST">
                            <div class="mb-3">
                                <label for="languageName" class="form-label">Nombre del language</label>
                                <input id="languageName" name="languageName" type="text" placeholder="Introduzca el nombre del idioma" class="form-control" required value="<?php if(isset($languageObject)) echo $languageObject->getName(); ?>"/>
                                <label for="isoCode" class="form-label">ISO Code</label>
                                <input id="isoCode" name="isoCode" type="text" placeholder="Introduzca el ISO Code" class="form-control" required value="<?php if(isset($languageObject)) echo $languageObject->getIsoCode(); ?>"/>
                                <input type="hidden" name="languageId" value="<?php echo $idLanguage; ?>"/>
                            </div>
                            <input type="submit" value="Editar" class="btn btn-primary" name="editBtn">
                        </form>
                    </div>
                </div>
                <?php
            } else {
                if($languageEdited) {
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Idioma editado correctamente.<br><a href="list.php">Volver al listado de idiomas</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El idioma no ha sido editado correctamente.<br><a href="edit.php?id=<?php echo $idLanguage;?>">Volver a intentarlo</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>

