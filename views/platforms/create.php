<?php
    require_once('../../controllers/SerieController.php');
    require_once('../../controllers/PlatformController.php');
    include('../../menu.html');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <title>Crear plataformas</title>
    </head>
    <body>
        <div class="container">
            <?php
                $sendData = false;
                $platformCreated = false;
                if(isset($_POST['createBtn']))
                {
                    $sendData = true;
                }
                if($sendData)
                {
                    if(isset($_POST['platformName']))
                    {
                        $platformCreated = storePlatform($_POST['platformName']);
                    }
                }
                if(!$sendData){
            ?>
            <div class="row">
                <div class="col-12">
                    <h1>Crear plataformas</h1>
                </div>
                <div class="col-12">
                    <form name="create_platform" action="" method="POST">
                        <div class="mb-3">
                            <label for="platformName" class="form-label">Nombre plataforma</label>
                            <input id="platformName" name="platformName" type="text" placeholder="Introduzca el nombre de la plataforma" class="form-control" required/>
                        </div>
                        <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
                    </form>
                </div>
            </div>
            <?php
                } else {
                    if($platformCreated){
                        ?>
                        <div class="row">
                            <div class="alert alert-success" role="alert">
                                Plataforma creada correctamente.<br><a href="list.php">Volver al listado de plataformas</a>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="row">
                            <div class="alert alert-danger" role="alert">
                                La plataforma no se ha creada correctamente.No pueden existir dos plataformas con la misma información.<br><a href="create.php">Volver a intentarlo</a>
                            </div>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
    </body>
</html>