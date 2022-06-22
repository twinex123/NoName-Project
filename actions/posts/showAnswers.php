<?php

require("actions/config.php");

$getAnswers = $bdd->prepare("SELECT id, username_author, question_id, content, id_author, likes FROM answers WHERE question_id = ? ORDER BY likes DESC");
$getAnswers->execute(array($_GET["p"]));