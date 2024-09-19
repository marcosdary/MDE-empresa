<?php
// Define o link da página anterior, se disponível
$pagina_anterior = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'listar-funcionario.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Funcionário</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/novo_funcionario.css">
</head>
<body>

    <div class="container">
        <h2 class="mb-4">Realize o seu cadastro</h2>
        
        <form action="atividades-mysql.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF" oninput="validateCPF(this)">
                        <label for="cpf">Digite seu CPF</label>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" maxlength="80" required>
                        <label for="nome">Digite seu nome</label>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="datanascimento" name="datanascimento" placeholder="Data de nascimento (dd/mm/yyyy)">
                        <label for="datanascimento">Data de nascimento</label>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite seu endereço" maxlength="80" required>
                        <label for="endereco">Digite seu endereço</label>
                    </div>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo">
                    <option selected>Selecione sexo</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="salario" class="form-label">Salário</label>
                        <input type="number" class="form-control" id="salario" name="salario" placeholder="Digite seu salário" step="1000">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" maxlength="80" required>
                        <label for="email">Digite seu email</label>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" maxlength="255" required>
                        <label for="password">Digite sua senha</label>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme sua senha" maxlength="255" required>
                        <label for="confirmpassword">Confirme sua senha</label>
                    </div>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="form-group button-group">
                <input type="submit" class="btn btn-primary" name="create_funcionario" value="Salvar">
                <!-- Botão "Voltar" redirecionando para a página anterior -->
                <a href="<?= htmlspecialchars($pagina_anterior) ?>" class="btn btn-secondary" style="background-color: #4CAF50">Voltar</a>
            </div>
            
        </form>
    </div>  

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateCPF(input) {
            // Remove qualquer caractere não numérico
            let value = input.value.replace(/\D/g, '');
            
            // Limita o número de caracteres a 11
            if (value.length > 11) {
                value = value.slice(0, 11);
            }
            
            // Atualiza o valor do campo
            input.value = value;
        }
    </script>
</body>
</html>
