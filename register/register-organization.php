<?php
     include_once('../bootstrap.php');

     if (!empty($_POST['register'])) {
         try {
             $user = new User();
             $user->setFirstname($_POST['name']);
             $user->setEmail($_POST['email']);
             $user->setPassword($_POST['password']);
             $user->setConfirm($_POST['confirm']);
             $user->setDescription($_POST['description']);
             $user->setStudent(0);
             $user->registerOrganisation();
             
             header('Location: ../index.php');
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

            <div class="form__container">
                <label class="form__text" for="name">Naam organisatie</label>
                <input class="form__input" type="text" name="name">
            </div>

            <div class="form__container">
                <label class="form__text" for="description">Beschrijving organisatie</label>
                <textarea class="form__text description" cols="30" rows="5" name="description"></textarea>
            </div>

            <div class="form__container">
                <label class="form__text" for="email">Email</label>
                <input class="form__input" type="text" name="email">
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