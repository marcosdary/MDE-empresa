<?php
    // Inclui a conexão com o banco de dados
    require('conexao\\conexao.php');

    // Obtém o iddependente da solicitação
    $id_dependente = $_REQUEST["iddependente"];
    $sql = "
    select 
        iddependente, d.Nome as nome_dependente, d.Sexo as sexo_dependente, 
        Datanasc, Parentesco, f.Nome as nome_funcionario, f.Cpf as cpf
    from dependente as d
    inner join funcionario as f on f.Cpf = fkCpf
    where iddependente = '".$_REQUEST["iddependente"]."';";
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
    <title>Editar Dependente</title>
</head>
<body>
    <div class="container col-11 col-md-9" id="form-container">
        <div class="row gx-5">
            <div class="col-md-6">
                <h2>Editar Dependente</h2>
                <form action="atividades-mysql.php" method="POST">
                    <input type="hidden" name="cpf" value="<?= htmlspecialchars($row->cpf)?>">
                    <input type="hidden" name="id_dependente" value="<?= htmlspecialchars($id_dependente)?>">
                    <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="hidden" name="nome_funcionario" value="<?=$row->nome_funcionario?>">
                        <input type="text" class="form-control" id="nome_funcionario" name="nome_funcionario" 
                        placeholder="Disabled input" aria-label="nome_funcionario" disabled
                        value = "<?=$row->nome_funcionario?>">
                        <label for="cpf" class="form-label">Funcionário(a)</label>
                    </div>
                </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do dependente" value="<?=$row->nome_dependente?>" maxlength="80" required>
                        <label for="nome" class="form-label">Digite o nome do dependente</label>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="datanascimento" name="datanascimento" placeholder="Data de nascimento (dd/mm/yyyy)" value = "<?=$row->Datanasc?>">
                            <label for="datanascimento">Data de nascimento</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" id="sexo" name="sexo">
                            <option selected>Selecione sexo</option>
                            <option value="M" <?php if($row->sexo_dependente == "M"){echo("selected");}; ?>>Masculino</option>
                            <option value="F" <?php if($row->sexo_dependente == "F"){echo("selected");}; ?>>Feminino</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="parentesco" class="form-label">Parentesco</label>
                        <select class="form-select" id="parentesco" name="parentesco">
                            <option value="" disabled>Selecione o parentesco</option>
                            <option value="Pai" <?= $row->Parentesco === "Pai" ? 'selected' : '' ?>>Pai</option>
                            <option value="Mãe" <?= $row->Parentesco === "Mãe" ? 'selected' : '' ?>>Mãe</option>
                            <option value="Esposo" <?= $row->Parentesco === "Esposo" ? 'selected' : '' ?>>Esposo</option>
                            <option value="Esposa" <?= $row->Parentesco === "Esposa" ? 'selected' : '' ?>>Esposa</option>
                            <option value="Amante" <?= $row->Parentesco === "Amante" ? 'selected' : '' ?>>Amante</option>
                            <option value="Filho" <?= $row->Parentesco === "Filho" ? 'selected' : '' ?>>Filho</option>
                            <option value="Filha" <?= $row->Parentesco === "Filha" ? 'selected' : '' ?>>Filha</option>
                            <option value="Irmão" <?= $row->Parentesco === "Irmão" ? 'selected' : '' ?>>Irmão</option>
                            <option value="Irmã" <?= $row->Parentesco === "Irmã" ? 'selected' : '' ?>>Irmã</option>
                            <option value="Avô" <?= $row->Parentesco === "Avô" ? 'selected' : '' ?>>Avô</option>
                            <option value="Avó" <?= $row->Parentesco === "Avó" ? 'selected' : '' ?>>Avó</option>
                            <option value="Tio" <?= $row->Parentesco === "Tio" ? 'selected' : '' ?>>Tio</option>
                            <option value="Tia" <?= $row->Parentesco === "Tia" ? 'selected' : '' ?>>Tia</option>
                            <option value="Primo" <?= $row->Parentesco === "Primo" ? 'selected' : '' ?>>Primo</option>
                            <option value="Prima" <?= $row->Parentesco === "Prima" ? 'selected' : '' ?>>Prima</option>
                            <option value="Outro" <?= $row->Parentesco === "Outro" ? 'selected' : '' ?>>Outro</option>
                        </select>
                    </div>
        
                    <input type="submit" class="btn btn-primary" name="edit_dependente" value="Salvar">
                </form>
            </div>
            <div class="col-md-6">
                <div class="row align-items-center">
                    <div class="col-12">
                        <img src="img/hello.svg" alt="Hello New Customer" class="img-fluid">
                    </div>
                    <div class="col-12" id="link-container">
                        <a href="home.php" class="link-back">Já tem dependente? Voltar para a Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>