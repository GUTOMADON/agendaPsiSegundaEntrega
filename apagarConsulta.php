<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    require 'conexao_Banco.php';

    $consulta_id = $banco->real_escape_string($_GET['id']);

    $sql = "DELETE FROM consultas WHERE id = $consulta_id";

    if ($banco->query($sql)) {
        echo "<p>Consulta apagada com sucesso!</p>";
    } else {
        echo "<p>Erro ao apagar consulta: " . $banco->error . "</p>";
    }
    $banco->close();
}
?>
