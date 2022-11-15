<?php
    require_once('../../models/Language.php');

    function listLanguages()
    {
        $mysqli = Conn();
        $languageList = $mysqli->query("SELECT * FROM `languages`");
        $languageObjectArray = [];
        foreach ($languageList as $languageItem) {
            $languageObject = new Language($languageItem['id_language'], $languageItem['name_language'],
                $languageItem['iso_code']);
            array_push($languageObjectArray, $languageObject);
        }
        $mysqli->close();
        return $languageObjectArray;
    }

    function getLanguageData ($idLanguage)
    {
        $mysqli = Conn();
        $languageObject = null;
        if (isset($idLanguage) and ctype_digit($idLanguage)) {
            $languageData = $mysqli->query("SElECT * FROM `languages` WHERE id_language=$idLanguage");
            foreach ($languageData as $languageItem) {
                $languageObject = new Language($languageItem['id_language'], $languageItem['name_language'],
                    $languageItem['iso_code']);
                break;
            }
        }
        $mysqli->close();
        return $languageObject;
    }

    function storeLanguage ($languageName, $isoCode)
    {
        $mysqli = Conn();
        $languageCreated = false;
        if(isset($languageName) and isset($isoCode) and is_string($languageName) and is_string($isoCode))
            //TODO: Comprobar que no exista un lenguaje con los mismos datos
            $resultadoList = $mysqli->query("SELECT * FROM `languages` WHERE name_language='$languageName' AND iso_code='$isoCode'");
            if (!(mysqli_num_rows($resultadoList) > 0)) {
                if ($mysqli->query("INSERT INTO `languages` (name_language, iso_code) VALUES ('$languageName', '$isoCode')")) {
                    $languageCreated = true;
                }
            }
        $mysqli->close();
        return $languageCreated;
    }

    function updateLanguage ($languageId, $languageName, $isoCode)
    {
        $mysqli = Conn();
        $languageEdited = false;
        if (isset($languageId) and isset($languageName) and isset($isoCode) and ctype_digit($languageId))
            $resultadoList = $mysqli->query("SELECT * FROM `languages` WHERE id_language=$languageId");
            if ( mysqli_num_rows($resultadoList) > 0 and is_string($languageName) and is_string($isoCode)) {
                if ($mysqli->query("UPDATE `languages` SET name_language='$languageName',
                                   iso_code='$isoCode' WHERE id_language=$languageId")) {
                    $languageEdited = true;
                }
            }
        $mysqli->close();
        return $languageEdited;
    }

    function deleteLanguage ($languageId)
    {
        $mysqli = Conn();
        $languageDelete = false;
        if (isset($languageId) and ctype_digit($languageId)) {
            $resultadoList = $mysqli->query("SELECT * FROM `languages` WHERE id_language=$languageId");
            if (mysqli_num_rows($resultadoList) > 0) {
                if ($mysqli->query("DELETE FROM `languages` WHERE id_language=$languageId")) {
                    $languageDelete = true;
                }
            }
        }
        $mysqli->close();
        return $languageDelete;
    }

    function findLanguageByName ($languageName)
    {
        $mysqli = Conn();
        $languageObject = null;
        if (isset($languageName) and is_string($languageName)) {
            $languageData = $mysqli->query("SElECT * FROM `languages` WHERE name_language='$languageName'");
            foreach ($languageData as $languageItem) {
                $languageObject = new Language($languageItem['id_language'], $languageItem['name_language'],
                    $languageItem['iso_code']);
                break;
            }
        }
        $mysqli->close();
        return $languageObject;
    }
?>
