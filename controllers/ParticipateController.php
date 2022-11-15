<?php
    require_once('../../models/Participate.php');

    function listParticipate($idSerie)
    {
        $mysqli = Conn();
        $participateObjectArray = [];
        if (isset($idSerie) and ctype_digit($idSerie)){
            $participateList = $mysqli->query("SELECT a.name_actor, a.last_name_actor FROM `participate` AS `p`, `serie` AS `s`, `actor` AS `a` WHERE p.id_actor=a.id_actor AND p.id_serie=s.id_serie AND p.id_serie=$idSerie");
            foreach ($participateList as $participateItem) {
                $participateObject = new Participate(null, null, $participateItem['name_actor'], $participateItem['last_name_actor']);
                array_push($participateObjectArray, $participateObject);
            }
        }
        $mysqli->close();
        return $participateObjectArray;
    }

    function storeParticipate ($idSerie, $idActor)
    {
        $mysqli = Conn();
        $participateCreated = false;
        if (isset($idSerie) and isset($idActor) and ctype_digit($idSerie) and ctype_digit($idActor)) {
            if ($mysqli->query("INSERT INTO `participate` (id_serie, id_actor) VALUES ('$idSerie', '$idActor')")) {
                $participateCreated = true;
            }
        }
        $mysqli->close();
        return $participateCreated;
    }

    function deleteParticipate ($serieId, $actorId)
    {
        $mysqli = Conn();
        $participateDelete = false;
        if (isset($serieId) and isset($actorId) and ctype_digit($serieId) and ctype_digit($actorId)) {
            if ($mysqli->query("DELETE FROM `participate` WHERE id_serie=$serieId AND id_actor=$actorId")) {
                $participateDelete = true;
            }
        }
        $mysqli->close();
        return $participateDelete;
    }

    function deleteParticipateSerie ($serieId)
    {
        $mysqli = Conn();
        $participateDelete = false;
        if (isset($serieId) and ctype_digit($serieId)) {
            if ($mysqli->query("DELETE FROM `participate` WHERE id_serie=$serieId")) {
                $participateDelete = true;
            }
        }
        $mysqli->close();
        return $participateDelete;
    }

    function findParticipateByIdSerie ($idSerie)
    {
        $mysqli = Conn();
        $participateObjectArray = [];
        if (isset($idSerie) and ctype_digit($idSerie)) {
            $participateList = $mysqli->query("SELECT  * FROM `participate` WHERE id_serie=$idSerie");
            foreach ($participateList as $participateItem) {
                $directObject = new Participate($participateItem['id_serie'], $participateItem['id_actor'], null, null);
                array_push($participateObjectArray, $directObject);
            }
        }
        $mysqli->close();
        return $participateObjectArray;
    }
?>