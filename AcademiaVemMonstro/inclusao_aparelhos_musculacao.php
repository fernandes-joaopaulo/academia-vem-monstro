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

$codigo = "";
$nome_aparelho = "";
$marca = "";
$preco = "";
$funcao = "";
$carga_max = "";
$carga_min = "";
$material = "";
$peso = "";
$comentarios = "";
$destino = '';
$ComandoSQL = "";

if ($_POST['form_operacao'] == "inclusao_aparelhos_musculacao") {
    try
    {
        require_once 'funcoes/conexao.php';
        $codigo = $_POST['codigo'];
        $nome_aparelho = $_POST['nome_aparelho'];
        $marca = $_POST['marca'];
        $preco = $_POST['preco'];
        $funcao = $_POST['funcao'];
        $carga_max = $_POST['carga_max'];
        $carga_min = $_POST['carga_min'];
        $material = $_POST['material'];
        $peso = $_POST['peso'];
        $comentarios = $_POST['comentarios'];

		$result = $conn->query("SELECT * FROM tb_aparelhos_musculacao where codigo = $codigo");
		$count = $result->rowCount();
		if ($count > 0) {
			$destino = "function () {window.location='inclusao_aparelhos_musculacao.php';}";
			echo "<script>sendToastr('Código de aparelho já cadastrado!<br />Clique para continuar!','error',$destino)</script>";
		}
		
		$stmt = $conn->prepare('INSERT INTO tb_aparelhos_musculacao VALUES
		(:codigo,:nome_aparelho,:marca,:preco,:funcao,:carga_max,:carga_min,:material,:peso,:comentarios)');
        $stmt->bindValue(':codigo', $codigo);
        $stmt->bindValue(':nome_aparelho', $nome_aparelho);
        $stmt->bindValue(':marca', $marca);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':funcao', $funcao);
        $stmt->bindValue(':carga_max', $carga_max);
		$stmt->bindValue(':carga_min', $carga_min);
		$stmt->bindValue(':material', $material);
		$stmt->bindValue(':peso', $peso);
		$stmt->bindValue(':comentarios', $comentarios);
        $stmt->execute();

	} catch (PDOException $e) {
		$destino = "function () {window.location='index.php';}";
		echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
        die();
    }
	$destino = "function () {window.location='inclusao_aparelhos_musculacao.php';}";
	echo "<script>sendToastr('Aparelho cadastrado com sucesso!<br />Clique para continuar!','success',$destino)</script>";
}
?>
<br>
<br>
<br>
	  <div class="form">
	  <h5>INCLUSÃO DE APARELHOS DE MUSCULAÇÃO</h5>
	<br>
	  <form method="POST" action="inclusao_aparelhos_musculacao.php" name="form_inclusao">
		<table width="600">
		  <tr>
			<td class="td_r">Código:</td>
			<td class="td_input">
			  <input name="codigo" type="number" id="codigo" required="required">
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Nome:</td>
			<td class="td_input">
			  <input name="nome_aparelho" type="text" id="nome_receita" size="50" maxlength="50" required="required">
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Marca:</td>
			<td class="td_input">
			<input name="marca" type="text" id="marca" size="50" maxlength="50" required="required">
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Preço:</td>
			<td class="td_input">
			<input name="preco" type="number" id="preco" step="any" required="required">
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Função:</td>
			<td class="td_input">
			  <textarea name="funcao" id="funcao"
			  rows="4" cols="40" required="required"></textarea>
			</td>
		  </tr>
             <tr>
			<td class="td_r">Carga Máxima:</td>
			<td class="td_input">
			  <input type="number" name="carga_max" id="carga_max" required="required">
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Carga Mínima:</td>
			<td class="td_input">
			  <input type="number" name="carga_min" id="carga_min" required="required">
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Material:</td>
			<td class="td_input">
			  <input type="text" name="material" id="material" size="50" maxlength="50" required="required">
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Peso</td>
			<td class="td_input">
			  <input type="number" name="peso" id="peso" step="any" required="required">
			</td>
		  </tr>
		  <tr>
			<td class="td_r">Comentários:</td>
			<td class="td_input">
			<textarea name="comentarios" id="comentarios"
			  rows="4" cols="40" required="required"></textarea>
			</td>
		  </tr>
		  <tr>
			<td colspan='2' class="td_c">
				<br />
				<input type="hidden" name="form_operacao" value="inclusao_aparelhos_musculacao">
				<input id="botao" type="submit" name="enviar" value="INSERIR APARELHOS">
				
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