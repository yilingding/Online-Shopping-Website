<!DOCTYPE html>
<html>
<head>
	<title>Admin Report</title>
</head>
<body>
<?php 
    require_once "./DatabaseAdaptor.php";
    session_start();
    ?>

    	<table>
		<tr>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Price for each</th>
			<th>Customer</th>
			<th>PurchaseDate</th>
		<th>Total</th>
		</tr>
	</table>
	<?php

    $all = $myDatabaseAdaptor->printUserReport($_POST['user']);
    foreach ($all as $record) {
    	?>
    	<tr>
			<td><?php echo $record['product']; ?></td>
			<td><?php echo $record['quantity']; ?></td>
			<td><?php echo $record['price']; ?></td>
			<td><?php echo $record['username']; ?></td>
			<td><?php echo $record['purchaseDate']; ?></td>
			<td><?php echo $record['total']; ?></td>
		</tr> 
		<br>
    <?php
    }
 $all1 = $myDatabaseAdaptor->printUsername();
    
	?>



</body>
</html>