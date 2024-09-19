<?php
    // Inclui a conexão com o banco de dados
    require('conexao\\conexao.php');

    // Obtém o CPF da solicitação
    $cpf = $_REQUEST["numero_departamento"];
    $sql = "
        select NomeDepartamento as nome_departamento, ld.Nome as local_departamento, ld.idLocalDepartamento as id_local_departamento, NumDepartamento as numero_departamento from departamento as d
        inner join funcionario as f on f.Cpf = fkCpf
        inner join local_departamento as ld on ld.idLocalDepartamento = fkidLocalDepartamento
        where NumDepartamento = '".$_REQUEST["numero_departamento"]."'"
    ;
    $res = $conn->query($sql);
    $row = $res->fetch_object();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Departamento
    </title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/novo_funcionario.css">
</head>
<body>

    <div class="container ">
        <h2 class="mb-4">Atualizar informações do departamento</h2>
        
        <form action="atividades-mysql.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="hidden" name="numero_departamento" value="<?=$row->numero_departamento?>">
                        <input type="text" class="form-control" id="numero_departamento" name="numero_departamento" 
                        placeholder="Disabled input" aria-label="id" disabled
                        value = "<?=$row->numero_departamento?>">
                        <label for="id">ID</label>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome_departamento" name="nome_departamento" 
                            placeholder="Digite nome do departamento" value = "<?=$row->nome_departamento?>" maxlength="15" required>
                        <label for="nome_departamento" class="form-label">
                            Digite o nome departamento
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="hidden" name="id_local_departamento" value="<?=$row->id_local_departamento?>">
                        <input type="text" class="form-control" id="id_local_departamento" name="id_local_departamento" 
                        placeholder="Disabled input" aria-label="id_local_departamento" disabled
                        value = "<?=$row->local_departamento?>">
                        <label for="id">Local Departamento</label>
                    </div>
                </div>
                
            </div>
            <!-- Botões -->
            <div class="form-group button-group">
                <input type="submit" class="btn btn-primary" name="edit_departamento" value="Salvar">
                <a href="listar-departamento.php" class="btn btn-secondary" style="background-color: #4CAF50">Voltar</a>
            </div>
            
        </form>
    </div>  

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js">

    </script>
</body>
</html>
