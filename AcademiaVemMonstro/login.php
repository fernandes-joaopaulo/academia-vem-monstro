<?php
header("Content-Type: text/html; charset=utf-8", true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<title>DWeb - PHP</title><?php

function protecao($string){
	$string = str_replace(" or ", "", $string);
	$string = str_replace("select ", "", $string);
	$string = str_replace("delete ", "", $string);
	$string = str_replace("create ", "", $string);
	$string = str_replace("drop ", "", $string);
	$string = str_replace("update ", "", $string);
	$string = str_replace("drop table", "", $string);
	$string = str_replace("show table", "", $string);
	$string = str_replace("applet", "", $string);
	$string = str_replace("object", "", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("#", "", $string);
	$string = str_replace("=", "", $string);
	$string = str_replace("--", "", $string);
	$string = str_replace("-", "", $string);
	$string = str_replace(";", "", $string);
	$string = str_replace("*", "", $string);
	$string = strip_tags($string);
	return $string;
}

$email = protecao($_POST['email']);
$senha = protecao($_POST['senha']);

$senha = md5($senha);

require_once 'funcoes/conexao.php';
		
$stmt = $conn->prepare('select * from tb_cliente where email = :email and senha = :senha');
$stmt->bindValue(':email', $email);
$stmt->bindValue(':senha', $senha);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_OBJ);
$count = $stmt->rowCount();   

if ($count > 0) {
	@session_start();

	$_SESSION["cpf"] = $row->cpf;
	$_SESSION["telefone"] = $row->telefone;
	$_SESSION["nome"] = $row->nome;
	$_SESSION["tempo_login"] = $row->tempo_login;
	$_SESSION["email"] = $row->email;
	$_SESSION["senha"] = $row->senha;


	date_default_timezone_set('America/Sao_Paulo');
	$date = date('Y-m-d H:i:s', time());
	$tempo_novo = $date;
	
	$atualizar = $conn->prepare('UPDATE tb_cliente SET
	tempo_login = :tempo_login WHERE cpf = :cpf');
	$atualizar->bindValue(':tempo_login', $tempo_novo);
	$atualizar->bindValue(':cpf', $row->cpf);
	$atualizar->execute();


	header('Location: index.php'); 
}
else
{
	@session_start();
	$_SESSION = array();
    session_destroy();

		header("Location: falha_login.php");
}
?>