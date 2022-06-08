<?php 
    include_once('bootstrap.php');
    Security::onlyLoggedInUsers();

    $team = User::getTeam($_SESSION['id']);

?><!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Berichten</title>
        <link rel="stylesheet" href="https://use.typekit.net/hbs6zbg.css">
        <link rel="stylesheet" href="style/style.css">
    </head>
</head>

<body>
    <div class="container--messages">
        <?php if(!empty($team)): ?>
            <div class="messages__groups">
            <div class="messages__chat__info">
                <a href="index.php"><img class="chat__info__img" src="assets/img/arrow.png" alt="arrow"></a>
                <h2>Chats</h2>
            </div>

            <div>
                <input class="messages__chat__search" type="text" placeholder="Search">
            </div>

            <div class="messages__chat__groups">
                <h2>Groepen</h2>
                <div class="chat__groups">
                    <img class="projects__img" src="profile_pictures/<?php echo $team['profile_pic'] ?>" alt="profile-pic">
                    <div class="chat__groups__text">
                        <h3 class="subtitle-big"><?php echo $team['title']; ?></h3>
                        <p>Wie kan er een figma file ...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="messages__chat">
            <div class="messages__title">
                <img class="projects__img" src="profile_pictures/<?php echo $team['profile_pic'] ?>" alt="profile-pic">
                <h1 class="header-two"><?php echo $team['name'] ?></h1>
            </div>
            <div class="messages__time">
                <p>16:13</p>
            </div>
            <div class="messages__chat__active">
                <img class="projects__img" src="profile_pictures/<?php echo $team['profile_pic'] ?>" alt="profile-pic">
                <p class="message__receive">Wie kan er een figma file aanmaken?</p>
            </div>
            <div class="messages__time">
                <p>16:21</p>
            </div>
            <div class="messages__chat__active__sent">
                <p class="message__sent">Komt in orde!</p>
                <img class="projects__img" src="profile_pictures/me.jpeg" alt="profile-pic">
            </div>
            <div class="messages__chat__send">
                <input class="send__input" type="text" placeholder="Typ je bericht">
                <img class="send__img" src="assets/img/send.png" alt="send">
            </div>
        </div>

        <?php else: ?>
        <div class="messages__groups">
            <div class="messages__chat__info">
                <a href="index.php"><img class="chat__info__img" src="assets/img/arrow.png" alt="arrow"></a>
                <h2>Chats</h2>
            </div>

            <div>
                <input class="messages__chat__search" type="text" placeholder="Search">
            </div>

            <div class="messages__chat__groups">
                <h2>Groepen</h2>
                <div class="chat__groups">
                    <div class="chat__groups__text">
                        <h3 class="subtitle-big">Je hebt nog geen berichtjes</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="messages__chat">
            <div class="messages__chat__emptystate">
                <img class="chat__emptystate__img" src="assets/img/emptystate-messages.png" alt="empty state">
                <h2 class="header-two">Je hebt nog geen berichtjes</h2>
                <p>Doe mee aan een project om in een groep te sturen.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</body>

</html>