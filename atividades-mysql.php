<?php
	session_start();
	require 'conexao\\conexao.php';

	//Login
	if (isset($_POST['login_funcionario'])) {
		$cpf = $_POST['cpf'];
		$senha = $_POST['senha'];

		$sql = "
			select count(*) as total from funcionario
			where Cpf = '{$cpf}' and Senha = '{$senha}';";

		$res = $conn->query($sql);
		$row = $res->fetch_object();
		if ($row->total > 0) {
			header('Location: home.php');
		} else {
			print "<script>alert('Não foi possível acessar o home - dados inválidos');</script>";
			print "<script>location.href='login.php';</script>";
		}
		exit;
    }

    // FUNCIONÁRIO
	if (isset($_POST['create_funcionario'])) {
		$cpf = $_POST['cpf'];
		$nome = $_POST['nome'];
		$datanascimento = $_POST['datanascimento'];
		$endereco = $_POST['endereco'];
		$sexo = $_POST['sexo'];
		$salario = $_POST['salario'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		
		$sql = "insert into funcionario 
					(Cpf, Nome, DataNascimento, Endereco, Sexo, Salario, Email, Senha) 
				values ('{$cpf}', '{$nome}', '{$datanascimento}', 
					'{$endereco}', '{$sexo}', '{$salario}', '{$email}', '{$senha}')";
		
		
		
		$res = $conn->query($sql);
		if ($res==true) {
			header('Location: listar-funcionario.php');
		} else {
			print "<script>alert('Não foi possível cadastrar o funcionário');</script>";
			print "<script>location.href='novo-funcionario.php';</script>";
		}
		exit;
    }
    
    if (isset($_POST['edit_funcionario'])) {
		$cpf = $_POST['cpf'];
		$nome = $_POST['nome'];
		$datanascimento = $_POST['datanascimento'];
		$endereco = $_POST['endereco'];
		$sexo = $_POST['sexo'];
		$salario = $_POST['salario'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		
		$sql = "update funcionario set
					Nome = '{$nome}', 
					DataNascimento = '{$datanascimento}',
					Endereco = '{$endereco}', 
					Sexo = '{$sexo}', 
					Salario = '{$salario}', 
					Email = '{$email}', 
					Senha = '{$senha}' 
				where Cpf = '{$cpf}';";
		
		$res = $conn->query($sql);
		if ($res==true) {
			header('Location: listar-funcionario.php');
		} else {
			print "<script>alert('Não foi possível editar o cadastro do funcionário');</script>";
			print "<script>location.href='editar-funcionario.php';</script>";
		}
		exit;
	}

    if (isset($_POST['delete_funcionario'])) {
		$cpf = $_POST['delete_funcionario'];

		$sql = "select * from dependente where fkCpf = '{$cpf}';";
		$res = $conn->query($sql);
        
		if ($res && $res->num_rows > 0) {
            
			print "<script>alert('O Funcionário pode ter dependente ou trabalhar em algum projeto ou ser gerente de um departamento, não é possível excluir o cadastrado.');</script>";
			print "<script>location.href='listar-funcionario.php';</script>";
		} else {
		
			$sql = "delete from funcionario where Cpf = '{$cpf}'";
			$res = $conn->query($sql);
			if ($res==true) {
				header('Location: listar-funcionario.php');
			} else {
				print "<script>alert('Não foi possível excluir o cadastrado do funcionário.');</script>";
				print "<script>location.href='listar-funcionario.php';</script>";
			}
		}
		
	}

	// Dependente
	if (isset($_POST['create_dependente'])) {
		$cpf = $_POST['cpf'];
		$nome = $_POST['nome'];
		$datanascimento = $_POST['datanascimento'];
		$parentesco = $_POST['parentesco'];
		$sexo = $_POST['sexo'];
		
		
		$sql = "insert into dependente
				(fkCpf, Nome, Datanasc, Parentesco, Sexo) 
				values ('{$cpf}', '{$nome}','{$datanascimento}', '{$parentesco}', '{$sexo}')";
		
		$res = $conn->query($sql);
		if ($res==true) {
    		header('Location: listar-dependente.php?cpf='. urlencode($cpf));
		} else {
			print "<script>alert('Não foi possível cadastrar o dependente');</script>";
			print "<script>location.href='novo-dependente.php?cpf=" . urlencode($cpf) . "';</script>";
		}
		exit;
    }

	if (isset($_POST['edit_dependente'])) {
		$id_dependente = $_POST['id_dependente'];
		$cpf = $_POST['cpf'];
		$nome = $_POST['nome'];
		$datanascimento = $_POST['datanascimento'];
		$sexo = $_POST['sexo'];
		$parentesco = $_POST['parentesco'];
		
		$sql = "update dependente set
					Nome = '{$nome}', 
					Datanasc = '{$datanascimento}',
					Sexo = '{$sexo}', 
					Parentesco = '{$parentesco}' 
				where iddependente = '{$id_dependente}';";
		
		$res = $conn->query($sql);
		if ($res==true) {
			header('Location: listar-dependente.php?cpf='. urlencode($cpf));
		} else {
			print "<script>alert('Não foi possível editar o dependente');</script>";
			print "<script>location.href='novo-dependente.php?cpf=" . urlencode($id_dependente) . "';</script>";
		}
		exit;
	}
    
	if (isset($_POST['delete_dependente'])) {
		$delete_dependente = $_POST['delete_dependente'];

		
		$sql = "delete from dependente where iddependente = '{$delete_dependente}'";
		$res = $conn->query($sql);
		if ($res==true) {
			header('Location: listar-funcionario.php');
		} else {
			print "<script>alert('Não foi possível excluir o dependente.');</script>";
			print "<script>location.href='listar-funcionario.php';</script>";
		}
		exit;
	}

    // Projeto
    if (isset($_POST['create_projeto'])) {
		$nome = $_POST['nome'];
		$local = $_POST['local'];
		$numdepartamento = $_POST['departamento'];
		
		$sql = "insert into projeto
				(Nome, Local, fkNumDepartamento) 
				values ('{$nome}', '{$local}', '{$numdepartamento}')";
		
		$res = $conn->query($sql);
		if ($res==true) {
			header('Location: listar-projeto.php');
		} else {
			print "<script>alert('Não foi possível cadastrar o projeto');</script>";
			print "<script>location.href='novo-projeto.php';</script>";
		}
		exit;
    }

	if (isset($_POST['delete_projeto'])) {
		$id_projeto = $_POST['delete_projeto'];

		$sql = "select * from trabalha_em where fkIdProjeto = '{$id_projeto}';";
		$res = $conn->query($sql);
        
		if ($res && $res->num_rows > 0) {
            
			print "<script>alert('O Projeto está ainda em desenvolvimento.');</script>";
			print "<script>location.href='listar-projeto.php';</script>";
		} else {
		
			$sql = "delete from projeto where idProjeto = '{$id_projeto}'";
			$res = $conn->query($sql);
			if ($res==true) {
				header('Location: listar-projeto.php');
			} else {
				print "<script>alert('Não foi possível excluir o projeto.');</script>";
				print "<script>location.href='listar-projeto.php';</script>";
			}
		}
		exit;
	}

	if (isset($_POST['edit_projeto'])) {
		$id_projeto = $_POST['id_projeto'];
		$nome = $_POST['nome'];
		$local = $_POST['local'];
		
		$sql = "update projeto set
					Nome = '{$nome}',
					Local = '{$local}'
				where idProjeto = '{$id_projeto}';";
		
		$res = $conn->query($sql);
		if ($res==true) {
			header('Location: listar-projeto.php');
		
		} else {
			print "<script>alert('Não foi possível editar o projeto');</script>";
			print "<script>location.href='editar-projeto.php';</script>";
		}
		exit;
	}
    
	//Departamento
	if (isset($_POST['create_departamento'])) {
		$nome_departamento = $_POST['nome_departamento'];
		$cpf_gerente = $_POST['cpf_gerente'];
		$inicio_gerente = $_POST['inicio_gerente'];
		$numero_local_departamento = $_POST['numero_local_departamento'];
		
		$sql = "select count(*) as total from funcionario where Cpf = '{$cpf_gerente}';";
		$res = $conn->query($sql);
		$row = $res->fetch_object();
		if ($row->total > 0){
			$sql = "insert into departamento
					(fkCpf, NomeDepartamento, DataInicioGerente, fkidLocalDepartamento) 
					values ('{$cpf_gerente}', '{$nome_departamento}', '{$inicio_gerente}', '{$numero_local_departamento}')";
			$res = $conn->query($sql);
			if ($res==true) {
				header('Location: listar-departamento.php');
			} else {
				print "<script>alert('Não foi possível cadastrar o departamento');</script>";
				print "<script>location.href='novo-departamento.php';</script>";
			}
			exit;
		}else {
			print "<script>alert('Não foi possível cadastrar o departamento, pois o cpf está inválido');</script>";
			print "<script>location.href='novo-departamento.php';</script>";
		}
	}
    

	if (isset($_POST['edit_departamento'])) {
		$numero_departamento = $_POST['numero_departamento'];
		$nome_departamento = $_POST['nome_departamento'];
		
		$sql = "update departamento set
					NomeDepartamento = '{$nome_departamento}' 
				where NumDepartamento = '{$numero_departamento}';";
		
		$res = $conn->query($sql);
		if ($res==true) {
			header('Location: listar-departamento.php');
		} else {
			print "<script>alert('Não foi possível editar o departamento');</script>";
			print "<script>location.href='editar-departamento.php';</script>";
		}
		exit;
	}

	if (isset($_POST['delete_departamento'])) {
		$numero_departamento = $_POST['delete_departamento'];

		$sql = "select * from projeto where fkNumDepartamento = '{$numero_departamento}';";
		$res = $conn->query($sql);
        
		if ($res && $res->num_rows > 0) {
            
			print "<script>alert('O Departamento pode ter projeto vinculado');</script>";
			print "<script>location.href='listar-departamento.php';</script>";
		} else {
		
			$sql = "delete from departamento where NumDepartamento = '{$numero_departamento}'";
			$res = $conn->query($sql);
			if ($res==true) {
				header('Location: listar-departamento.php');
			} else {
				print "<script>alert('Não foi possível excluir o departamento.');</script>";
				print "<script>location.href='listar-departamento.php';</script>";
			}
		}
		exit;
	}

	// Local de Departamento
	if (isset($_POST['create_local_departamento'])) {
		$nome_local_departamento = $_POST['nome_local_departamento'];
		
		
		$sql = "insert into local_departamento
				(Nome) 
				values ('{$nome_local_departamento}')";
		
		$res = $conn->query($sql);
		if ($res==true) {
			header('Location: listar-local-departamento.php');
		} else {
			print "<script>alert('Não foi possível cadastrar o local');</script>";
			print "<script>location.href='novo-local-departamento.php';</script>";
		}
		exit;
    }

	if (isset($_POST['edit_local_departamento'])) {
		$id = $_POST['id'];
		$nome_local_departamento = $_POST['nome_local_departamento'];
		
		$sql = "update local_departamento set
					Nome = '{$nome_local_departamento}' 
				where idLocalDepartamento = '{$id}';";
		
		$res = $conn->query($sql);
		if ($res==true) {
			header('Location: listar-local-departamento.php');
		} else {
			print "<script>alert('Não foi possível editar o departamento');</script>";
			print "<script>location.href='editar-local-departamento.php';</script>";
		}
		exit;
	}

	if (isset($_POST['delete_local_departamento'])) {
		$id_local_departamento = $_POST['delete_local_departamento'];

		$sql = "select * from departamento where fkidLocalDepartamento = '{$id_local_departamento}';";
		$res = $conn->query($sql);
        
		if ($res && $res->num_rows > 0) {
            
			print "<script>alert('O Local tem departamento vinculado');</script>";
			print "<script>location.href='listar-local-departamento.php';</script>";
		} else {
		
			$sql = "delete from local_departamento where idLocalDepartamento = '{$id_local_departamento}'";
			$res = $conn->query($sql);
			if ($res==true) {
				header('Location: listar-local-departamento.php');
			} else {
				print "<script>alert('Não foi possível excluir o local.');</script>";
				print "<script>location.href='listar-local-departamento.php';</script>";
			}
		}
	}
?>