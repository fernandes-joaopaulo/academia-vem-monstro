
<?php
$nome = null;
$tempo_login = null;

// Iniciando a session
@session_start();
if(isset($_SESSION['email']) and isset($_SESSION['senha'])) {
	// se existe as sessões coloca os valores em uma varivel
	$cpf = $_SESSION['cpf'];
	$telefone = $_SESSION['telefone'];
	$nome = $_SESSION['nome'];
	$tempo_login = $_SESSION['tempo_login'];
	$email = $_SESSION['email'];
	$senha = $_SESSION['senha'];
	
}
/*else {
	header("Location: falha_login.php");
	exit;
}*/
?>