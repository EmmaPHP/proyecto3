<?php

class GastosModel extends Model implements IModel{

    private $id;
    private $titulo;
    private $amount;
    private $categoryid;
    private $date;
    private $userid;

    public function setId($id){ $this->id = $id; }
    public function setTitle($titulo){ $this->titulo= $titulo; }
    public function setAmount($amount){ $this->amount = $amount; }
    public function setCategoryId($categoryid){ $this->categoryid = $categoryid; }
    public function setDate($date){ $this->date = $date; }
    public function setUserId($userid){ $this->userid = $userid; }

    public function getId(){ return $this->id;}
    public function getTitle(){ return $this->titulo; }
    public function getAmount(){ return $this->amount; }
    public function getCategoryId(){ return $this->categoryid; }
    public function getDate(){ return $this->date; }
    public function getUserId(){ return $this->userid; }

    public function __construct(){
        parent::__construct();
    }

    public function save(){
        try{
            $query = $this->prepare('INSERT INTO expenses (title, amount, category_id, date, id_user) 
            VALUES(:titulo, :amount, :category, :d, :user)');
            $query->execute([
                'title' => $this->titulo, 
                'amount' => $this->amount, 
                'category' => $this->categoryid, 
                'user' => $this->userid, 
                'd' => $this->date
            ]);
            if($query->rowCount()) return true;

            return false;
        }catch(PDOException $e){
            return false;
        }
    }
    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM expenses WHERE id = :id');
            $query->execute([ 'id' => $id]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function from($array){
        $this->id = $array['id'];
        $this->titulo = $array['title'];
        $this->amount = $array['amount'];
        $this->categoryid = $array['category_id'];
        $this->date = $array['date'];
        $this->userid = $array['id_user'];
    }

    public function update(){
        try{
            $query = $this->prepare('UPDATE expenses SET title = :titulo, amount = :amount, 
            category_id = :category, date = :d, id_user = :user WHERE id = :id');
            $query->execute([
                'title' => $this->titulo, 
                'amount' => $this->amount, 
                'category' => $this->categoryid, 
                'user' => $this->userid, 
                'd' => $this->date
            ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function get($id){
        try{
            $query = $this->prepare('SELECT * FROM expenses WHERE id = :id');
            $query->execute([ 'id' => $id]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $this->from($user);
            return $this;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getAll(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM expenses');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new GastosModel();
                $item->from($p); 
                
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getAllByUserId($userid){
        $items = [];

        try{
            $query = $this->prepare('SELECT * FROM expenses WHERE id_user = :userid');
            $query->execute([ "userid" => $userid]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new GastosModel();
                $item->from($p); 
                
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            return [];
        }
    }

    /**
     * Obtiene el total de amount de expenses basado en id de categoria
     */
    function getNumberOfExpensesByCategoryThisMonth($categoryid, $userid){
        try{
            $total = 0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT COUNT(id) AS total from expenses 
            WHERE category_id = :categoryid AND id_user = :userid AND YEAR(date) = :year 
            AND MONTH(date) = :month');
            $query->execute(['categoryid' => $categoryid, 'userid' => $userid, 'year' => $year, 
            'month' => $month]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) return 0;
            return $total;

        }catch(PDOException $e){
            return NULL;
        }
    }

    public function getByUserIdAndLimit($userid, $n){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM expenses WHERE id_user = :userid 
            ORDER BY expenses.date DESC LIMIT 0, :n ');
            $query->execute([ 'n' => $n, 'userid' => $userid]);
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ExpensesModel();
                $item->from($p);                 
                array_push($items, $item);
            }
            error_log("GastosModel::getByUserIdAndLimit(): count: " . count($items));
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    /**
     * Regresa el monto total de expenses en este mes
     */
    function getTotalAmountThisMonth($iduser){
        try{
            $year = date('Y');
            $month = date('m');
            $query = $this->db->connect()->prepare('SELECT SUM(amount) AS total FROM expenses 
            WHERE YEAR(date) = :year AND MONTH(date) = :month AND id_user = :iduser');
            $query->execute(['year' => $year, 'month' => $month, 'iduser' => $iduser]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) $total = 0;
            
            return $total;

        }catch(PDOException $e){
            return NULL;
        }
    }

    function getMaxExpensesThisMonth($iduser){
        try{
            $year = date('Y');
            $month = date('m');
            $query = $this->db->connect()->prepare('SELECT MAX(amount) AS total FROM expenses 
            WHERE YEAR(date) = :year AND MONTH(date) = :month AND id_user = :iduser');
            $query->execute(['year' => $year, 'month' => $month, 'iduser' => $iduser]);
            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) $total = 0;
            return $total;
        }catch(PDOException $e){
            return NULL;
        }
    }

    function getTotalByCategoryThisMonth($categoryid, $userid){
        error_log("GastosModel::getTotalByCategoryThisMonth");
        try{
            $total = 0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT SUM(amount) AS total from expenses 
            WHERE category_id = :categoryid AND id_user = :userid AND YEAR(date) = :year AND MONTH(date) = :month');
            $query->execute(['categoryid' => $categoryid, 'userid' => $userid, 'year' => $year, 'month' => $month]);
            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) return 0;
            return $total;

        }catch(PDOException $e){
            error_log("**ERROR: GastosModel::getTotalByCategoryThisMonth: error: " . $e);
            return NULL;
        }
    }
}
?>