<!DOCTYPE html>
<html>
<head>
	<title>Admin Report</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="report">
	<h1>Administrator Report</h1>
	<?php 
    require_once "./DatabaseAdaptor.php";
    session_start();
    ?>
    <h4>Orders that have been placed by all users from our website:</h4>
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
    
	?>

<h4>You could also choose to see the orders that have been placed by one specific user</h4>
<form>
	<select name="users" onchange="showCustomer(this.value)">
		<option value="">Select a customer:</option>

<?php foreach ($all1 as $record1){?>
<option value="<?php echo $record1['username']; ?>">
    <?php echo $record1['username']; ?>
</option>

	<?php } ?>
</select>
</form>
<br>

<div id="output">Orders made by the customer you choose will be listed here...</div>



  <form action="controller.php" method="post">
    <button class="menu" name="action" value="logout">Logout</button>
  </form>

<script >
	

	function showCustomer(str) {
	
  if (str == "") {
    document.getElementById("output").innerHTML = "Orders made by the customer you choose will be listed here...";
   return;
  }else{

getOutput(str);

}

}




function getOutput(str) {
	document.getElementById("output").innerHTML = "choose";
     var str1=str;
  getRequest(
  	  'myAjax.php', // URL for the PHP file
       drawOutput,  // handle successful request
       drawError,    // handle error
       str1

  );
  return false;
}  
// handles drawing an error message
function drawError() {
    var container = document.getElementById('output');
    container.innerHTML = 'Bummer: there was an error!';
}
// handles the response, adds the html
function drawOutput(responseText) {
    var container = document.getElementById('output');
    container.innerHTML = responseText;
}
// helper function for cross-browser request object
function getRequest(url, success, error,str) {
    var req = false;
    try{
        // most browsers
        req = new XMLHttpRequest();
    } catch (e){
        // IE
        try{
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            // try an older version
            try{
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                return false;
            }
        }
    }
    if (!req) return false;
    if (typeof success != 'function') success = function () {};
    if (typeof error!= 'function') error = function () {};
    req.onreadystatechange = function(){
        if(req.readyState == 4) {
            return req.status === 200 ? 
                success(req.responseText) : error(req.status);
        }
    }
    req.open("POST", url, true);
    var data = new FormData();
    data.append('user',str);
    req.send(data);
    return req;
}

</script>





</body>
</html>