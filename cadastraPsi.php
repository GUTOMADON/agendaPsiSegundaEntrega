<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'conexao_Banco.php';

    $nome = $banco->real_escape_string($_POST['nome']);
    $telefone = $banco->real_escape_string($_POST['telefone']);
    $email = $banco->real_escape_string($_POST['email']);
    $data_nascimento = $_POST['data_nascimento'];

    $query = "INSERT INTO psicologos (nome, telefone, email, data_nascimento) VALUES ('$nome', '$telefone', '$email', '$data_nascimento')";

    if ($banco->query($query)) {
        echo "<p>Psicólogo cadastrado com sucesso!</p>";
    } else {
        echo "<p>Erro ao cadastrar psicólogo: " . $banco->error . "</p>";
    }
    $banco->close();
}
?>
