<?php
include("Connections/conn_atletas.php");

// Consulta para trazer os dados e SE necessário filtrar
$tabela         =   "vw_tbatletas";
$campo_filtro   =   "destaque_atleta";
$ordenar_por    =   "descri_categoria ASC";
$filtro_select  =   "Não";
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
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundofixo">
    <main>
    <h2 class="fontetabela text-center"><strong>Conheça os atletas das seguintes categorias:</strong></h2>
    <div class="container">
    <br>

                <!-- abre thumbnail -->
                <?php do{ ?>
                <div class="col-sm-6 col-md-4"> <!-- dimensionamento -->
                    <div class="thumbnail" style="width: 37rem;">
                        <img src="imagens/categorias/aberto.png" class="card-img-top" alt="...">

                        <div class="caption text-center">
                            <h5 class="text-info"><strong><?php echo $row['nome_categoria']; ?></strong></h5>
                            <p class="text-center"><?php echo $row['descri_categoria']; ?></p>
                            <p>
                                <a 
                                    href="..." 
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

    </div>
</main>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>    
</body>
</html>
<?php mysqli_free_result($lista); ?>
   <!-- <a href="atletas_detalhe.php?id_produto=<?php echo $row['id_produto']; ?>" -->