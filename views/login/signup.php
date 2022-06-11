<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <title>Registro</title>
</head>
<body>
    <section>
    <?php $this->showMessages(); ?>
    <div class="login-page">
        <div class="form">
            <form action = "<?php echo constant('URL'); ?>signup/nuevoUsuario" method= "POST" class="register-form">
            <h2> Registrarse </h2>
            <p>
                <label for="username"></label>
                <input class="date" type="text" name="username" id="username" required autocomplete="off" placeholder="Introduce tu usuario">
            </p>
            <p>
                <label for="password"></label>
                <input class="date" type="password" name="password" id="password" required autocomplete="off" placeholder="Introduce tu contraseña">
            </p>
            <p>
                <input class="botones" type="submit" value="Registrarse" id="button"/>
            </p>
            <p>
                ¿Ya tienes una cuenta? <a href="<?php echo constant('URL'); ?>">
                Iniciar Sesión </a>
            </p>
            </form>
        </div>
    </div>
    </section>
</body>
</html>