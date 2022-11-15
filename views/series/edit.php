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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(".multiple-select").select2({
                //maximumSelectionLength: 2
            });
        </script>
        <title>Editar series</title>
    </head>
    <body>
        <div class="container">
            <?php
            $idSerie = $_GET['id'];
            $serieObject = getSerieData($idSerie);

            $sendData = false;
            $serieEdited = false;
            $directCreated = false;
            $directDelete = false;
            $participateCreated = false;
            $participateDelete = false;
            $audioCreated =false;
            $audioDelete = false;
            $subtitleCreated = false;
            $subtitleDelete = false;
            if(isset($_POST['editBtn']))
            {
                $sendData = true;
            }
            if($sendData)
            {
                if(isset($_POST['title']) and isset($_POST['platform']))
                {
                    $idPlatform = findPlatformByName($_POST['platform']);
                    if ($idSerie !=null and $idPlatform != null) {
                        $serieEdited = updateSerie($idSerie, $_POST['title'], $idPlatform->getId());
                    }
                }
                if(isset($_POST['director'])) {
                    $directList = findDirectByIdSerie($idSerie);
                    if ($idSerie != null and $directList != null){
                        //Agregar directores
                        foreach ($_POST['director'] as $director){
                            $arrayNombre = explode(" ", $director);
                            $idDirector = findDirectorByName($arrayNombre[0], $arrayNombre[1]);
                            if (!in_array($idDirector->getId(), $directList)){
                                $directCreated = storeDirect($idDirector->getId(), $idSerie);
                            }
                        }
                        //Eliminar directores
                        $idDirectorArray[] = null;
                        foreach ($_POST['director'] as $d) {
                            $arrayNombre = explode(" ", $d);
                            $idDirector = findDirectorByName($arrayNombre[0], $arrayNombre[1]);
                            array_push($idDirectorArray, $idDirector->getId());
                        }
                        foreach ($directList as $dir){
                            $arrayNombre = explode(" ", $director);
                            $idDirector = findDirectorByName($arrayNombre[0], $arrayNombre[1]);
                            if (!in_array($dir->getIdDirector(), $idDirectorArray)){
                                $directDelete = deleteDirect($idSerie, $dir->getIdDirector());
                            }
                        }
                    }
                }
                if(isset($_POST['actor'])) {
                    $participateList = findParticipateByIdSerie($idSerie);
                    if ($idSerie != null and $participateList != null){
                        //Agregar actores
                        foreach ($_POST['actor'] as $actor){
                            $arrayNombre = explode(" ", $actor);
                            $idActor = findActorByName($arrayNombre[0], $arrayNombre[1]);
                            if (!in_array($idActor->getId(), $participateList)){
                                $participateCreated = storeParticipate($idSerie, $idActor->getId());
                            }
                        }
                        //Eliminar actores
                        $idActorArray[] = null;
                        foreach ($_POST['actor'] as $a){
                            $arrayNombre = explode(" ", $a);
                            $idActor= findActorByName($arrayNombre[0], $arrayNombre[1]);
                            array_push($idActorArray, $idActor->getId());
                        }
                        foreach ($participateList as $par){
                            $arrayNombre = explode(" ", $actor);
                            $idActor = findActorByName($arrayNombre[0], $arrayNombre[1]);
                            if (!in_array($par->getIdActor(), $idActorArray)){
                                $participateDelete = deleteParticipate($idSerie, $par->getIdActor());
                            }
                        }
                    }
                }
                if(isset($_POST['audio'])) {
                    $audioAvailableListList = findAudioAvailableByIdSerie($idSerie);
                    if ($idSerie != null and $audioAvailableListList != null){
                        //Agregar audios disponibles
                        foreach ($_POST['audio'] as $audio){
                            $idLanguage = findLanguageByName($audio);
                            if (!in_array($idLanguage->getId(), $audioAvailableListList)){
                                $audioCreated = storeAudioAvailable($idLanguage->getId(), $idSerie);
                            }
                        }
                        //Eliminar audios disponibles
                        $idAudioArray[] = null;
                        foreach ($_POST['audio'] as $au){
                            $idLanguage = findLanguageByName($au);
                            array_push($idAudioArray, $idLanguage->getId());
                        }
                        foreach ($audioAvailableListList as $a){
                            $idLanguage = findLanguageByName($audio);
                            if (!in_array($a->getIdLanguage(), $idAudioArray)){
                                $audioDelete = deleteAudioAvailable($a->getIdLanguage(), $idSerie);
                            }
                        }
                    }
                }
                if(isset($_POST['subtitle'])) {
                    $subtitleAvailableListList = findSubtitleAvailableByIdSerie($idSerie);
                    if ($idSerie != null and $subtitleAvailableListList != null){
                        //Agregar subtítulos disponibles
                        foreach ($_POST['subtitle'] as $subtitle){
                            $idLanguage = findLanguageByName($subtitle);
                            if (!in_array($idLanguage->getId(), $subtitleAvailableListList)){
                                $subtitleCreated = storeSubtitleAvailable($idLanguage->getId(), $idSerie);
                            }
                        }
                        //Eliminar subtítulos disponibles
                        $idSubtitleArray[] = null;
                        foreach ($_POST['subtitle'] as $sub){
                            $idLanguage = findLanguageByName($sub);
                            array_push($idSubtitleArray, $idLanguage->getId());
                        }
                        foreach ($subtitleAvailableListList as $s){
                            $idLanguage = findLanguageByName($subtitle);
                            if (!in_array($s->getIdLanguage(), $idSubtitleArray)){
                                $subtitleDelete = deleteSubtitleAvailable($s->getIdLanguage(), $idSerie);
                            }
                        }
                    }
                }
            }
            if(!$sendData) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <h1>Editar series</h1>
                    </div>
                    <div class="col-12">
                        <form name="create_actor" action="" method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Título</label>
                                <input id="title" name="title" type="text" placeholder="Introduzca el título de la serie" class="form-control" required value="<?php if(isset($serieObject)) echo $serieObject->getTitle(); ?>"/>
                                <label for="platform" class="form-label">Seleccione la plataforma</label>
                                <select id="platform" name="platform" class="form-control" required>
                                    <?php
                                    $platformList = listPlatforms();
                                    foreach ($platformList as $platform){
                                        $idPlatformByName = findPlatformByName($platform->getName());
                                        $idPlatform = getPlatformData($serieObject->getIdPlatform());
                                        if ($idPlatformByName->getId() == $idPlatform->getId()){
                                            ?>
                                            <option selected><?php echo $idPlatform->getName(); ?></option>
                                            <?php
                                            continue;
                                        }
                                        ?>
                                        <option><?php echo $platform->getName(); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div class="mb-3">
                                    <label for="director" class="form-label">Seleccione los directores</label>
                                    <select id="director" name="director[]" class="form-control multiple-select" role="combobox" multiple required>
                                        <?php
                                        $i = 0;
                                        $directorList = listDirectors();
                                        $directList = listDirect($serieObject->getId());
                                        foreach ($directorList as $director){
                                            $i = 0;
                                            foreach ($directList as $direct){
                                                if($direct->getNameDirector() == $director->getName() and
                                                   $direct->getLastNameDirector() == $director->getLastName()){
                                                    ?>
                                                    <option selected><?php echo $director->getName().' '.$director->getLastName();?></option>
                                                    <?php
                                                    $i = 1;
                                                }
                                            }
                                            if ($i == 0){
                                                ?>
                                                <option><?php echo $director->getName().' '.$director->getLastName(); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="actor" class="form-label">Seleccione los actores</label>
                                    <select id="actor" name="actor[]" class="form-control" multiple required>
                                        <?php
                                        $i = 0;
                                        $actorList = listActors();
                                        $ParticipateList = listParticipate($serieObject->getId());
                                        foreach ($actorList as $actor){
                                            $i = 0;
                                            foreach ($ParticipateList as $participate){
                                                if($participate->getNameActor() == $actor->getName() and
                                                    $participate->getLastNameActor() == $actor->getLastName()){
                                                    ?>
                                                    <option selected><?php echo $actor->getName().' '.$actor->getLastName(); ?></option>
                                                    <?php
                                                    $i = 1;
                                                }
                                            }
                                            if ($i == 0){
                                                ?>
                                                <option><?php echo $actor->getName().' '.$actor->getLastName(); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="audio" class="form-label">Seleccione los audios disponibles</label>
                                    <select id="audio" name="audio[]" class="form-control" multiple required>
                                        <?php
                                        $i = 0;
                                        $languageList = listLanguages();
                                        $audioAvailableList = listAudioAvailables($serieObject->getId());
                                        foreach ($languageList as $language){
                                            $i = 0;
                                            foreach ($audioAvailableList as $audio){
                                                if($audio->getNameLanguage() == $language->getName()){
                                                    ?>
                                                    <option selected><?php echo $language->getName(); ?></option>
                                                    <?php
                                                    $i = 1;
                                                }
                                            }
                                            if ($i == 0){
                                                ?>
                                                <option><?php echo $language->getName(); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Seleccione los subtítulos disponibles</label>
                                    <select id="subtitle" name="subtitle[]" class="form-control" multiple>
                                        <?php
                                        $i = 0;
                                        $languageList = listLanguages();
                                        $subtitleAvailableList = listSubtitleAvailables($serieObject->getId());
                                        foreach ($languageList as $language){
                                            $i = 0;
                                            foreach ($subtitleAvailableList as $subtitle){
                                                if($subtitle->getNameLanguage() == $language->getName()){
                                                    ?>
                                                    <option selected><?php echo $language->getName(); ?></option>
                                                    <?php
                                                    $i = 1;
                                                }
                                            }
                                            if ($i == 0){
                                                ?>
                                                <option><?php echo $language->getName(); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <input type="hidden" name="serieId" value="<?php echo $idSerie; ?>"/>
                            </div>
                            <input type="submit" value="Editar" class="btn btn-primary" name="editBtn">
                        </form>
                    </div>
                </div>
                <?php
            } else {
                if($serieEdited) {
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Serie editada correctamente.<br><a href="list.php">Volver al listado de series</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            La serie no ha sido editada correctamente.<br><a href="edit.php?id=<?php echo $idSerie;?>">Volver a intentarlo</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>
