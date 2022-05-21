<?php
    include_once('bootstrap.php');
    Security::onlyLoggedInUsers();

    if (!empty($_POST['uploadProject'])) {
        try {
            $project = new Project();
            $project->setTitle($_POST['title']);
            $project->setDescription($_POST['description']);
            $project->setUser_id($_SESSION['id']);
            $projectId = $project->uploadProject();

            $competences = new Competence();
            $competences->setPostId($projectId);
            $competences->setCompetence($_POST['competences']);
            $competences->uploadCompetences();

            
            header('Location: index.php');
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
    <title>Post</title>
    <link rel="stylesheet" href="https://use.typekit.net/hbs6zbg.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <form action="" method="post">
        <div class="add-project">
            <input class="project__input" type="text" placeholder="Titel" name="title">
            <input class="project__input desc" type="text" placeholder="Beschrijving" name="description">
            <input class="project__input" type="text" placeholder="Plaats een spatie tussen de competenties" name="competences">
            <input class="project__btn" type="submit" value="Uploaden" name="uploadProject">
        </div>
    </form>
</body>
</html>