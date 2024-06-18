<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    require 'conexao_Banco.php';

    $psicologo_id = $banco->real_escape_string($_GET['id']);

    $sql = "DELETE FROM psicologos WHERE id = $psicologo_id";

    if ($banco->query($sql)) {
        echo "<p>Psicólogo apagado com sucesso!</p>";
    } else {
        echo "<p>Erro ao apagar psicólogo: " . $banco->error . "</p>";
    }
    $banco->close();
}
?>
