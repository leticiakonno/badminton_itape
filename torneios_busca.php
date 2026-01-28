<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Verificar se o parâmetro de busca foi enviado
if(!isset($_GET['buscar']) || empty(trim($_GET['buscar']))) {
    header("Location: torneios_geral.php");
    exit();
}

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "tbtorneios";
$campo_filtro   =   "tipo_torneio"; 
$ordenar_por    =   "tipo_torneio ASC";
$filtro_select  =   trim($_GET['buscar']); 

// Prevenir SQL Injection
$filtro_select_safe = $conn_atletas->real_escape_string($filtro_select);

// Busca em múltiplos campos (tipo_torneio E descri_torneio)
$consulta       =   "
                    SELECT   *
                    FROM     ".$tabela."
                    WHERE    tipo_torneio LIKE '%".$filtro_select_safe."%'
                    OR       descri_torneio LIKE '%".$filtro_select_safe."%'
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
    <title>Busca Torneio</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundofixo">
<?php include('menu_publico.php'); ?>

<main class="container">

<!-- Mostrar se os registros retornarem VAZIOS -->
<?php if($totalRows == 0){ ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="breadcrumb alert-danger fundoatletas titulo text-center">
                <a href="javascript:window.history.go(-1)" class="btn btntotal">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                Você pesquisou por:
                "<i><strong><?php echo htmlspecialchars($_GET['buscar']); ?></strong></i>"
                <br><br>
                <span class="text-center">Zero resultados encontrados!</span>
                <br>
                <small>Tente buscar por: Regional, Estadual, Nacional ou Internacional</small>
            </h2>
            <div class="text-center" style="margin-top: 30px;">
                <a href="torneios_geral.php" class="btn btn-primary btn-lg">
                    <span class="glyphicon glyphicon-list"></span> Ver Todos os Torneios
                </a>
            </div>
        </div>
    </div>
<?php }; ?>

<!-- Mostrar se os registros NÃO retornarem VAZIOS -->
<?php if($totalRows > 0){ ?>
<h2 class="breadcrumb alert-success fundoatletas titulo">
    <a href="javascript:window.history.go(-1)" class="btn btntotal">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
        Você pesquisou por:
        "<i><strong><?php echo htmlspecialchars($_GET['buscar']); ?></strong></i>"
        <span class="badge"><?php echo $totalRows; ?> resultado(s)</span>
</h2>
<div class="row"> <!-- manter os elementos na linha -->

    <!-- Abre thumbnail/card (card no bootstrap em inglês) -->
     <?php do{ ?> <!-- abre estrutura de repetição -->
    <div class="col-sm-6 col-md-4 col-lg-3"> <!-- dimensionamento ajustado -->
        <div class="thumbnail">
            <a 
                href="torneios_detalhe.php?id_torneio=<?php echo $row['id_torneio']; ?>"
            >
            <img 
                src="imagens/torneios/<?php echo $row['img_torneio']; ?>" 
                alt="<?php echo $row['tipo_torneio']; ?>"
                class="img-responsive img-rounded"
                style="height: 200px; width: 100%; object-fit: cover;"               
            >
            </a>                                       

            <div class="caption text-center">
                <h4 class="text-primary">
                    <strong><?php echo $row['tipo_torneio']; ?></strong>
                </h4>
                
                <p class="text-left" style="min-height: 80px;">
                    <?php echo mb_strimwidth($row['descri_torneio'], 0, 100, "..."); ?>
                </p>
                <p>
                    <a 
                        href="torneios_detalhe.php?id_torneio=<?php echo $row['id_torneio']; ?>"
                        class="btn btntotal btn-block"
                        role="button"
                    >
                        <span class="glyphicon glyphicon-eye-open"></span> Saiba mais
                    </a>
                </p>
            </div>
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->
    <?php }while($row=$lista->fetch_assoc()); ?> <!-- fecha estrutura de repetição -->
    <!-- Fecha thumbnail/card -->
</div> <!-- fecha row -->
<?php }; ?>

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