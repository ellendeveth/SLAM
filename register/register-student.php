<?php
     include_once('../bootstrap.php');

     if (!empty($_POST['register'])) {
         try {
             $user = new User();
             $user->setName($_POST['name']);
             $user->setEmail($_POST['email']);
             $user->setPassword($_POST['password']);
             $user->setConfirm($_POST['confirm']);
             $user->setSchool($_POST['school']);
             $user->setEducation($_POST['education']);
             $user->setStudent(1);
             $user->registerStudent();
             
             header('Location: competences.php');
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
    <title>Document</title>
    <link rel="stylesheet" href="https://use.typekit.net/hbs6zbg.css">
    <link rel="stylesheet" href="../style/style.css">
</head>
<body class="body--startpage">
    <div class="form">
        <form action="" method="post">
            <h1 class="form__title">Welkom bij SLAM</h1>

            <?php if (isset($error)): ?>
                <div class="form__container">
                    <p class="form__error"><?php echo $error; ?></p>
                </div>
            <?php endif; ?>
            
            <div class="form__container">
                <label class="form__text" for="name">Naam</label>
                <input class="form__input" type="text" name="name">
            </div>

            <div class="form__container">
                <label class="form__text" for="email">Email</label>
                <input class="form__input" type="text" name="email">
            </div>

            <div class="form__container">
                <label class="form__text" for="school">School</label>
                <input class="form__input" type="text" name="school">
            </div>

            <div class="form__container">
                <label class="form__text" for="education">Richting</label>
                <input class="form__input" type="text" name="education">
            </div>
        
            <div class="form__container">
                <label class="form__text" for="password">Wachtwoord</label>
                <input class="form__input" type="password" name="password" id="password">
            </div>

            <div class="form__container">
                <label class="form__text" for="confirm">Herhaal wachtwoord</label>
                <input class="form__input" type="password" name="confirm" id="confirm">

            </div>
            
            <div >
                <input class="btn" type="submit" name="register" value="Registreer">
            </div>

            <div class="form__span">
                <span>Al een account?</span>
                <a class="form__link" href="../login.php">Login</a>
            </div>
        
        </form>
    </div>
    
</body>
</html>