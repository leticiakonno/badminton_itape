<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "vw_tbatletas";
$ordenar_por    =   "id_categoria_atleta ASC, nome_atleta ASC";
$consulta       =   "
                    SELECT   *
                    FROM     ".$tabela."
                    ORDER BY ".$ordenar_por.";
                    ";
$lista      =   $conn_atletas->query($consulta);
$row        =   $lista->fetch_assoc();
$totalRows  =   ($lista)->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico-->
    <link rel="stylesheet" href="css/meu_estilo.css"> 
</head>
<body class="fundofixo">
<?php include('menu_publico.php'); ?>
<?php include('carroussel.php'); ?>

<main class="container">

    <h2 class="breadcrumb fundoatletas titulo text-center">
        <a href="javascript:window.history.go(-1)" class="btn btntotal">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <strong>Atletas por Categoria</strong>
    </h2>
<?php 
// Variável para controlar o grupo atual
$tipo_atual =   "";

if($totalRows > 0){;// Verifica se há produtos para exibir
    do{
    // Se o id_tipo produto atual for diferente do anterior, cria um novo grupo
        if($tipo_atual != $row['id_categoria_atleta']){
            // Se não for o primeiro grupo, fecha o anterior
            if($tipo_atual!= ""){
                echo '</div>';
            }
            // Atualiza $tipo_atual e exibe o novo cabeçalho do grupo
            $tipo_atual = $row['id_categoria_atleta'];
            echo '<h2 class="breadcrumb titulo">'.$row['nome_categoria'].'</h2>';
            // Abre uma nova div row para os produtos deste grupo
            echo '<div class="row"><!-- manter os elementos na linha (poliça) -->'; 
        }
?>
    <!-- Abre thumbnail/card (card no bootstrap em inglês) -->
    <div class="col-sm-6 col-md-4"> <!-- dimensionamento -->
        <div class="thumbnail">
            <a 
                href="atletas_detalhe.php?id_atleta=<?php echo $row['id_atleta']; ?>"
            >
            <img 
                src="imagens/atletas/<?php echo $row['img_atleta']; ?>" 
                alt=""
                class="img-responsive img-rounded"
                style="height: 20em;"               
            >                                                                                       <!-- height "em" deixa o tamanho da imagem relativo ao tamanho da página -->
            </a>                                       

            <div class="caption text-left">
                <h3 class="text">
                    <strong><?php echo $row['nome_atleta']; ?></strong>
                </h3>
                <p class="text-left">
                    <?php echo mb_strimwidth ($row['descri_atleta'],0,45,"...");?>
                </p>
                <p class="text-left">
                    <?php
                        if($row['destaque_atleta']=='Sim'){
                            echo('<span class="glyphicon glyphicon-star texticon"></span>');
                        }else if($row['destaque_atleta']=='Não'){
                            echo('<span class="glyphicon glyphicon-star-empty texticon"></span>');
                        };
                    ?>
                </p>                                                                            <!-- mb_strimwidth diminiu o tamanho de linhas que são exibidos dentro do card de descrição -->
                <p>
                    <a 
                        href="atletas_detalhe.php?id_atleta=<?php echo $row['id_atleta']; ?>"
                        class="btn btntotal"
                        role="button"
                    >
                        <span class="hidden-xs">Saiba mais...</span>
                        <span class="visible-xs glyphicon glyphicon-eye-open"></span>
                    </a>
                </p>
            </div>
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->
    <?php }while($row=$lista->fetch_assoc()); 

    // É importante fechar a última div row que ficou aberta após o loop
        echo '</div> <!-- fecha row -->';
        }else{
            //Mensagem caso não haja produtos
            echo '<div class="alert-warning" role="alert">Nenhum produto encontrado.</div>';
        }
?>

<!-- Link arquivos Bootstrap js 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> -->
</main>
<footer>
    <?php include('rodape.php'); ?>
</footer>
</body>
</html>
<?php mysqli_free_result($lista); ?>