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
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(".multiple-select").select2({
                //maximumSelectionLength: 2
            });
        </script>
        <title>Crear series</title>
    </head>
    <body>
        <div class="container">
            <?php
            $sendData = false;
            $serieCreated = false;
            $directCreated = false;
            $participateCreated = false;
            $audioCreated = false;
            $subtitleCreated = false;
            if(isset($_POST['createBtn']))
            {
                $sendData = true;
            }
            if($sendData)
            {
                if(isset($_POST['title']) and isset($_POST['platform']))
                {
                    $idPlatform = findPlatformByName($_POST['platform']);
                    if ($idPlatform != null) {
                        $serieCreated = storeSerie($_POST['title'], $idPlatform->getId());
                    }
                }
                if(isset($_POST['director'])) {
                    $idSerie = findMaxIdSerie();
                    if ($idSerie != null){
                       foreach ($_POST['director'] as $director){
                           $arrayNombre = explode(" ", $director);
                           $idDirector = findDirectorByName($arrayNombre[0], $arrayNombre[1]);
                           if($idDirector != null) {
                               $directCreated = storeDirect($idDirector->getId(), $idSerie->getId());
                           }
                       }
                    }
                }
                if(isset($_POST['actor'])) {
                    $idSerie = findMaxIdSerie();
                    if ($idSerie != null){
                        foreach ($_POST['actor'] as $actor) {
                            $arrayNombre = explode(" ", $actor);
                            $idActor = findActorByName($arrayNombre[0], $arrayNombre[1]);
                            if($idActor != null){
                               $participateCreated = storeParticipate($idSerie->getId(), $idActor->getId());
                            }
                        }
                    }
                }
                if(isset($_POST['audio'])) {
                    $idSerie = findMaxIdSerie();
                    if ($idSerie != null){
                        foreach ($_POST['audio'] as $audio) {
                            $idLanguage = findLanguageByName($audio);
                            if ($idLanguage != null) {
                                $audioCreated = storeAudioAvailable($idLanguage->getId(), $idSerie->getId());
                            }
                        }
                    }
                }
                if(isset($_POST['subtitle'])) {
                    $idSerie = findMaxIdSerie();
                    if ($idSerie != null){
                        foreach ($_POST['subtitle'] as $subtitle) {
                            $idLanguage = findLanguageByName($subtitle); ;
                            if ($idLanguage != null) {
                                $subtitleCreated = storeSubtitleAvailable($idLanguage->getId(), $idSerie->getId());
                            }
                        }
                    }
                }
            }
            if(!$sendData){
                ?>
                <div class="row">
                    <div class="col-12">
                        <h1>Crear series</h1>
                    </div>
                    <div class="col-12">
                        <form name="create_serie" action="" method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Título</label>
                                <input id="title" name="title" type="text" placeholder="Introduzca el título de la serie" class="form-control" required/>
                                <label for="platform" class="form-label">Seleccione la plataforma</label>
                                <select id="platform" name="platform" class="form-control" required>
                                    <?php
                                    $platformList = listPlatforms();
                                    foreach ($platformList as $platform){
                                        ?>
                                        <option><?php echo $platform->getName(); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="director" class="form-label">Seleccione los directores</label>
                                <select id="director" name="director[]" class="form-control multiple-select" role="combobox" multiple required>
                                    <?php
                                    $directorList = listDirectors();
                                    foreach ($directorList as $director){
                                        ?>
                                        <option><?php echo $director->getName().' '.$director->getLastName(); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="actor" class="form-label">Seleccione los actores</label>
                                <select id="actor" name="actor[]" class="form-control" multiple required>
                                    <?php
                                    $actorList = listActors();
                                    foreach ($actorList as $actor){
                                        ?>
                                        <option><?php echo $actor->getName().' '.$actor->getLastName(); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="audio" class="form-label">Seleccione los audios disponibles</label>
                                <select id="audio" name="audio[]" class="form-control" multiple required>
                                    <?php
                                    $languageList = listLanguages();
                                    foreach ($languageList as $language){
                                        ?>
                                        <option><?php echo $language->getName(); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subtitle" class="form-label">Seleccione los subtítulos disponibles</label>
                                <select id="subtitle" name="subtitle[]" class="form-control" multiple required>
                                    <?php
                                    $languageList = listLanguages();
                                    foreach ($languageList as $language){
                                        ?>
                                        <option><?php echo $language->getName(); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
                        </form>
                    </div>
                </div>
                <?php
            } else {
                if($serieCreated and $directCreated and $participateCreated and $audioCreated and $subtitleCreated){
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Serie creada correctamente.<br><a href="list.php">Volver al listado de series</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            La serie no se ha creado correctamente.No pueden existir dos series con la misma información.<br><a href="create.php">Volver a intentarlo</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>

