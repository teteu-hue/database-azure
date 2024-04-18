<?php

require("Database.php");

require("header.php");

echo '<pre>';
$conn = new Database();
var_dump($conn);

/*
try 
{
$query = $conn->query("SELECT * FROM login")->fetchAll();

} catch(PDOException $e){
    echo "The query doens't work" . $e->getMessage();
}

foreach($query as $row){
    echo "<br>";
    echo "Login: " . $row['nome'] . "<br>";
    echo "Senha: " . $row['senha'] . "<br>";
    echo "<br>";
} */

$conn->insertLogin('admin', 'admin');

$conn->showLogins();

require("footer.php");

?>