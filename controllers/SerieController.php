<?php
    require_once('../../models/Serie.php');
    require('../../models/Connection.php');

    function Conn(){
        $conn = new Connection();
        $mysqli = $conn->initConnectionDB();
        return $mysqli;
    }

    function listSeriesNamePlatform()
    {
        $mysqli = Conn();
        $serieList = $mysqli->query("SELECT s.id_serie, s.title, s.id_platform, p.name_platform FROM `serie` AS `s`, `platform` AS `p` WHERE s.id_platform=p.id_platform");
        $serieObjectArray = [];
        foreach ($serieList as $serieItem) {
            $serieObject = new Serie($serieItem['id_serie'], $serieItem['title'], $serieItem['id_platform'], $serieItem['name_platform']);
            array_push($serieObjectArray, $serieObject);
        }
        $mysqli->close();
        return $serieObjectArray;
    }

    function getSerieData ($idSerie)
    {
        $mysqli = Conn();
        $serieObject = null;
        if (isset($idSerie) and ctype_digit($idSerie)) {
            $serieData = $mysqli->query("SElECT * FROM `serie` WHERE id_serie=$idSerie");
            foreach ($serieData as $serieItem) {
                $serieObject = new Serie($serieItem['id_serie'], $serieItem['title'],
                    $serieItem['id_platform'], null);
                break;
            }
        }
        $mysqli->close();
        return $serieObject;
    }

    function storeSerie ($title, $idPlatform)
    {
        $mysqli = Conn();
        $serieCreated = false;
        if (isset($title) and isset($idPlatform) and is_string($title) and ctype_digit($idPlatform)) {
            //TODO: Comprobar que no exista una serie con los mismos datos
            $resultadoList = $mysqli->query("SELECT * FROM `serie` WHERE title='$title' AND id_platform='$idPlatform'");
            if (!(mysqli_num_rows($resultadoList) > 0)) {
                if ($mysqli->query("INSERT INTO `serie` (title, id_platform) VALUES ('$title', '$idPlatform')")) {
                    $serieCreated = true;
                }
            }
        }
        $mysqli->close();
        return $serieCreated;
    }

    function updateSerie ($serieId, $title, $idPlatform)
    {
        $mysqli = Conn();
        $serieEdited = false;
        if (isset($serieId) and isset($title) and isset($idPlatform) and ctype_digit($serieId) and is_string($title) and ctype_digit($idPlatform))
            $resultadoList = $mysqli->query("SELECT * FROM `serie` WHERE id_serie=$serieId");
            if (mysqli_num_rows($resultadoList) > 0) {
                if ($mysqli->query("UPDATE `serie` SET title='$title', id_platform='$idPlatform' WHERE id_serie=$serieId")) {
                    $serieEdited = true;
                }
            }
        $mysqli->close();
        return $serieEdited;
    }

    function deleteSerie ($serieId)
    {
        $mysqli = Conn();
        $serieDelete = false;
        if (isset($serieId) and ctype_digit($serieId)) {
            $resultadoList = $mysqli->query("SELECT * FROM `serie` WHERE id_serie=$serieId");
            if (mysqli_num_rows($resultadoList) > 0) {
                if ($mysqli->query("DELETE FROM `serie` WHERE id_serie=$serieId")) {
                    $serieDelete = true;
                }
            }
        }
        $mysqli->close();
        return $serieDelete;
    }

    function findMaxIdSerie ()
    {
        $mysqli = Conn();
        $serieData = $mysqli->query("SELECT MAX(id_serie) AS id_serie FROM `serie`");
        $serieObject = null;
        foreach ($serieData as $serieItem)
        {
            $serieObject = new Serie($serieItem['id_serie'], null, null, null);
            break;
        }
        $mysqli->close();
        return $serieObject;
    }

    //Validar fecha en formato español
    function validateDate($date){
        $val = explode('-', $date);
        if(count($val) == 3 and checkdate($val[1], $val[2], $val[0])){
            return true;
        }
        return false;
    }
?>
