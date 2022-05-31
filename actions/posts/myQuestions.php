<?php

require('actions/config.php');

$getQuestions = $bdd->prepare("SELECT id, title, content, publication_date FROM questions WHERE id_author = ?");
$getQuestions->execute(array($_SESSION['id']));