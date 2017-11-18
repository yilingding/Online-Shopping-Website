<?php
require_once "./DatabaseAdaptor.php";

session_start();


if(isset($_POST['action']) && isset($_POST['name']) && isset($_POST['pw'])){
	$action = $_POST['action'];
	$username = $_POST['name'];
	$password = $_POST['pw'];
	// $password = password_hash($_POST['pw'], PASSWORD_DEFAULT);
	if($action == "register"){
		$all =$myDatabaseAdaptor->checkAccountName($username);
		if(count($all)===1){
			$_SESSION["error"] = "Account is already existed, Please change your information.";
        	header("Location: ./index.php?mode=register");
		}else{
			$secret = password_hash($password, PASSWORD_DEFAULT);
			$myDatabaseAdaptor->createAccount($username, $secret);	//create account and store hashed password into db
			$_SESSION['username'] = $username;
			header("Location: ./index.php?mode=onlineStore");
		}
	}
	if($action == "login"){
		//TA says we can hard code this one for administor to look at admin report
		if(($username === "administrator")){ 
			$_SESSION['username'] = $username;
			header("Location: ./index.php?mode=adminReport");
		}else{
			if($myDatabaseAdaptor->CheckSecret($username, $password)==1){
			// $all = $myDatabaseAdaptor->CheckSecret($username, $password);
			// if(count($all)===1){//count($all)===1
				//$myDatabaseAdaptor->createAccount($username, $password);	//create account
				$_SESSION['username'] = $username;
				header("Location: ./index.php?mode=onlineStore");
			}else{
				$_SESSION["error"] = "Wrong username or password. Please change your information.";
	        	header("Location: ./index.php?mode=login");
			}

		}

	}
	if($action=="non"){
	$username="Customer";
		$secret ="666";
		$myDatabaseAdaptor->createAccount($username, $secret);
		$myDatabaseAdaptor->clearCartForCustomer($username);
		$_SESSION['username'] = $username;
header("Location: ./index.php?mode=onlineStore");
	}
	
	if($action == "back"){
		session_destroy();
		header("Location: ./index.php");
	}
}else if(isset($_POST['action']) && isset($_POST['product'])){
	$action = $_POST['action'];
	if($action == "addToCart"){
		//To Do: check item 
		echo "===>".$_POST['product']. "|||";
		echo $_SESSION['username'];
		$myDatabaseAdaptor->addItems($_SESSION['username'], $_POST['product']);	
		header("Location: ./index.php?mode=cart");
	}

	// if($action == "logout"){
	// 	session_destroy();
	// }
	// header("Location: ./index.php");
}else if(isset($_POST['action'])){
	$action = $_POST['action'];
	if($action == "logout"){
		session_destroy();
		header("Location: ./index.php");
	}
	if($action == "view"){
		header("Location: ./index.php?mode=cart");
	}
}else if (isset($_POST['up'])){
    	$name = $_POST['name'];
    	$myDatabaseAdaptor->updateQuoteUp($name, $_SESSION['username']);
    	header("Location: ./index.php?mode=cart");
}else if (isset($_POST['down'])){
    	$name = $_POST['name'];
    	if(($myDatabaseAdaptor->updateQuoteDown($name, $_SESSION['username']))==0){
    	}
    	header("Location: ./index.php?mode=cart");
}else if(isset($_POST['remove'])){
		// 	if($_GET["action"] == "remove"){
		$name = $_POST['name'];
		$myDatabaseAdaptor->deleteItem($name, $_SESSION['username']);
		header("Location: ./index.php?mode=cart");
		// header("Location: ./index.php");
	}
?>

