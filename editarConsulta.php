<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    <style>
        body {
            background-color: #E0E9EF;
            color: #333;
            font-family: 'Arial', sans-serif;
        }
        h1, h2 {
            color: #3E6D8E;
            font-family: 'Arial', sans-serif;
            font-weight: bold;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3E6D8E;">
    <div class="container">
        <a class="navbar-brand" href="#" style="color: #FFF; font-family: 'Arial', sans-serif; font-size: 24px;">AgendaPsi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php" style="color: #FFF;">Cadastrar Consulta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listaConsultas.php" style="color: #FFF;">Mostrar Consultas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pagCadPsicologo.php" style="color: #FFF;">Cadastrar Psicólogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listaPsicologo.php" style="color: #FFF;">Mostrar Psicólogos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Editar Consulta</h2>
            <?php
            require_once 'conexao_Banco.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
                $id = $banco->real_escape_string($_POST['id']);
                $data_hora = $banco->real_escape_string($_POST['data_hora']);
                $paciente_nome = $banco->real_escape_string($_POST['paciente_nome']);
                $psicologo_id = $banco->real_escape_string($_POST['psicologo_id']);
                $observacao = $banco->real_escape_string($_POST['observacao']);

                $sql_check_paciente = "SELECT id FROM pacientes WHERE nome = '$paciente_nome'";
                $result_check_paciente = $banco->query($sql_check_paciente);

                if ($result_check_paciente && $result_check_paciente->num_rows > 0) {
                    $row = $result_check_paciente->fetch_assoc();
                    $paciente_id = $row['id'];

                    $sql_update = "UPDATE consultas SET data_hora='$data_hora', paciente_id=$paciente_id, psicologo_id=$psicologo_id, observacao='$observacao' WHERE id=$id";

                    if ($banco->query($sql_update)) {
                        echo '<div class="alert alert-success" role="alert">Consulta atualizada com sucesso!</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Erro ao atualizar consulta: ' . $banco->error . '</div>';
                    }
                } else {
                    $sql_insert_paciente = "INSERT INTO pacientes (nome) VALUES ('$paciente_nome')";
                    if ($banco->query($sql_insert_paciente)) {
                        $paciente_id = $banco->insert_id;

                        $sql_update = "UPDATE consultas SET data_hora='$data_hora', paciente_id=$paciente_id, psicologo_id=$psicologo_id, observacao='$observacao' WHERE id=$id";

                        if ($banco->query($sql_update)) {
                            echo '<div class="alert alert-success" role="alert">Consulta atualizada com sucesso!</div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Erro ao atualizar consulta: ' . $banco->error . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Erro ao inserir novo paciente: ' . $banco->error . '</div>';
                    }
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                $consulta_id = $banco->real_escape_string($_GET['id']);

                $sql = "SELECT c.id, c.data_hora, c.paciente_id, c.psicologo_id, c.observacao, p.nome as paciente, ps.nome as psicologo 
                        FROM consultas c
                        INNER JOIN pacientes p ON c.paciente_id = p.id
                        INNER JOIN psicologos ps ON c.psicologo_id = ps.id
                        WHERE c.id = $consulta_id";

                $resultado = $banco->query($sql);

                if ($resultado->num_rows == 1) {
                    $consulta = $resultado->fetch_assoc();
            ?>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $consulta['id']; ?>">
                        <div class="mb-3">
                            <label for="data_hora" class="form-label">Data e Hora da Consulta:</label>
                            <input type="datetime-local" class="form-control" id="data_hora" name="data_hora" value="<?php echo date('Y-m-d\TH:i', strtotime($consulta['data_hora'])); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="paciente_nome" class="form-label">Nome do Paciente:</label>
                            <input type="text" class="form-control" id="paciente_nome" name="paciente_nome" value="<?php echo $consulta['paciente']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="psicologo_id" class="form-label">Psicólogo:</label>
                            <select class="form-control" id="psicologo_id" name="psicologo_id" required>
                                <?php
                                $psicologos = $banco->query("SELECT id, nome FROM psicologos ORDER BY nome");
                                if ($psicologos->num_rows > 0) {
                                    while ($psicologo = $psicologos->fetch_assoc()) {
                                        $selected = $psicologo['id'] == $consulta['psicologo_id'] ? 'selected' : '';
                                        echo "<option value='{$psicologo['id']}' $selected>{$psicologo['nome']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="observacao" class="form-label">Observação:</label>
                            <textarea class="form-control" id="observacao" name="observacao" rows="3"><?php echo $consulta['observacao']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar Consulta</button>
                    </form>
            <?php
                } else {
                    echo '<p class="text-center">Consulta não encontrada.</p>';
                }
            }
            $banco->close();
            ?>
        </div>
    </div>
</div>
</body>
</html>
