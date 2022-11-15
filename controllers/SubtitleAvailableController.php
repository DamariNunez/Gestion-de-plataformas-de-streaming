<?php
    require_once('../../models/SubtitleAvailable.php');

    function listSubtitleAvailables($idSerie)
    {
        $mysqli = Conn();
        $subtitleAvailableObjectArray = [];
        if (isset($idSerie) and ctype_digit($idSerie)) {
            $subtitleAvailableList = $mysqli->query("SELECT l.name_language FROM `languages` AS `l`, `subtitle_available` AS `a`, `serie` AS `s` WHERE l.id_language=a.id_language AND a.id_serie=s.id_serie AND a.id_serie=$idSerie");
            foreach ($subtitleAvailableList as $subtitleAvailableItem) {
                $subtitleAvailableObject = new SubtitleAvailable(null, null, $subtitleAvailableItem['name_language']);
                array_push($subtitleAvailableObjectArray, $subtitleAvailableObject);
            }
        }
        $mysqli->close();
        return $subtitleAvailableObjectArray;
    }

    function storeSubtitleAvailable ($idLanguage, $idSerie)
    {
        $mysqli = Conn();
        $subtitleAvailableCreated = false;
        if (isset($idLanguage) and isset($idSerie) and ctype_digit($idLanguage) and ctype_digit($idSerie)) {
            if ($mysqli->query("INSERT INTO `subtitle_available` (id_language, id_serie) VALUES ('$idLanguage', '$idSerie')")) {
                $subtitleAvailableCreated = true;
            }
        }
        $mysqli->close();
        return $subtitleAvailableCreated;
    }

    function deleteSubtitleAvailable ($languageId, $serieId)
    {
        $mysqli = Conn();
        $subtitleAvailableDelete = false;
        if (isset($languageId) and isset($serieId) and ctype_digit($languageId) and ctype_digit($serieId)) {
            if ($mysqli->query("DELETE FROM `subtitle_available` WHERE id_serie=$serieId AND id_language=$languageId")) {
                $subtitleAvailableDelete = true;
            }
        }
        $mysqli->close();
        return $subtitleAvailableDelete;
    }

    function deleteSubtitleAvailableSerie ($serieId)
    {
        $mysqli = Conn();
        $subtitleAvailableDelete = false;
        if (isset($serieId) and ctype_digit($serieId)) {
            if ($mysqli->query("DELETE FROM `subtitle_available` WHERE id_serie=$serieId")) {
                $subtitleAvailableDelete = true;
            }
        }
        $mysqli->close();
        return $subtitleAvailableDelete;
    }

    function findSubtitleAvailableByIdSerie ($idSerie)
    {
        $mysqli = Conn();
        $subtitleAvailableObjectArray = [];
        if (isset($idSerie) and ctype_digit($idSerie)) {
            $subtitleAvailableList = $mysqli->query("SELECT  * FROM `subtitle_available` WHERE id_serie=$idSerie");
            foreach ($subtitleAvailableList as $subtitleAvailableItem) {
                $subtitleAvailableObject = new SubtitleAvailable($subtitleAvailableItem['id_language'], $subtitleAvailableItem['id_serie'], null);
                array_push($subtitleAvailableObjectArray, $subtitleAvailableObject);
            }
        }
        $mysqli->close();
        return $subtitleAvailableObjectArray;
    }
?>
