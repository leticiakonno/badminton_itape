<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "vw_tbatletas";
$campo_filtro   =   "id_categoria_atleta";
$ordenar_por    =   "descri_categoria ASC";
$filtro_select  =   $_GET['id_categoria'];
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
    <title>Atletas</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundo2">
<?php include('menu_publico.php'); ?>
<main class="container">
    <h2 class=" categoriageral nomeatleta titulo">
    <a href="javascript:window.history.go(-1)" class="btn btntotal">
    <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <strong><?php echo $row['nome_categoria']; ?></strong>
    </h2>

<div class="row"> <!-- div row mantém os elementos na linha -->
<br>
    <!-- Abre thumbnail/card (card no bootstrap em inglês) -->
     <?php do{ ?> <!-- abre estrutura de repetição -->
    <div class="col-sm-10 col-sm-offset-1 col-md-4 coll-md-offset-4"> <!-- dimensionamento -->
        <div class="thumbnail" style="width: 40rem;">    
        <h2 class="fundoatleta titulo nomeatleta table td, table th">
    <strong><?php echo $row['nome_atleta']; ?></strong>
</h2>        
            <img 
                src="imagens/atletas/<?php echo $row['img_atleta']; ?>" 
                alt=""
                class="img-responsive img-rounded"
            >                                    
            <div class="caption text-right">
              
                                                                                           
            </div>
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->
    <?php }while($row=$lista->fetch_assoc()); ?> <!-- fecha estrutura de repetição -->
    <!-- Fecha thumbnail/card -->

</div> <!-- fecha row -->

<!-- Link arquivos Bootstrap js --> 
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
</body>
</html>
<?php mysqli_free_result($lista); ?>