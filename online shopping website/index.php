<?php
if(isset($_GET['mode'])){
	if($_GET ['mode'] === 'new'){
		require_once("./register.html");
	}else if($_GET ['mode'] === 'login'){
		require_once("./login.html");
	}else if($_GET ['mode'] === 'register'){
		require_once("./register.html");
	}else if($_GET ['mode'] === 'onlineStore'){
		require_once("./onlineStore.php");
	}else if($_GET ['mode'] === 'cart'){
		require_once("./cart.php");
	}else if($_GET ['mode'] === 'checkout'){
		require_once("./checkout.php");
	}else if($_GET ['mode'] === 'adminReport'){
		require_once("./adminReport.php");
	}
}else{ //default
	require_once("./mainPage.php");
}
?>
