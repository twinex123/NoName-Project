<?php

error_reporting(E_ALL ^ E_NOTICE);  
require("actions/config.php");

if(isset($_POST['create'])){
    if(!empty($_POST['title'])){

        $title = htmlspecialchars($_POST['title']);

        ?><script>alert("1")</script><?php
      
        $date = date("d/m/Y");
        $question_id_author = $_SESSION['id'];
        $question_username_author = $_SESSION['username'];

        ?><script>alert("2")</script><?php

        $insertChannel = $bdd->prepare("INSERT INTO channels (channel_name,channel_author,creation_date) VALUES (?, ?, ?)");
        $insertChannel->execute(
            array(
                $title, 
                $question_username_author,
                $date
            )
        );
        
        ?><script>alert("3")</script><?php

        header("Location: room.php#succesCreate");

    }else{
        $errorMsg = "All fields must be completed";
    }
}