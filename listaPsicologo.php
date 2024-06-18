<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Psicólogos - AgendaPsi</title>
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
        .psicologo-card {
            margin-bottom: 20px;
        }
        .psicologo-card .card-header {
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
            <h2 class="text-center">Lista de Psicólogos</h2>
            <?php
            require_once 'conexao_Banco.php';

            $sql = "SELECT * FROM psicologos ORDER BY nome";
            $resultado = $banco->query($sql);

            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
            ?>
                    <div class="card psicologo-card">
                        <div class="card-header">
                            Psicólogo ID: <?php echo $row['id']; ?>
                        </div>
                        <div class="card-body">
                            <p><strong>Nome Completo:</strong> <?php echo $row['nome']; ?></p>
                            <p><strong>Telefone:</strong> <?php echo $row['telefone']; ?></p>
                            <p><strong>E-mail:</strong> <?php echo $row['email']; ?></p>
                            <p><strong>Data de Nascimento:</strong> <?php echo date('d/m/Y', strtotime($row['data_nascimento'])); ?></p>
                            <a href="editarPsicologo.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Editar</a>
                            <a href="apagarPsicologo.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-apagar">Apagar</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="text-center">Não há psicólogos cadastrados.</p>';
            }
            $banco->close();
            ?>
        </div>
    </div>
</div>
</body>
</html>
