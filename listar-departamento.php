<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
        require("conexao/conexao.php");
    ?>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Adiciona ícones do Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/listar_departamento.css">
    <title>Departamentos</title>
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
        <div class="card-body">
            <div class="col-md-12"> <!-- Alterado para col-md-12 para usar toda a largura disponível -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Departamentos</h4>
                    <a class="btn btn-primary" href="novo-departamento.php">Novo Departamento</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped full-width-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome do Departamento</th>
                                <th>Nome do Gerente</th>
                                <th>Local do Departamento</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "
                            select f.Nome as nome_gerente, NomeDepartamento as nome_departamento, d.NumDepartamento as numero_departamento, ld.Nome as local_departamento from departamento as d
                            inner join funcionario as f on f.Cpf = fkCpf
                            inner join local_departamento as ld on ld.idLocalDepartamento = fkidLocalDepartamento
                            order by nome_departamento;";

                            // Executa a consulta
                            $res = $conn->query($sql);
                            $qtd = $res->num_rows;

                            // Verifica se há registros e os exibe
                            if ($qtd > 0) {
                                $counter = 1;
                                while ($row = $res->fetch_object()) {
                            ?>
                                <tr>
                                    <td><?= $counter ?></td>
                                    <td><?= htmlspecialchars($row->nome_departamento) ?></td>
                                    <td><?= htmlspecialchars($row->nome_gerente) ?></td>
                                    <td><?= htmlspecialchars($row->local_departamento) ?></td>
                                    <td>
                                        <form action="editar-departamento.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="numero_departamento" value="<?= htmlspecialchars($row->numero_departamento) ?>">
                                            <button type="submit" class="btn btn-secondary btn-sm" style="background-color: #4CAF50; color:white">
                                            <i class="bi bi-eye-fill"></i>&nbsp;Editar
                                            </button>
                                        </form>
                                        <form action="atividades-mysql.php" method="POST" class="d-inline">
                                            <button onclick="return confirm('Tem certeza que deseja excluir?')" 
                                                type="submit" name="delete_departamento" 
                                                value="<?= htmlspecialchars($row->numero_departamento)?>" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash3-fill"></i>&nbsp;Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                $counter++;
                                    }
                            } else {
                                // Mensagem para quando não há registros
                                echo "<tr><td colspan='5'>Nenhum departamento encontrado</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
