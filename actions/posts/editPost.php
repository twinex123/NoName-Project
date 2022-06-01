<?php

require('actions/config.php');

if(isset($_POST['modify'])){
    if(!empty($_POST['title']) AND !empty($_POST['content'])){

        $new_post_title = htmlspecialchars($_POST['title']);
        $new_post_content = nl2br(htmlspecialchars($_POST['content']));

        $editPost = $bdd->prepare("UPDATE questions SET title = ?, content = ? WHERE id = ?");
        $editPost->execute(array($new_post_title, $new_post_content, $idOfPost));

        header("Location: myposts.php");

    }else{
        $errorMsg = "All fields must be completed";
    }
}