<?php
header("Content-Type: text/html; charset=utf-8", true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Academia Vem Monstro</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="css/toastr.css" rel="stylesheet"/>
<script src="jquery/jquery-3.3.1.min.js"></script>
<script src="popper/popper.min.js"></script>
<script src="bootstrap4/js/bootstrap.min.js"></script>
<script src="funcoes/toastr.min.js"></script>
<script src="funcoes/funcao_toastr.js"></script>
<script src="selectcd_php.js"></script>
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
		#tabela_relatorio{
			display: flex;
            justify-content: center;
            margin-top: 100px;
			font: 25px Georgia, 'Times New Roman', Times, serif;
			color: white;
		}
		#filtro{
			width: 300px;
			height: 20px;
		}
		#botao2{
			background-color: #8503bb;
			color: white;
			width: 100px;
			height: 20px;
			float: right;
		}
        #menu{
            margin-top:10px;
        }
        #relatorio{

            display: flex;
            justify-content: center;
            margin-top: 100px;
			font: 25px Georgia, 'Times New Roman', Times, serif;
			color: white;
        }
        #txtHint{
            
            display: flex;
            justify-content: center;
            margin-top: 50px;
			font: 20px Georgia, 'Times New Roman', Times, serif;
			color: white;
        }
#txtHint{
    background-color: white;
    color:black;
}
	</style>
</head>
<body>
<div class="cabeçalho">
        <div id="logoo"><img src="imagens/logo_vemmonstro"></div>
		<div id="menu"><?php require_once 'funcoes/menu.php';?></div>
	</div>
    <div id='relatorio'>
	<form> 
    Selecione a aula desejada:
<select name="cds" onChange="showCD(this.value)" height='30px'>
<option value="Bike">Bike</option>
<option value="Muay Thai">Muay Thai</option>
<option value="Dança">Dança</option>
<option value="Judô">Judô</option> 
<option value="Jump">Jump</option> 
<option value="Krav-Maga">Krav-Maga</option> 
<option value="Jiu-jitsu">Jiu-jitsu</option> 
</select>
</form>
    </div>

<p>
<div id="txtHint">As informações sobre as aulas serão listadas aqui.</div>
</p>

	<div class="clear"></div>
    <?php include("verifica_usuario_logado.php");?>
</body>
</html>