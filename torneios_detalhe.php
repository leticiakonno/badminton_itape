<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Verificar se o parâmetro foi passado
if(!isset($_GET['id_torneio']) || empty($_GET['id_torneio'])) {
    die("ID do torneio não especificado!");
}

$tabela         =   "tbtorneios";
$campo_filtro   =   "id_torneio";
$ordenar_por    =   "tipo_torneio ASC";
$filtro_select  =   $_GET['id_torneio'];
$consulta       =   "
                    SELECT   *
                    FROM     ".$tabela."
                    WHERE    ".$campo_filtro."='".$filtro_select."'
                    ORDER BY ".$ordenar_por.";
                    ";
$lista      =   $conn_atletas->query($consulta);
$row        =   $lista->fetch_assoc();
$totalRows  =   ($lista)->num_rows;

// Verificar se encontrou resultados
if($totalRows == 0) {
    die("Torneio não encontrado!");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneios Detalhes</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundo2 fontetabela">
<?php include('menu_publico.php'); ?>


<main class="container">

<h2 class="breadcrumb alert-danger fundoatletas titulo">
    <a href="javascript:window.history.go(-1)" class="btn btntotal">
    <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <!-- CORREÇÃO: A tabela tbtorneios não tem 'nome_tecnico', use 'tipo_torneio' -->
    <strong><?php echo $row['tipo_torneio']; ?></strong>
</h2>
<div class="row"> <!-- div row mantém os elementos na linha -->

    <!-- Abre thumbnail/card (card no bootstrap em inglês) -->
     <?php do{ ?> <!-- abre estrutura de repetição -->
    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2"> <!-- dimensionamento -->
        <div class="thumbnail">            
            <img 
                src="imagens/torneios/<?php echo $row['img_torneio']; ?>" 
                alt=""
                class="img-rounded"
                style="height: 40em;" 
            >                                    
            <div class="caption text-left">
                <h3 class="text-danger titulo">
                    <strong><?php echo $row['tipo_torneio']; ?></strong>
                </h3>
                
                <p class="text fontedestaque">
                    <strong><?php echo $row['descri_torneio']; ?></strong>
                </p>
                                                                                          
            </div>
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->
    <?php }while($row=$lista->fetch_assoc()); ?> <!-- fecha estrutura de repetição -->
    <!-- Fecha thumbnail/card -->

</div> <!-- fecha row -->

</main>
<footer>
    <?php include('rodape.php'); ?>
</footer>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php mysqli_free_result($lista); ?>