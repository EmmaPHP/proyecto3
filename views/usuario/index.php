<?php
    $user = $this->d['user'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/usuario.css">
    <title>Usuarios</title>
</head>
<body class="body">

    <div id="main-container">
    <?php $this->showMessages();?>
        <div id="user-container" class="container">
            <div>
                <div id="user-info-container">
                    <div id="user-photo">
                    <?php if($user->getPhoto() != ''){?>
                        <img src="public/img/photos/<?php echo $user->getPhoto(); ?>" width="85" />
                    <?php }
                    ?>
                    </div>
                    <div id="user-info">
                        <h2><?php echo ($user->getName() != '')? $user->getName(): $user->getUsername(); ?></h2>
                    </div>
                </div>
            </div>
            <div id="side-menu">
                <ul>
                    <li><a href="#info-user-container">Personalizar usuario</a></li>
                    <li><a href="#password-user-container">Password</a></li>
                    <li><a href="#budget-user-container">Presupuesto</a></li>
                </ul>
            </div>

            <div id="user-section-container">
                <section id="info-user-container">
                    <form action=<?php echo constant('URL'). 'usuario/updateName' ?> method="POST">
                    <br>
                        <div class="section">
                            <br>
                            <input class="nombre" type="text" name="name" id="name" autocomplete="off" required value="<?php echo $user->getName() ?>">
                            <label class="parrafo" for="name">Nombre</label>
                            <div><input class="boton" type="submit" value="Cambiar nombre" /></div>
                        </div>
                    </form><br>

                    <form action="<?php echo constant('URL'). 'usuario/updatePhoto' ?>" method="POST" enctype="multipart/form-data">
                        <div class="section">
                            <label class="parrafo" for="photo">Foto de perfil </label>

                            <?php
                                if(!empty($user->getPhoto())){
                            ?>
                                <img src="<?php echo constant('URL') ?>public/img/photos/<?php echo $user->getPhoto() ?>" width="50" height="50" padding="10px"/>
                            <?php
                                }
                            ?>
                            <input type="file" name="photo" id="photo"  autocomplete="off" required>
                            <div> <input class="boton" type="submit" value="Cambiar foto de perfil" /></div>
                        </div>
                    </form>
                </section>

                <section id="password-user-container">
                    <form action="<?php echo constant('URL'). 'usuario/updatePassword' ?>" method="POST"><br>
                        <div class="section">
                            <label class="parrafo" for="current_password">Password actual</label>
                            <input class="actual" type="password" name="current_password" id="current_password" autocomplete="off" required>

                            <br><label class="parrafo" for="new_password">Nuevo password</label>
                            <input class="nuevo" type="password" name="new_password" id="new_password" autocomplete="off" required>
                            <div><input class="boton" type="submit" value="Cambiar password" /></div>
                        </div>
                    </form>
                </section> 
                <section id="budget-user-container">
                    <form action="<?php echo constant('URL'). 'usuario/updateBudget'  ?>" method="POST">
                        <div class="section">
                            <label class="parrafo" for="budget">Definir presupuesto </label>
                            <input class="presupuesto" type="number" name="budget" id="budget" autocomplete="off" required value="<?php echo $user->getBudget() ?>">
                            <div><input class="boton" type="submit" value="Actualizar presupuesto" /></div>
                        </div>
                    </form>
                    <div>
                        <ul>
                            <li>
                                <a href="<?php echo constant('URL'); ?>salir">Cerrar sessión</a>
                            </li>
                        </ul>
                    </div>
                </section>

            </div>
        </div>

    </div>
    <script>

        const url = location.href;
        const indexAnchor = url.indexOf('#');

        closeSections();

        if(indexAnchor > 0){
            const anchor = url.substring(indexAnchor);
            document.querySelector(anchor).style.display = 'block';
            
            document.querySelectorAll('#side-menu a').forEach(item =>{
                if(item.getAttribute('href') === anchor){
                    item.classList.add('option-active');
                }
            });
        }else{
            document.querySelector('#info-user-container').style.display = 'block';
            document.querySelectorAll('#side-menu a')[0].classList.add('option-active');
        }
        document.querySelectorAll('#side-menu a').forEach(item =>{
            item.addEventListener('click', e =>{
                closeSections();
                const anchor = e.target.getAttribute('href');
                document.querySelector(anchor).style.display = 'block';
                e.target.classList.add('option-active');
            });
        });

        function closeSections(){
            const sections = document.querySelectorAll('section');
            sections.forEach(item =>{
                item.style.display="nome";
            });
            document.querySelectorAll('.option-active').forEach(item =>{
                item.classList.remove('option-active');
            });
        }
    </script>
</body>
</html>