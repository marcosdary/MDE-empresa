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
    <title>Cadastro Local</title>
</head>
<body>
    <div class="container col-11 col-md-9" id="form-container">
        <div class="row gx-5">
            <div class="col-md-6">
                <h2>Adicione o novo local</h2>
                <form method="POST" action="atividades-mysql.php">
                    <input type="text" class="form-control" id="nome_local_departamento" name="nome_local_departamento" 
                        placeholder="Digite o nome do departamento" 
                        maxlength="15" required>

                    <input type="submit" class="btn btn-primary" name="create_local_departamento" value="Cadastrar">
                </form>

            </div>
            <div class="col-md-6">
                <div class="row align-items-center">
                    <div class="col-12">
                        <img src="img/hello.svg" alt="Hello New Customer" class="img-fluid">
                    </div>
                    <div class="col-12" id="link-container">
                        <a href="home.php" class="link-back">Já tem um local? Voltar para a Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
