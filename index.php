<?php
    include_once('bootstrap.php');
    Security::onlyLoggedInUsers();

    //check if user is student
    $isStudent = User::getStudentById($_SESSION['id']);

    //get posts
    $projects = Project::getAllProjects();
    var_dump($projects);
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://use.typekit.net/hbs6zbg.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php require_once('header.php'); ?>

    <div class="container--feed">
        <div class="filters">
            <h2 class="header-two">Filter</h2>
            <div class="filters__language">
                <h3>Taal van project</h3>
                <div class="filter__languages">
                    <div class="filter__container">
                        <input class="filter__checkbox--active" type="checkbox" name="language" value="nl">
                        <label for="language">Nederlands</label>
                    </div>
                    <div class="filter__container">
                        <input class="filter__checkbox--active" type="checkbox" name="language" value="fr">
                        <label for="language">Frans</label>
                    </div>
                    <div class="filter__container">
                        <input class="filter__checkbox--active" type="checkbox" name="language" value="en">
                        <label for="language">Engels</label>
                    </div>
                </div>
            </div>

            <div class="filters__skills">
                <h3>Vaardigheden</h3>
                <div class="filter__container">
                    <input class="filter__checkbox--active" type="checkbox" name="skills" value="com">
                    <label class="filter__checkbox--active" for="skills">Communicatie</label>
                </div>
                <div class="filter__container">
                    <input class="filter__checkbox--active" type="checkbox" name="skills" value="inf">
                    <label for="skills">Informatica</label>
                </div>
                <div class="filter__container">
                    <input class="filter__checkbox--active" type="checkbox" name="skills" value="des">
                    <label for="skills">Webdesign</label>
                </div>
                <div class="filter__container">
                    <input class="filter__checkbox--active" type="checkbox" name="skills" value="ond">
                    <label for="skills">Onderwijs</label>
                </div>
                <div class="filter__container">
                    <input class="filter__checkbox--active" type="checkbox" name="skills" value="org">
                    <label for="skills">Organisatie</label>
                </div>
            </div>
            <div>
                <button class="btn--extra">+ Meer opties</button>
            </div>
        </div>

        <div class="projects">
            <div class="projects__newProject">
                <h1>Projecten</h1>
                <?php if (!$isStudent): ?>
                    <a href="add-project.php" class="btn--extra">+ Nieuw project</a>
                <?php endif; ?>
            </div>
            
            <div class="projects__box">
                <ul class="project__box__li">
                    <?php foreach ($projects as $project): ?>
                    <li>
                        <div class="project__box">
                            <div class="project__box__profile">
                                <img class="projects__img" src="assets/img/profile-pic.png" alt="profile-pic">
                                <h2><?php echo $project['name']; ?></h2>
                            </div>


                            <div class="project__box__item">
                                <div>
                                    <a href="project.php?project=<?php echo $project[0]; ?>" class="project__title">
                                        <h3><?php echo $project['title']; ?></h3>
                                    </a>

                                    <ul class="project__tags">
                                        <li class="tags__tag">tag</li>
                                        <li class="tags__tag">tag</li>
                                        <li class="tags__tag">tag</li>
                                    </ul>
                                    <p><?php echo $project['description']; ?></p>
                                </div>

                                <a href="project.php">
                                    <div class="project__info">
                                        <a class="project__info__link" href="project.php?project=<?php echo $project[0]; ?>">Meer info</a>
                                        <img class="project__info__img" src="assets/img/arrow.png" alt="arrow">
                                    </div>
                                </a>

                            </div>

                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>