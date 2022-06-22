<?php

session_start();
require('actions/config.php');

if(isset($_POST['submit'])){
    if(!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['repeat-password'])){
        
        $username = htmlspecialchars($_POST["username"]);
        
        if($_POST['password'] == $_POST['repeat-password']){
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $checkIfUserRegistered = $bdd->prepare("SELECT username FROM users WHERE username = ?");
            $checkIfUserRegistered->execute(array($username));

            if($checkIfUserRegistered->rowCount() == 0) {

                $insertUserOnWebsite = $bdd->prepare("INSERT INTO users (username, password, inscription_date, private) VALUES (?, ?, NOW() , ?);");
                $insertUserOnWebsite->execute(array($username, $password, "public"));
                
                $getInfosOfUsers = $bdd->prepare("SELECT * FROM users WHERE username = ?");
                $getInfosOfUsers->execute(array($username));

                $userInfos = $getInfosOfUsers->fetch();

                $_SESSION['auth'] = true;
                $_SESSION['id'] = $userInfos['id'];
                $_SESSION['username'] = $userInfos['username'];

                header("Location: room.php");

            }else{ 
                $errorMsg = "This user is already registered.";
            }
        }else{ 
            $errorMsg = "Passwords do not match.";
        }

    }else{
        $errorMsg = "All fields must be completed.";
    }
}