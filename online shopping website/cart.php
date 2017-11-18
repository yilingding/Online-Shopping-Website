<?php
if(isset($_POST['action'])){
	$action = $_POST['action'];
	if($action == "backshop"){
		$_SESSION['username'] = $username;
		header("Location: ./index.php?mode=onlineStore");
	}
	if($action == "checkout"){
		$_SESSION['username'] = $username;
		header("Location: ./index.php?mode=checkout");
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<title>Order Deatils</title>
</head>


<body class="cart">
	<div class="navForshoppingSite">
  <ul>	
 	<li id="cartNav">
    <form action="onlineStore.php" method="post">
    	<button class="menu" name="action" value="backshop">Go Back Shopping</button>
 	</form>
 	</li>

    <li id="cartNav">
 	<form action="checkout.php" method="post">
    	<button class="menu" name="action" value="checkout">Check Out</button>
 	</form>
    </li>
    
    <li id="other">
	<form action="controller.php" method="post">
    	<button class="menu" name="action" value="logout">Logout</button>
  	</form> 
  	</li>

    <li id="other">
      <?php 
        require_once "./DatabaseAdaptor.php";
        session_start();
      ?>
      <p>Hello, <?php  echo $_SESSION['username'];  ?></p>
    </li>
  </ul>
</div>


<h1>Shopping Cart</h1>
<?php

?>
<?php 
if(isset($_POST["addToCart"]) && isset($_GET["action"])){
	$action = $_GET["action"];
	$name = $_POST["hidden_name"];
	if($action == 'add'){
		$all = $myDatabaseAdaptor->checkItem($name, $_SESSION['username']);
		if(count($all)== 0){//safe
	    	$myDatabaseAdaptor->addItems($name, $_SESSION['username'],$_POST["hidden_price"],$_POST["quantity"]);
	    }else{//already have that item in the cart
	    	$myDatabaseAdaptor->updateQuoteUp($name, $_SESSION['username']);
	    }
	}
}


$data1 = $myDatabaseAdaptor->emptyCart($_SESSION['username']);

if($data1[0]['count']==0){
echo 'Now, your shopping cart is empty, so there is nothing to display.' ;
}


$data = $myDatabaseAdaptor->getCart($_SESSION['username']);

foreach ( $data as $record) { ?>
<div class="cartOne">
        	Product Name: <?php echo $record['name']; ?>
        	<br>
        	Price: $<?php echo $record['price']; ?>
        	<br>
        	
        	<div class='quantity'>
            	Quantity:<?php echo $record['quantity']; ?>
        	</div>
	        <div class='up_down'>
	            <form class='up' action='controller.php' method='post'>
	                <input hidden name='up' value='up'>
	                <input hidden name='name' value='<?php echo $record['name']; ?>'>
	                <button>+</button>
	            </form><br>
	            <form class='down' action='controller.php' method='post'>
	                <input hidden name='down' value='down'>
	                <input hidden name='name' value='<?php echo $record['name']; ?>'>
	                <button>-</button>
	            </form>
	        </div>

	       	<form class='remove' action='controller.php' method='post'>
	            <input hidden name='remove' value='value'>
	            <input hidden name='name' value='<?php echo $record['name']; ?>'>
	            <button>Remove</button>
	        </form>
		</div>

<?php
}
?>
<br>
<br>
<br>


 	<div class="warning">
		<?php
		    if(isset($_SESSION["error"])){
            	echo $_SESSION["error"];
        	}else{
        		echo $_SESSION["error"] = "";
        	}
		?>
	</div>
</body>
</html>