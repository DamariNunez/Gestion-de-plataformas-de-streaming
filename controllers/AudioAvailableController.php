<?php
    require_once('../../models/AudioAvailable.php');

    function listAudioAvailables($idSerie)
    {
        $mysqli = Conn();
        $audioAvailableObjectArray = [];
        if (isset($idSerie) and ctype_digit($idSerie)) {
            $audioAvailableList = $mysqli->query("SELECT l.name_language FROM `languages` AS `l`, `audio_available` AS `a`, `serie` AS `s` WHERE l.id_language=a.id_language AND a.id_serie=s.id_serie AND a.id_serie=$idSerie");
            foreach ($audioAvailableList as $audioAvailableItem) {
                $audioAvailableObject = new AudioAvailable(null, null, $audioAvailableItem['name_language']);
                array_push($audioAvailableObjectArray, $audioAvailableObject);
            }
        }
        $mysqli->close();
        return $audioAvailableObjectArray;
    }

    function storeAudioAvailable ($idLanguage, $idSerie)
    {
        $mysqli = Conn();
        $audioAvailableCreated = false;
        if (isset($idLanguage) and isset($idSerie) and ctype_digit($idLanguage) and ctype_digit($idSerie)) {
            if ($mysqli->query("INSERT INTO `audio_available` (id_language, id_serie) VALUES ('$idLanguage', '$idSerie')")) {
                $audioAvailableCreated = true;
            }
        }
        $mysqli->close();
        return $audioAvailableCreated;
    }

    function deleteAudioAvailable ($languageId, $serieId)
    {
        $mysqli = Conn();
        $audioAvailableDelete = false;
        if (isset($languageId) and isset($serieId) and ctype_digit($languageId) and ctype_digit($serieId)) {
            if ($mysqli->query("DELETE FROM `audio_available` WHERE id_serie=$serieId AND id_language=$languageId")) {
                $audioAvailableDelete = true;
            }
        }
        $mysqli->close();
        return $audioAvailableDelete;
    }

    function deleteAudioAvailableSerie ($serieId)
    {
        $mysqli = Conn();
        $audioAvailableDelete = false;
        if (isset($serieId) and ctype_digit($serieId)) {
            if ($mysqli->query("DELETE FROM `audio_available` WHERE id_serie=$serieId")) {
                $audioAvailableDelete = true;
            }
        }
        $mysqli->close();
        return $audioAvailableDelete;
    }

    function findAudioAvailableByIdSerie ($idSerie)
    {
        $mysqli = Conn();
        $audioAvailableObjectArray = [];
        if (isset($idSerie) and ctype_digit($idSerie)) {
            $audioAvailableList = $mysqli->query("SELECT  * FROM `audio_available` WHERE id_serie=$idSerie");
            foreach ($audioAvailableList as $audioAvailableItem) {
                $audioAvailableObject = new AudioAvailable($audioAvailableItem['id_language'], $audioAvailableItem['id_serie'], null);
                array_push($audioAvailableObjectArray, $audioAvailableObject);
            }
        }
        $mysqli->close();
        return $audioAvailableObjectArray;
    }
?>
