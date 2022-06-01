<?php

require('actions/config.php');

$getQuestions = $bdd->prepare("SELECT id, title, content, publication_date FROM questions WHERE id_author = ? ORDER BY id DESC");
$getQuestions->execute(array($_SESSION['id']));