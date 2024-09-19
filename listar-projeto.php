<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
        require("conexao\\conexao.php");
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  
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
        </div>
    </nav>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Projetos</h2>
            <a class="btn btn-primary" href="novo-projeto.php">Novo Projeto</a>
        </div>

        <!-- Tabela -->
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Local</th>
                <th scope="col">Departamento</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody id="dataTableBody">
                <?php
                                
                    $sql = "
                    select idProjeto, p.Nome, Local, d.NomeDepartamento as NomeDepartamento from projeto as p
                    inner join departamento as d on d.NumDepartamento = p.fkNumDepartamento order by p.Nome;
                    ";

                    $res = $conn->query($sql);

                    $qtd = $res->num_rows;
                                
                    if($qtd > 0){
                        $counter = 1;
                        while($row = $res->fetch_object()){
                            ?>
                        <tr>
                            <td><?=$counter?></td>
                            <td><?=$row->Nome?></td>
                            <td><?=$row->Local?></td>
                            <td><?=$row->NomeDepartamento?></td>
                            <td>
                                <form action="editar-projeto.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_projeto" value="<?= htmlspecialchars($row->idProjeto) ?>">
                                        <button type="submit" class="btn btn-secondary btn-sm" style="background-color: #4CAF50; color:white">
                                            <i class="bi bi-eye-fill"></i>&nbsp;Editar
                                        </button>
                                </form>

                                <form action="atividades-mysql.php" method="POST" class="d-inline">
                                    <button onclick="return confirm('Tem certeza que deseja excluir?')" 
                                        type="submit" name="delete_projeto" 
                                        value="<?=$row->idProjeto?>" class="btn btn-danger btn-sm">
                                    <span class="bi-trash3-fill"></span>&nbsp;Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                <?php
                    $counter++;
                        }
                    }
                ?>         
            </tbody>
        </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
