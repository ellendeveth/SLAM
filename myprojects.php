<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn projecten</title>
    <link rel="stylesheet" href="https://use.typekit.net/hbs6zbg.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php require_once('header.php'); ?>

    <div class="container--feed">
        <div class="sidebar__myprojects">
            <div class="active__projects">
                <h2>Mijn projecten</h2>
                <div class="project__card">
                    <div class="project__summary">
                        <div class="project__box__profile">
                            <img class="projects__img" src="assets/img/profile-pic.png" alt="profile-pic">
                            <h3>Naam VZW</h3>
                        </div>

                        <p><span>Project:</span> Ontwikkeling website</p>
                        <img class="projects__img overlapping__img" src="assets/img/profile-pic.png" alt="profile-pic">
                        <img class="projects__img overlapping__img" src="assets/img/profile-pic.png" alt="profile-pic">
                        <img class="projects__img overlapping__img" src="assets/img/profile-pic.png" alt="profile-pic">
                        <img class="projects__img overlapping__img" src="assets/img/profile-pic.png" alt="profile-pic">
                    </div>

                    <div class="project__info">
                        <a class="project__info__link" href="project.php">Meer info</a>
                        <img class="project__info__img" src="assets/img/arrow.png" alt="arrow">
                    </div>
                </div>
            </div>

            <div class="finished__projects">
                <h2>Voltooide projecten</h2>
                <div class="project__card project__card__finished">
                    <div class="project__summary">
                        <div class="project__box__profile">
                            <img class="projects__img" src="assets/img/profile-pic.png" alt="profile-pic">
                            <h3>Naam VZW</h3>
                        </div>

                        <p><span>Project:</span> Ontwikkeling website</p>
                        <img class="projects__img overlapping__img" src="assets/img/profile-pic.png" alt="profile-pic">
                        <img class="projects__img overlapping__img" src="assets/img/profile-pic.png" alt="profile-pic">
                        <img class="projects__img overlapping__img" src="assets/img/profile-pic.png" alt="profile-pic">
                        <img class="projects__img overlapping__img" src="assets/img/profile-pic.png" alt="profile-pic">
                    </div>

                    <div class="project__info">
                        <a class="project__info__link" href="project.php">Meer info</a>
                        <img class="project__info__img" src="assets/img/arrow.png" alt="arrow">
                    </div>
                </div>
            </div>
        </div>

        <div class="project__details">
            <div class="project__explanation">
                <h1 class="header-one">Ontwikkeling website</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores eius non accusantium dignissimos deleniti fuga
                    quia sint placeat pariatur! Rerum doloribus ut distinctio aliquid tempora! Facere iste repudiandae illum amet.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores eius non accusantium dignissimos deleniti fuga
                    quia sint placeat pariatur! Rerum doloribus ut distinctio aliquid tempora! Facere iste repudiandae illum amet.</p>
            </div>

            <div class="external__documents">
                <h2>Externe documenten</h2>
                <div class="external__link">
                    <img src="./assets/img/github.png" alt="">
                </div>
            </div>

            <div class="tasks">
                <h2>Taken</h2>
                <div class="task__list">
                    <div class="task__container">
                        <div class="checkbox__task">
                            <input class="filter__checkbox--active" type="checkbox" name="language" value="nl">
                            <p>Feature list</p>
                        </div>
                        <img class="projects__img overlapping__img" src="assets/img/profile-pic.png" alt="profile-pic">
                    </div>
                    <div class="task__container">
                        <div class="checkbox__task">
                            <input class="filter__checkbox--active" type="checkbox" name="language" value="nl">
                            <p>Flowchart</p>
                        </div>
                        <img class="projects__img overlapping__img" src="assets/img/profile-pic.png" alt="profile-pic">
                    </div>
                    <div class="task__container">
                        <div class="checkbox__task">
                            <input class="filter__checkbox--active" type="checkbox" name="language" value="nl">
                            <p>Wireframes</p>
                        </div>
                        <img class="projects__img overlapping__img" src="assets/img/profile-pic.png" alt="profile-pic">
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>