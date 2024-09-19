<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link para o CSS personalizado -->
    <link rel="stylesheet" href="css/home.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="home.php">Empresa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listar-funcionario.php">Funcionários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listar-projeto.php">Projetos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listar-departamento.php">Departamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listar-local-departamento.php">Locais dos Departamentos</a>
                </li>
            </ul>
            <a class="btn btn-danger ml-auto" href="login.php">Sair</a>
        </div>
    </nav>
    <!-- Rodapé -->
    <footer class="bg-light text-center text-lg-start mt-4">
        <div class="container p-4">
            <p class="text-muted mb-0">" Não espere por uma crise para descobrir o que é importante em sua vida." - Platão</p>
        </div>
    </footer>

    <!-- Scripts do Bootstrap e jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
