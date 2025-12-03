<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "vw_tbatletas";
$campo_filtro   =   "id_categoria_atleta";
$ordenar_por    =   "descri_atleta ASC";
$filtro_select  =   $_GET['id_categoria'];                       // "GET" busca o parâmetro na URL
$consulta       =   "
                    SELECT   *
                    FROM     ".$tabela."
                    WHERE    ".$campo_filtro."='".$filtro_select."'
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
    <title>Modelo</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundofixo">
<?php include('menu_publico.php'); ?>
<?php include('carroussel.php'); ?>

<main class="container">
    
<!-- Mostrar se os registros retornarem vazios -->
 <?php if($totalRows==0){ ?>
<h2 class="breadcrumb fundoatletas titulo text-center">
<a href="javascritp:window.history.go(-1)" class="btn btntotal">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    Ops… por aqui ainda não tem ninguém!
</h2>
<?php }; ?>

<!-- Mostrar se os NÃO registros retornarem VAZIOS -->
<?php if($totalRows>0){ ?>
<h2 class="breadcrumb alert-danger">
    <a href="javascritp:window.history.go(-1)" class="btn btn-danger">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <strong><?php echo $row['nome_atleta']; ?></strong>
</h2>

<div class="row"> <!-- div row mantém os elementos na linha -->

    <!-- Abre thumbnail/card (card no bootstrap em inglês) -->
     <?php do{ ?> <!-- abre estrutura de repetição -->
    <div class="col-sm-6 col-md-4"> <!-- dimensionamento -->
        <div class="thumbnail">
            <a 
                href="atletas_detalhe.php?id_produto=<?php echo $row['id_atleta']; ?>"
            >
            <img 
                src="imagens/atletas/<?php echo $row['img_atleta']; ?>" 
                alt=""
                class="img-responsive img-rounded"
                style="height: 20em;"               
            >                                                                                       <!-- height "em" deixa o tamanho da imagem relativo ao tamanho da página -->
            </a>                                       

            <div class="caption text-right">
                <h3 class="text-danger">
                    <strong><?php echo $row['nome_atleta']; ?></strong>
                </h3>
                <p class="text-left">
                <?php echo mb_strimwidth ($row['descri_atleta'],0,45,"...");?>
                </p>                                                                            <!-- mb_strimwidth diminiu o tamanho de linhas que são exibidos dentro do card de descrição -->
                <p>
                    <a 
                        href="atletas_detalhe.php?id_atleta=<?php echo $row['id_atleta']; ?>"
                        class="btn btn-danger"
                        role="button"
                    >
                        <span class="hidden-xs">Saiba mais...</span>
                        <span class="visible-xs glyphicon glyphicon-eye-open"></span>
                    </a>
                </p>
            </div>
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->
    <?php }while($row=$lista->fetch_assoc()); ?> <!-- fecha estrutura de repetição -->
    <!-- Fecha thumbnail/card -->
</div> <!-- fecha row -->
<?php }; ?>

<!-- Link arquivos Bootstrap js 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>-->
</main>
<footer>
    <?php include('rodape.php'); ?>
</footer>
</body>
</html>
<?php mysqli_free_result($lista); ?>