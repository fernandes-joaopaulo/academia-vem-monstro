<?php
header("Content-Type: text/html; charset=utf-8", true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<?php require_once "verifica_usuario_logado.php"; 
if($nome == null) { header("Location: falha_login.php"); 
}?>
<meta charset="utf-8">
<title>Academia Vem Monstro</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="css/toastr.css" rel="stylesheet"/>
<script src="jquery/jquery-3.3.1.min.js"></script>
<script src="popper/popper.min.js"></script>
<script src="bootstrap4/js/bootstrap.min.js"></script>
<script src="funcoes/toastr.min.js"></script>
<script src="funcoes/funcao_toastr.js"></script>
<style>
     #menu{
            margin-top:10px;
        }
body{
            background-image : url('imagens/background_inclusao2.png');
        }              
        .cabeçalho {
            background-color: white;
            height: 130px;
            width: 100%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, .8);
        }

        #logoo {
           text-align: center;
        }

        .slogan {
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: 20px;
            position: fixed;
            right: 50px;
            top: 90px;
        }

        #auxiliar {
            width: 200px;
            float: center;
            padding-top: 0px;
        }

        ul {
            width: 250px;
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
        }

        ul li {
            margin: 1px 0;
        }

        ul li a,
        ul li a:visited {
            height: 1%;
            font: 20px Georgia, 'Times New Roman', Times, serif;
            background: #8503bb;
            color: #fff;
            text-decoration: none;
            padding: 2px 40px;
        }

        ul li a:hover {
            background: #9f9;
            color: #060;
        }
        .form{
			font: 20px Georgia, 'Times New Roman', Times, serif;
			color: white;
			margin-left: 100px;
		}
		#botao{
			background-color: #8503bb;
			color: white;
			width: 300px;
		}
</style>
</head>
<body>
<div class="cabeçalho">
        <div id="logoo"><img src="imagens/logo_vemmonstro"></div>
		<div id="menu"><?php require_once 'funcoes/menu.php';?></div>
	</div>
<?php
//
// Define as variáveis locais
//
$cpf = "";
$nome= "";
$telefone= "";
$cep="";
$logradouro="";
$bairro="";
$localidade="";
$uf="";
$destino = '';
$ComandoSQL = "";


// abre conexão com o banco
require_once 'funcoes/conexao.php';
$cpf = $_GET['cpf'];
// só entrará neste bloco na segunda vez, quando o programa for chamado pelo formulário
switch ($_POST['form_operacao']) {
    case "alteracao":
        try
        {
            // recebe os dados do formulário
            $cpf = $_POST['cpf'];
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $telefone = $_POST['telefone'];
            $cep= $_POST['cep'];
            $logradouro= $_POST['logradouro'];
            $bairro= $_POST['bairro'];
            $localidade= $_POST['localidade'];
            $uf= $_POST['uf'];
    
            $stmt = $conn->prepare('UPDATE tb_cliente SET
			nome = :nome,
		    telefone = :telefone WHERE cpf = :cpf');
			$stmt->bindValue(':cpf', $cpf);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':telefone', $telefone);
            $stmt->bindValue(':cep', $cep);
        $stmt->bindValue(':logradouro', $logradouro);
        $stmt->bindValue(':bairro', $bairro);
        $stmt->bindValue(':localidade', $localidade);
        $stmt->bindValue(':uf', $uf);
            $stmt->execute();
		
			$destino = "function () {window.location='consulta_cliente.php';}";
            echo "<script>sendToastr('Aluno alterado com sucesso! Clique para continuar!','success',$destino)</script>";
            break;
        } catch (PDOException $e) {
            // caso ocorra uma exceção, exibe na tela
			$destino = "function () {window.location='index.php';}";
			echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
		    die();
        }
    case "exclusao":
        try
        {
            // recebe os dados do formulário
            $cpf = $_POST['cpf'];
            $stmt = $conn->prepare('DELETE from tb_cliente WHERE cpf = :cpf');
            $stmt->bindValue(':cpf', $cpf);
            $stmt->execute();
			$destino = "function () {window.location='consulta_cliente.php';}";
            echo "<script>sendToastr('Aluno excluído com sucesso! Clique para seguir!','success',$destino)</script>";
	            break;
        } catch (PDOException $e) {
            // caso ocorra uma exceção, exibe na tela
			$destino = "function () {window.location='index.php';}";
			echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
            die();
        }
}
// executa uma instrução SQL de consulta
$ComandoSQL = "select * from tb_cliente where cpf = '" . $cpf . "'";
$result = $conn->query($ComandoSQL);
if (!$result) {
	$destino = "function () {window.location='index.php';}";
    echo "<script>sendToastr('Nenhum aluno foi encontrado! Clique para continuar!','error',$destino)</script>";
}
$row = $result->fetch(PDO::FETCH_OBJ)
?>
<script LANGUAGE="JavaScript">
// função que define qual operação será realizada, alteração ou exclusão. Ela depende do botão que o usuário pressionar  
	function define_operacao(operacao){
		if (operacao == "alt") {
		document.form_alteracao_exclusao_cliente.form_operacao.value = "alteracao";
		}
		if (operacao == "exc") {
		document.form_alteracao_exclusao_cliente.form_operacao.value = "exclusao";
		}
		document.form_alteracao_exclusao_cliente.submit();
	}
</script>
<div class='form'>
	<br>
	<br>
	<br>
	<h4>ALTERAÇÃO E EXCLUSÃO DE ALUNOS</h4>
	<br>
	<form method="POST" action="alteracao_exclusao_cliente.php" name="form_alteracao_exclusao_cliente">
    <table width="600">
		  <tr>
			<td class="td_r">CPF:</td>
			<td class="td_input">
			  <input name="cpf" type="number" id="cpf" required="required" value="<?php echo $row->cpf; ?>">
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Nome:</td>
			<td class="td_input">
			  <input name="nome" type="text" id="nome" required="required" value="<?php echo $row->nome; ?>">
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Telefone:</td>
			<td class="td_input">
			<input name="telefone" type="number" id="telefone" required="required" value="<?php echo $row->telefone; ?>">
			</td>
		  </tr>

          <tr>
			<td class="td_r">CEP:</td>
			<td class="td_input">
			  <input name="cep" type="text" id="cep" required="required">
			</td>
		  </tr>

      <tr>
			<td class="td_r">Logradouro:</td>
			<td class="td_input">
			  <input name="logradouro" type="text" id="logradouro" required="required">
			</td>
		  </tr>
      
      <tr>
			<td class="td_r">Bairro:</td>
			<td class="td_input">
			  <input name="bairro" type="text" id="bairro" required="required">
			</td>
		  </tr>

      <tr>
			<td class="td_r">Localidade:</td>
			<td class="td_input">
			  <input name="localidade" type="text" id="localidade" required="required">
			</td>
		  </tr>

      <tr>
			<td class="td_r">UF:</td>
			<td class="td_input">
			  <input name="uf" type="text" id="uf" required="required">
			</td>
		  </tr>

			<tr>
				<td colspan='2' class="td_c">
				<input type="hidden" name="form_operacao" value="consulta">
				<input id='botao' name="alterar" type="button" value="Alterar" onClick="define_operacao('alt');">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input id='botao' name="excluir" type="button" value="Excluir" onClick="define_operacao('exc');">
				</td>
			</tr>
		</table>
	</form>
</div>
	<div class="clear"></div>
</body>
</html>