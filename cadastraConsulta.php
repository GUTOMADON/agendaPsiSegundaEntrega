<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'conexao_Banco.php';

    $data_hora = $_POST['data_hora'];
    $nome = $banco->real_escape_string($_POST['paciente_nome']);
    $telefone = $banco->real_escape_string($_POST['telefone']);
    $observacao = $banco->real_escape_string($_POST['observacao']);
    $psicologo_id = $_POST['psicologo_id'];

    $query = "INSERT INTO pacientes (nome, telefone) VALUES ('$nome', '$telefone')";

    if (!$banco->query($query)) {
        echo "<p>Erro ao inserir paciente: " . $banco->error . "</p>";
    } else {
        $paciente_id = $banco->insert_id;

        if (empty($data_hora) || empty($psicologo_id)) {
            echo "<p>Por favor, preencha todos os campos obrigatórios.</p>";
        } else {
            $sql = "INSERT INTO consultas (data_hora, paciente_id, psicologo_id, observacao) VALUES ('$data_hora', $paciente_id, $psicologo_id, '$observacao')";

            if ($banco->query($sql)) {
                echo "<p>Consulta marcada com sucesso!</p>";
            } else {
                echo "<p>Erro ao marcar consulta: " . $banco->error . "</p>";
            }
        }
    }
    $banco->close();
}
?>
