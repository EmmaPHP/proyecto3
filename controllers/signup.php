<?php
require_once 'models/usermodel.php';
class Signup extends SessionController{

    function __construct(){
        parent::__construct();
    }

    function render(){
        $this->view->errorMessage = '';
        $this->view->render('login/signup');
    }

    function nuevoUsuario(){
        if($this->existPOST(['username', 'password'])){
            
            $username = $this->getPost('username');
            $password = $this->getPost('password');
            error_log('Controller::nuevoUsuario => ver datos:');
            if($username == '' || empty($username) || $password == '' || empty($password)){
                $this->redirect('signup', ['error' => MensajesError::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }

            $user = new UserModel();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRole("user");
            
            if($user->exists($username)){
                //$this->errorAtSignup('Error al registrar el usuario. Elige un nombre de usuario diferente');
                $this->redirect('signup', ['error' => MensajesError::ERROR_SIGNUP_NEWUSER_EXISTS]);
                //return;
            }else if($user->save()){
                //$this->view->render('login/index');
                $this->redirect('', ['success' => MensajesCorrectos::SUCCESS_SIGNUP_NEWUSER]);
            }else{
                /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                return; */
                $this->redirect('signup', ['error' => MensajesError::ERROR_SIGNUP_NEWUSER]);
            }
        }else{
            // error, cargar vista con errores
            //$this->errorAtSignup('Ingresa nombre de usuario y password');
            $this->redirect('signup', ['error' => MensajesError::ERROR_SIGNUP_NEWUSER]);
        }
    }
}

?>