<?php
    require_once('../../controllers/SerieController.php');
    require_once('../../controllers/ActorController.php');
    include('../../menu.html');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <title>Crear actores</title>
    </head>
    <body>
        <div class="container">
            <?php
            $sendData = false;
            $actorCreated = false;
            if(isset($_POST['createBtn']))
            {
                $sendData = true;
            }
            if($sendData)
            {
                if(isset($_POST['actorName']) and isset($_POST['actorLastName']) and isset($_POST['actorDateOfBirth']) and isset($_POST['actorNacionality']))
                {
                    $actorCreated = storeActor($_POST['actorName'], $_POST['actorLastName'], $_POST['actorDateOfBirth'], $_POST['actorNacionality']);
                }
            }
            if(!$sendData){
                ?>
                <div class="row">
                    <div class="col-12">
                        <h1>Crear actores</h1>
                    </div>
                    <div class="col-12">
                        <form name="create_actor" action="" method="POST">
                            <div class="mb-3">
                                <label for="actorName" class="form-label">Nombre del actor</label>
                                <input id="actorName" name="actorName" type="text" placeholder="Introduzca el nombre del actor" class="form-control" required/>
                                <label for="actorLastName" class="form-label">Apellido del actor</label>
                                <input id="actorLastName" name="actorLastName" type="text" placeholder="Introduzca el apellido del actor" class="form-control" required/>
                                <label for="actorDateOfBirth" class="form-label">Fecha de nacimiento del actor</label>
                                <input id="actorDateOfBirth" name="actorDateOfBirth" type="date" max="<?=date('Y-m-d');?>" placeholder="Introduzca la fecha de nacimiento del actor" class="form-control" required/>
                                <label for="actorNationality" class="form-label">Nacionalidad del actor</label>
                                <input id="actorNationality" name="actorNacionality" type="text" placeholder="Introduzca la nacionalidad del actor" class="form-control" required/>
                            </div>
                            <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
                        </form>
                    </div>
                </div>
                <?php
            } else {
                if($actorCreated){
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Actor creado correctamente.<br><a href="list.php">Volver al listado de actores</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El actor no se ha creado correctamente.No pueden existir dos actores con la misma información.<br><a href="create.php">Volver a intentarlo</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>
