<?php
require('actions/users/securityAction.php');
require('actions/channels/getChannels.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/room.css">
    <link rel="stylesheet" href="assets/css/scrollbar.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/29ce918257.js" crossorigin="anonymous"></script>
    <title>NoName | Rooms</title>
</head>
<body>

    <div>
        <?php include 'includes/navbar.php'; ?>
    </div>
   
    <?php
        
        if(isset($successMsg)){
            echo "<div class='alert-msg' role='alert'>".$successMsg."</div>";
        }

    ?>

    <main>
        <div class="head">
            <div class="title">
                <h1>
                    Rooms
                </h1>
            </div>
        </div>
        <!--<hr class="separation">-->
        <form method="GET">
            <input type="search" class="input-search" placeholder="Search a room" name="search" id="search">
            <button class="button-search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <button class="button-add" onclick="window.location.href='createchannel.php'">Create a channel</button>
        <div class="channels">
            <h3>Text Channels</h3>
        </div>
        <div class="channels-open">
            <div class="card" onclick="window.location.href='channel.php?c=General'" id="general-card">
                <div class="head">
                    <div class="title">
                    
                        General
    
                    </div>
                </div>
                <div class="square">
                    <i class="fa-solid fa-thumbtack"></i>
                </div>
            </div>
            
            <?php
            while($channel = $getChannels->fetch()){
                if($channel["channel_name"] != "General"){
                ?>
                <div class="card" onclick="window.location.href='channel.php?c=<?= $channel['channel_name']; ?> '">
                    <div class="head">
                        <div class="title">
                    
                            <?= $channel['channel_name']; ?>
    
                        </div>
                        <!--<div class="date">
                            <?php //echo ", ".$channel['creation_date']; ?>
                        </div>-->
                    </div>
                    <?php
                    if($channel['channel_author'] == $_SESSION['username']){
                    ?>
                    <!--<div class="footer">
                        <div class="deleteBtn">
                            <button onclick="#channelDeleted<?= $channel['id']; ?>"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>-->
                    <?php
                    }
                    }
                    ?>
                </div>
                
                <div id="channelDeleted<?= $channel['id']; ?>" class="modal">
                    <div class="modal_content">
                    <h1 style="text-align: center; color: #8E919A;">Are you sure?</h1>
                        <p>
                            <br>
                                You are going to delete a channel,
                            <br>
                                <strong>
                                    click ok if you want to.
                                </strong>
                            <br>
                                
                            <br>
                            <br style="color: black;">
                        </p>
                        
                        <button onclick="window.location.href='actions/channels/deleteChannel.php?id=<?= $channel['id']; ?>'" style="background-color: #F05454; color: #grey; border: none; border-radius: 10px; padding: 20px 65px; width: 100%;">Ok </button>
                    
                        <a href="#" class="modal_close">&times;</a>
                    </div>
                </div>
                <?php
            }
            ?>
            
        </div>
    </main>

    <div id="success" class="modal">
		<div class="modal_content">
		  <h1 style="text-align: center; color: #8E919A;">Success!</h1>
            <p>
                <br>
                    Your message has been posted,
                <br>
                    <strong>
                        Join your channel to see your post
                    </strong>
                <br>
                    
                <br>
                <br style="color: black;">
            </p>
            
            <button onclick="window.location.href='#'" style="background-color: #F05454; color: #grey; border: none; border-radius: 10px; padding: 20px 130px;">Ok </button>
        
            <a href="#" class="modal_close">&times;</a>
		</div>
    </div>

    <div id="succesCreate" class="modal">
		<div class="modal_content">
		  <h1 style="text-align: center; color: #8E919A;">Success!</h1>
            <p>
                <br>
                    You've successfully created a channel,
                <br>
                    <strong>
                        You can go to your channel and click on the trash to delete it.
                    </strong>
                <br>
                    
                <br>
                <br style="color: black;">
            </p>
            
            <button onclick="window.location.href='#'" style="background-color: #F05454; color: #grey; border: none; border-radius: 10px; padding: 20px 130px;">Ok </button>
        
            <a href="#" class="modal_close">&times;</a>
		</div>
    </div>

    <div id="channelDeleted_" class="modal">
		<div class="modal_content">
		  <h1 style="text-align: center; color: #8E919A;">Are you sure?</h1>
            <p>
                <br>
                    You are going to delete a channel,
                <br>
                    <strong>
                        click ok if you want to.
                    </strong>
                <br>
                    
                <br>
                <br style="color: black;">
            </p>
            
            <button onclick="window.location.href='actions/channels/deleteChannel.php?id=<?= $channel['id']; ?>'" style="background-color: #F05454; color: #grey; border: none; border-radius: 10px; padding: 20px 65px;">Ok </button><button onclick="window.location.href='#'" style="background-color: #F05454; color: #grey; border: none; border-radius: 10px; padding: 20px 65px;">Cancel </button>
        
            <a href="#" class="modal_close">&times;</a>
		</div>
    </div>

    <div class="createChannel">
        <button>
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>

    <script>
                    
    $(document).ready(function(){
        $(window).scroll(function(){
            var scroll = $(window).scrollTop();
            if (scroll > 10) {
                $(".navigation").css("transition" , "0.1s");
                $(".navigation").css("background" , "#222831");
                $(".navigation").css("top" , "0");
                $(".navigation").css("left" , "0");
                $(".navigation").css("margin-bottom" , "15px");
                $(".userBx").css("margin-left" , "10px");
                $(".userBx").css("margin-top" , "8px");
                $(".tools").css("margin-left" , "20px");
                $(".tools").css("margin-top" , "30px");
            }

            else{
                $(".navigation").css("background" , "transparent");  	
            }
        })
    })

    </script>
</body>
</html>