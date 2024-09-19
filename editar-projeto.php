<?php
// Inclui a conexão com o banco de dados
require('conexao\\conexao.php');

// Obtém o id_projeto da solicitação
$id_projeto = $_REQUEST["id_projeto"];
$sql = "
    select idProjeto, p.Nome as nome_projeto, Local, d.NomeDepartamento as nome_departamento from projeto as p
    inner join departamento as d on d.NumDepartamento = p.fkNumDepartamento
    where idProjeto = '".$_REQUEST["id_projeto"]."';";
$res = $conn->query($sql);
$row = $res->fetch_object();
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
    <title>Editar Projeto</title>
</head>
<body>
    <div class="container col-11 col-md-9" id="form-container">
        <div class="row gx-5">
            <div class="col-md-6">
                <h2>Editar projeto</h2>
                <form action="atividades-mysql.php" method="POST">
                    
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="hidden" name="id_projeto" value="<?=$row->idProjeto?>">
                            <input type="text" class="form-control" id="id_projeto"  name="id_projeto" 
                                    placeholder="Disabled input" aria-label="id_projeto" disabled
                                    value = "<?=$row->idProjeto?>">
                            <label for="id_projeto" class="form-label">ID</label>
                        </div>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" name="nome" value="<?=$row->nome_projeto?>" placeholder="Digite o nome do projeto" maxlength="15" required>
                        <label for="nome" class="form-label">Digite o nome do projeto</label>
                    </div>  

                    <div class="form-floating mb-3">                        
                        <input type="text" class="form-control" id="local" name="local" value="<?=$row->Local?>" placeholder="Digite o local" maxlength="15" required>
                        <label for="local" class="form-label">Digite o local</label>
                    </div>
                    <!-- Selects -->
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nome_departamento"  name="nome_departamento" 
                                    placeholder="Disabled input" aria-label="nome_departamento" disabled
                                    value = "<?=$row->nome_departamento?>">
                                <label for="nome_departamento" class="form-label">Departamento</label>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="edit_projeto" value="Salvar">
                </form>
            </div>
            <div class="col-md-6">
                <div class="row align-items-center">
                    <div class="col-12">
                        <img src="img/hello.svg" alt="Hello New Customer" class="img-fluid">
                    </div>
                    <div class="col-12" id="link-container">
                        <a href="home.php" class="link-back">Já tem um projeto? Voltar para a Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>