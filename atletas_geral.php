<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "vw_tbatletas";
$ordenar_por    =   "descri_atleta ASC";
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
    <title>Modelo</title>
    <!-- não esquecer de comentar o JS e CSS para não dar conflito no index -->
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head> 
<body class="fundofixo fontetabela">
<!-- MENU 
<?php include('menu_publico.php'); ?> 
 CARROUSSEL 
<?php include('carroussel.php'); ?> 
-->
<main class="container">
    <h2 class="fundoatletas categoriageral text-center titulo"><strong>Conheça os atletas:</strong></h2>
    <div class="container">
    <br>
        <!-- abre thumbnail -->
        <?php do{ ?>
        <div class="col-sm-6 col-md-4"> <!-- dimensionamento -->
            <div class="thumbnail" style="width: 36rem;">
                <a 
                href="atletas_detalhe.php?id_atleta=<?php echo $row['id_atleta']; ?>" 
                >
                    <img 
                        src="imagens/atletas/<?php echo $row['img_atleta']; ?>" 
                        alt=""
                        class="img-responsive img-rounded"
                        style="height: 20em;"
                    >
                </a>
                <div class="caption text-center">
                    <h5 class="text" style="font-size: 25px;"><strong><?php echo $row['nome_atleta']; ?></strong></h5>
                    <p class="texticon">
                    <strong><?php echo $row['nome_categoria']; ?></strong>
                    </p>
                    <p class="text-left">
                        <?php echo mb_strimwidth ($row['descri_atleta'],0,45,"...");?>
                    </p>
                    <p>
                        <a 
                            href="atletas_detalhe.php?id_atleta=<?php echo $row['id_atleta']; ?>" 
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
    </div> <!-- fecha div container -->
</main>

<!-- não esquecer de comentar o JS e CSS para não dar conflito no index -->
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
</body>
</html>
<?php mysqli_free_result($lista); ?>