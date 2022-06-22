<?php

require("actions/config.php");

if(isset($_GET['c']) AND !empty($_GET['c'])){

    $checkIfChannelExists = $bdd->prepare('SELECT * FROM channels WHERE channel_name = ?');
    $checkIfChannelExists->execute(array($_GET['c']));

    if($checkIfChannelExists->rowCount() != 0){

        $getPostsChannel = $bdd->prepare("SELECT id, title, content, publication_date, likes, dislikes FROM questions WHERE channel = ? ORDER BY id DESC");
        $getPostsChannel->execute(array($_GET['c']));
    
    }else{
        header('Location: room.php');
    }

}else{
    header('Location: room.php');
}