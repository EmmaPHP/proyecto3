<?php
require_once 'models/gastosmodel.php';
require_once 'models/categoriasmodel.php';
class Dashboard extends SessionController{
    private $user;
    function __construct(){
        parent::__construct();
        $this->user = $this->getUserSessionData();
        error_log('Dashboard::Construct -> Inicio de dashboard');
    }
    function render(){
        error_log('Dashboard::render -> Carga el index de dashboard');
        $gastosModel = new GastosModel();
        $gastos = $this->getGastos(5);
        $totalThisMonth = $gastosModel->getTotalAmountThisMonth($this->user->getId());
        $maxExpensesThisMonth = $gastosModel->getMaxExpensesThisMonth($this->user->getId());
        $categories = $this->getCategories();
        $this->view->render('dashboard/index', [
            'user' => $this->user,
            'expenses' => $gastos,
            'totalAmountThisMonth' => $totalThisMonth,
            'maxExpensesThisMonth' => $maxExpensesThisMonth,
            'categories' => $categories
        ]);
    }
    public function getGastos($n){
        if($n < 0) return NULL;
        //error_log("Dashboard::getExpenses() id = " . $this->user->getId());
        $gastos = new GastosModel();
        return $gastos->getByUserIdAndLimit($this->user->getId(), $n);   
    }

    function getCategories(){
        $res = [];
        $categoriesModel = new CategoriasModel();
        $gastosModel = new GastosModel();
        $categorias = $categoriesModel->getAll();
        foreach ($categorias as $category) {
            $categoryArray = [];
            $total = $gastosModel->getTotalByCategoryThisMonth($category->getId(), $this->user->getId());
            // obtenemos el número de expenses por categoria por mes
            $numeroDeGastos = $gastosModel->getNumberOfExpensesByCategoryThisMonth($category->getId(), $this->user->getId());
            if($numeroDeGastos > 0){
                $categoryArray['total'] = $total;
                $categoryArray['count'] = $numeroDeGastos;
                $categoryArray['category'] = $category;
                array_push($res, $categoryArray);
            }
            
        }
        return $res;
    }
}
?>