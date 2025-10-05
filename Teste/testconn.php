<?php
try {
    $pdo = new PDO("mysql:host=143.106.241.4;dbname=CrudSeries2;charset=utf8mb4", "cl203219", "cl*25052007", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "Conectou OK ao DB.";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}