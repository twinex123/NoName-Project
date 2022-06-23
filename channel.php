<?php
require("actions/users/securityAction.php");
require("actions/channels/general.php");

error_reporting(E_ALL ^ E_NOTICE);  

require("actions/posts/like.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_GET['c']; ?> | NoName</title>
    <link rel="stylesheet" href="assets/css/posts.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/29ce918257.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/channel.css">
</head>
<body>
    <style>
        .User a{
            color: white;
        }
        .readMore .addText{
            display: none;
        }
        .lire-plus{
            color: #F05454;
        }
    </style>

    <?php include 'includes/navbar.php'; ?>

    <div class="content">
        
        <h1 class="title-post"><!--Room--> <?php echo $_GET['c']; ?></h1>
        <?php
        require("actions/config.php");

        $req = $bdd->prepare("SELECT * FROM channels WHERE channel_name = ?");
        $req->execute(array($_GET["c"]));

        $res = $req->fetch();

        ?>
        <div class="desc">Created by <?= "<a style='text-decoration: underline; color: #F05454; cursor: pointer;'>".$res['channel_author']."</a>"; ?></div>
        <?php
        if($res["channel_author"] == $_SESSION["username"]){
            ?>
            <button style="border: 1px solid #F05454; padding: 10px 15px; margin-top: 10px; color: #F05454; background-color: transparent; border-radius: 5px;" onclick="window.location.href='actions/channels/deleteChannel.php?id=<?= $res['id']; ?>'">Delete the channel</button>
            <?php
        }
        ?>
        <div class="addPost">
            <div class="addPost-title">
                <p onclick="window.location.href='publish.php?v=<?= $_GET['c']; ?>'">Add a post</p>
            </div>
        </div>
        <div class="posts">
            <?php
            $vote = false;
            while($post = $getPostsChannel->fetch()){

                $likes = $bdd->prepare("SELECT id FROM likes WHERE id_article=?");
                $likes->execute(array($post["id"]));

                $likes = $likes->rowCount();

                $dislikes = $bdd->prepare("SELECT id FROM likes WHERE id_article=?");
                $dislikes->execute(array($post["id"]));

                $dislikes = $dislikes->rowCount();
                ?>
                <div class="card">
                    <div class="head" onclick="window.location.href='post.php?p=<?= $post['id'] ?>'">
                        <div class="title">
                            <?= $post['title']; ?>
                        </div>
                        <div class="date">
                            <?= ", ".$post['publication_date']; ?>
                        </div>
                    </div>
                    <div class="content-card" onclick="window.location.href='post.php?p=<?= $post['id'] ?>'">
                        <?= "<div class='readMore'>" . $post['content'] . "</div>"; ?>
                    </div>
                    <div class="footer-card">
                        <div class="vote <?php if($vote["vote"] == "1"){echo "is-liked";}elseif($vote["vote"] == "-1"){echo "is-disliked";} ?>">
                            <div class="vote_bar">
                                <div class="vote_progress" style="width:<?= ($post["likes"] + $post["dislikes"]) == 0 ? 100 : round(100 * ($post["likes"] / ($post["likes"] + $post["dislikes"])))?>%"></div>
                            </div>
                            <div class="vote_btns">
                                <form action="actions/posts/like.php?t=1&id=<?= $post["id"]; ?>" method="post">
                                    <button type="submit" class="vote_btn vote_like"><i class="fa-solid fa-thumbs-up"></i> <?= $post["likes"]; ?></button>
                                </form>
                                <form action="actions/posts/like.php?t=2&id=<?= $post["id"]; ?>" method="post">
                                    <button type="submit" class="vote_btn vote_dislike"><i class="fa-solid fa-thumbs-down"></i> <?= $post["dislikes"]; ?></button>
                                </form>
                            </div>
                        </div>
                        <?php if($post["username_author"] == $_SESSION["username"]){ ?>
                            <div class="footer">
                        <div class="modifyBtn">
                            <button onclick="window.location.href='editpost.php?id=<?= $question['id']; ?>'">Modify the post</button>
                        </div>
                        <div class="deleteBtn">
                            <button onclick="window.location.href='actions/posts/deleteQuestion.php?id=<?= $question['id']; ?>'"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                        <div class="statsBtn">
                            <button onclick="window.location.href='actions/posts/?id=<?= $question['id']; ?>'">Stats  <i class="fa-solid fa-square-poll-vertical"></i></button>
                        </div>
                    </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <script src="assets/js/scroll.js"></script>
    <script src="assets/js/maxstr.js"></script>
    <script src="assets/js/vote.js"></script>
</body>
</html>