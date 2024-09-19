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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dependentes</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Adiciona ícones do Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
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
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Funcionários por dependente</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nome</th>
                            <th>Sexo</th>
                            <th>Data de Nascimento</th>
                            <th>Parentesco</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta para obter os dependentes do funcionário com o CPF fornecido
                        $sql = "select iddependente, Nome, Sexo, Datanasc, Parentesco 
                                from dependente 
                                where fkCpf = '" . $conn->real_escape_string($cpf) . "'";
                        
                        // Executa a consulta
                        $res = $conn->query($sql);
                        $qtd = $res->num_rows;

                        // Verifica se há registros e os exibe
                        if ($qtd > 0) {
                            while ($row = $res->fetch_object()) {
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($row->Nome) ?></td>
                                <td><?= htmlspecialchars($row->Sexo) ?></td>
                                <td><?= date('d/m/Y', strtotime($row->Datanasc)) ?></td>
                                <td><?= htmlspecialchars($row->Parentesco) ?></td>
                                <td>
                                    <form action="editar-dependente.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="iddependente" value="<?= htmlspecialchars($row->iddependente) ?>">
                                            <button type="submit" class="btn btn-secondary btn-sm" style="background-color: #4CAF50; color:white">
                                                    <i class="bi bi-eye-fill"></i>&nbsp;Editar
                                            </button>
                                    </form>
                                    <form action="atividades-mysql.php" method="POST" class="d-inline">
                                        <button onclick="return confirm('Tem certeza que deseja excluir?')" 
                                            type="submit" name="delete_dependente" 
                                            value="<?= htmlspecialchars($row->iddependente) ?>" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash3-fill"></i>&nbsp;Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                            // Mensagem para quando não há registros
                            echo "<tr><td colspan='5'>Nenhum dependente encontrado.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <form action="novo-dependente.php" method="POST" style="display: inline;">
                    <input type="hidden" name="cpf" value="<?= htmlspecialchars($cpf) ?>">
                    <button type="submit" class="btn btn-secondary btn-sm" style="background-color: green; color: white; border: none;">
                        <i class="bi bi-eye-fill"></i>&nbsp;Novo Dependente
                    </button>
                </form>
                <div class="mt-3">
                    <a href="listar-funcionario.php">Voltar para o Listar Funcionário</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
