<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer os dados e SE necessário filtrar
$tabela         =   "tbnoticias";
$campo_filtro   =   "id_noticia";
$ordenar_por    =   "id_noticia ASC";
$filtro_select  =   $_GET['id_noticia'];
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
    <title>Noticias Detalhe</title>
</head>
<body class="fundo2">
<?php include('menu_publico.php'); ?>
    <main class="container">
        <h2 class="breadcrumb alert-danger fundoatletas titulo">
            <a href="javascript:window.history.go(-1)" class="btn btntotal">
            <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <strong><?php echo $row['titulo_noticia']; ?></strong>
        </h2>

        <div class="row"> <!-- div row mantém os elementos na linha -->
    <!-- Abre thumbnail/card (card no bootstrap em inglês) -->
     <?php do{ ?> <!-- abre estrutura de repetição -->
    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2"> <!-- dimensionamento -->
        <div class="thumbnail">            
            <img 
                src="imagens/atletas/<?php echo $row['img_noticia']; ?>" 
                alt=""
                class="img-rounded"
                style="height: 40em;" 
            >                                    
            <div class="caption text-left">
                <h3 class="text-danger titulo">
                    <strong><?php echo $row['titulo_noticia']; ?></strong>
                </h3>
                <p class="text fontedestaque">
                    <strong><?php echo $row['descri_noticia']; ?></strong>
                </p>                                                                          
            </div>
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->
    <?php }while($row=$lista->fetch_assoc()); ?> <!-- fecha estrutura de repetição -->
    <!-- Fecha thumbnail/card -->

</div> <!-- fecha row -->

<!-- Link arquivos Bootstrap js 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> --> 
    </main>
</body>
</html>