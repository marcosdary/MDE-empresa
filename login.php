<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/novo_funcionario.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Login</h2>
            <form action="atividades-mysql.php" method="POST">
                <div class="form-group mb-3">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF" oninput="validateCPF(this)">
                </div>
                <div class="form-group mb-3 position-relative">
                    <label for="senha">Senha</label>
                    <input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                </div>
                <div class="form-group button-group">
                    <input type="submit" class="btn btn-primary w-100" name="login_funcionario" value="Entrar">
                </div>
            </form>
            <!-- Adicionando o link para recuperação de senha -->
            <div class="text-center mt-3">
                <a href="novo-funcionario.php">Não é cadastrado?</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
