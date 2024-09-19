<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
        require("conexao\\conexao.php")
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="css/novo_projeto.css">
    <title>Cadastro Projeto</title>
</head>
<body>
    <div class="container col-11 col-md-9" id="form-container">
        <div class="row gx-5">
            <div class="col-md-6">
                <h2>Adicione o novo projeto</h2>
                <form action="atividades-mysql.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do projeto" maxlength="15" required>
                        <label for="nome" class="form-label">Digite o nome do projeto</label>
                    </div>  

                    <div class="form-floating mb-3">                        
                        <input type="text" class="form-control" id="local" name="local" placeholder="Digite o local" maxlength="15" required>
                        <label for="local" class="form-label">Digite o local</label>
                    </div>
                    <!-- Selects -->
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Departamentos</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="departamento">
                            <?php
                                // Consulta para obter os departamentos
                                $sql = "SELECT NumDepartamento, NomeDepartamento FROM departamento";
                                $result = $conn->query($sql);

                                // Verifica se há resultados
                                if ($result->num_rows > 0) {
                                    // Itera sobre os resultados e cria uma opção para cada departamento
                                    while ($row = $result->fetch_assoc()) {
                                        // O valor enviado ao servidor será o NumDepartamento
                                        // O texto visível será o NomeDepartamento
                                        echo '<option value="' . htmlspecialchars($row['NumDepartamento']) . '">' . htmlspecialchars($row['NomeDepartamento']) . '</option>';
                                    }
                                } else {
                                    // Caso não haja resultados, exibe uma opção padrão
                                    echo '<option value="">Nenhum departamento disponível</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="create_projeto"  value="Cadastrar">
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