<?php

session_start();
require("../config.php");

if(!empty($_POST["answer"])){
        $user_answer = nl2br(htmlspecialchars($_POST["answer"]));
        $insertAnswer = $bdd->prepare("INSERT INTO answers(id_author, username_author, question_id, content, likes) VALUES(?, ?, ?, ?, ?)");
        $insertAnswer->execute(array($_SESSION["id"], $_SESSION["username"], $_POST["post_id"], $user_answer, "0"));

}
