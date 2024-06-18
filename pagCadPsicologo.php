<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Psicólogo</title>
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
        .card-header {
            background-color: #3E6D8E;
            color: #FFF;
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Cadastrar Psicólogo</div>
                <div class="card-body">
                    <form action="cadastraPsi.php" method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
