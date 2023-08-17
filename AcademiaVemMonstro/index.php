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
    <link href="style.css" rel="stylesheet">
    <link href="css/toastr.css" rel="stylesheet"/>
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap4/js/bootstrap.min.js"></script>
    <script src="funcoes/toastr.min.js"></script>
    <script src="funcoes/funcao_toastr.js"></script>
    <style>
        body{
            background-image : url('imagens/background_home.png');
            position:relative;
            min-height: 100vh;
        }              
        .cabeçalho {
            background-color: white;
            height: 130px;
            width: 100%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, .8);
            position:fixed;
        }

        #logoo {
           text-align: center;
        }
        #menu{
            margin-top:10px;
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
        #descri{
            color: whitesmoke;
            font-style:Helvetica, sans-serif;
            font-size:23px;
            position: absolute;
            bottom: 15px;
            right:0;
            width:500px;
            border: purple solid 1px;
        }
        #nmuser{
            color: whitesmoke;
            font-style:Helvetica, sans-serif;
            font-size:23px;
            text-align: left;
        }
        #tempo{
            text-align: right;
            color: whitesmoke;
            font-style:Helvetica, sans-serif;
            font-size:20px;
            margin-right: 20px;
        }
        #descr{
            position: fixed;
        }
    </style>

</head>

<body>
<div id="descri">Academia localizada na Av. Barão do Rio Branco, 1969.
        <br>Este site tem como objetivo auxiliar os usuários em suas diversas necessidades, como consultas, inclusões, alterações de informações, entre outros.</div>
	</div>
<div class="cabeçalho">
        <div id="logoo"><img src="imagens/logo_vemmonstro"></div>
		<div id="menu"><?php require_once 'funcoes/menu.php';?></div>
        <br><br>
        <div id="tempo"><?php   require_once("verifica_usuario_logado.php");

        if ($tempo_login != null){
            echo "Último acesso: $tempo_login";
        }
        ?></div>
        <div id="nmuser"><?php 

        if($nome == null){
            echo "Seja bem vindo!";
        }else{
            echo"Seja bem vindo $nome!";
        }
    ?></div>
</body>

</html>