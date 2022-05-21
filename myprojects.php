<?php
    include_once('bootstrap.php');
    Security::onlyLoggedInUsers();
 
    try {
        $myprojects = Project::getMyProjects($_SESSION['id']);
        $tasks = Task::getTasks($myprojects[0]['id']);
        $organisation = Project::getOrganisationOfProject($myprojects[0]['id']);
        $members = Project::getMembersByProject($myprojects[0]['id']);
        //var_dump($tasks);
    } catch (\Throwable $e) {
        $error = $e->getMessage();
    }

    if (!empty($_POST["addTask"])) {
        $task = new Task();
        $task->setTask($_POST["task"]);
        $task->setPost_id($myprojects[0]["id"]);
        $task->setUser_id($_SESSION["id"]);
        $task->addTask();
    }
   
?><!DOCTYPE html>
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

    <?php if (isset($error)): ?>
    <div class="container--emptystate">
        <div class="sidebar__emptystate">
            <div class="active__projects__emptystate">
                <h2>Mijn projecten</h2>
                <div class="project__card__emptystate">
                    <div class="project__box__emptystate">
                        <a href="index.php"><img class="emptystate__plus" src="assets/img/plus.png" alt="plus"></a>
                        <h3>Zoek een Project</h3>
                    </div>
                </div>
            </div>

            <div class="finished__projects__emptystate">
                <h2>Voltooide projecten</h2>
                <div class="project__card__emptystate project__card__finished">
                    <div class="project__box__emptystate">
                        <div class="project__box__emptystate">
                            <h3>Je hebt nog geen voltooide projecten</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="project__emptystate">
            <img class="emptystate__doc" src="assets/img/empty-state.png" alt="empty state">
            <h2 class="emptystate__title"><?php echo $error ?></h2>
            <p class="emptystate__text">Vind een geschikt project en meld je zo snel mogelijk aan!</p>
        </div>  
    </div>      
    <?php else: ?>
    <!-- add task modal -->
        <div class="container--modal" style="display: none;">
            
                <form action="" method="post" class="modal__content">
                    <div id="closeModal" class="modal__close">+</div>
                    <h2>Taak toevoegen</h2>
                    <input class="form__input modal__task" type="text" placeholder="Taak" name="task">
                    <input class="btn" type="submit" value="Taak toevoegen" name="addTask">   
                </form>
           
        </div>
    <!--- end task modal -->
    <div class="container--feed">
        <div class="sidebar__myprojects">
            <div class="active__projects">
                <h2>Mijn projecten</h2>
                <div class="project__card">
                    <div class="project__summary">
                        <div class="project__box__profile">
                            <?php if (empty($organisation['profile_pic'])): ?>
                                <img class="projects__img" src="profile_pictures/profile-pic.png" alt="profile-pic">
                            <?php else: ?>
                                <img class="projects__img" src="profile_pictures/<?php echo $organisation['profile_pic'] ?>" alt="profile-pic">
                            <?php endif; ?>
                            <h3><?php echo $organisation['name'] ?></h3>
                        </div>

                        <p><span>Project:</span> <?php echo $myprojects[0]["title"] ?></p>
                        <ul class="projects__list">
                            <?php foreach ($members as $member): ?>
                            <li>
                                <?php if (empty($member['profile_pic'])): ?>
                                    <img class="projects__img overlapping__img" src="profile_pictures/profile-pic.png" alt="profile-pic">
                                <?php else: ?>
                                    <img class="projects__img overlapping__img" src="profile_pictures/<?php echo $member['profile_pic'] ?>" alt="profile-pic">
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        
                    </div>

                    <div class="project__info">
                        <a class="project__info__link" href="project.php?project=<?php echo $myprojects[0]["id"] ?>">Meer info</a>
                        <img class="project__info__img" src="assets/img/arrow.png" alt="arrow">
                    </div>
                </div>
            </div>

            <div class="finished__projects">
                <h2>Voltooide projecten</h2>
                <div class="project__card project__card__finished">
                    <div class="project__summary">
                        <div class="project__box__profile">
                            <img class="projects__img" src="profile_pictures/profile-pic.png" alt="profile-pic">
                            <h3>Naam VZW</h3>
                        </div>

                        <p><span>Project:</span>  <?php echo $myprojects[0]["title"] ?></p>
                        <img class="projects__img overlapping__img" src="profile_pictures/profile-pic.png" alt="profile-pic">
                        <img class="projects__img overlapping__img" src="profile_pictures/profile-pic.png" alt="profile-pic">
                        <img class="projects__img overlapping__img" src="profile_pictures/profile-pic.png" alt="profile-pic">
                        <img class="projects__img overlapping__img" src="profile_pictures/profile-pic.png" alt="profile-pic">
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
                <h1 class="header-one"> <?php echo $myprojects[0]["title"] ?></h1>
                <p> <?php echo $myprojects[0]["description"] ?></p>
            </div>

            <div class="external__documents">
                <h2>Externe documenten</h2>
                <div class="external__link">
                    <img src="./assets/img/github.png" alt="">
                </div>
            </div>
            <div class="tasks">
                <div class="tasks__add">
                    <h2>Taken</h2>
                    <div id="addTask" class="btn--extra">+ Taak toevoegen</div>
                </div>
                <div class="task__list">
                    <?php if (empty($tasks)): ?>
                            <h3>Je hebt nog geen taken</h3>
                    <?php else: ?>
                    <div class="task__container">
                        <?php foreach ($tasks as $task): ?>
                            <div class="checkbox__task">
                                <div class="checkbox__task__info">
                                    <input class="filter__checkbox--active" type="checkbox" name="language" value="nl">
                                    <p><?php echo $task["task"] ?></p>
                                </div>
                                
                                <?php if (empty($task['profile_pic'])): ?>
                                    <img class="projects__img overlapping__img" src="profile_pictures/profile-pic.png" alt="profile-pic">
                                    <p><?php echo $task['name'] ?></p>
                                <?php else: ?>
                                    <img class="projects__img overlapping__img" src="profile_pictures/<?php echo $task['profile_pic'] ?>" alt="profile-pic">
                                    <p><?php echo $task['name'] ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        
                        
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
    <?php endif; ?>
<script src="js/modal.js"></script>
</body>

</html>