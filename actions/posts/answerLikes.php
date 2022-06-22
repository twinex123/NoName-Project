<?php

session_start();

require("../config.php");

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        http_response_code(403);
        die();
    }else{

        if(isset($_GET["id"]) AND !empty($_GET["id"])){

            $idAnswer = (int)$_GET["id"];
            $idUser = (int)$_SESSION["id"];

            $check = $bdd->prepare("SELECT * FROM answers WHERE id = ?");
            $check->execute(array($idAnswer));

            $Check = $check->fetch();

            if($check->rowCount() > 0){
                
                $ifAlreadyRated = $bdd->prepare("SELECT id FROM answers_rating WHERE user_id = ? AND answer_id = ?");
                $ifAlreadyRated->execute(array($_SESSION["id"], $_GET["id"]));

                if($ifAlreadyRated->rowCount() > 0){
                   
                    $deleteLike = $bdd->prepare("UPDATE answers SET likes = likes - ? WHERE id = ?");
                    $deleteLike->execute(array("1", $_GET["id"]));
                    $deleteRating = $bdd->prepare("DELETE FROM answers_rating WHERE user_id = ? AND answer_id = ?");
                    $deleteRating->execute(array($_SESSION["id"], $_GET["id"]));

                    header("Location: ".$_SERVER["HTTP_REFERER"]."");

                }else{
                    $insertLike = $bdd->prepare("UPDATE answers SET likes = likes + ? WHERE id = ?");
                    $insertLike->execute(array("1", $_GET["id"]));
                    $insertRating = $bdd->prepare("INSERT INTO answers_rating(username, user_id, answer_id) VALUES(?, ?, ?)");
                    $insertRating->execute(array($_SESSION["username"], $_SESSION["id"], $_GET["id"]));

                    header("Location: ".$_SERVER["HTTP_REFERER"]."");

                }

            }else{
                echo "error: " . $check->error;
            }

        }else{
            exit("Erreur fatale");
        }

    }