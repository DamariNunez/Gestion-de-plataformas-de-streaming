<?php
    require_once('../../models/Direct.php');

    function listDirect($idSerie)
    {
        $mysqli = Conn();
        $directObjectArray = [];
        if (isset($idSerie) and ctype_digit($idSerie)) {
            $directList = $mysqli->query("SELECT * FROM `direct` AS `d`, `serie` AS `s`, `director` AS `a` WHERE d.id_director=a.id_director AND d.id_serie=s.id_serie AND d.id_serie=$idSerie");
            foreach ($directList as $directItem) {
                $directObject = new Direct($directItem['id_director'], null, $directItem['name_director'], $directItem['last_name_director']);
                array_push($directObjectArray, $directObject);
            }
        }
        $mysqli->close();
        return $directObjectArray;
    }

    function storeDirect ($idDirector, $idSerie)
    {
        $mysqli = Conn();
        $directCreated = false;
        if (isset($idDirector) and isset($idSerie) and ctype_digit($idSerie) and ctype_digit($idDirector)) {
            if ($mysqli->query("INSERT INTO `direct` (id_director, id_serie) VALUES ('$idDirector', '$idSerie')")) {
                $directCreated = true;
            }
        }
        $mysqli->close();
        return $directCreated;
    }

    function deleteDirect ($serieId, $directorId)
    {
        $mysqli = Conn();
        $directDelete = false;
        if (isset($serieId) and isset($directorId) and ctype_digit($serieId) and ctype_digit($directorId)) {
            if ($mysqli->query("DELETE FROM `direct` WHERE id_serie=$serieId AND id_director=$directorId")) {
                $directDelete = true;
            }
        }
        $mysqli->close();
        return $directDelete;
    }

    function deleteDirectSerie ($serieId)
    {
        $mysqli = Conn();
        $directDelete = false;
        if (isset($serieId) and ctype_digit($serieId)) {
            if ($mysqli->query("DELETE FROM `direct` WHERE id_serie=$serieId")) {
                $directDelete = true;
            }
        }
        $mysqli->close();
        return $directDelete;
    }

    function findDirectByIdSerie ($idSerie)
    {
        $mysqli = Conn();
        $directObjectArray = [];
        if (isset($idSerie)  and ctype_digit($idSerie)) {
            $directList = $mysqli->query("SELECT  * FROM `direct` WHERE id_serie=$idSerie");
            foreach ($directList as $directItem) {
                $directObject = new Direct($directItem['id_director'], $directItem['id_serie'], null, null);
                array_push($directObjectArray, $directObject);
            }
        }
        $mysqli->close();
        return $directObjectArray;
    }
?>
