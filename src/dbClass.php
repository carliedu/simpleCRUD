<?php

namespace src;

use App\Users\User;
use Dotenv\Dotenv;
use React\MySQL\ConnectionInterface;
use React\MySQL\Factory;
use React\MySQL\Io\LazyConnection;
use React\Promise\PromiseInterface;

final class dbClass
{
    //	public $m, 	$i, 	$n,		$o;
    public $connection;

    public function __construct($loop)
    {
        echo(date("d/m/Y-G:i:s") . " (/src/dbClass.php) Execute method __construct()\n");
        $env = Dotenv::createImmutable(__DIR__);
        $env->load();
        $uri = $_ENV['DB_USER']
            . ':' . $_ENV['DB_PASS']
            . '@' . $_ENV['DB_HOST']
            . '/' . $_ENV['DB_NAME'];
        echo(date("d/m/Y-G:i:s") . " (/src/dbClass.php) Uri: [" . $uri . "]\n");

        $factory = new Factory($loop);
        $this->connection = $factory->createLazyConnection($uri);
		//	echo(date("d/m/Y-G:i:s")." (/src/dbClass.php) Connection [".(is_object($this->connection) ? ' eh objeto' : ' NAO eh objeto')."]\n" );

        $this->a_Buffer = null;
    }

    /**
     * @return ConnectionInterface|LazyConnection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    public function quit()
    {
        echo(date("d/m/Y-G:i:s") . " (/src/dbClass.php) Execute method quit()\n");
        $this->connection->quit();
    }

    public function getUser($userCode): PromiseInterface
    {
		//	OBS.: Este metodo na usa Promise. Criado para acelerar o desenvolvimento
        echo(date("d/m/Y-G:i:s") . " (/src/dbClass.php) Execute method getUser(" . $userCode . ")\n");
        return $this->connection
            ->query("SELECT * FROM Users WHERE UserCode = '" . $userCode . "';");
    }

}