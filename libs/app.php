<?php

require_once 'controllers/errores.php';

class App{

    function __construct(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);//permite saber el controlador al que se
        
        if(empty($url[0])){
            error_log('APP::construct-> no hay controlador especifico');
            $archivoController = 'controllers/login.php';
            require_once $archivoController;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }
        $archivoController = 'controllers/' . $url[0] . '.php';
        if(file_exists($archivoController)){
            require_once $archivoController;
            $controller = new $url[0];
            $controller->loadModel($url[0]);
            if(isset($url[1])){
                if(method_exists($controller, $url[1])){
                    if(isset($url[2])){
                        $nparam = count($url) - 2;
                        $params = [];
                        for($i = 0; $i< $nparam; $i++){
                            array_push($params, $url[$i]+2);
                        }
                        $controller->{$url[1]}($params);
                    }else{
                        //no tiene paramettros se manda a llamar el método tal cual
                        $controller->{$url[1]}();
                    }
                }else{
                    //no existe el metodo
                    $controller = new Errores();
                    $controller->render();
                }
            }else{
                //no hay metodo a cargar, se carga el metodo por default
                $controller->render();//carga metodo por defecto
            }
        }else{
            $controller = new Errores();
            $controller->render();
        }

    }
}

?>