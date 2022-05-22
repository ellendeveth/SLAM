<?php
    include_once('bootstrap.php');
    Security::onlyLoggedInUsers();

    try {
        $user = new User();
        $sessionId = $_SESSION['id'];
        $userDataFromId = User::getUserDataFromId($sessionId);
        $isStudent = User::getStudentById($_SESSION['id']);
    } catch (\Throwable $e) {
        $error = $e->getMessage();
    }

    if ($isStudent) {
        if (!empty($_POST["editProfile"])) {
            $user = new User();
            $user->setFirstname($_POST["name"]);
            $user->setLastname($_POST["lastname"]);
            $user->setSchool($_POST["school"]);
            $user->setEducation($_POST["education"]);
            $user->setId($_SESSION['id']);
            $user->updateStudentProfile();
            if ($user->updateStudentProfile()) {
                $success = "Gegevens gewijzigd";
            }
        }
    } else {
        if (!empty($_POST["editProfile"])) {
            $user = new User();
            $user->setFirstname($_POST["name"]);
            $user->setDescription($_POST["description"]);
            $user->setId($_SESSION['id']);
            $user->updateOrganisationProfile();
        }
    }

    if (!empty($_POST['deleteAccount'])) {
        $user = new User();
        $id = $_SESSION['id'];
        $user->setId($id);
        $user->deleteAccount();
        Project::deleteProject($id);
        Project::deleteTeam($id);
        Task::deleteTasks($id);
        Competence::deleteCompetences($id);
        
        header("Location: logout.php");
    }
    // if (!empty($_POST['submitProfilePicture'])) {
    //     try {
    //         $user->canUploadPicture($sessionId);
    //         $success = "Profile picture saved. Refresh to see changes.";
    //     } catch (Exception $e) {
    //         $error = $e->getMessage();
    //     }
    // }

   

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instellingen</title>
    <link rel="stylesheet" href="https://use.typekit.net/hbs6zbg.css">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php require_once('header.php'); ?>

    <div class="settings__container">
         <!-- are you sure modal -->
         <div class="container--modal" style="display: none;">
            
            <form action="" method="post" class="modal__content">
                <div id="closeModal" class="modal__close">+</div>
                <h2 class="modal__text">Ben je zeker dat je je account wil verwijderen?</h2>
                <div class="modal__btn">
                    <input class="btn--no" type="submit" value="Nee" name="task">
                    <input class="btn btn--yes" type="submit" value="Ja" name="deleteAccount">   
                </div>
            </form>
       
        </div>
        <!--- end are you sure modal -->
        <div class="sidebar__settings">
            <h1 class="header-one">Instellingen</h1>

            <div class="settings__menu">
                <ul>
                    <li><a href="settings.php">Profiel <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="#">Skills wijzigen <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="#">Meldingen beheren <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="#">Privacy policy <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="change-password.php">Wachtwoord wijzigen <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a id="deleteAccount">Account verwijderen <img src="assets/img/arrow.png" alt="arrow"></a></li>
                </ul>

                <a href="logout.php" class="subtitle-big logout">Uitloggen</a>
            </div>
        </div>

        <div class="settings__active">
            <h2>Wijzig gegevens</h2>
            <?php if (isset($success)): ?>
                <div>
                    <?php echo $success ?>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="user__settings">
                    <div class="user__img">
                        <?php if (empty($userDataFromId['profile_pic'])): ?>
                            <img class="projects__img" src="profile_pictures/profile-pic.png" alt="profile-pic">
                        <?php else: ?>
                            <img src="profile_pictures/<?php echo $userDataFromId['profile_pic'] ?>" alt="" class="projects__img">
                        <?php endif; ?>
                        <div >
                            <div id="upload-btn" class="upload__btn subtitle-big" name="profilepic" >Wijzig profielfoto </div>
                            <div class="upload-file" style="display: none;">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <fieldset class="upload__form">
                                        <div class="">
                                            <input class="upload__form__file" type="file" class="" name="picture" id="profilePicture">
                                            <input class="upload__form__btn" type="submit" class="" name="submitProfilePicture" value="Upload">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                        </div>
                    </div>

                    <?php if ($isStudent): ?>
                        <div class="form__container">
                            <label class="form__text" for="name">Voornaam</label>
                            <input class="form__input form__input__large" type="text" name="name" value="<?php echo $userDataFromId['name'] ?>">
                        </div>

                        <div class="form__container">
                            <label class="form__text" for="lastname">Achternaam</label>
                            <input class="form__input form__input__large" type="text" name="lastname" value="<?php echo $userDataFromId['last_name'] ?>">
                        </div>

                        <div class="form__container">
                            <label class="form__text" for="email">Email</label>
                            <input class="form__input form__input__large" type="text" name="email" value="<?php echo $userDataFromId['email']; ?>" readonly>
                        </div>

                        <div class="form__container">
                            <label class="form__text" for="school">School</label>
                            <input class="form__input form__input__large" type="text" name="school" value="<?php echo $userDataFromId['school'] ?>">
                        </div>

                        <div class="form__container">
                            <label class="form__text" for="education">Opleiding</label>
                            <input class="form__input form__input__large" type="text" name="education" value="<?php echo $userDataFromId['education'] ?>">
                        </div>
                    <?php else: ?>
                        <div class="form__container">
                            <label class="form__text" for="name">Naam</label>
                            <input class="form__input form__input__large" type="text" name="name">
                        </div>

                        <div class="form__container">
                            <label class="form__text" for="description">Beschrijving VZW</label>
                            <input class="form__input form__input__large" type="text" name="description">
                        </div>
                    <?php endif; ?>

                    <div class="btn__container">
                        <div>
                            <input class="btn btn__variant" type="submit" name="annuleren" value="Annuleren">
                        </div>
                        <div>
                            <input class="btn" type="submit" name="editProfile" value="Opslaan">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script src="js/modal-delete.js"></script>
</body>

</html>