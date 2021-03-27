<?php
date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ALL);
echo("\n\n\n\n\n\n\n\n");
echo(date("d/m/Y-G:i:s") . " (crud.php) INI---INI---INI---INI---INI---INI---INI---INI---INI---INI---INI---\n");

use React\EventLoop\Factory;
use React\MySQL\QueryResult;
use src\dbClass;

require 'vendor/autoload.php';

$loop = Factory::create();

echo(date("d/m/Y-G:i:s") . " (crud.php) Started Eventloop\n");

$db = new dbClass($loop);

$db->getUser("user1")
    ->then(
        function (QueryResult $result) {
            echo(date("d/m/Y-G:i:s") . " (/src/dbClass.php) getUser-QueryResult\n");
			//print_r($result->resultFields);
            print_r($result->resultRows);
            echo(date("d/m/Y-G:i:s") . " (/src/dbClass.php) Qt.Reg: [" . Count($result->resultRows) . "]\n");
            echo(date("d/m/Y-G:i:s") . " (/src/dbClass.php) Type [" . (gettype($result->resultRows)) . "]\n");
            return $result->resultRows;
        },
        function (Exception $error) {
            echo(date("d/m/Y-G:i:s") . " (/src/dbClass.php) Exception occurred in MySQL. ERRO:\n");
            echo 'Error: [' . $error->getMessage() . "]\n";
            return "ERROR";
        }
    );
echo(date("d/m/Y-G:i:s") . " (/src/dbClass.php) getUser passed here\n");

echo(date("d/m/Y-G:i:s") . " (crud.php) Connection-quit\n\n\n");

//Close connection
$db->getConnection()->close();
//Quit connection
$db->quit();
//Run event loop
$loop->run();

echo(date("d/m/Y-G:i:s") . " (crud.php) Ended Eventloop. Bye bye\n");