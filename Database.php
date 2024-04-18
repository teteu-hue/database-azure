<?php

class Database
{

    private static $conn;

    public function __construct($file = 'database.ini')
    {
        
        try
        {
            
            $database = parse_ini_file($file);
            $driver = $database['driver'];
            $hostname = $database['hostname'];
            $username = $database['username'];
            $password = $database['password'];
            $dbname = $database['dbname'];
            $port = $database['port'];
        
            $dsn = "$driver:host=$hostname;dbname=$dbname;port=$port";
        
            $options = [
                PDO::MYSQL_ATTR_SSL_CA => './DigiCertGlobalRootCA.crt.pem',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
        } catch(Exception $e){
            echo "Unable to open file:" . $e->getMessage();
        }
        
        if(!isset(self::$conn)){
            self::$conn = new PDO($dsn, $username, $password, $options);
            echo "Connection is sucessfully";
            echo "<br>";
        }
    }

    public function insertLogin($nome, $senha)
    {
        try
        {
            self::$conn->query("INSERT INTO login (nome, senha) VALUES ($nome, $senha)");
        } 
        catch(PDOException $e)
        {
            echo "erro: " . $e->getMessage();
            echo "<br>";
            echo "error: " . self::$conn->errorInfo()[2];
        }
    }

    public function showLogins(){
        try 
        {
            $query = self::$conn->query("SELECT * FROM login")->fetchAll();

        } catch(PDOException $e){
            echo "The query doens't work" . $e->getMessage();
        }

        echo "<br>";

        foreach($query as $row){
            echo "Login: " . $row['nome'] . "<br>";
            echo "Senha: " . $row['senha'] . "<br>";
            echo "<br>";
        }
    }

}


?>