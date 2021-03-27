<?php
	date_default_timezone_set('America/Sao_Paulo');
	error_reporting(E_ALL);

	use React\EventLoop\Factory;
	use src\dbClass;

	require 'vendor/autoload.php';
	
	$loop = Factory::create();
	
		echo(date("d/m/Y-G:i:s")." (crud.php) Started Eventloop\n");
		
		$db = new dbClass($loop);
	
//		(R)ead an users data
		$UserData = $db->getUser("user1");
		print_r($UserData);
	
		echo(date("d/m/Y-G:i:s")." (crud.php) Connection-quit\n\n\n");
		$connection->quit();
		$db->quit();
	$loop->run();
	echo(date("d/m/Y-G:i:s")." (crud.php) Ended Eventloop. Bye bye\n");
?>

