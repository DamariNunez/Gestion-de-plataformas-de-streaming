<?php
    require_once('../../controllers/SerieController.php');
    require_once('../../controllers/ActorController.php');
    include('../../menu.html');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <title>Editar actores</title>
    </head>
    <body>
        <div class="container">
            <?php
            $idActor = $_GET['id'];
            $actorObject = getActorData($idActor);

            $sendData = false;
            $actorEdited = false;
            if(isset($_POST['editBtn']))
            {
                $sendData = true;
            }
            if($sendData)
            {
                if(isset($_POST['actorName']) and isset($_POST['actorLastName']) and isset($_POST['actorDateOfBirth']) and isset($_POST['actorNacionality']))
                {
                    $actorEdited = updateActor($_POST['actorId'], $_POST['actorName'], $_POST['actorLastName'], $_POST['actorDateOfBirth'], $_POST['actorNacionality']);
                }
            }
            if(!$sendData) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <h1>Editar actores</h1>
                    </div>
                    <div class="col-12">
                        <form name="create_actor" action="" method="POST">
                            <div class="mb-3">
                                <label for="actorName" class="form-label">Nombre del actor</label>
                                <input id="actorName" name="actorName" type="text" placeholder="Introduzca el nombre del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getName(); ?>"/>
                                <label for="actorLastName" class="form-label">Apellido del actor</label>
                                <input id="actorLastName" name="actorLastName" type="text" placeholder="Introduzca el apellido del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getLastName(); ?>"/>
                                <label for="actorDateOfBirth" class="form-label">Fecha de nacimiento del actor</label>
                                <input id="actorDateOfBirth" name="actorDateOfBirth" type="date" max="<?=date('Y-m-d');?>" placeholder="Introduzca la fecha de nacimiento del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getDateOfBirth(); ?>"/>
                                <label for="actorNationality" class="form-label">Nacionalidad del actor</label>
                                <input id="actorNationality" name="actorNacionality" type="text" placeholder="Introduzca la nacionalidad del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getNationality(); ?>"/>
                                <input type="hidden" name="actorId" value="<?php echo $idActor; ?>"/>
                            </div>
                            <input type="submit" value="Editar" class="btn btn-primary" name="editBtn">
                        </form>
                    </div>
                </div>
                <?php
            } else {
                if($actorEdited) {
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Actor editado correctamente.<br><a href="list.php">Volver al listado de actores</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El actor no ha sido editado correctamente.<br><a href="edit.php?id=<?php echo $idActor;?>">Volver a intentarlo</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>