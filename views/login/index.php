<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <section>
    <h1></h1>
    <p>
        <?php $this->showMessages();  ?>  </p>
        <div class="login-page">
            <div class="form">
                <form action="<?php echo constant('URL'); ?>login/authenticate" method="POST" class="register-form">
                
                    <div><?php (isset($this->MensajesError))? $this->MensajesError : '' ?> </div>
                    
                    <h2>Iniciar Sesión </h2>

                    <p>
                        <label for="username"></label>
                        <input class= "date" type="text" name="username" id="username" autocomplete="off" placeholder="Introduce tu usuario">
                    </p>
                    <p>
                        <label for="password"></label>
                        <input class="date" type="password" name="password" id="password" autocomplete="off" placeholder="Introduce tu contraseña">
                    </p>
                    <p>
                        <input class="botones" type="submit" value="Iniciar sesión" id="button">
                    </p>
                    <p>
                        ¿No tienes cuenta? <a href="<?php echo constant('URL'); ?>signup">Registrate Aqui</a>
                    </p>

                </form>
            </div>
        </div>
    </section>
</body>
</html>