<?php

require("actions/config.php");

if(isset($_POST["changeusername"])){
    if(!empty($_POST['newusername'])){
        
        $username = htmlspecialchars($_POST["newusername"]);
        
        $checkIfUserRegistered = $bdd->prepare("SELECT username FROM users WHERE username = ?");
        $checkIfUserRegistered->execute(array($username));

        if($checkIfUserRegistered->rowCount() == 0) {

            $insertUserOnWebsite = $bdd->prepare("UPDATE users SET username = ? WHERE id = ?");
            $insertUserOnWebsite->execute(array($username, $_SESSION['id']));;
                
            $getInfosOfUsers = $bdd->prepare("SELECT * FROM users WHERE username = ?");
            $getInfosOfUsers->execute(array($username));

            $userInfos = $getInfosOfUsers->fetch();

            $_SESSION['username'] = $userInfos['username'];

            header("Location: #");

        }else{ 
            $errorMsg = "This user is already registered.";
        }
       

    }else{
        $errorMsg = "All fields must be completed.";
    }
}