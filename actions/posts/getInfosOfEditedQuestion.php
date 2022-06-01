<?php 


require('actions/config.php');

if(isset($_GET['id']) AND !empty($_GET['id'])){

    $idOfPost = $_GET['id'];

    $checkPostExists = $bdd->prepare("SELECT * FROM questions WHERE id = ?");
    $checkPostExists->execute(array($idOfPost));

    if($checkPostExists->rowCount() > 0){

        $postInfos = $checkPostExists->fetch();
        if($postInfos["id_author"] == $_SESSION["id"]){

            $postTitle = $postInfos["title"];
            $postContent = $postInfos["content"];
            $postDate = $postInfos["publication_date"];

            $postContent = str_replace("<br />", "", $postContent);

        }else{
            $errorMsg = "It's not your post, stay where you're allowed to";
        }

    }else{
        $errorMsg = "No post found!";
    }

}else{
    $errorMsg = "No post found!";
    
}