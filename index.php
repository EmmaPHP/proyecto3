<?php
error_reporting(E_ALL);
ini_set('ignore_repeated_errors',TRUE);

ini_set('display_errors',FALSE);

ini_set('log_errors',TRUE);

ini_set("error_log","C:/xampp/htdocs/proyecto3/php-error.log");
error_log("inicio de aplicacion web!!");


require_once 'libs/database.php';
require_once 'clases/mensajescorrectos.php';
require_once 'clases/mensajeserror.php';
require_once 'libs/model.php';
require_once 'libs/controller.php';
require_once 'libs/view.php';
require_once 'clases/sessioncontroller.php';
require_once 'controllers/errores.php';
require_once 'controllers/login.php';
require_once 'controllers/usuario.php';
require_once 'controllers/signup.php';
require_once 'libs/app.php';
require_once 'config/config.php';

require_once 'clases/session.php';
include_once 'models/loginmodel.php';
include_once 'models/usermodel.php';
include_once 'models/gastosmodel.php';
include_once "models/categoriasmodel.php";
include_once "models/uniongastoscatmodel.php";

$app = new App();

?>