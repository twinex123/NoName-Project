<?php

session_start();
if(!isset($_SESSION['auth'])){
    header("Location: ../../login.php");
}

require("../config.php");

if(isset($_GET["id"]) AND !empty($_GET["id"])){
    
    $idOfPost = $_GET["id"];
    
    $checkIfPostExists = $bdd->prepare("SELECT id, id_author FROM questions WHERE id = ?");
    $checkIfPostExists->execute(array($idOfPost));

    if($checkIfPostExists->rowCount() > 0){

        $usersInfos = $checkIfPostExists->fetch();
        if($usersInfos['id_author'] == $_SESSION['id']){

            $deleteQuestion = $bdd->prepare("DELETE FROM questions WHERE id = ?");
            $deleteQuestion->execute(array($idOfPost));

            $deleteAnswers = $bdd->prepare("DELETE * FROM answers WHERE question_id = ?");
            $deleteAnswers->execute(array($idOfPost));

            header("Location: ".$_SERVER["HTTP_REFERER"]."");

        }else{
            echo "It's not your post. Stay where you're allowed to... <a href='../../room.php'>Redirection</a>";
        }

    }else{
        echo "No question found! [2]";
    }

}else{
    echo "No question found! [1]";
}