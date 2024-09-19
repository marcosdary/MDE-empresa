<?php
// Inclui a conexão com o banco de dados
require('conexao\\conexao.php');

// Obtém o CPF da solicitação
$cpf = $_REQUEST["cpf"];
$sql = "select * from funcionario where Cpf = '".$_REQUEST["cpf"]."'";
$res = $conn->query($sql);
$row = $res->fetch_object();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Funcionário
    </title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/novo_funcionario.css">
</head>
<body>

    <div class="container ">
        <h2 class="mb-4">Atualizar informações do funcionário</h2>
        
        <form action="atividades-mysql.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="hidden" name="cpf" value="<?=$row->Cpf?>">
                        <input type="text" class="form-control" id="cpf" name="cpf" 
                        placeholder="Disabled input" aria-label="Cpf" disabled
                        value = "<?=$row->Cpf?>">
                        <label for="cpf" class="form-label">CPF</label>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" name="nome" 
                            placeholder="Digite seu nome" value = "<?=$row->Nome?>" maxlength="80" required>
                        <label for="nome" class="form-label">
                            Digite seu nome
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="datanascimento" name="datanascimento"
                            placeholder="Data de nascimento (dd/mm/yyyy)" value = "<?=$row->DataNascimento?>">
                        <label for="datanascimento" class="form-label">Data de nascimento (dd/mm/yyyy)</label>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="endereco" name="endereco" 
                            placeholder="Digite seu endereço" value = "<?=$row->Endereco?>" maxlength="80" required>
                        <label for="endereco" class="form-label">Digite seu endereço</label>
                    </div>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo">
                    <option selected>Selecione sexo</option>
                    <option value="M" <?php if($row->Sexo == "M"){echo("selected");}; ?>>Masculino</option>
                    <option value="F" <?php if($row->Sexo == "F"){echo("selected");}; ?>>Feminino</option>
                </select>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="salario">Salário</label>
                        <input type="number" class="form-control" id="salario" name="salario" 
                            placeholder="Digite seu salário" value = "<?=$row->Salario?>"
                            step="1000" min="1000">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control input-large" id="email" name="email" 
                            placeholder="Digite seu email" value = "<?=$row->Email?>" maxlength="80" required>
                        <label for="email" class="form-label">Digite seu email</label>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Digite sua senha" maxlength="255" required>
                    <label for="password">Digite sua senha</label>
                </div>
                
                <div class="col-md-6">
                    
                    <input type="text" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme sua senha">
                    <label for="confirmpassword">Confirme sua senha</label>
                </div>
            </div>
    
            <!-- Botões -->
            <div class="form-group button-group">
                <input type="submit" class="btn btn-primary" name="edit_funcionario" value="Salvar">
                <a href="listar-funcionario.php" class="btn btn-secondary" style="background-color: #4CAF50">Voltar</a>
            </div>
            
        </form>
    </div>  

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js">

    </script>
</body>
</html>
