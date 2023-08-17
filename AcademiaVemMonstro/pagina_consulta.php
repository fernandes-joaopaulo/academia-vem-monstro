<?php
header("Content-Type: text/html; charset=utf-8", true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia Vem Monstro</title>
    <link href="css/style.css" rel="stylesheet">
    <style>
        body{
            background-image : url('imagens/background_consulta.png');
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

        /* menu de inclusão */

        #menu_inclusao {
            width: 50px;
            float: center;
            padding-top: 0px;
            margin-left: 580px;
            margin-top: 170px;
        }

        ol {
            width: 400px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        ol li {
            margin: 10px 0;
        }

        ol li a,
        ol li a:visited {
            height: 1%;
            font: 20px Georgia, 'Times New Roman', Times, serif;
            background: #8503bb;
            color: #fff;
            text-decoration: none;
            padding: 2px 40px;
        }

        ol li a:hover {
            background: #9f9;
            color: #060;
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
      <div id="menu_inclusao">
	<ol>
		<li><a href="consulta_aparelhos_aerobicos.php">Aparelhos aeróbicos</a></li>
		<li><a href="consulta_aparelhos_musculacao.php">Aparelhos de musculação</a></li>
		<li><a href="consulta_cliente.php">Usuários</a></li>
		<li><a href="consulta_fichas.php">Fichas</a></li>
	</ol>
      </div>
</body>

</html>