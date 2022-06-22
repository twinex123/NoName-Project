<?php

session_start();
require("actions/config.php");

if(isset($_GET["pass"]) AND !empty($_GET["pass"])){
    if($_GET["pass"] == "private"){
        $updateStatus = $bdd->prepare("UPDATE users SET private = ? WHERE id = ?");
        $updateStatus->execute(array("private", $_SESSION["id"]));
        echo "Change to private";
    }else{
        $updateStatus = $bdd->prepare("UPDATE users SET private = ? WHERE id = ?");
        $updateStatus->execute(array("public", $_SESSION["id"]));
        echo "Change to public";
    }
}else{
    echo "No parameters found!";
}
