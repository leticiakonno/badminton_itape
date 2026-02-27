<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer os dados e SE necessário filtrar
$tabela         =   "tbnoticias";
$campo_filtro   =   "id_noticia";
$ordenar_por    =   "descri_noticia ASC";
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
    <link rel="icon" type="image/png" href="/imagens/logobadminton.png">
        <!-- Link CSS do Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css"> 
        <!-- Link para CSS Específico -->
        <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundo3  fontetabela">
<?php include('menu_publico.php'); ?>
    <main class="container">
        <h2 class="breadcrumb alert-danger fundoatletas text-center titulo">
            <a href="javascript:window.history.go(-1)" class="btn btntotal">
            <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <strong><?php echo $row['titulo_noticia']; ?></strong>
        </h2>
    <div class="row"> <!-- manter os elementos na linha (poliça) -->
    <br>
    <!-- Abre thumbnail/card -->
    <?php do{ ?> <!-- Abre a estrutura de repetição -->
    <div class="col-sm-12"> <!-- dimensionamento -->
        <div class="thumbnail">
            <br>
       
            <?php if(!empty($row['video_noticia'])) { ?>
                <video class="video-noticia" controls>
                    <source src="imagens/noticias/daichi.mp4" type="video/mp4">
                        Seu navegador não suporta vídeo.
                </video>
            <?php } ?>

            <div class="caption text-center">
                <p class="descrinoticia line">
                    <?php echo $row['descri_noticia']; ?>
            </div> <!-- fecha caption -->
            
            <img 
                src="imagens/noticias/<?php echo $row['img_noticia']; ?>" 
                alt=""
                class="img-rounded img-responsive"
                width="600px"
                height="auto"
            >
            <br>
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->
    <?php }while($row=$lista->fetch_assoc()); ?> 
    <!-- Fecha a estrutura de repetição -->
    <!-- Fecha thumbnail/card -->

</div> <!-- fecha row -->

<!-- Link arquivos Bootstrap js --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
</main>
<footer>
    <?php include('rodape.php'); ?>
</footer>
</body>
</html>