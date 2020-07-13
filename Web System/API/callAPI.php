<?php 
	include_once("config.php");
	$callFxn = isset($_REQUEST['method'])?$_REQUEST['method']:"-1";
	//$commonObj->getMonthly_in_useApi();

	switch ($callFxn) {
		case 'checkUIDAlreadyExists':
			$commonObj->checkUIDAlreadyExists();
			break;
		case 'checkUIDAlreadyExistss':
			$commonObj->checkUIDAlreadyExistss();
			break;
		case 'addUser':
			$commonObj->addUser();
			
			break;
		case "getMonthly_in_useApi":
			$commonObj->getMonthly_in_useApi();
			break;
		case 'addnormalUser':
			$commonObj->addnormalUser();
			
			break;
		case "getNormal_in_useApi":
			$commonObj->getNormal_in_useApi();
			break;
		default:
			echo "Method not found! please pass correct method!";
			break;
	}
	
?>
