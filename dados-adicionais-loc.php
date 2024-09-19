<?php
header('Content-Type: application/json');
require('conexao/conexao.php');

$id_local_departamento = isset($_GET['id_local_departamento']) ? $_GET['id_local_departamento'] : '';

if ($id_local_departamento) {
    // Consulta para obter informações básicas do funcionário
    $sql_local_departamento = "SELECT * FROM local_departamento WHERE idLocalDepartamento = ?";
    $stmt_local_departamento = $conn->prepare($sql_local_departamento);
    $stmt_local_departamento->bind_param('s', $id_local_departamento);
    $stmt_local_departamento->execute();
    $res_local_departamento = $stmt_local_departamento->get_result()->fetch_assoc();

    // Consulta para obter projetos em que o funcionário trabalha
    $sql_local_departamento = "
    select NomeDepartamento as nome_departamento from departamento
    inner join local_departamento on idLocalDepartamento = fkidLocalDepartamento
    where idLocalDepartamento = ?
    order by nome_departamento;";
    $stmt_departamentos = $conn->prepare($sql_local_departamento);
    $stmt_departamentos->bind_param('s', $id_local_departamento);
    $stmt_departamentos->execute();
    $res_departamentos = $stmt_departamentos->get_result();

    $departamentos = [];
    while ($departamento = $res_departamentos->fetch_assoc()) {
        $departamentos[] = $departamento;
    }

    // Retorno em formato JSON
    echo json_encode([
        'nome' => $res_local_departamento['nome_departamento'],
        
    ]);
} else {
    echo json_encode(['error' => 'CPF não fornecido']);
}

$conn->close();
?>
