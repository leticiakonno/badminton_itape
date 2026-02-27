<?php
include("Connections/conn_atletas.php");

/* Verifica se veio a categoria */
if (!isset($_GET['categoria']) || empty(trim($_GET['categoria']))) {
    header("Location: torneios_geral.php");
    exit();
}

/* Recebe e protege */
$categoria = trim($_GET['categoria']);
$categoria_safe = $conn_atletas->real_escape_string($categoria);

/* Consulta */
$tabela = "tb_torneios_noticias";  // ← TABELA DE NOTÍCIAS DE TORNEIOS
$ordenar_por = "data_publicacao DESC";

$consulta = "
    SELECT *
    FROM $tabela
    WHERE categoria = '$categoria_safe'
    AND status = 'ativo'
    ORDER BY $ordenar_por
";

$lista = $conn_atletas->query($consulta);
$row = $lista->fetch_assoc();
$totalRows = $lista->num_rows;
?>
 <head>
    <link rel="icon" type="image/png" href="imagens/logobadminton.png">
 </head>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias do Torneio</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundo3 fontetabela">

<?php include('menu_publico.php'); ?>

<main class="container">

<?php if ($totalRows == 0) { ?>
    <h2 class="breadcrumb alert-warning fundoatletas titulo text-center">
        Nenhuma notícia encontrada para esta categoria
    </h2>
<?php } ?>

<?php if ($totalRows > 0) { ?>
<h2 class="breadcrumb alert-success fundoatletas titulo">
    <a href="index.php" class="btn btntotal">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    Notícias da categoria:
    <strong><?php echo htmlspecialchars(ucfirst($categoria)); ?></strong>
    <span class="badge"><?php echo $totalRows; ?></span>
</h2>

<div class="row">

<?php do { ?>
    <div class="col-xs-12 col-sm-6 col-md-4 "> <!-- dimensionamento -->
        <div class="thumbnail">

            <?php 
            if(!empty($row['imagem'])) { 
                $imagem_path = $row['imagem'];
                // Verificar se o caminho já contém o diretório
                if (strpos($imagem_path, 'imagens/noticias/') === false && strpos($imagem_path, '../') === false) {
                    $imagem_path = "imagens/noticias/" . $imagem_path;
                }
            ?>
            <img
                src="<?php echo $imagem_path; ?>"
                alt="<?php echo htmlspecialchars($row['titulo']); ?>"
                class="img-responsive img-rounded"
                style="height:200px; width:100%; object-fit:cover;"
            >
            <?php } else { ?>
            <div class="text-center" style="height:200px; background-color:#f8f9fa; display:flex; align-items:center; justify-content:center;">
                <span class="text-muted">Sem imagem</span>
            </div>
            <?php } ?>

            <div class="caption text-center">
                <h4 class="text-dark">
                    <strong><?php echo htmlspecialchars(substr($row['titulo'], 0, 60)); ?><?php echo strlen($row['titulo']) > 60 ? '...' : ''; ?></strong>
                </h4>

                <p class="text-left" style="min-height:80px;">
                    <?php echo htmlspecialchars(mb_strimwidth($row['resumo'], 0, 100, "...")); ?>
                </p>

                <p>
                    <a
                        href="torneios_noticias_detalhe.php?id=<?php echo $row['id_noticia_torneio']; ?>"
                        class="btn btntotal btn-block"
                    >
                        <span class="glyphicon glyphicon-eye-open"></span>
                        Ler notícia
                    </a>
                </p>
            </div>

        </div>
    </div>
<?php } while ($row = $lista->fetch_assoc()); ?>

</div>
<?php } ?>

</main>

<footer>
    <?php include('rodape.php'); ?>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php mysqli_free_result($lista); ?>