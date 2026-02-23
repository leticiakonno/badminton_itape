<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer os dados e SE necessário filtrar
$tabela         =   "tbparceiros";
$campo_filtro   =   "id_parceiro";
$ordenar_por    =   "nome_parceiro ASC";
$filtro_select  =   $_GET['id_parceiro'];
$consulta       =   "
                    SELECT  *
                    FROM    ".$tabela."
                    WHERE   ".$campo_filtro."='".$filtro_select."'
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
    <!-- Link CSS do Bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<?php include('menu_publico.php'); ?>

<body class="fundo3 fontetabela">
    <main class="container">
       <h2 class="breadcrumb alert-danger fundoatletas titulo">
            <a href="javascript:window.history.go(-1)" class="btn btntotal">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <strong><?php echo $row['nome_parceiro']; ?></strong>
        </h2>
<div class="row fundo-index"> <!-- manter os elementos na linha (poliça) -->
    <!-- Abre thumbnail/card -->
    <?php do{ ?> <!-- Abre a estrutura de repetição -->
    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2"> <!-- dimensionamento -->
        <br><br>
        <div class="thumbnail">
            <img 
                src="imagens/apoiadores/<?php echo $row['img_parceiro']; ?>" 
                alt=""
                class=" img-rounded"
                width="550px"
            >
            <div class="caption text-center">
                <h3 class="nomeatleta">
                    <strong><?php echo $row['nome_parceiro']; ?></strong>
                </h3>
                <p class="parceirosdetalhe">
                    <strong><?php echo $row['descri_parceiro']; ?></strong>
                </p>         
                    <!-- <a 
                        href="produto_detalhe.php?id_produto=<?php echo $row['id_produto']; ?>" 
                        class="btn btn-danger" 
                        role="button"
                    >
                        <span class="hidden-xs">Saiba mais...</span>
                        <span class="visible-xs glyphicon glyphicon-eye-open"></span>
                    </a> -->
                </p>
            </div> <!-- fecha caption -->
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->
    <?php }while($row=$lista->fetch_assoc()); ?> 
    <!-- Fecha a estrutura de repetição -->
    <!-- Fecha thumbnail/card -->

</div> <!-- fecha row -->
<br>
</main>
<?php include('rodape.php'); ?>
<!-- Link arquivos Bootstrap js --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>   
</body>
</html>
<?php mysqli_free_result($lista); ?>