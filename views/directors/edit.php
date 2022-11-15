<?php
    require_once('../../controllers/SerieController.php');
    require_once('../../controllers/DirectorController.php');
    include('../../menu.html');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <title>Editar directores</title>
    </head>
    <body>
        <div class="container">
            <?php
            $idDirector = $_GET['id'];
            $directorObject = getDirectorData($idDirector);

            $sendData = false;
            $directorEdited = false;
            if(isset($_POST['editBtn']))
            {
                $sendData = true;
            }
            if($sendData)
            {
                if(isset($_POST['directorName']) and isset($_POST['directorLastName']) and isset($_POST['directorDateOfBirth']) and isset($_POST['directorNacionality']))
                {
                    $directorEdited = updateDirector($_POST['directorId'], $_POST['directorName'], $_POST['directorLastName'], $_POST['directorDateOfBirth'], $_POST['directorNacionality']);
                }
            }
            if(!$sendData) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <h1>Editar directores</h1>
                    </div>
                    <div class="col-12">
                        <form name="create_director" action="" method="POST">
                            <div class="mb-3">
                                <label for="directorName" class="form-label">Nombre del director</label>
                                <input id="directorName" name="directorName" type="text" placeholder="Introduzca el nombre del director" class="form-control" required value="<?php if(isset($directorObject)) echo $directorObject->getName(); ?>"/>
                                <label for="directorLastName" class="form-label">Apellido del director</label>
                                <input id="directorLastName" name="directorLastName" type="text" placeholder="Introduzca el apellido del director" class="form-control" required value="<?php if(isset($directorObject)) echo $directorObject->getLastName(); ?>"/>
                                <label for="directorDateOfBirth" class="form-label">Fecha de nacimiento del director</label>
                                <input id="directorDateOfBirth" name="directorDateOfBirth" type="date" max="<?=date('Y-m-d');?>" placeholder="Introduzca la fecha de nacimiento del director" class="form-control" required value="<?php if(isset($directorObject)) echo $directorObject->getDateOfBirth(); ?>"/>
                                <label for="directorNationality" class="form-label">Nacionalidad del director</label>
                                <input id="directorNationality" name="directorNacionality" type="text" placeholder="Introduzca la nacionalidad del director" class="form-control" required value="<?php if(isset($directorObject)) echo $directorObject->getNationality(); ?>"/>
                                <input type="hidden" name="directorId" value="<?php echo $idDirector; ?>"/>
                            </div>
                            <input type="submit" value="Editar" class="btn btn-primary" name="editBtn">
                        </form>
                    </div>
                </div>
                <?php
            } else {
                if($directorEdited) {
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Director editado correctamente.<br><a href="list.php">Volver al listado de directores</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El director no ha sido editado correctamente.<br><a href="edit.php?id=<?php echo $idDirector;?>">Volver a intentarlo</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>
