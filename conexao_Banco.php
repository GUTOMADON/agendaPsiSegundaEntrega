<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bancoDados = "test";

$banco = new mysqli($servidor, $usuario, $senha, $bancoDados);

if ($banco->connect_error) {
    die("Falha na conexão: " . $banco->connect_error);
}
?>
