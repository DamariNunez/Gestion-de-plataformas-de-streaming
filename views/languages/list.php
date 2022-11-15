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
        <title>Listado de idiomas</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Listado de idiomas</h1>
                </div>
                <div class="col-6">
                    <a class="btn btn-primary" href="create.php">+ Crear idioma</a>
                </div>
                <div class="col-12">
                    <?php
                    $languageList = listLanguages();
                    if (count($languageList) > 0) {
                        ?>
                        <table class="table">
                            <thead>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>ISO Code</th>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($languageList as $language) {
                                ?>
                                <tr>
                                    <td><?php echo $language->getId();?></td>
                                    <td><?php echo $language->getName();?></td>
                                    <td><?php echo $language->getIsoCode();?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Language">
                                            <a class="btn btn-success" href="edit.php?id=<?php echo $language->getId();?>">Editar</a>
                                            &nbsp;&nbsp;
                                            <form name="delete_language" action="delete.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="languageId" value="<?php echo $language->getId();?>" />
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
                            Aún no existen idiomas
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
