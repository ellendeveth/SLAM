<?php
    include_once('bootstrap.php');
    Security::onlyLoggedInUsers();
   
    if (!empty($_POST['editPassword'])) {
        $id = $_SESSION['id'];
        $oldpassword = $_POST['current_password'];
        $newpassword = $_POST['new_password'];
        $confirmation = $_POST['confirm_password'];
        try {
            $checkPassword = User::checkPassword($id, $oldpassword);
            if ($newpassword == $confirmation) {
                $user = new User();
                $user->setId($id);
                $user->setPassword($newpassword);
                $user->updatePassword();
                $success = "Password successfully changed.";
            } else {
                $error = "Passwords don't match.";
            }
        } catch (\Throwable $e) {
            $error =  $e->getMessage();
        }
    }
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
        <div class="sidebar__settings">
            <h1 class="header-one">Instellingen</h1>

            <div class="settings__menu">
                <ul>
                    <li><a href="settings.php">Profiel <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="#">Skills wijzigen <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="#">Meldingen beheren <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="#">Privacy policy <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="change-password.php">Wachtwoord wijzigen <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="logout.php">Account verwijderen <img src="assets/img/arrow.png" alt="arrow"></a></li>
                </ul>

                <a href="logout.php" class="subtitle-big logout">Uitloggen</a>
            </div>
        </div>

        <div class="settings__active">
            <h2>Wijzig wachtwoord</h2>
            <?php if (isset($success)): ?>
                <div class="success">
                    <?php echo $success ?>
                </div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="error">
                    <?php echo $error ?>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="user__settings">
                    <div class="form__container form__container--password">
                        <label class="form__text" for="current_password">Huidig wachtwoord</label>
                        <input class="form__input form__input__large" type="password" name="current_password">
                    </div>

                    <div class="form__container">
                        <label class="form__text" for="new_password">Nieuw wachtwoord</label>
                        <input class="form__input form__input__large" type="password" name="new_password">
                    </div>

                    <div class="form__container">
                        <label class="form__text" for="confirm_password">Herhaal wachtwoord</label>
                        <input class="form__input form__input__large" type="password" name="confirm_password">
                    </div>
                  
                    <div class="btn__container">
                        <div>
                            <input class="btn btn__variant" type="submit" name="annuleren" value="Annuleren">
                        </div>
                        <div>
                            <input class="btn" type="submit" name="editPassword" value="Opslaan">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script src="js/profilepicture.js"></script>
</body>

</html>