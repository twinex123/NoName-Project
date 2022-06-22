<?php

session_start();
if(!isset($_SESSION['auth'])){
    header("Location: ../../login.php");
}

require("../config.php");

if(isset($_GET["id"]) AND !empty($_GET["id"])){
    
    $idOfChannel = $_GET["id"];
    
    $checkIfChannelExists = $bdd->prepare("SELECT id, channel_author FROM channels WHERE id = ?");
    $checkIfChannelExists->execute(array($idOfChannel));

    if($checkIfChannelExists->rowCount() > 0){

        $usersInfos = $checkIfChannelExists->fetch();
        if($usersInfos['channel_author'] == $_SESSION['username']){

            $deleteChannel = $bdd->prepare("DELETE FROM channels WHERE id = ?");
            $deleteChannel->execute(array($idOfChannel));

            header("Location: ../../room.php#channelDeleted");

        }else{
            echo "It's not your channel. Stay where you're allowed to...";
        }

    }else{
        echo "No channel found! [2]";
    }

}else{
    echo "No channel found! [1]";
}