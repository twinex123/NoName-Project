<?php

error_reporting(E_ALL ^ E_NOTICE);  
require("actions/config.php");

if(isset($_POST['publish'])){
    if(!empty($_POST['title']) AND !empty($_POST['content']) AND !empty($_POST['select_channel'])){

        $title = htmlspecialchars($_POST['title']);
        $content = nl2br(htmlspecialchars($_POST['content']));
        $channel = htmlspecialchars($_POST['select_channel']);

        $date = date("d/m/Y");
        $question_id_author = $_SESSION['id'];
        $question_username_author = $_SESSION['username'];

        $insertQuestion = $bdd->prepare("INSERT INTO questions (title,content,id_author,username_author, publication_date, channel, likes, dislikes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insertQuestion->execute(
            array(
                $title, 
                $content, 
                $question_id_author, 
                $question_username_author, 
                $date,
                $channel,
                "0",
                "0"
            )
        );

        $succesMsg = "Successfully published your post!";

        header("Location: room.php");

    }else{
        $errorMsg = "All fields must be completed";
    }
}