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
$tabela = "tb_torneios_noticias";
$ordenar_por = "data_publicacao DESC";

$consulta = "
    SELECT *
    FROM $tabela
    WHERE categoria = '$categoria_safe'
    ORDER BY $ordenar_por
";

$lista = $conn_atletas->query($consulta);
$row = $lista->fetch_assoc();
$totalRows = $lista->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Notícias do Torneio</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>

<body class="fundofixo fontetabela">

<?php include('menu_publico.php'); ?>

<main class="container">

<?php if ($totalRows == 0) { ?>
    <h2 class="breadcrumb alert-warning fundoatletas titulo text-center">
        Nenhuma notícia encontrada para esta categoria
    </h2>
<?php } ?>

<?php if ($totalRows > 0) { ?>
<h2 class="breadcrumb alert-success fundoatletas titulo">
    <a href="javascript:window.history.go(-1)" class="btn btntotal">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    Notícias da categoria:
    <strong><?= htmlspecialchars($categoria); ?></strong>
    <span class="badge"><?= $totalRows; ?></span>
</h2>

<div class="row">

<?php do { ?>
    <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="thumbnail">

            <img
                src="<?= $row['imagem']; ?>"
                alt="<?= $row['titulo']; ?>"
                class="img-responsive img-rounded"
                style="height:200px; width:100%; object-fit:cover;"
            >

            <div class="caption text-center">
                <h4 class="text-primary">
                    <strong><?= $row['titulo']; ?></strong>
                </h4>

                <p class="text-left" style="min-height:80px;">
                    <?= mb_strimwidth($row['resumo'], 0, 100, "..."); ?>
                </p>

                <p>
                    <a
                        href="torneios_noticia_detalhe.php?id=<?= $row['id_noticia_torneio']; ?>"
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
