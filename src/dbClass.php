<?php
	
	namespace src;

	use React\EventLoop\Factory;
	use Dotenv\Dotenv;
	use React\MySQL\QueryResult;
	use React\Promise\PromiseInterface;
	use App\Users\User;

	final class dbClass {
//		public $m, 	$i, 	$n,		$o;
		public $connection;

		public function __construct($loop)
		{
			echo(date("d/m/Y-G:i:s")." (/src/dbClass.php) Execute method __construct()\n");
			$env = Dotenv::createImmutable(__DIR__);
			$env->load();
			$uri = $_ENV['DB_USER']
			    . ':' . $_ENV['DB_PASS']
			    . '@' . $_ENV['DB_HOST']
			    . '/' . $_ENV['DB_NAME'];
			echo(date("d/m/Y-G:i:s")." (/src/dbClass.php) Uri: [".$uri."]\n");
			
			$factory = new \React\MySQL\Factory($loop);
			$this->connection = $factory->createLazyConnection($uri);
//			echo(date("d/m/Y-G:i:s")." (/src/dbClass.php) Connection [".(is_object($this->connection) ? ' eh objeto' : ' NAO eh objeto')."]\n" );

			$this->a_Buffer = null;
		}

		public function quit()
		{
			echo(date("d/m/Y-G:i:s")." (/src/dbClass.php) Execute method quit()\n");
			$this->connection->quit();
		}

		public function getUser($userCode) : PromiseInterface
		{
//			OBS.: Este metodo na usa Promise. Criado para acelerar o desenvolvimento
			echo(date("d/m/Y-G:i:s")." (/src/dbClass.php) Execute method getUser(".$userCode.")\n");
			$this->connection
			->query("SELECT * FROM Users WHERE UserCode = '".$userCode."';")
			->then(
				function (QueryResult $result) {
					echo(date("d/m/Y-G:i:s")." (/src/dbClass.php) getUser-QueryResult\n");
//					print_r($result->resultFields);
					print_r($result->resultRows);
					echo(date("d/m/Y-G:i:s")." (/src/dbClass.php) Qt.Reg: [".Count($result->resultRows)."]\n");
					echo(date("d/m/Y-G:i:s")." (/src/dbClass.php) Type [".(gettype($result->resultRows))."]\n" );
					return $result->resultRows;
				},
				function (Exception $error) {
					echo(date("d/m/Y-G:i:s")." (/src/dbClass.php) Exception occurred in MySQL. ERRO:\n");
					echo 'Error: [' . $error->getMessage() ."]\n";
					return "ERROR";
				}
			);
			echo(date("d/m/Y-G:i:s")." (/src/dbClass.php) getUser passed here\n");
		}
		
	}
?>
