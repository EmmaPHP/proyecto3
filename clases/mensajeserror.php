<?php
class MensajesError{
    const ERROR_ADMIN_NEWCATEGORY_EXISTS = "b74df323e3939b563635a2cba7a7afba";
    const ERROR_SIGNUP_NEWUSER = "c9089f3c9adaf0186f6ffb1ee8d6501c";
    const ERROR_SIGNUP_NEWUSER_EMPTY = "c4ca4238a0b923820dcc509a6f75849b";
    const ERROR_SIGNUP_NEWUSER_EXISTS = "c81e728d9d4c2f636f067f89cc14862c";
    const ERROR_LOGIN_AUTHENTICATE_EMPTY = "eccbc87e4b5ce2fe28308fd9f2a7baf3";
    const ERROR_LOGIN_AUTHENTICATE_DATA = "e4da3b7fbbce2345d7772b0674a318d5";
    const ERROR_EXPENSES_DELETE = "c9f0f895fb98ab9159f51fd0297e236d";
    CONST ERROR_EXPENSES_NEWEXPENSE = "45c48cce2e2d7fbdea1afc51c7c6ad26";
    const ERROR_EXPENSES_NEWEXPENSE_EMPTY = "6512bd43d9caa6e02c990b0a82652dca";
    const ERROR_USER_UPDATEBUDGET = "c20ad4d76fe97759aa27a0c99bff6710";
    const ERROR_USER_UPDATEBUDGET_EMPTY = "c20ad4d76fe97759aa27a0c99bff6710";
    const ERROR_USER_UPDATENAME_EMPTY = "aab3238922bcc25a6f606eb525ffdc56";
    const ERROR_USER_UPDATENAME = "9bf31c7ff062936a96d3c8bd1f8f2ff3";
    const ERROR_USER_UPDATEPASSWORD = "c74d97b01eae257e44aa9d5bade97baf";
    const ERROR_USER_UPDATEPASSWORD_EMPTY = "70efdf2ec9b086079795c442636b55fb";
    const ERROR_USER_UPDATEPASSWORD_ISNOTTHESAME = "1f0e3dad99908345f7439f8ffabdffc4";
    const ERROR_USER_UPDATEPHOTO = "98f13708210194c475687be6106a3b84";
    const ERROR_USER_UPDATEPHOTO_FORMAT = "3c59dc048e8850243be8079a5c74d079";
    const ERROR_LOGIN_AUTHENTICATE = "b6d767d2f8ed5d21a44b0e5886680cb9";
    private $errorList = [];

    public function __construct(){
        $this->errorList = [
            MensajesError::ERROR_ADMIN_NEWCATEGORY_EXISTS => 'El nombre de la categoria ya existe',
            MensajesError::ERROR_SIGNUP_NEWUSER => 'Hubo un error al intentar procesar la solicitud',
            MensajesError::ERROR_SIGNUP_NEWUSER_EMPTY => 'LLena los campos de usurio y Password',
            MensajesError::ERROR_SIGNUP_NEWUSER_EXISTS => 'Ya existe ese nombre de usuario escoge otro',
            MensajesError::ERROR_LOGIN_AUTHENTICATE_EMPTY => 'Llena los compos de usuario y password',
            MensajesError::ERROR_LOGIN_AUTHENTICATE_DATA => 'Nombre de usuario y/o password incorrectos',
            MensajesError::ERROR_EXPENSES_DELETE           => 'Hubo un problema el eliminar el gasto, inténtalo de nuevo',
            MensajesError::ERROR_EXPENSES_NEWEXPENSE       => 'Hubo un problema al crear el gasto, inténtalo de nuevo',
            MensajesError::ERROR_EXPENSES_NEWEXPENSE_EMPTY => 'Los campos no pueden estar vacíos',
            MensajesError::ERROR_USER_UPDATEBUDGET         => 'No se puede actualizar el presupuesto',
            MensajesError::ERROR_USER_UPDATEBUDGET_EMPTY   => 'El presupuesto no puede estar vacio o ser negativo',
            MensajesError::ERROR_USER_UPDATENAME_EMPTY     => 'El nombre no puede estar vacio o ser negativo',
            MensajesError::ERROR_USER_UPDATENAME           => 'No se puede actualizar el nombre',
            MensajesError::ERROR_USER_UPDATEPASSWORD       => 'No se puede actualizar la contraseña',
            MensajesError::ERROR_USER_UPDATEPASSWORD_EMPTY => 'El nombre no puede estar vacio o ser negativo',
            MensajesError::ERROR_USER_UPDATEPASSWORD_ISNOTTHESAME => 'Los passwords no son los mismos',
            MensajesError::ERROR_USER_UPDATEPHOTO          => 'Hubo un error al actualizar la foto',
            MensajesError::ERROR_USER_UPDATEPHOTO_FORMAT   => 'El archivo no es una imagen',
            MensajesError::ERROR_LOGIN_AUTHENTICATE => 'No se puede procesar la solicitud. Ingresa usuario y password'
        ];
    }
    public function get($hash){
        return $this->errorList[$hash];
    }
    public function existsKey($key){
        if(array_key_exists($key, $this->errorList)){
            return true;
        }else{
            return false;
        }
    }

}

?>