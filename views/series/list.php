<?php
    require('../../controllers/SerieController.php');
    require('../../controllers/DirectController.php');
    require('../../controllers/ParticipateController.php');
    require('../../controllers/AudioAvailableController.php');
    require('../../controllers/SubtitleAvailableController.php');
    include('../../menu.html');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <title>Listado de series</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Listado de series</h1>
                </div>
                <div class="col-6">
                    <a class="btn btn-primary" href="create.php">+ Crear serie</a>
                </div>
                <div class="col-12">
                    <?php
                    $serieList = listSeriesNamePlatform();
                    if (count($serieList) > 0) {
                        ?>
                        <table class="table">
                            <thead>
                            <th>Id</th>
                            <th>Título</th>
                            <th>Plataforma</th>
                            <th>Director</th>
                            <th>Actores/Actrices</th>
                            <th>Idiomas en audio</th>
                            <th>Idiomas en subtítulos</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($serieList as $serie) {
                                $idSerie = $serie->getId();
                                ?>
                                <tr>
                                    <td><?php echo $serie->getId();?></td>
                                    <td><?php echo $serie->getTitle();?></td>
                                    <td><?php echo $serie->getNamePlatform();?></td>
                                    <?php
                                    $directList = listDirect($idSerie);
                                    $directors = null;
                                    foreach ($directList as $direct){
                                        $directors = $directors.', '.$direct->getNameDirector().' '.$direct->getLastNameDirector();
                                    }
                                    $directors = substr($directors, 1);
                                    ?>
                                    <td><?php echo $directors;?></td>
                                    <?php
                                    $participateList = listParticipate($idSerie);
                                    $actors = null;
                                    foreach ($participateList as $participate){
                                        $actors = $actors.', '.$participate->getNameActor().' '.$participate->getLastNameActor();
                                    }
                                    $actors = substr($actors, 1);
                                    ?>
                                    <td><?php echo $actors;?></td>
                                    <?php
                                    $audioAvailableList = listAudioAvailables($idSerie);
                                    $audios = null;
                                    foreach ($audioAvailableList as $audiosAvailable){
                                        $audios = $audios.', '.$audiosAvailable->getNameLanguage();
                                    }
                                    $audios = substr($audios, 1);
                                    ?>
                                    <td><?php echo $audios;?></td>
                                    <?php
                                    $subtitleAvailableList = listSubtitleAvailables($idSerie);
                                    $subtitles = null;
                                    foreach ($subtitleAvailableList as $subtitlesAvailable){
                                        $subtitles = $subtitles.', '.$subtitlesAvailable->getNameLanguage();
                                    }
                                    $subtitles = substr($subtitles, 1);
                                    ?>
                                    <td><?php echo $subtitles;?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Serie">
                                            <a class="btn btn-success" href="edit.php?id=<?php echo $serie->getId();?>">Editar</a>
                                                &nbsp;&nbsp;
                                            <form name="delete_serie" action="delete.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="serieId" value="<?php echo $serie->getId();?>" />
                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-warning" role="alert">
                            Aún no existen series
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

