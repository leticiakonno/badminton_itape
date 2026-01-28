<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "tbparceiros";
$ordenar_por    =   "id_parceiro ASC";
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
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundofixo fontetabela">
<?php include('menu_publico.php'); ?>
    <main class="container">
    <h2 class="fundocategoria categoriageral text-center titulo"><strong>Saiba mais sobre os nossos parceiros:</strong></h2>
    <br><br>

                <!-- abre thumbnail -->
                <?php do{ ?>
                <div class="col-sm-6 col-md-4"> <!-- dimensionamento -->
                    <div class="thumbnail" style="width: 36rem;">
                        <a 
                        href="parceiros_detalhe.php?id_parceiro=<?php echo $row['id_parceiro']; ?>" 
                    >
                        <img 
                            src="imagens/apoiadores/<?php echo $row['img_parceiro']; ?>" 
                            alt=""
                            class="img-responsive img-rounded"
                            style="height: 20em;"
                        >
                    </a>
                    <div class="caption text-center">
                    <h5 class="text-dark" style="font-size: 25px;"><strong><?php echo mb_strimwidth ($row['nome_parceiro'],0,27,"...");?></strong></h5>
                    <p class="text-center">
                        <?php echo mb_strimwidth ($row['descri_parceiro'],0,45,"...");?>
                    </p>
                    <p>
                        <a 
                            href="parceiros_detalhe.php?id_parceiro=<?php echo $row['id_parceiro']; ?>" 
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


</main>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>    
</body>
</html>
<?php mysqli_free_result($lista); ?>
  