<?php
require_once 'models/gastosmodel.php';
require_once 'models/categoriasmodel.php';
class Gastos extends SessionController{
    private $user;
    function __construct(){
        parent::__construct();
        $this->$user = $this->getUserSessionData();
        error_log("Gastos::constructor() ");
    }
    function render(){
        error_log("Gastos::RENDER() ");

        $this->view->render('gastos/index', [
            'user' => $this->user,
            'dates' => $this->getDateList(),
            'categories' => $this->getCategoryList()
        ]);
    }
    function newExpense(){
        error_log('Gastos::newExpense()');
        if(!$this->existPOST(['title', 'amount', 'category', 'date'])){
            $this->redirect('dashboard', ['error' => MensajesError::ERROR_EXPENSES_NEWEXPENSE_EMPTY]);
            return;
        }

        if($this->user == NULL){
            $this->redirect('dashboard', ['error' => MensajesError::ERROR_EXPENSES_NEWEXPENSE]);
            return;
        }
        $gasto = new GastosModel();
        $gasto->setTitle($this->getPost('title'));
        $gasto->setAmount((float)$this->getPost('amount'));
        $gasto->setCategoryId($this->getPost('category'));
        $gasto->setDate($this->getPost('date'));
        $gasto->setUserId($this->user->getId());
        $gasto->save();
        $this->redirect('dashboard', ['success' => MensajesCorrectos::SUCCESS_EXPENSES_NEWEXPENSE]);
    }
    function create(){
        $categories = new CategoriasModel();
        $this->view->render('gastos/create', [
            "categories" => $categories->getAll(),
            "user" => $this->user
        ]);
    } 

    function getCategoryIds(){
        $UnionGastosCatModel = new UnionGastosCatModel();
        $categories = $UnionGastosCatModel->getAll($this->user->getId());
        $res = [];
        foreach ($categories as $cat) {
            array_push($res, $cat->getCategoryId());
        }
        $res = array_values(array_unique($res));
        return $res;
    }
    private function getCategoryColorList(){
        $res = [];
        $UnionGastosCatModel = new UnionGastosCatModel();
        $gastos = $UnionGastosCatModel->getAll($this->user->getId());
        foreach ($gastos as $gasto) {
            array_push($res, $gasto->getColor());
        }
        $res = array_unique($res);
        $res = array_values(array_unique($res));
        return $res;
    }
    private function getCategoryList(){
        $res = [];
        $UnionGastosCatModel = new UnionGastosCatModel();
        $gastos = $UnionGastosCatModel->getAll($this->user->getId());
        foreach ($gastos as $gasto) {
            array_push($res, $gasto->getNameCategory());
        }
        $res = array_values(array_unique($res));
        return $res;
    }
    function getHistoryJSON(){
        header('Content-Type: application/json');
        $res = [];
        $UnionGastosCatModel = new UnionGastosCatModel();
        $gastos = $UnionGastosCatModel->getAll($this->user->getId());
        foreach ($gastos as $gasto) {
            array_push($res, $gasto->toArray());
        }
        echo json_encode($res);
    }
    function getExpensesJSON(){
        header('Content-Type: application/json');

        $res = [];
        $categoryIds = $this->getCategoryIds();
        $categoryNames  = $this->getCategoryList();
        $categoryColors = $this->getCategoryColorList();
        array_unshift($categoryNames, 'mes');
        array_unshift($categoryColors, 'categorias');
        $months = $this->getDateList();
        for($i = 0; $i < count($months); $i++){
            $item = array($months[$i]);
            for($j = 0; $j < count($categoryIds); $j++){
                $total = $this->getTotalByMonthAndCategory( $months[$i], $categoryIds[$j]);
                array_push( $item, $total );
            }   
            array_push($res, $item);
        }
        array_unshift($res, $categoryNames);
        array_unshift($res, $categoryColors);
        echo json_encode($res);
    }
    private function getDateList(){
        $months = [];
        $res = [];
        $UnionGastosCatModel = new UnionGastosCatModel();
        $gastos = $UnionGastosCatModel->getAll($this->user->getId());
        foreach ($gastos as $gasto) {
            array_push($months, substr($gasto->getDate(),0, 7 ));
        }
        $months = array_values(array_unique($months));
        if(count($months) >3){
            array_push($res, array_pop($months));
            array_push($res, array_pop($months));
            array_push($res, array_pop($months));
        }
        return $res;
    }
    function getTotalByMonthAndCategory($date, $categoryid){
        $iduser = $this->user->getId();
        $UnionGastosCatModel = new UnionGastosCatModel();

        $total = $UnionGastosCatModel->getTotalByMonthAndCategory($date, $categoryid, $iduser);
        if($total == NULL) $total = 0;
        return $total;
    }
    function delete($params){
        error_log("Gastos::delete()");
        
        if($params === NULL) $this->redirect('gastos', ['error' => MensajesError::ERROR_ADMIN_NEWCATEGORY_EXISTS]);
        $id = $params[0];
        error_log("Gastos::delete() id = " . $id);
        $res = $this->model->delete($id);

        if($res){
            $this->redirect('gastos', ['success' => MensajesCorrectos::SUCCESS_EXPENSES_DELETE]);
        }else{
            $this->redirect('gastos', ['error' => MensajesError::ERROR_ADMIN_NEWCATEGORY_EXISTS]);
        }
    }
}
?>