<!DOCTYPE html>
<html> 
<head>
 <link rel="stylesheet" type="text/css" href="styles.css">

  <title>Online Store</title>
</head>

<div class="navForshoppingSite">
  <ul>
    <li id="view">
      <form action="controller.php" method="post">
      <button class="menu" name="action" value="view">View My Shopping Cart</button>
      </form>
    </li>
    <li id="other">
      <form action="controller.php" method="post">
      <button class="menu" name="action" value="logout">Log Out</button>
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
<body class="online">
  <h1>Welcome to Online Store</h1>
  <div class="stock">

<div class="onlineSTwo">
  <?php
    $all = $myDatabaseAdaptor->getProduct();
    foreach ($all as $record) {
  ?>
    <form method="post" action="cart.php?action=add&id=<?php echo $record["id"]; ?>">  
      <div id="boxForEachProduct">
        <img src="./images/<?php echo $record["image"]; ?>"/><br />
        Product Name: <?php echo $record['name'] ?>
        <br>
        Price: $<?php echo $record['price'] ?>
        <br>
        Insert the quantity you want to have:
        <input type="text" name="quantity" value="1" />
        <input hidden name="hidden_name" value="<?php echo $record["name"]; ?>"/>  
        <input hidden name="hidden_price" value="<?php echo $record["price"]; ?>"/> 
        <input type="submit" name="addToCart" value="Add to Cart"/>
      </div>
      <br>
    </form>
  <?php } ?>
  </div>
</div>
</body>
</html> 