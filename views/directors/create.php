<?php
    require_once('../../controllers/SerieController.php');
    require_once('../../controllers/DirectorController.php');
    include('../../menu.html');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../estilo.css">
        <title>Crear directores</title>
    </head>
    <body>
        <div class="container">
            <?php
            $sendData = false;
            $directorCreated = false;
            if(isset($_POST['createBtn']))
            {
                $sendData = true;
            }
            if($sendData)
            {
                if(isset($_POST['directorName']) and isset($_POST['directorLastName']) and isset($_POST['directorDateOfBirth']) and isset($_POST['directorNacionality']))
                {
                    $directorCreated = storeDirector($_POST['directorName'], $_POST['directorLastName'], $_POST['directorDateOfBirth'], $_POST['directorNacionality']);
                }
            }
            if(!$sendData){
                ?>
                <div class="row">
                    <div class="col-12">
                        <h1>Crear directores</h1>
                    </div>
                    <div class="col-12">
                        <form name="create_director" action="" method="POST">
                            <div class="mb-3">
                                <label for="directorName" class="form-label">Nombre del director</label>
                                <input id="directorName" name="directorName" type="text" placeholder="Introduzca el nombre del director" class="form-control" required/>
                                <label for="directorLastName" class="form-label">Apellido del director</label>
                                <input id="directorLastName" name="directorLastName" type="text" placeholder="Introduzca el apellido del director" class="form-control" required/>
                                <label for="directorDateOfBirth" class="form-label">Fecha de nacimiento del director</label>
                                <input id="directorDateOfBirth" name="directorDateOfBirth" type="date" max="<?=date('Y-m-d');?>" placeholder="Introduzca la fecha de nacimiento del director" class="form-control" required/>
                                <label for="directorNationality" class="form-label">Nacionalidad del director</label>
                                <input id="directorNationality" name="directorNacionality" type="text" placeholder="Introduzca la nacionalidad del director" class="form-control" required/>
                            </div>
                            <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
                        </form>
                    </div>
                </div>
                <?php
            } else {
                if($directorCreated){
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Director creado correctamente.<br><a href="list.php">Volver al listado de directores</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El director no se ha creado correctamente. No pueden existir dos directores con la misma información.<br><a href="create.php">Volver a intentarlo</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>