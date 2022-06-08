<?php
    include_once('bootstrap.php');
    Security::onlyLoggedInUsers();
 
    try {
        $myprojects = Project::getMyProjects($_SESSION['id']);
        $tasks = Task::getTasks($myprojects[0]['id']);
        $organisation = Project::getOrganisationOfProject($myprojects[0]['id']);
        $members = Project::getMembersByProject($myprojects[0]['id']);
        
        $github = $myprojects[0]['doc_github'];
        $figma = $myprojects[0]['doc_figma'];
        $trello = $myprojects[0]['doc_trello'];
        $word = $myprojects[0]['doc_word'];

        $isStudent = User::getStudentById($_SESSION['id']);
        
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

    if(!empty($_POST["addDocument"])) {
        $doc = new Document();
        $doc->setProjectId($myprojects[0]["id"]);
        $doc->setGithub($_POST['github']);
        $doc->setFigma($_POST['figma']);
        $doc->setTrello($_POST['trello']);
        $doc->setWord($_POST['word']);
        $doc->addDocument();
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
                    <input class="form__input modal__task" id="task" type="text" placeholder="Taak" name="task">
                    <input class="btn" id="btnSubmit" data-postid="<?php echo $myprojects[0]["id"] ?>" data-userid="<?php echo $_SESSION['id'] ?>" type="submit" value="Taak toevoegen" name="addTask">   
                </form>
           
        </div>
    <!--- end task modal -->
     <!-- add doc modal -->
     <div class="container--modal--doc" style="display: none;">
            
            <form action="" method="post" class="modal__content__doc">
                <div id="closeModalDoc" class="modal__close">+</div>
                <h2>Document toevoegen</h2>
                    <?php if(!empty($github)): ?>
                        <label for="github">GitHub</label>
                        <input class="form__input modal__task" type="text" placeholder="Link to GitHub" name="github" id="github" value="<?php echo $github ?>">
                    <?php else: ?>
                        <label for="github">GitHub</label>
                        <input class="form__input modal__task" type="text" placeholder="Link to GitHub" name="github" id="github">
                    <?php endif; ?>
                    
                    <?php if(!empty($figma)): ?>
                        <label for="figma">Figma</label>
                        <input class="form__input modal__task" type="text" placeholder="Link to Figma" name="figma" id="figma" value="<?php echo $figma ?>">
                    <?php else: ?>
                        <label for="figma">Figma</label>
                        <input class="form__input modal__task" type="text" placeholder="Link to Figma" name="figma" id="figma">
                    <?php endif; ?>

                    <?php if(!empty($trello)): ?>
                        <label for="trello">Trello</label>
                        <input class="form__input modal__task" type="text" placeholder="Link to Trello" name="trello" id="trello" value="<?php echo $trello ?>">
                    <?php else: ?>
                        <label for="trello">Trello</label>
                        <input class="form__input modal__task" type="text" placeholder="Link to Trello" name="trello" id="trello">
                    <?php endif; ?>

                    <?php if(!empty($word)): ?>
                        <label for="word">Word</label>
                        <input class="form__input modal__task" type="text" placeholder="Link to Word" name="word" id="word" value="<?php echo $word ?>">
                    <?php else: ?>
                        <label for="word">Word</label>
                        <input class="form__input modal__task" type="text" placeholder="Link to Word" name="word" id="word">
                    <?php endif; ?>

                <input class="btn" type="submit" value="Document toevoegen" name="addDocument">   
            </form>
       
    </div>
    <!--- end doc modal -->
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

            <!-- <div class="finished__projects">
                <h2>Voltooide projecten</h2>
                <div class="project__card project__card__finished">
                    <div class="project__summary">
                        <div class="project__box__profile">
                            <img class="projects__img" src="profile_pictures/profile-pic.png" alt="profile-pic">
                            <h3>Naam VZW</h3>
                        </div>

                        <p><span>Project:</span>  echo $myprojects[0]["title"] ?></p>
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
            </div> -->
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

        <div class="project__details">
            <div class="project__explanation">
                <h1 class="header-one"> <?php echo $myprojects[0]["title"] ?></h1>
                <p> <?php echo $myprojects[0]["description"] ?></p>
            </div>

            <div class="external__documents">
                <h2>Externe documenten</h2>
                    <div class="external__link__documents">
                        <div id="addDocument" class="external__link">
                            <p>+</p>
                        </div>
                        <?php if(!empty($github)): ?>
                            <div class="external__link">
                                <a href="<?php echo $github ?>" target="_blank">
                                    <img src="assets/img/github.png" alt="github">
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($figma)): ?>
                            <div class="external__link">
                                <a href="<?php echo $figma ?>" target="_blank">
                                    <img src="assets/img/figma.svg" alt="figma">
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($trello)): ?>
                            <div class="external__link">
                                <a href="<?php echo $trello ?>" target="_blank">
                                    <img src="assets/img/trello.png" alt="trello">
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($word)): ?>
                            <div class="external__link">
                                <a href="<?php echo $word ?>" target="_blank">
                                    <img src="assets/img/word.png" alt="word">
                                </a>
                            </div>
                        <?php endif; ?>
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
            <?php if (!$isStudent): ?>
                <input type="submit" value="Eindig project" class="btn btn--end">
            <?php endif; ?>

        </div>
    </div>
    <?php endif; ?>
<script src="js/modal-task.js"></script>
<script src="js/modal-document.js"></script>
<script src="js/task.js"></script>
</body>

</html>