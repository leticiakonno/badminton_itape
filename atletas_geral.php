<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "vw_tbatletas";
$ordenar_por    =   "data_nas_atleta DESC";
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
    <title>Atletas Geral</title>
    <link rel="icon" type="image/png" href="/imagens/logobadminton.png">
    <!-- não esquecer de comentar o JS e CSS para não dar conflito no index -->
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head> 
<body class="fundofixo fontetabela">
<!-- MENU -->
<?php include('menu_publico.php'); ?> 

<main class="container ">
    <h2 class="fundocategoria categoriageral text-center titulo" style="position: relative; padding: 10px 50px;">
                    <a href="index.php" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%);">
                        <button class="btn btntotal bg-danger text-white" style="width: 40px; height: 40px; padding: 0;">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
        <strong>ATLETAS</strong></h2>
    <br><br>
    <div class="fundo-index" style="padding-top: 50px;border-radius: 15px;">
    <div class="row" style="padding-left: 50px; padding-right: 50px;">        <!-- abre thumbnail -->
        <?php do{ ?>
        <div class="col-xs-12  col-sm-6 col-md-4  " > <!-- dimensionamento -->
            <div class="thumbnail" style="width: 100%; padding-top: 20px;">
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
                        <?php echo mb_strimwidth ($row['descri_atleta'],0,38,"...");?>
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
            <br>
        </div> <!--fecha dimensionamento-->
        <?php }while($row=$lista->fetch_assoc()); ?>
    </div> <!-- fecha div container -->
</div>
<br>

<!-- não esquecer de comentar o JS e CSS para não dar conflito no index -->
<!-- Link arquivos Bootstrap js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
</main>
<footer> 
    <?php include('rodape.php'); ?>
</footer>
</body>
</html>
<?php mysqli_free_result($lista); 