<?php
class DatabaseAdaptor{
    private $DB;

    public function __construct(){
        $db = 'mysql:dbname=mydatabase;host=127.0.0.1';
        $user = 'root';
        $password = '';
        try {
            $this->DB = new PDO($db, $user, $password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error Establishing connection';
            exit();
        }
    }
    public function clearCart($user){
         $stmt = $this->DB->prepare("DELETE FROM mydatabase.cart WHERE username='".$user."'");
        
        $stmt->execute();
    }
     public function emptyCart($user){
        $stmt = $this->DB->prepare("SELECT count(*) AS 'count' FROM mydatabase.cart WHERE username='".$user."'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   public function clearCartForCustomer($value)
    {
         $stmt = $this->DB->prepare("DELETE FROM mydatabase.cart WHERE username='". $value."'");
        $stmt->execute();
    }
    public function getProduct(){
        $stmt = $this->DB->prepare("SELECT * FROM mydatabase.product");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCart($user){
        $stmt = $this->DB->prepare("SELECT * FROM mydatabase.cart WHERE username='".$user."'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addNewUser($username, $password){
        $stmt = $this->DB->prepare("INSERT INTO mydatabase.account VALUES (:username,:password, now())");
        $stmt->bindParam('username', $username);
        $stmt->bindParam('password', $password);
        $stmt->execute();
    }
     public function addOrderItem($username, $product,$price,$quantity,$total){
        $stmt = $this->DB->prepare("INSERT INTO mydatabase.orderlist VALUES (:username,:product,:price,:quantity,:total, now())");
        $stmt->bindParam('username', $username);
        $stmt->bindParam('product', $product);
        $stmt->bindParam('price', $price);
        $stmt->bindParam('quantity', $quantity);
        $stmt->bindParam('total', $total);
        $stmt->execute();
        echo "suuccess";
    }

    public function checkAccountName($name){
        $stmt = $this->DB->prepare("SELECT * FROM mydatabase.account where username ='".$name."'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // $getUser = $stmt->fetch(PDO::FETCH_ASSOC);
        // return password_verify($pw, $getUser['password']) . PHP_EOL;
    }

    public function CheckSecret($name, $entered_Password){
        // echo $entered_Password;
        $stmt = $this->DB->prepare("SELECT password FROM mydatabase.account where username ='".$name."'");
        // echo "SELECT password FROM mydatabase.account where username ='".$name."'";
        $stmt->execute();
        $stored_secret = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($stored_secret as $record) {
        }
        return password_verify($entered_Password, $record['password']).PHP_EOL;//valid password return 1
    }

    public function checkAccount($name, $pw){
        $stmt = $this->DB->prepare("SELECT * FROM mydatabase.account where username ='".$name."' AND password='".$pw."'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // $getUser = $stmt->fetch(PDO::FETCH_ASSOC);
        // return password_verify($pw, $getUser['password']) . PHP_EOL;
    }

    public function createAccount($name, $pw){
        $stmt = $this->DB->prepare("INSERT INTO mydatabase.account (username, password, registered) VALUES (:name,:pw, now())");
        $stmt->bindParam('name', $name);
        $stmt->bindParam('pw', $pw);
        $stmt->execute();
    }

    public function addItems($name, $user, $price, $quantity){
        $stmt = $this->DB->prepare("INSERT INTO mydatabase.cart (name, username, price,quantity,purchaseDate) VALUES (:name,:user, :price, :quantity, now())");
        $stmt->bindParam('name', $name);
        $stmt->bindParam('user', $user);
        $stmt->bindParam('price', $price);
        $stmt->bindParam('quantity', $quantity);
        $stmt->execute();
    }
 public function printUsername(){
        $stmt = $this->DB->prepare("SELECT distinct username  FROM mydatabase.orderlist");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function printReport(){
        $stmt = $this->DB->prepare("SELECT * FROM mydatabase.orderlist");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkItem($name, $user){
        $stmt = $this->DB->prepare("SELECT * FROM mydatabase.cart where name ='".$name."' AND username='".$user."'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArray(){
        $stmt = $this->DB->prepare("SELECT * FROM mydatabase.cart ORDER BY itemNum DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateQuoteUp($id,$username){
        $stmt = $this->DB->prepare("SELECT quantity, name FROM mydatabase.cart WHERE name='" . $id."' AND username='". $username."'");
        $stmt->execute();
        $getVote = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = $this->DB->prepare("UPDATE mydatabase.cart SET quantity=".($getVote['quantity'] + 1). " WHERE name='" . $id."' AND username='". $username."'");
        $stmt->execute();
    }

    public function updateQuoteDown($id,$username){
        $stmt = $this->DB->prepare("SELECT quantity, name FROM mydatabase.cart WHERE name='" . $id."' AND username='". $username."'");
        $stmt->execute();
        $getVote = $stmt->fetch(PDO::FETCH_ASSOC);

        if(($getVote['quantity'] - 1) < 0){
            return false;
        }else{
            $stmt = $this->DB->prepare("UPDATE mydatabase.cart SET quantity=" . ($getVote['quantity'] - 1). " WHERE name='" .$id."' AND username='". $username."'");
            $stmt->execute();
            return true;
        }

    }
    public function printUserReport($user){
      
        $stmt = $this->DB->prepare("SELECT * FROM mydatabase.orderlist where username ='".$user."'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteItem($ItemName, $username){
        $stmt = $this->DB->prepare("DELETE FROM mydatabase.cart WHERE name='" . $ItemName."' AND username='". $username."'");
        $stmt->execute();
    }
    

}
$myDatabaseAdaptor = new DatabaseAdaptor();
?>
