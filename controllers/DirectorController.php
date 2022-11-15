<?php
    require_once('../../models/Director.php');

    function listDirectors()
    {
        $mysqli = Conn();
        $directorList = $mysqli->query("SELECT id_director, name_director, last_name_director, date_format(date_of_birth_director, '%d/%m/%Y') as date_of_birth_director, nacionality_director FROM director");
        $directorObjectArray = [];
        foreach ($directorList as $directorItem) {
            $directorObject = new Director($directorItem['id_director'], $directorItem['name_director'],
                $directorItem['last_name_director'], $directorItem['date_of_birth_director'],
                $directorItem['nacionality_director']);
            array_push($directorObjectArray, $directorObject);
        }
        $mysqli->close();
        return $directorObjectArray;
    }

    function getDirectorData ($idDirector)
    {
        $mysqli = Conn();
        $directorObject = null;
        if (isset($idDirector) and ctype_digit($idDirector)) {
            $directorData = $mysqli->query("SElECT * FROM `director` WHERE id_director=$idDirector");
            foreach ($directorData as $directorItem) {
                $directorObject = new Director($directorItem['id_director'], $directorItem['name_director'],
                    $directorItem['last_name_director'], $directorItem['date_of_birth_director'],
                    $directorItem['nacionality_director']);
                break;
            }
        }
        $mysqli->close();
        return $directorObject;
    }

    function storeDirector ($directorName, $directorLastName, $directorDateOfBirth, $directorNacionality)
    {
        $mysqli = Conn();
        $directorCreated = false;
        if (isset($directorName) and isset($directorLastName) and isset($directorDateOfBirth) and isset($directorNacionality)){
            if (validateDate($directorDateOfBirth) and is_string($directorName) and is_string($directorLastName) and is_string($directorNacionality)) {
                $resultadoList = $mysqli->query("SELECT * FROM `director` WHERE name_director='$directorName' AND last_name_director='$directorLastName' AND date_of_birth_director='$directorDateOfBirth' AND nacionality_director='$directorNacionality'");
            }
            //TODO: Comprobar que no exista un director con los mismos datos
            if (!(mysqli_num_rows($resultadoList) > 0)) {
                if ($mysqli->query("INSERT INTO `director` (name_director, last_name_director, 
                                date_of_birth_director, nacionality_director) VALUES ('$directorName', '$directorLastName',
                                '$directorDateOfBirth','$directorNacionality')")) {
                    $directorCreated = true;
                }
            }
        }
        $mysqli->close();
        return $directorCreated;
    }

    function updateDirector ($directorId, $directorName, $directorLastName, $directorDateOfBirth, $directorNacionality)
    {
        $mysqli = Conn();
        $directorEdited = false;
        if (isset($directorId) and isset($directorName) and isset($directorLastName) and isset($directorDateOfBirth) and isset($directorNacionality) and ctype_digit($directorId)) {
            $resultadoList = $mysqli->query("SELECT * FROM `director` WHERE id_director=$directorId");
            if (validateDate($directorDateOfBirth) and mysqli_num_rows($resultadoList) > 0 and is_string($directorName) and is_string($directorLastName) and is_string($directorNacionality)) {
                if ($mysqli->query("UPDATE `director` SET name_director='$directorName',
                               last_name_director='$directorLastName', date_of_birth_director='$directorDateOfBirth',
                               nacionality_director='$directorNacionality' WHERE id_director=$directorId")) {
                    $directorEdited = true;
                }
            }
        }
        $mysqli->close();
        return $directorEdited;
    }

    function deleteDirector ($directorId)
    {
        $mysqli = Conn();
        $directorDelete = false;
        if (isset($directorId) and ctype_digit($directorId)){
            $resultadoList = $mysqli->query("SELECT * FROM `director` WHERE id_director=$directorId");
            if (mysqli_num_rows($resultadoList) > 0) {
                if ($mysqli->query("DELETE FROM `director` WHERE id_director=$directorId")) {
                    $directorDelete = true;
                }
            }
        }
        $mysqli->close();
        return $directorDelete;
    }

    function findDirectorByName ($directorName, $directorLastName)
    {
        $mysqli = Conn();
        $directorObject = null;
        if (isset($directorName) and isset($directorLastName) and is_string($directorName) and is_string($directorLastName)) {
            $directorData = $mysqli->query("SELECT * FROM `director` WHERE name_director='$directorName' AND last_name_director='$directorLastName'");
            foreach ($directorData as $directorItem) {
                $directorObject = new Director($directorItem['id_director'], $directorItem['name_director'],
                    $directorItem['last_name_director'], $directorItem['date_of_birth_director'],
                    $directorItem['nacionality_director']);
                break;
            }
        }
        $mysqli->close();
        return $directorObject;
    }
?>