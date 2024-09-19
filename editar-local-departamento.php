<?php
    // Inclui a conexão com o banco de dados
    require('conexao\\conexao.php');

    // Obtém o id do local do departamento da solicitação
    $id_local_departamento = $_REQUEST["id_local_departamento"];
   
    $sql = "
        select ld.Nome as nome_local_departamento, ld.idLocalDepartamento as id_local_departamento from local_departamento as ld
        where ld.idLocalDepartamento = ' ".$_REQUEST["id_local_departamento"]." '";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Local do Departamento
    </title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/novo_funcionario.css">
</head>
<body>

    <div class="container ">
        <h2 class="mb-4">Atualizar informações do local</h2>
        
        <form action="atividades-mysql.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="hidden" name="id" value="<?=$row->id_local_departamento?>">
                        <input type="text" class="form-control" id="id" name="id" 
                        placeholder="Disabled input" aria-label="id" disabled
                        value = "<?=$row->id_local_departamento?>" maxlength="15">
                        <label for="id">ID</label>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome_local_departamento" name="nome_local_departamento" 
                            placeholder="Digite o nome do departamento" 
                            value="<?= htmlspecialchars($row->nome_local_departamento, ENT_QUOTES, 'UTF-8') ?>"
                            maxlength="15" required>
                        <label for="nome_local_departamento" class="form-label">
                            Digite o nome local
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="form-group button-group">
                <input type="submit" class="btn btn-primary" name="edit_local_departamento" value="Salvar">
                <a href="listar-departamento.php" class="btn btn-secondary" style="background-color: #4CAF50">Voltar</a>
            </div>
            
        </form>
    </div>  

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js">

    </script>
</body>
</html>
