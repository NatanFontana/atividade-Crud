<?php

$host = '143.106.241.4';
$dbname = 'cl203219';
$usuario = 'cl203219';
$senha = 'cl*25052007';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", 
                    $usuario, $senha);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

?>