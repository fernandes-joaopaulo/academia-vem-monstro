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
		.tabela_relatorio{
			margin-left: 650px;
			margin-top: 200px;
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
        .tabela_consulta2{
            margin-left:10px;
            margin-top: 100px;
            font: 20px Georgia, 'Times New Roman', Times, serif;
            text-align: center;
            color: white;
        }
        #menu{
            margin-top:10px;
        }
        #relatorio{

            text-align: center;

        }

    </style>
</head>
<body>
<div class="cabeçalho">
        <div id="logoo"><img src="imagens/logo_vemmonstro"></div>
		<div id="menu"><?php require_once 'funcoes/menu.php';?></div>
	</div>
    <div class='tabela_consulta2'>
	  <h2>CADASTRO DE USUÁRIOS</h2>
	  <h3>RELATÓRIO</h3>
<?php

//
// Define as variáveis locais
//
$ComandoSQL = "";
$filtro = '';
$maximo = 0;
$pagina = 0;
$inicio = 0;
try
{
    // abre conexão com o banco
    require_once 'funcoes/conexao.php';
    //
    if (isset($_REQUEST['filtro'])) {
        $filtro = $_REQUEST['filtro'];
    }
    // Maximo de registros por pagina
    $maximo = 5; // quando tiver mais dados na tabela, altere para um valor maior
    // Declaração da pagina inicial
    $pagina = intval(($_GET["pagina"]));
    if ($pagina == "") {
        $pagina = "1";
    }
    // Calculando o registro inicial
    $inicio = $pagina - 1;
    $inicio = $maximo * $inicio;
    // Conta os resultados no total da query
    //
    $ComandoSQL = "select * from tb_cliente where nome like '$filtro%'";
    $result = $conn->query($ComandoSQL);
    $rows = $result->fetchAll();
    $total = count($rows);

    $ComandoSQL = "select * from tb_cliente where nome like '$filtro%'
		LIMIT $inicio, $maximo";
    $result = $conn->query($ComandoSQL);

    echo "<table border='1' cellpadding='0' cellspacing='0' width='80%'
		bordercolor='#8503bb' align='center'>";
    if ($total == 0 || $filtro == null) {                   //TRATAMENTO DE ERRO DO RELATÓRIO
        $destino = "function () {window.location='relatorio_filtro.php';}";
        echo "<script>sendToastr('Nenhum aluno foi encontrado! <br /> Clique para continuar!','error',$destino)</script>";
    } else {
        // percorre os resultados via fetch()
        echo "<table align='center'>";
        echo "<br><br>";
        echo "<tr>\n";
        echo "<td>\n";
        echo "<b>Nome</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b></b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Telefone</b>\n";
        echo "</td>\n";
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            // exibe os dados na tela, acessando o objeto retornado
            echo "<tr>\n";
echo "<td class='td_l'>\n";
echo $row->nome . "&nbsp;\n &nbsp;\n &nbsp;\n";
echo "</td>\n";
echo "<td class='td_l'>\n";
echo "&nbsp;\n &nbsp;\n &nbsp;\n";
echo "</td>\n";
echo "<td class='td_l'>\n";
echo $row->telefone . "&nbsp;\n &nbsp;\n &nbsp;\n";
echo "</td>\n";
            echo "<td>\n";
        }
    }
    echo "</table>";

} catch (PDOException $e) {
    print "Erro!: " . $e->getMessage() . "<br/>";
    die();
}
// controla quantas páginas o relatório possui e cria os links para as páginas seguintes e anteriores
$menos = $pagina - 1;
$mais = $pagina + 1;
$pgs = ceil($total / $maximo);
if ($pgs > 1) {
    echo "<br clear='all'/><br /><br />";
    // Mostragem de pagina
    if ($menos > 0) {
        echo "<a href='relatorio_paginacao_filtro.php?pagina=$menos&filtro=$filtro'>
		<button type='button' class='btn btn-outline-success'>Anterior</button></a> | ";
    }
    // Listando as paginas
    for ($i = 1; $i <= $pgs; $i++) {
        if ($i != $pagina) {
            echo "<a href='relatorio_paginacao_filtro.php?pagina=$i&filtro=$filtro'>
				<button type='button' class='btn btn-outline-success'>$i</button></a> | ";
        } else {
            echo "<strong><font color='#000'>$i</font></strong> | ";
        }
    }
    if ($mais <= $pgs) {
        echo "<a href='relatorio_paginacao_filtro.php?pagina=$mais&filtro=$filtro'>
			<button type='button' class='btn btn-outline-success'>Próxima</button></a>";
    }
}
echo "<br><br><br><br><br>
<a href='relatorio_filtro.php' style='color: white'>Voltar</a>";
$conn = null;
?>
</div>
<div class="clear"></div>
</body>
</html>