<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Log In</title>
</head>
<body class="recipt">
	<h1>recipt</h1>

	<!-- once you confirm your order, the info in your cart should be cleared away -->
	<?php 
	require_once "./DatabaseAdaptor.php";

	// session_start();
	// $purchaseItem = $_POST['purchaseItem'];
	// $total_price = $_POST['total_price'];
	//$all =$myDatabaseAdaptor->placeOrder($purchaseItem, $_SESSION['username'], $total_price);
	?>



	Hello,
	<?php
	session_start();
	$checkout = $myDatabaseAdaptor->getCart($_SESSION['username']);
	    				$total = 0;
	    				$purchaseItem;
						foreach ($checkout as $record) {
$total += $record['price'] * $record['quantity'];
$myDatabaseAdaptor->addOrderItem($_SESSION['username'],$record['name'],$record['price'],$record['quantity'],$total);
}





	$myDatabaseAdaptor->clearCart($_SESSION['username']);
	echo $_SESSION['username']; 




	?>
	Welcome to our store,
	Your order have been placed!

	<br>
	Have a nice day! :)



    <form action="onlineStore.php" method="post">
    	<button class="menu" name="action" value="backshop">Go Back Shopping</button>
 	</form>

 	 <form action="controller.php" method="post">
    <button class="menu" name="action" value="logout">logout</button>
  </form>


</body>
</html>
