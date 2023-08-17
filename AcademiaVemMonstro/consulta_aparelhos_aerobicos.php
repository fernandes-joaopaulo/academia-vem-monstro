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
</head>
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
        .tabela_consulta{
            margin-left:100px;
            margin-top: 100px;
            font: 20px Georgia, 'Times New Roman', Times, serif;
            text-align: center;
            color: white;
        }
        #menu{
            margin-top:10px;
        }
    </style>
<body>
<div class="cabeçalho">
        <div id="logoo"><img src="imagens/logo_vemmonstro"></div>
		<div id="menu"><?php require_once 'funcoes/menu.php';?></div>
	</div>
                        <div class="tabela_consulta">
<?php
try
{
    require_once 'funcoes/conexao.php';
    $result = $conn->query("SELECT * FROM tb_aparelhos_aerobico");
    $count = $result->rowCount();
    if ($count > 0) {
        // percorre os resultados via fetch(), caso tenha pelo menos um registro
        echo "<table border='1'>";
        echo "<tr>\n";
        echo "<td>\n";
        echo "<b>Código</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Nome</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Marca</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Preço</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Função</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Velocidade Máxima</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Velocidade Mínima</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Material</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Peso</b>\n";
        echo "</td>\n";
        echo "<td>\n";
        echo "<b>Comentários</b>\n";
        echo "</td>\n";
        
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            // exibe os dados na tela, acessando o objeto retornado
            echo "<tr>\n";
            echo "<td class='td_l'>\n";
            echo $row->codigo . "&nbsp;\n &nbsp;\n &nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->nome_aparelho . "&nbsp;\n &nbsp;\n &nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->marca . "&nbsp;\n &nbsp;\n &nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->preco . "&nbsp;\n &nbsp;\n &nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->funcao . "&nbsp;\n &nbsp;\n &nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->velocidade_max . "&nbsp;\n &nbsp;\n &nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->velocidade_min . "&nbsp;\n &nbsp;\n &nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->material . "&nbsp;\n &nbsp;\n &nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->peso . "&nbsp;\n &nbsp;\n &nbsp;\n";
            echo "</td>\n";
            echo "<td class='td_l'>\n";
            echo $row->comentarios;
            echo "</td>\n";
            echo "<td>\n";
// cria o link para o programa alteracao_receitas.php passando o código da receita a ser alterada/excluída            
            echo "<a href='alteracao_exclusao_aparelhos_aerobicos.php?codigo=" . $row->codigo . "'>";
            echo "<img src='imagens/b_edit.png' border='0'><img src='imagens/b_drop.png' border='0'></a>&nbsp;\n";
            echo "</td>\n";
            echo "</tr>\n";
            
        }
    } else {
        $destino = "function () {window.location='index.php';}";
        echo "<script>sendToastr('Nenhum aparelho foi encontrado! <br /> Clique para continuar!','error',$destino)</script>";
    }
    echo "</table>";
    // fecha a conexão
    $conn = null;
} catch (PDOException $e) {
    $destino = "function () {window.location='index.php';}";
    echo "<script>sendToastr($e->getMessage(),'error',$destino)</script>";
    die(); // interrompe o processamento do lado do servidor
}
?>
</div>
<?php require_once 'funcoes/menu.php';?>
<div class="clear"></div>
</body>
</html>