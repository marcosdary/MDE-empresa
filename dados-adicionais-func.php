<?php
header('Content-Type: application/json');
require('conexao/conexao.php');

$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : '';

if ($cpf) {
    // Consulta para obter informações básicas do funcionário
    $sql_funcionario = "SELECT * FROM funcionario WHERE Cpf = ?";
    $stmt_funcionario = $conn->prepare($sql_funcionario);
    $stmt_funcionario->bind_param('s', $cpf);
    $stmt_funcionario->execute();
    $res_funcionario = $stmt_funcionario->get_result()->fetch_assoc();

    // Consulta para obter projetos em que o funcionário trabalha
    $sql_projetos = "
    SELECT p.Nome AS nome_projeto, t.Horas AS horas
    FROM trabalha_em t
    INNER JOIN projeto p ON t.fkIdProjeto = p.idProjeto
    WHERE t.fkCpf = ?";
    $stmt_projetos = $conn->prepare($sql_projetos);
    $stmt_projetos->bind_param('s', $cpf);
    $stmt_projetos->execute();
    $res_projetos = $stmt_projetos->get_result();

    $projetos = [];
    while ($projeto = $res_projetos->fetch_assoc()) {
        $projetos[] = $projeto;
    }

    // Retorno em formato JSON
    echo json_encode([
        'nome' => $res_funcionario['Nome'],
        'data_nascimento' => $res_funcionario['DataNascimento'],
        'sexo' => $res_funcionario['Sexo'],
        'salario' => $res_funcionario['Salario'],
        'projetos' => $projetos
    ]);
} else {
    echo json_encode(['error' => 'CPF não fornecido']);
}

$conn->close();
?>
