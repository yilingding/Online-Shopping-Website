<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<title>Check Out</title>
</head>

<body class="checkout">
<h1>Check Out</h1>
<h1>Hello, 
	<?php 
	require_once "./DatabaseAdaptor.php";
	session_start();
	// echo $_POST['hidden_name']
	echo $_SESSION['username']; 
	?>

	<form action="controller.php" method="post">
    	<button class="menu" name="action" value="logout">logout</button>
  	</form>

	<div class="checkOut_Form">
		<!-- TO DO : send to admin -->
	    <form action="recepit.php" method="POST"> 
	    	<fieldset>
	    		<legend>Tell us about yourself</legend>
	    			<label>First Name:</label>
	    			<input name="firstname" pattern="[A-Za-z]*" required="required"><br>
	    			<label>Last Name:</label>
	    			<input name="lastname" pattern="[A-Za-z]*" required="required"><br>
	    			<label>Telephone number:</label>
	    			<input name="phone" required="required" placeholder="(###) ###-####" ><br>
	    			<label>Your Address:</label>
	    			<input name="address" required="required"><br>

	    			<label>Payment Method</label>
	    			<select>
	    				<option value="credit">Credit</option>
						<option value="check">Check</option>
						<option value="Saving">Saving</option>
	    			</select><br>

	    			<div class="order">
	    				<h2>Confirm your order:</h2>
	    				<table>
							<tr>
								<th>Product Name</th>
							    <th>Price</th>
							    <th>Quantity</th>
							</tr>
	    				</table>
	    				<?php 
	    				$checkout = $myDatabaseAdaptor->getCart($_SESSION['username']);
	    				$total = 0;
	    				$purchaseItem;
						foreach ($checkout as $record) {
						?>
							<tr>
								<td><?php echo $record['name']; ?></td>
								<td><?php echo $record['price']; ?></td>
								<td><?php echo $record['quantity']; ?></td>
							</tr> 
							
						<?php $total += $record['price'] * $record['quantity'];
						
						?>
						<br>
						
						<?php
						}
						
	    				?>
	    				<br>
	    				<input hidden name="total_price" value="<?php echo $total; ?>">
	    				Total Price: $<?php echo $total; ?>
	    				<br>
	    			</div>
	    			<label></label><input type="submit" value="Confirm Request">
	    	</fieldset>
	    </form>
	    <form action="onlineStore.php" method="post">
    		<button class="menu" name="action" value="backshop">Go Back Shopping</button>
 		</form>
</body>
</html>