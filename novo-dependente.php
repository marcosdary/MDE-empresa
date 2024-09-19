<?php
// Inclui a conexão com o banco de dados
require('conexao\\conexao.php');

// Obtém o CPF da solicitação
$cpf = $_REQUEST["cpf"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="css/novo_projeto.css">
    <title>Cadastro Dependente</title>
</head>
<body>
    <div class="container col-11 col-md-9" id="form-container">
        <div class="row gx-5">
            <div class="col-md-6">
                <h2>Adicione o novo dependente</h2>
                <form action="atividades-mysql.php" method="POST">
                    <!-- Campo oculto para CPF -->
                    <input type="hidden" name="cpf" value="<?= htmlspecialchars($cpf) ?>">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do dependente" maxlength="80" required>
                        <label for="nome" class="form-label">Digite o nome do dependente</label>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="datanascimento" name="datanascimento" placeholder="Data de nascimento (dd/mm/yyyy)">
                            <label for="datanascimento">Data de nascimento</label>
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
                    <div class="mb-4">
                        <label for="parentesco" class="form-label">Parentesco</label>
                        <select class="form-select" id="parentesco" name="parentesco">
                            <option selected>Selecione o parentesco</option>
                            <option value="Pai">Pai</option>
                            <option value="Mãe">Mãe</option>
                            <option value="Esposo">Esposo</option>
                            <option value="Esposa">Esposa</option>
                            <option value="Amante">Amante</option>
                            <option value="Filho">Filho</option>
                            <option value="Filha">Filha</option>
                            <option value="Irmão">Irmão</option>
                            <option value="Irma">Irmã</option>
                            <option value="Avô">Avô</option>
                            <option value="Avó">Avó</option>
                            <option value="Tio">Tio</option>
                            <option value="Tia">Tia</option>
                            <option value="Primo">Primo</option>
                            <option value="Prima">Prima</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
        
                    <input type="submit" class="btn btn-primary" name="create_dependente"  value="Cadastrar">
                </form>
            </div>
            <div class="col-md-6">
                <div class="row align-items-center">
                    <div class="col-12">
                        <img src="img/hello.svg" alt="Hello New Customer" class="img-fluid">
                    </div>
                    <div class="col-12" id="link-container">
                        <a href="home.php" class="link-back">Já tem dependente? Voltar para a Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>