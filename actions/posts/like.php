<?php

session_start();

$url = $_SERVER['PHP_SELF']; 
$reg = '#^(.+[\\\/])*([^\\\/]+)$#';
$url_courante = preg_replace($reg, '$2', $url);

if($url_courante != "channel.php"){

    require("../config.php");

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        http_response_code(403);
        die();
    }else{

        if(isset($_GET["t"], $_GET["id"]) AND !empty($_GET["t"]) AND !empty($_GET["id"])){

            $getId = (int)$_GET["id"];
            $getT = (int)$_GET["t"];

            $check = $bdd->prepare("SELECT id FROM questions WHERE id = ?");
            $check->execute(array($getId));

            if($check->rowCount() == 1){
                if($getT==1){
                    $ins = $bdd->prepare("INSERT INTO likes (id_article, id_membre) VALUES (?, ?)");
                    $ins->execute(array($getId, $_SESSION["id"]));
                }elseif($getT==2){
                    $ins = $bdd->prepare("INSERT INTO likes (id_article) VALUES (?)");
                    $ins->execute(array($getId));
                }
                header("Location: ".$_SERVER["HTTP_REFERER"]."");
            }else{
                exit("Erreur fatale");
            }

        }else{
            exit("Erreur fatale");
        }

    }

}else{
    require("actions/config.php");
}