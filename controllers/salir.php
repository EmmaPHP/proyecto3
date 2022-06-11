
<?php

class Salir extends SessionController{

    function __construct(){
        parent::__construct();
    }

    public function render(){
        $this->logout();

        $this->redirect('');
    }
}

?>