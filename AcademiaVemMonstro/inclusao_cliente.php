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
$cpf = "";
$nome= "";
$telefone= "";
$email= "";
$senha= "";
$cep="";
$logradouro="";
$bairro="";
$localidade="";
$uf="";
$destino = '';
$ComandoSQL = "";

// Só entrará neste bloco do IF após o envio pelo formulário - o campo form_operação será criado no formulário abaixo

if ($_POST['form_operacao'] == "inclusao_cliente") {
    try
    {
// abre conexão com o banco
        require_once 'funcoes/conexao.php';
// recebe os dados do formulário
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $cep= $_POST['cep'];
        $logradouro= $_POST['logradouro'];
        $bairro= $_POST['bairro'];
        $localidade= $_POST['localidade'];
        $uf= $_POST['uf'];

        class Tamanho extends Exception { }


        if(strlen($senha) <= 6) {
          $destino = "function () {window.location='inclusao_cliente.php';}";
          echo "<script>sendToastr('A senha deve haver pelo menos 6 caracteres!<br />Clique para continuar!','error',$destino)</script>"; 
          die();      
         }

// verifica se já existe um registro na tabela para o código informado (chave duplicada)		
		$result = $conn->query("SELECT * FROM tb_cliente where cpf = $cpf");
		$count = $result->rowCount();
		if ($count > 0) {
			$destino = "function () {window.location='inclusao_cliente.php';}";
			echo "<script>sendToastr('CPF de cliente já cadastrado!<br />Clique para continuar!','error',$destino)</script>";
		}
    date_default_timezone_set('America/Sao_Paulo');
	$tempo_login = date('Y-m-d H:i:s', time());
  $senha = md5($senha);
// insere o dados digitados na tabele tb_receitas		
		$stmt = $conn->prepare('INSERT INTO tb_cliente VALUES(:cpf,:nome,:telefone, :tempo_login, :email, :senha, :cep, :logradouro, :bairro, :localidade, :uf)');
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':tempo_login', $tempo_login);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':cep', $cep);
        $stmt->bindValue(':logradouro', $logradouro);
        $stmt->bindValue(':bairro', $bairro);
        $stmt->bindValue(':localidade', $localidade);
        $stmt->bindValue(':uf', $uf);
        $stmt->execute();

	} catch (PDOException $e) {
        // caso ocorra uma exceção, exibe na tela
		$destino = "function () {window.location='index.php';}";
		echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
        die();
    }
	$destino = "function () {window.location='index.php';}";
	echo "<script>sendToastr('Aluno cadastrado com sucesso!<br />Clique para continuar!','success',$destino)</script>";
}
?>
	<br>
<br>
<br>
	  <div class="form">
	  <h5>INCLUSÃO DE USUÁRIOS</h5>
	<br>
	  <form method="POST" action="inclusao_cliente.php" name="form_inclusao">
		<table width="600">
		  <tr>
			<td class="td_r">CPF:</td>
			<td class="td_input">
			  <input name="cpf" type="number" id="cpf" required="required" size='11' maxlenght='11'>
			</td>
		  </tr>
            
             <tr>
			<td class="td_r">Nome:</td>
			<td class="td_input">
			  <input name="nome" type="text" id="nome"  required="required">
			</td>
		  </tr>
            
             <tr>
			<td class="td_r">Telefone:</td>
			<td class="td_input">
			  <input name="telefone" type="number" id="telefone" required="required">
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
			<td class="td_r">E-mail:</td>
			<td class="td_input">
			  <input name="email" type="text" id="email" required="required">
			</td>
		  </tr>

      <tr>
			<td class="td_r">Senha:</td>
			<td class="td_input">
			  <input name="senha" type="password" min_length="32" max_lenght="32" id="senha" required="required">
			</td>
		  </tr>
            
		  <tr>
			<td colspan='2' class="td_c">
				<br />
				<input type="hidden" name="form_operacao" value="inclusao_cliente">
				<input id="botao" type="submit" name="enviar" value="Inserir Aluno">
				
		
			</td>
		  </tr>
		  </table>
	  </form>
      </div>
	</div>
	<?php require_once 'funcoes/menu.php';?>
	<div class="clear"></div>
</div> 
<script>
   const cep = document.querySelector("#cep")

const showData = (result)=>{
    for(const campo in result){
        if(document.querySelector("#"+campo)){
            document.querySelector("#"+campo).value = result[campo]
        }
    }
}

cep.addEventListener("blur",(e)=>{
    let search = cep.value.replace("-","")
    const options = {
        method: 'GET',
        mode: 'cors',
        cache: 'default'
    }

    fetch(`https://viacep.com.br/ws/${search}/json/`, options)
    .then(response =>{ response.json()
        .then( data => showData(data))
    })
    .catch(e => console.log('Deu Erro: '+ e,message))
})
</script>
</body>
</html>