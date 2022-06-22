<?php

require('actions/config.php');

$getChannels = $bdd->query('SELECT id, channel_name, channel_author, creation_date FROM channels ORDER BY id DESC');

if(isset($_GET["search"]) AND !empty($_GET["search"])){

    $usersSearch = $_GET["search"];

    $getChannels = $bdd->query('SELECT id, channel_name, channel_author, creation_date FROM channels WHERE channel_name LIKE "%'. $usersSearch .'%" ORDER BY id DESC');
    
}