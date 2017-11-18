<!DOCTYPE html>
<html>
<head>
	<title>Admin Report</title>
</head>
<body>
	<h1>Administrator Report</h1>
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

    $all = $myDatabaseAdaptor->printReport();
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
     print_r($all1);
	?>
<form>
<select name="users" onchange="showUser(this.value)">
<option value="">Select a customer:</option>
<?php foreach ($all1 as $record1){?>
<option value=<?php $record['username']?>> <?php echo $record['username'] ?></option>
 }

</select>
</form>
<br>
<div id="txtHint"><b>Person info will be listed here.</div>


</body>
</html>