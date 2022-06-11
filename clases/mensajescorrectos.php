<?php
class MensajesCorrectos{
    const SUCCESS_ADMIN_NEWCATEGORY = "2510c39011c5be704182423e3a695e91";
    const SUCCESS_ADMIN_NEWCATEGORY_EXISTS = "7694f4a66316e53c8cdd9d9954bd611d";
    const SUCCESS_SIGNUP_NEWUSER = "f1290186a5d0b1ceab27f4e77c0c5d68";
    const SUCCESS_EXPENSES_DELETE = "4b43b0aee35624cd95b910189b3dc231";
    const SUCCESS_EXPENSES_NEWEXPENSE = "5ca2aa845c8cd5ace6b016841f100d82";
    const SUCCESS_USER_UPDATEBUDGET = "5f02f0889301fd7be1ac972c11bf3e7d";
    const SUCCESS_USER_UPDATENAME = "690382ddccb8abc7367a136262e1978f";
    const SUCCESS_USER_UPDATEPASSWORD =  "d4579b2688d675235f402f6b4b43bcbf";
    const SUCCESS_USER_UPDATEPHOTO = "b807023f87e63b8ada92f79f546ff9cc";
    private $successList = [];

    public function __construct(){
        $this->successList = [
            MensajesCorrectos::SUCCESS_ADMIN_NEWCATEGORY_EXISTS => 'El nombre de la categoria se ha creado exitosamente',
            MensajesCorrectos::SUCCESS_SIGNUP_NEWUSER => 'Nuevo usuario registrado correctamente',
            MensajesCorrectos::SUCCESS_ADMIN_NEWCATEGORY => "Nueva categoría creada correctamente",
            MensajesCorrectos::SUCCESS_EXPENSES_DELETE => "Gasto eliminado correctamente",
            MensajesCorrectos::SUCCESS_EXPENSES_NEWEXPENSE => "Nuevo gasto registrado correctamente",
            MensajesCorrectos::SUCCESS_USER_UPDATEBUDGET => "Nombre actualizado correctamente",
            MensajesCorrectos::SUCCESS_USER_UPDATENAME => "Presupuesto actualizado correctamente",
            MensajesCorrectos::SUCCESS_USER_UPDATEPASSWORD => "Contraseña actualizado correctamente",
            MensajesCorrectos::SUCCESS_USER_UPDATEPHOTO => "Imagen de usuario actualizada correctamente",
            
        ];
    }
    public function get($hash){
        return $this->successList[$hash];
    }
    public function existsKey($key){
        if(array_key_exists($key, $this->successList)){
            return true;
        }else{
            return false;
        }
    }

}

?>