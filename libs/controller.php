<?php
class Controller{
    function __construct(){
        $this->view = new View();//crea variable view
    }

    function loadModel($model){ //funcion que permite cargar el modelo
        $url = 'models/' . $model .'model.php';//se disela la url
        if(file_exists($url)){ //se valida que existe el archivo
            require_once $url;//se incorpora el archivo al confirmar su existencia
            $modelName = $model.'Model';//se estructura el nombre del modelo
            $this->model = new $modelName();//se carga el modelo
        }
    }

    function existPOST($params){
        foreach ($params as $param) {
            if(!isset($_POST[$param])){
                error_log("ExistPOST: No existe el parametro $param" );
                return false;
            }
        }
        error_log( "ExistPOST: Existen parámetros" );
        return true;
    }

    function existGET($params){
        foreach ($params as $param) {
            if(!isset($_GET[$param])){
                return false;
            }
        }
        return true;
    }

    function getGet($name){
        return $_GET[$name];
    }

    function getPost($name){
        return $_POST[$name];
    }

    function redirect($url, $mensajes = []){
        $data = [];
        $params = '';
        
        foreach ($mensajes as $key => $value) {
            array_push($data, $key . '=' . $value);
        }
        $params = join('&', $data);
        
        if($params != ''){
            $params = '?' . $params;
        }
        header('location: ' . constant('URL') . $url . $params);
    }
}
?>