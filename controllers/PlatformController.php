<?php
    require_once('../../models/Platform.php');

    function listPlatforms()
    {
        $mysqli = Conn();
        $platformList = $mysqli->query("SELECT * FROM `platform` ORDER BY id_platform ASC");
        $platformObjectArray = [];
        foreach ($platformList as $platformItem) {
            $platformObject = new Platform($platformItem['id_platform'], $platformItem['name_platform']);
            array_push($platformObjectArray, $platformObject);
        }
        $mysqli->close();
        return $platformObjectArray;
    }

    function getPlatformData ($idPlatform)
    {
        $mysqli = Conn();
        $platformObject = null;
        if (isset($idPlatform) and ctype_digit($idPlatform)) {
            $platformData = $mysqli->query("SElECT * FROM `platform` WHERE id_platform=$idPlatform");
            foreach ($platformData as $platformItem) {
                $platformObject = new Platform($platformItem['id_platform'], $platformItem['name_platform']);
                break;
            }
        }
        $mysqli->close();
        return $platformObject;
    }

    function storePlatform ($platformName)
    {
        $mysqli = Conn();
        $platformCreated = false;
        if (isset($platformName) and is_string($platformName)) {
            //TODO: Comprobar que no exista una plataforma con el mismo nombre
            $resultadoList = $mysqli->query("SELECT * FROM `platform` WHERE name_platform='$platformName'");
            if (!(mysqli_num_rows($resultadoList) > 0)) {
                if ($mysqli->query("INSERT INTO `platform` (name_platform) VALUES ('$platformName')")) {
                    $platformCreated = true;
                }
            }
        }
        $mysqli->close();
        return $platformCreated;
    }

    function updatePlatform ($platformId, $platformName)
    {
        $mysqli = Conn();
        $platformEdited = false;
        if (isset($platformId) and isset($platformName) and ctype_digit($platformId) and is_string($platformName)) {
            $resultadoList = $mysqli->query("SELECT * FROM `platform` WHERE id_platform=$platformId");
            if (mysqli_num_rows($resultadoList) > 0) {
                if ($mysqli->query("UPDATE `platform` SET name_platform='$platformName' WHERE id_platform=$platformId")) {
                    $platformEdited = true;
                }
            }
        }
        $mysqli->close();
        return $platformEdited;
    }

    function deletePlatform ($platformId)
    {
        $mysqli = Conn();
        $platformDelete = false;
        if (isset($platformId) and ctype_digit($platformId)) {
            $resultadoList = $mysqli->query("SELECT * FROM `platform` WHERE id_platform=$platformId");
            if (mysqli_num_rows($resultadoList) > 0) {
                if ($mysqli->query("DELETE FROM `platform` WHERE id_platform=$platformId")) {
                    $platformDelete = true;
                }
            }
        }
        $mysqli->close();
        return $platformDelete;
    }

    function findPlatformByName ($platformName)
    {
        $mysqli = Conn();
        $platformObject = null;
        if (isset($platformName) and is_string($platformName)) {
            $platformData = $mysqli->query("SElECT * FROM `platform` WHERE name_platform='$platformName'");
            foreach ($platformData as $platformItem) {
                $platformObject = new Platform($platformItem['id_platform'], $platformItem['name_platform']);
                break;
            }
        }
        $mysqli->close();
        return $platformObject;
    }
?>