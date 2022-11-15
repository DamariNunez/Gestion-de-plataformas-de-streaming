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
        <title>Listado de actores</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Listado de actores</h1>
                </div>
                <div class="col-6">
                    <a class="btn btn-primary" href="create.php">+ Crear actor</a>
                </div>
                <div class="col-12">
                    <?php
                    $actorList = listActors();
                    if (count($actorList) > 0) {
                        ?>
                        <table class="table">
                            <thead>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Fecha de nacimiento</th>
                            <th>Nacionalidad</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($actorList as $actor) {
                                ?>
                                <tr>
                                    <td><?php echo $actor->getId();?></td>
                                    <td><?php echo $actor->getName();?></td>
                                    <td><?php echo $actor->getLastName();?></td>
                                    <td><?php echo $actor->getDateOfBirth();?></td>
                                    <td><?php echo $actor->getNationality();?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Actor">
                                            <a class="btn btn-success" href="edit.php?id=<?php echo $actor->getId();?>">Editar</a>
                                            &nbsp;&nbsp;
                                            <form name="delete_actor" action="delete.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="actorId" value="<?php echo $actor->getId();?>" />
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
                            Aún no existen actores
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>