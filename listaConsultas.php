<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Consultas</title>
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
        .consulta-card {
            margin-bottom: 20px;
        }
        .consulta-card .card-header {
            background-color: #3E6D8E;
            color: #FFF;
            font-weight: bold;
        }
        .btn-apagar {
            margin-left: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3E6D8E;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="color: #FFF; font-family: 'Arial', sans-serif; font-size: 24px;">AgendaPsi</a>
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
    <h1 class="text-center">Lista de Consultas</h1>
    <div class="row">
    <?php
require_once 'conexao_Banco.php';
$sql = "SELECT c.id, c.data_hora, c.observacao, p.nome AS paciente_nome, ps.nome AS psicologo_nome 
        FROM consultas c
        INNER JOIN pacientes p ON c.paciente_id = p.id
        INNER JOIN psicologos ps ON c.psicologo_id = ps.id
        ORDER BY c.data_hora";
$result = $banco->query($sql);
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-md-4 consulta-card'>
                <div class='card'>
                    <div class='card-header'>
                        Consulta com " . $row['psicologo_nome'] . "
                    </div>
                    <div class='card-body'>
                        <h5 class='card-title'>Paciente: " . $row['paciente_nome'] . "</h5>
                        <p class='card-text'><strong>Data e Hora:</strong> " . $row['data_hora'] . "</p>
                        <p class='card-text'><strong>Observação:</strong> " . $row['observacao'] . "</p>
                        <a href='editarConsulta.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a>
                        <a href='apagarConsulta.php?id=" . $row['id'] . "' class='btn btn-danger btn-apagar'>Apagar</a>
                    </div>
                </div>
            </div>";
        }
    } else {
        echo "<p class='text-center'>Nenhuma consulta encontrada.</p>";
    }
} else {
    echo "Erro na consulta: " . $banco->error;
}
$banco->close();
?>

    </div>
</div>
</body>
</html>
