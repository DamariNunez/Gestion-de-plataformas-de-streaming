<?php
    require_once('../../models/Actor.php');

    function listActors()
    {
        $mysqli = Conn();
        $actorList = $mysqli->query("SELECT id_actor, name_actor, last_name_actor, date_format(date_of_birth_actor, '%d/%m/%Y') AS date_of_birth_actor, nacionality_actor FROM actor");
        $actorObjectArray = [];
        foreach ($actorList as $actorItem) {
            $actorObject = new Actor($actorItem['id_actor'], $actorItem['name_actor'],
                $actorItem['last_name_actor'], $actorItem['date_of_birth_actor'], $actorItem['nacionality_actor']);
            array_push($actorObjectArray, $actorObject);
        }
        $mysqli->close();
        return $actorObjectArray;
    }

    function getActorData ($idActor)
    {
        $mysqli = Conn();
        $actorObject = null;
        if (isset($idActor) and ctype_digit($idActor)) {
            $actorData = $mysqli->query("SElECT * FROM `actor` WHERE id_actor=$idActor");
            foreach ($actorData as $actorItem) {
                $actorObject = new Actor($actorItem['id_actor'], $actorItem['name_actor'],
                    $actorItem['last_name_actor'], $actorItem['date_of_birth_actor'], $actorItem['nacionality_actor']);
                break;
            }
        }
        $mysqli->close();
        return $actorObject;
    }

    function storeActor ($actorName, $actorLastName, $actorDateOfBirth, $actorNacionality)
    {
        $mysqli = Conn();
        $actorCreated = false;
        if (isset($actorName) and isset($actorLastName) and isset($actorDateOfBirth) and isset($actorNacionality)) {
            if (validateDate($actorDateOfBirth) and is_string($actorName) and is_string($actorLastName) and is_string($actorNacionality)) {
                $resultadoList = $mysqli->query("SELECT * FROM `actor` WHERE name_actor='$actorName' AND last_name_actor='$actorLastName' AND date_of_birth_actor='$actorDateOfBirth' AND nacionality_actor='$actorNacionality'");
            }
            //TODO: Comprobar que no exista un actor con los mismos datos
            if (!(mysqli_num_rows($resultadoList) > 0)) {
                if ($mysqli->query("INSERT INTO `actor` (name_actor, last_name_actor, date_of_birth_actor, nacionality_actor) VALUES ('$actorName', '$actorLastName', '$actorDateOfBirth','$actorNacionality')")) {
                    $actorCreated = true;
                }
            }
        }
        $mysqli->close();
        return $actorCreated;
    }

    function updateActor ($actorId, $actorName, $actorLastName, $actorDateOfBirth, $actorNacionality)
    {
        $mysqli = Conn();
        $actorEdited = false;
        if (isset($actorId) and isset($actorName) and isset($actorLastName) and isset($actorDateOfBirth) and isset($actorNacionality) and ctype_digit($actorId)) {
            $resultadoList = $mysqli->query("SELECT * FROM `actor` WHERE id_actor=$actorId");
            if (validateDate($actorDateOfBirth) and mysqli_num_rows($resultadoList) > 0 and is_string($actorName) and is_string($actorLastName) and is_string($actorNacionality)) {
                if ($mysqli->query("UPDATE `actor` SET name_actor='$actorName',
                           last_name_actor='$actorLastName', date_of_birth_actor='$actorDateOfBirth',
                           nacionality_actor='$actorNacionality' WHERE id_actor=$actorId")) {
                    $actorEdited = true;
                }
            }
        }
        $mysqli->close();
        return $actorEdited;
    }

    function deleteActor ($actorId)
    {
        $mysqli = Conn();
        $actorDelete = false;
        if (isset($actorId) and ctype_digit($actorId))
            $resultadoList = $mysqli->query("SELECT * FROM `actor` WHERE id_actor=$actorId");
            if (mysqli_num_rows($resultadoList) > 0) {
                if ($mysqli->query("DELETE FROM `actor` WHERE id_actor=$actorId")) {
                    $actorDelete = true;
                }
            }
        $mysqli->close();
        return $actorDelete;
    }

    function findActorByName ($actorName, $actorLastName)
    {
        $mysqli = Conn();
        $actorObject = null;
        if (isset($actorName) and isset($actorLastName) and is_string($actorName) and is_string($actorLastName)) {
            $actorData = $mysqli->query("SElECT * FROM `actor` WHERE name_actor='$actorName' AND last_name_actor='$actorLastName'");
            foreach ($actorData as $actorItem) {
                $actorObject = new Actor($actorItem['id_actor'], $actorItem['name_actor'],
                    $actorItem['last_name_actor'], $actorItem['date_of_birth_actor'], $actorItem['nacionality_actor']);
                break;
            }
        }
        $mysqli->close();
        return $actorObject;
    }
?>