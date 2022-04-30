<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.typekit.net/hbs6zbg.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body class="body--startpage">
    <div class="form">
        <form action="" method="post">
            <h1 class="form__title">Welkom terug!</h1>

            <div class="form__container">
                <label class="form__text" for="email">Email</label>
                <input class="form__input" type="text" name="email">
            </div>
        
            <div class="form__container">
                <label class="form__text" for="password">Wachtwoord</label>
                <input class="form__input" type="password" name="password" id="password">
                <a class="form__link" href="forgot-password.php">Wachtwoord vergeten?</a>
            </div>
            
            <div >
                <input class="btn" type="submit" name="submit" value="Aanmelden">
            </div>

            <div class="form__span">
                <span>Nog geen account?</span>
                <a class="form__link" href="register.php">Registreer</a>
            </div>
        
        </form>
    </div>
    
</body>
</html>