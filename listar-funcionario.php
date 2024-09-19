<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/novo-funconario.css">
    <style>
        .info-div {
            display: none;
            position: fixed;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
            background-color: white;
            border: 1px solid #ddd;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        .info-div.show {
            display: block;
        }
        .info-div .close {
            float: right;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
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

    <div class="container mt-4">
        <?php
        require('conexao/conexao.php');
        ?>

        <div class="card">
            <div class="card-header">
                <h4>
                    Lista de Funcionários
                    <a class="btn btn-primary float-right" href="novo-funcionario.php">Novo Funcionário</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data Nascimento</th>
                            <th>Sexo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "select Cpf, Nome, DataNascimento, Sexo from funcionario order by Nome";
                            $res = $conn->query($sql);

                            if ($res->num_rows > 0) {
                                $counter = 1;
                                while ($row = $res->fetch_object()) {
                        ?>
                                    <tr class="clickable-row" data-id="<?= htmlspecialchars($row->Cpf) ?>">
                                        <td><?= $counter ?></td>
                                        <td><?= htmlspecialchars($row->Nome) ?></td>
                                        <td><?= date('d/m/Y', strtotime($row->DataNascimento)) ?></td>
                                        <td><?= htmlspecialchars($row->Sexo) ?></td>
                                        <td>
                                            <form action="listar-dependente.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="cpf" value="<?= htmlspecialchars($row->Cpf) ?>">
                                                <button type="submit" class="btn btn-secondary btn-sm" style="background-color: gray; color: white; border: none;">
                                                    <i class="bi bi-eye-fill"></i>&nbsp;Dependente
                                                </button>
                                            </form>
                                            <form action="editar-funcionario.php" method="POST" style="display:inline;">
                                                <input type="hidden" name="cpf" value="<?= htmlspecialchars($row->Cpf) ?>">
                                                <button type="submit" class="btn btn-secondary btn-sm" style="background-color: #4CAF50; color:white">
                                                    <i class="bi bi-eye-fill"></i>&nbsp;Editar
                                                </button>
                                            </form>
                                
                                            <form action="atividades-mysql.php" method="POST" class="d-inline">
                                                <button onclick="return confirm('Tem certeza que deseja excluir?')" 
                                                    type="submit" name="delete_funcionario" 
                                                    value="<?= htmlspecialchars($row->Cpf) ?>" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash3-fill"></i>&nbsp;Excluir
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
        </div>
    </div>

    <!-- Informações Detalhadas -->
    <div class="info-div" id="infoDiv">
        <span class="close" onclick="closeInfo()">×</span>
        <h5>Informações Adicionais</h5>
        <div id="infoContent"></div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.querySelectorAll('.clickable-row').forEach(row => {
            row.addEventListener('click', function() {
                var cpf = this.getAttribute('data-id');

                // Requisição AJAX para buscar informações adicionais
                fetch('dados-adicionais-func.php?cpf=' + encodeURIComponent(cpf))
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            document.getElementById('infoContent').innerHTML = '<p>' + data.error + '</p>';
                        } else {
                            var info = '<p><strong>Nome:</strong> ' + data.nome + '</p>';
                            info += '<p><strong>Data Nascimento:</strong> ' + data.data_nascimento + '</p>';
                            info += '<p><strong>Sexo:</strong> ' + data.sexo + '</p>';
                            info += '<p><strong>Salário (R$):</strong> ' + data.salario + '</p>';
                            info += '<p><strong>Projetos:</strong></p><ul>';
                            data.projetos.forEach(projeto => {
                                info += '<li>' + projeto.nome_projeto + ' (' + projeto.horas + ' horas)</li>';
                            });
                            info += '</ul>';

                            document.getElementById('infoContent').innerHTML = info;
                        }
                        document.getElementById('infoDiv').classList.add('show');
                    })
                    .catch(error => {
                        console.error('Erro ao buscar informações:', error);
                        document.getElementById('infoContent').innerHTML = '<p>Erro ao buscar informações.</p>';
                        document.getElementById('infoDiv').classList.add('show');
                    });
            });
        });

        function closeInfo() {
            document.getElementById('infoDiv').classList.remove('show');
        }
    </script>
</body>
</html>
