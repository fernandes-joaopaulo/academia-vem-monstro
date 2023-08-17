<?php
header("Content-Type: text/html; charset=utf-8", true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Academia Vem Monstro</title>
<!--
    Carrega as folhas de estilos e as bibliotecas em javascript para o funcionamento da funcionalidade toastr (mensagens do sistema) 
-->
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
        #login-usuario{
            margin-top: 100px;
            font: 20px Georgia, 'Times New Roman', Times, serif;
			color: white;
            float:left;
            margin-left: 30px;
        }
        #login-usuario form{
            float:right;
        }
        #logout{
            float:right;
            margin-right: 20px;
        }
</style>
</head>
<body>
<div class="cabeçalho">
        <div id="logoo"><img src="imagens/logo_vemmonstro"></div>
        <button id='logout'><a href="logout.php">Logout</a></button>
		<div id="menu"><?php require_once 'funcoes/menu.php';?></div>
	</div>
    <div id='login-usuario'>
		<form name="form_acesso" method="post" action="login.php">
			E-mail:
				<input name="email" type="text" id="email" size="30" maxlength="30" required='required'><br><br>
			Senha:
			  <input name="senha" type="password"  id="senha" size="32" maxlength="32" required='required'><br /><br />
			  <input id='botao' type="submit" name="enviar" value="Entrar">
		</form>	
    </div>
</body>
</html>