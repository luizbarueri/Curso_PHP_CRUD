<?php
Class Pessoa
{
	private $pdo;
	//CONEXAO com banco de dados
	public function __construct($dbname,$host,$user,$senha)
	{
		try
		{
			$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
		} catch (PDOException $e)
		{
			echo "Erro com banco de dados! - ".$e->getmessage();
			exit();
		}
		catch (Exception $e)
		{
			echo "Erro geral - ".$e->getmessage();
			exit();
		}

	}
	//FUNCAO PARA BUSCAR DADOS E COLOCAR NO LADO DIREITO
	public function buscarDados()
	{
		$res=array();
		$cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
		$res=$cmd->fetchall(PDO::FETCH_ASSOC);
		return $res;
	}

	//---------------Cadastrar-------------------
	public function cadastrarPessoa($nome,$telefone,$email)
	{
		//antes de cadastra verificar se ja existe o email
		$cmd=$this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");
		$cmd->bindvalue(":e",$email);
		$cmd->Execute();
		if($cmd->rowcount() > 0) //email já existe
		{
			return false;
		}
		else //não foi cadastrado
		{
			$cmd = $this->pdo->prepare("INSERT INTO pessoa (nome,telefone,email) VALUES (:n,:t,:e)");
			$cmd->bindvalue(":n",$nome);
			$cmd->bindvalue(":t",$telefone);
			$cmd->bindvalue(":e",$email);
			$cmd->Execute();
			return true;
		}	

	}
	//------------------EXCLUIR-------------------------
	public function excluirPessoa($id)
	{
		$cmd=$this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
		$cmd->bindvalue(":id",$id);
		$cmd->Execute();
	}
	//-------------------ALTERAR--------------------------------------
	//--------Buscar Dado
	public function buscarDadosPessoa($id)
	{
		$res=array();
		$cmd=$this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
		$cmd->bindvalue(":id",$id);
		$cmd->execute();
		$res=$cmd->fetch(PDO::FETCH_ASSOC);
		return $res;
	}

	//-------Atualizar Dados
	public function atualizarDados($id,$nome,$telefone,$email)
	{
    	$cmd = $this->pdo->prepare("UPDATE pessoa SET nome = :n,telefone = :t,email = :e WHERE id = :id");
		$cmd->bindvalue(":n",$nome);
		$cmd->bindvalue(":t",$telefone);
		$cmd->bindvalue(":e",$email);
		$cmd->bindvalue(":id",$id);
		$cmd->Execute();
	}

}//Fim classe


?>