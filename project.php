<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link rel="stylesheet" href="https://use.typekit.net/hbs6zbg.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php require_once('header.php'); ?>

    <div class="container--feed">

        <div class="project__info__expanded">

            <a href="index.php" class="return__btn">
                <img class="chat__info__img" src="assets/img/arrow.png" alt="arrow">
                <h3>Ga terug</h3>
            </a>

            <div class="project__box__profile">
                <img class="projects__img" src="assets/img/profile-pic.png" alt="profile-pic">
                <h2>Naam VZW</h2>
            </div>

            <div class="about__org">
                <h3>Over Naam VZW</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Illo tempore voluptate reprehenderit, aliquid tempora,
                    consectetur maiores consequatur nobis ratione cupiditate cumque,
                    facere architecto. Incidunt voluptatem placeat consectetur
                    rem temporibus dignissimos.</p>
            </div>

            <div class="about__project">
                <h3>Over project</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Illo tempore voluptate reprehenderit, aliquid tempora,
                    consectetur maiores consequatur nobis ratione cupiditate cumque,
                    facere architecto. Incidunt voluptatem placeat consectetur
                    rem temporibus dignissimos.</p>
            </div>

            <div class="btn__container">
                <div>
                    <input class="btn btn__variant" type="submit" name="login" value="Organisatie contacteren">
                </div>
                <div>
                    <input class="btn" type="submit" name="login" value="Aanmelden">
                </div>
            </div>


        </div>


        <div class="project__sidebar">
            <div class="learning__goals">
                <h3>Leerdoelen</h3>
                <ul>
                    <li>Kinderbegeleiding</li>
                    <li>Onderwijs</li>
                    <li>Klasplanning</li>
                    <li>Psychologische bijstand</li>
                    <li>Organiseren groepsactiviteiten</li>
                </ul>
            </div>

            <div class="members">
                <h3>Teamleden</h3>
                <ul>
                    <li>
                        <img class="members__img" src="assets/img/profile-pic.png" alt="profile-pic">
                        <p>Voornaam Achternaam</p>
                    </li>
                    <li>
                        <img class="members__img" src="assets/img/profile-pic.png" alt="profile-pic">
                        <p>Voornaam Achternaam</p>
                    </li>
                    <li>
                        <img class="members__img" src="assets/img/profile-pic.png" alt="profile-pic">
                        <p>Voornaam Achternaam</p>
                    </li>
                    <li>
                        <img class="members__img" src="assets/img/profile-pic.png" alt="profile-pic">
                        <p>Voornaam Achternaam</p>
                    </li>
                </ul>
            </div>
        </div>

    </div>


</body>

</html>