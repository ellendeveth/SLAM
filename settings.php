<!DOCTYPE html>
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
                    <li><a href="#">Profiel <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="#">Skills wijzigen <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="#">Meldingen beheren <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="#">Privacy policy <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="#">Wachtwoord wijzigen <img src="assets/img/arrow.png" alt="arrow"></a></li>
                    <li><a href="#">Account verwijderen <img src="assets/img/arrow.png" alt="arrow"></a></li>
                </ul>

                <a href="login.php" class="subtitle-big logout">Uitloggen</a>
            </div>
        </div>

        <div class="settings__active">
            <h2>Wijzig gegevens</h2>
            <div class="user__settings">
                <div class="user__img">
                    <img src="assets/img/profile-pic.png" alt="" class="projects__img">
                    <div class="subtitle-big">Wijzig profielfoto</div>
                </div>

                <div class="form__container">
                    <label class="form__text" for="email">Vooraam</label>
                    <input class="form__input form__input__large" type="text" name="email">
                </div>

                <div class="form__container">
                    <label class="form__text" for="email">Achternaam</label>
                    <input class="form__input form__input__large" type="text" name="email">
                </div>

                <div class="form__container">
                    <label class="form__text" for="email">Email</label>
                    <input class="form__input form__input__large" type="text" name="email">
                </div>

                <div class="form__container">
                    <label class="form__text" for="email">School</label>
                    <input class="form__input form__input__large" type="text" name="email">
                </div>

                <div class="form__container">
                    <label class="form__text" for="email">Opleiding</label>
                    <input class="form__input form__input__large" type="text" name="email">
                </div>

                <div class="btn__container">
                    <div>
                        <input class="btn btn__variant" type="submit" name="login" value="Annuleren">
                    </div>
                    <div>
                        <input class="btn" type="submit" name="login" value="Opslaan">
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>