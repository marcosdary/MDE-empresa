<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
        require("conexao/conexao.php"); // Inclui o arquivo de conexão
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="css/novo_projeto.css">
    <title>Cadastro Departamento</title>
</head>
<body>
    <div class="container col-11 col-md-9" id="form-container">
        <div class="row gx-5">
            <div class="col-md-6">
                <h2>Adicione o novo departamento</h2>
                <form method="POST" action="atividades-mysql.php">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome_departamento" name="nome_departamento" placeholder="Digite o nome do departamento" required maxlength="15" required>
                        <label for="nome_departamento" class="form-label">Digite o nome do departamento</label>
                    </div>

                    <div class="form-floating mb-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="cpf_gerente" name="cpf_gerente" placeholder="Digite seu CPF" oninput="validateCPF(this)">
                            <label for="cpf_gerente">CPF do Gerente</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="inicio_gerente" name="inicio_gerente" placeholder="Ínicio do trabalho">
                                <label for="inicio_gerente">Ínicio do Trabalho</label>
                            </div>
                        </div>
                    </div>

                    <!-- Select para local dos departamentos -->
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Local dos Departamentos</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="numero_local_departamento" required>
                            <?php
                                // Consulta para obter os locais de departamentos
                                $sql = "SELECT idLocalDepartamento, Nome FROM local_departamento";
                                $result = $conn->query($sql);

                                // Verifica se há resultados
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . htmlspecialchars($row['idLocalDepartamento']) . '">' . htmlspecialchars($row['Nome']) . '</option>';
                                    }
                                } else {
                                    echo '<option value="">Nenhum local disponível</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <input type="submit" class="btn btn-primary" name="create_departamento" value="Cadastrar">
                </form>

            </div>
            <div class="col-md-6">
                <div class="row align-items-center">
                    <div class="col-12">
                        <img src="img/hello.svg" alt="Hello New Customer" class="img-fluid">
                    </div>
                    <div class="col-12" id="link-container">
                        <a href="home.php" class="link-back">Já tem um departamento? Voltar para a Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
