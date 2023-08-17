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
    #menu{
            margin-top:10px;
        }
</style>
</head>
<body>
<div class="cabeçalho">
        <div id="logoo"><img src="imagens/logo_vemmonstro"></div>
		<div id="menu"><?php require_once 'funcoes/menu.php';?></div>
	</div>
	<div id='principal'>
<?php
//
// Define as variáveis locais
//
$codigo = "";
$aparelhos= "";
$exercicios= "";
$series= "";
$repeticoes= "";
$destino = '';
$ComandoSQL = "";

// Só entrará neste bloco do IF após o envio pelo formulário - o campo form_operação será criado no formulário abaixo

if ($_POST['form_operacao'] == "inclusao_ficha") {
    try
    {
// abre conexão com o banco
        require_once 'funcoes/conexao.php';
// recebe os dados do formulário
        $codigo = $_POST['codigo'];
        $aparelhos = $_POST['aparelhos'];
        $exercicios = $_POST['exercicios'];
        $series = $_POST['series'];
        $repeticoes = $_POST['repeticoes'];
// verifica se já existe um registro na tabela para o código informado (chave duplicada)		
		$result = $conn->query("SELECT * FROM tb_ficha where codigo = $codigo");
		$count = $result->rowCount();
		if ($count > 0) {
			$destino = "function () {window.location='inclusao_ficha.php';}";
			echo "<script>sendToastr('Código já cadastrado!<br />Clique para continuar!','error',$destino)</script>";
		}
// insere o dados digitados na tabele tb_receitas		
		$stmt = $conn->prepare('INSERT INTO tb_ficha VALUES(:codigo,:aparelhos,:exercicios,:series,:repeticoes)');
        $stmt->bindValue(':codigo', $codigo);
        $stmt->bindValue(':aparelhos', $aparelhos);
        $stmt->bindValue(':exercicios', $exercicios);
        $stmt->bindValue(':series', $series);
        $stmt->bindValue(':repeticoes', $repeticoes);
        $stmt->execute();

	} catch (PDOException $e) {
        // caso ocorra uma exceção, exibe na tela
		$destino = "function () {window.location='index.php';}";
		echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
        die();
    }
	$destino = "function () {window.location='inclusao_ficha.php';}";
	echo "<script>sendToastr('Ficha cadastrada com sucesso!<br />Clique para continuar!','success',$destino)</script>";
}
?>
	<br>
<br>
<br>
	  <div class="form">
	  <h5>INCLUSÃO DE FICHAS</h5>
	<br>
	  <form method="POST" action="inclusao_ficha.php" name="form_inclusao">
		<table width="600">
		  <tr>
			<td class="td_r">Código da ficha:</td>
			<td class="td_input">
			  <input name="codigo" type="number" id="codigo" required="required">
			</td>
		  </tr>
            
             <tr>
			<td class="td_r">Aparelhos:</td>
			<td class="td_input">
            <textarea name="aparelhos" id="aparelhos"
			  rows="4" cols="60" required="required"></textarea>	
            </td>
		  </tr>
            
             <tr>
			<td class="td_r">Exercicios:</td>
			<td class="td_input">
            <textarea name="exercicios" id="exercicios"
			  rows="4" cols="60" required="required"></textarea>
            </td>
		  </tr>

          <td class="td_r">Número de séries:</td>
			<td class="td_input">
			  <input name="series" type="number" id="series" required="required">
			</td>
		  </tr>

          <td class="td_r">Número de repetições:</td>
			<td class="td_input">
			  <input name="repeticoes" type="number" id="repeticoes" required="required">
			</td>
		  </tr>
            
		  <tr>
			<td colspan='2' class="td_c">
				<br />
				<input type="hidden" name="form_operacao" value="inclusao_ficha">
				<input id="botao" type="submit" name="enviar" value="INSERIR FICHA">
				
				
			</td>
		  </tr>
		  </table>
	  </form>
</div>
	  </div>
	<div class="clear"></div>
</div> 
</body>
</html>