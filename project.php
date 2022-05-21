<?php
    include_once('bootstrap.php');
    Security::onlyLoggedInUsers();

    $projectId = $_GET['project'];
    $project = Project::getProjectById($projectId);

    $members = Project::getMembersByProject($projectId);
    $isMember = Project::isMemberOfProject($projectId, $_SESSION['id']);

    $competences = Competence::getCompetences($projectId);

    if (empty($members)) {
        $emptyState = "Er zijn nog geen studenten toegevoegd aan dit project.";
    }
    if (!empty($_POST['addMember'])) {
        try {
            $project = new Project();
            $project->setId($projectId);
            $project->setUser_id($_SESSION['id']);
            $project->addMember();

            header('Location: myprojects.php');
        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }
    }

?><!DOCTYPE html>
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
                <h2><?php echo $project["name"] ?></h2>
            </div>

            <div class="about__org">
                <h3>Over VZW</h3>
                <p><?php echo $project['description_vzw'] ?></p>
            </div>

            <div class="about__project">
                <h3>Over project</h3>
                <p><?php echo $project['description'] ?></p>
            </div>

            <div>
                <?php if (empty($isMember)): ?>
                <form action="" method="post" class="btn__container">
                    <div>
                        <input class="btn btn__variant" type="submit" name="login" value="Organisatie contacteren">
                    </div>
                    <div>
                        <input class="btn" type="submit" name="addMember" value="Aanmelden">
                    </div>
                </form>
                <?php else: ?>
                    <form action="" method="post" class="btn__container">
                    <div>
                        <input class="btn btn__variant" type="submit" name="login" value="Organisatie contacteren">
                    </div>
                    <div>
                        <input class="btn btn--subscribed" disabled="disabled" type="submit" value="Aangemeld">
                    </div>
                </form>
                <?php endif; ?>
            </div>


        </div>


        <div class="project__sidebar">
            <div class="learning__goals">
                <h3>Leerdoelen</h3>
                <ul>
                    <?php foreach ($competences as $competence): ?>
                        <li><?php echo $competence['name'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="members">
                <h3>Teamleden</h3>
                <ul>
                    <?php if (!empty($emptyState)): ?>
                        <li><?php echo $emptyState; ?></li>
                    <?php else: ?>
                        <?php foreach ($members as $key => $member): ?>
                        <li>
                            <img class="members__img" src="assets/img/profile-pic.png" alt="profile-pic">
                            <p><?php echo $member["name"] . " " . $member["last_name"] ?></p>
                        </li>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </div>


</body>

</html>