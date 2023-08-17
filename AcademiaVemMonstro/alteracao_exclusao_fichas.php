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


// abre conexão com o banco
require_once 'funcoes/conexao.php';
$codigo = $_GET['codigo'];
// só entrará neste bloco na segunda vez, quando o programa for chamado pelo formulário
switch ($_POST['form_operacao']) {
    case "alteracao":
        try
        {
            // recebe os dados do formulário
            $codigo = $_POST['codigo'];
            $aparelhos = $_POST['aparelhos'];
            $exercicios = $_POST['exercicios'];
            $series = $_POST['series'];
            $repeticoes = $_POST['repeticoes'];
			

            $stmt = $conn->prepare('UPDATE tb_ficha SET
			aparelhos = :aparelhos,
			exercicios = :exercicios,
			series = :series,
			repeticoes = :repeticoes WHERE codigo = :codigo');
			$stmt->bindValue(':codigo', $codigo);
            $stmt->bindValue(':aparelhos', $aparelhos);
            $stmt->bindValue(':exercicios', $exercicios);
            $stmt->bindValue(':series', $series);
			$stmt->bindValue(':repeticoes', $repeticoes);
            $stmt->execute();
		
			$destino = "function () {window.location='consulta_fichas.php';}";
            echo "<script>sendToastr('Ficha alterada com sucesso! Clique para continuar!','success',$destino)</script>";
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
            $codigo = $_POST['codigo'];
            $stmt = $conn->prepare('DELETE from tb_ficha WHERE codigo = :codigo');
            $stmt->bindValue(':codigo', $codigo);
            $stmt->execute();
			$destino = "function () {window.location='consulta_fichas.php';}";
            echo "<script>sendToastr('Ficha excluída com sucesso! Clique para seguir!','success',$destino)</script>";
	            break;
        } catch (PDOException $e) {
            // caso ocorra uma exceção, exibe na tela
			$destino = "function () {window.location='index.php';}";
			echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
            die();
        }
}
// executa uma instrução SQL de consulta
$ComandoSQL = "select * from tb_ficha where codigo = '" . $codigo . "'";
$result = $conn->query($ComandoSQL);
if (!$result) {
	$destino = "function () {window.location='index.php';}";
    echo "<script>sendToastr('Nenhuma ficha foi encontrado! Clique para continuar!','error',$destino)</script>";
}
$row = $result->fetch(PDO::FETCH_OBJ)
?>
<script LANGUAGE="JavaScript">
// função que define qual operação será realizada, alteração ou exclusão. Ela depende do botão que o usuário pressionar  
	function define_operacao(operacao){
		if (operacao == "alt") {
		document.form_alteracao_exclusao_fichas.form_operacao.value = "alteracao";
		}
		if (operacao == "exc") {
		document.form_alteracao_exclusao_fichas.form_operacao.value = "exclusao";
		}
		document.form_alteracao_exclusao_fichas.submit();
	}
</script>
<div class='form'>
	<br>
	<br>
	<br>
	<h4>ALTERAÇÃO E EXCLUSÃO DE FICHAS</h4>
	<br>
	<form method="POST" action="alteracao_exclusao_fichas.php" name="form_alteracao_exclusao_fichas">
    <table width="600">
    <tr>
			<td class="td_r">Código:</td>
			<td class="td_input">
			  <input name="codigo" type="number" id="codigo" required="required" value="<?php echo $row->codigo; ?>">
			</td>
		  </tr>
             <tr>
			<td class="td_r">Aparelhos:</td>
			<td class="td_input">
            <textarea name="aparelhos" id="aparelhos"
			  rows="4" cols="60" required="required"><?php echo $row->aparelhos; ?></textarea>	
            </td>
		  </tr>
            
             <tr>
			<td class="td_r">Exercicios:</td>
			<td class="td_input">
            <textarea name="exercicios" id="exercicios"
			  rows="4" cols="60" required="required"><?php echo $row->exercicios; ?></textarea>
            </td>
		  </tr>

          <td class="td_r">Número de séries:</td>
			<td class="td_input">
			  <input name="series" type="number" id="series" required="required" value="<?php echo $row->series; ?>">
			</td>
		  </tr>

          <td class="td_r">Número de repetições:</td>
			<td class="td_input">
			  <input name="repeticoes" type="number" id="repeticoes" required="required" value="<?php echo $row->repeticoes; ?>">
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