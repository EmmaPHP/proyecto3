<?php
    class Errores extends Controller{
        function __construct(){
            parent::__construct();
            error_log('Errores::Construct -> Inicio de Errores');
        }
        function render(){
            $this->view->render('errores/index');
        }
    }

?>