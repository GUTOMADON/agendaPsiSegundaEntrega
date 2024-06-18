<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Psicólogo</title>
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
            <h2 class="text-center">Editar Psicólogo</h2>
            <?php
            require_once 'conexao_Banco.php';

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                $psicologo_id = $banco->real_escape_string($_GET['id']);

                $sql = "SELECT * FROM psicologos WHERE id = $psicologo_id";
                $resultado = $banco->query($sql);

                if ($resultado->num_rows == 1) {
                    $psicologo = $resultado->fetch_assoc();
            ?>
                    <form action="editarPsicologo.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $psicologo['id']; ?>">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $psicologo['nome']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $psicologo['telefone']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $psicologo['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $psicologo['data_nascimento']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar Psicólogo</button>
                    </form>
            <?php
                } else {
                    echo '<p class="text-center">Psicólogo não encontrado.</p>';
                }
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $banco->real_escape_string($_POST['id']);
                $nome = $banco->real_escape_string($_POST['nome']);
                $telefone = $banco->real_escape_string($_POST['telefone']);
                $email = $banco->real_escape_string($_POST['email']);
                $data_nascimento = $_POST['data_nascimento'];

                $query = "UPDATE psicologos SET nome='$nome', telefone='$telefone', email='$email', data_nascimento='$data_nascimento' WHERE id=$id";

                if ($banco->query($query)) {
                    echo "<p>Psicólogo atualizado com sucesso!</p>";
                } else {
                    echo "<p>Erro ao atualizar psicólogo: " . $banco->error . "</p>";
                }
            } else {
                echo '<p class="text-center">Parâmetro inválido.</p>';
            }
            $banco->close();
            ?>
        </div>
    </div>
</div>
</body>
</html>
