<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer os dados e SE necessário filtrar
$tabela         =   "tbtecnicos";
$campo_filtro   =   "descri_tecnico";
$ordenar_por    =   "nome_tecnico ASC";
$filtro_select  =   $_GET['buscar'];
$consulta       =   "
                    SELECT  *
                    FROM    ".$tabela."
                    WHERE   ".$campo_filtro." LIKE ('%".$filtro_select."%')
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
    <title>Técnicos</title>
    <!-- Link CSS do Bootstrap 
    <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <!-- Link para CSS Específico 
    <link rel="stylesheet" href="css/meu_estilo.css">-->
</head>
<body class="container">
<?php include('menu_publico.php'); ?>
<!-- Mostrar se os registros retornarem VAZIOS -->
<?php if($totalRows == 0){ ?>
    <h2 class="categoriabusca">
        <a href="javascript:window.history.go(-1)" class="btn btntotal">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        Você pesquisou:
        "<i><strong><?php echo $_GET['buscar']; ?></strong></i>"
        <br>
        Ninguém por aqui... AINDA!!
    </h2>
<?php }; ?>

<!-- Mostrar se os registros NÃO retornarem VAZIOS -->
<?php if($totalRows > 0){ ?>
<h2 class="breadcrumb alert-danger">
    <a href="javascript:window.history.go(-1)" class="btn btntotal">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    Você pesquisou:
    "<i><strong><?php echo $_GET['buscar']; ?></strong></i>"
</h2>
<div class="row"> <!-- manter os elementos na linha (poliça) -->
    
    <!-- Abre thumbnail/card -->
     <!-- abre thumbnail -->
     <?php do{ ?>
                <div class="col-sm-6 col-md-4"> <!-- dimensionamento -->
                    <div class="thumbnail" style="width: 36rem;">
                        <a 
                        href="tecnicos_detalhe.php?id_tecnico=<?php echo $row['id_tecnico']; ?>" 
                    >
                        <img 
                            src="imagens/tecnicos/<?php echo $row['img_tecnico']; ?>" 
                            alt=""
                            class="img-responsive img-rounded"
                            style="height: 20em;"
                        >
                    </a>
                    <div class="caption text-center">
                    <h5 class="text-dark" style="font-size: 25px;"><strong><?php echo $row['nome_tecnico']; ?></strong></h5>
                    <p class="text-center"><?php echo $row['descri_tecnico']; ?></p>
                    <p>
                        <a 
                            href="parceiros_detalhe.php?id_parceiro=<?php echo $row['id_tecnico']; ?>" 
                            class="btn btntotal" 
                            role="button"
                        >
                            <span class="hidden-xs">Clique para saber mais...</span>
                            <span class="visible-xs glyphicon glyphicon-eye-open"></span>
                        </a>
                    </p>
                </div> <!--fecha caption-->
                    </div> <!--fecha thumbnail-->
                </div> <!--fecha dimensionamento-->
                <?php }while($row=$lista->fetch_assoc()); ?>
    <!-- Fecha a estrutura de repetição -->
    <!-- Fecha thumbnail/card -->
</div> <!-- fecha row -->
<?php }; ?>

<!-- Link arquivos Bootstrap js 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>    -->
</body>
</html>
<?php mysqli_free_result($lista); ?>