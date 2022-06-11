<?php
  
    $user                   = $this->d['user'];
  
?>
<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/default.css">
<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/dashboard.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


<div id="header">
    <ul>
        <li><a href="<?php echo constant('URL'); ?>dashboard">Home</a></li>
        <li><a href="<?php echo constant('URL').'gastos'; ?>">Gastos</a></li>
        <li><a href="<?php echo constant('URL'); ?>Salir">Salir</a></li>
    </ul>

    <div id="profile-container">
        <a href="<?php echo constant('URL');?>usuario">
            <div class="name"><?php echo $user->getName(); ?></div>
            <div class="photo">
                <?php  if($user->getPhoto() == ''){?>
                        <i class="material-icons">account_circle</i>
                <?php }else{ ?>
                        <img src="<?php echo constant('URL'); ?>public/img/photos/<?php echo $user->getPhoto() ?>" width="32" />
                <?php }  ?>
            </div>
        </a>
        <div id="submenu">
            <ul>
                <li><a href="<?php echo constant('URL'); ?>usuario">Ver perfil</a></li>
                <li class='divisor'></li>
                <li><a href="<?php echo constant('URL'); ?>Salir">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</div>
