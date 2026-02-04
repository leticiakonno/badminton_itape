<?php
include("Connections/conn_atletas.php");

/* ===============================
   VALIDA ID NA URL
================================ */
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do torneio não especificado!");
}

$id = (int) $_GET['id'];

/* ===============================
   CONSULTA NO BANCO
================================ */
$sql = "
    SELECT *
    FROM tb_torneios_noticias
    WHERE id_noticia_torneio = $id
    AND status = 'ativo'
";

$lista = $conn_atletas->query($sql);

if ($lista->num_rows == 0) {
    die("Notícia não encontrada!");
}

$row = $lista->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $row['titulo']; ?></title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>

<body class="fundofixo fontetabela">

<?php include('menu_publico.php'); ?>

<main class="container">

    <h2 class="breadcrumb alert-success fundoatletas titulo">
        <a href="javascript:history.back();" class="btn btntotal">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <?= $row['titulo']; ?>
    </h2>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <?php if (!empty($row['imagem'])) { ?>
                <img
                    src="<?= $row['imagem']; ?>"
                    alt="<?= $row['titulo']; ?>"
                    class="img-responsive img-rounded"
                    style="width:100%; max-height:400px; object-fit:cover; margin-bottom:20px;"
                >
            <?php } ?>

            <p class="text-muted">
                Publicado em:
                <?= date('d/m/Y H:i', strtotime($row['data_publicacao'])); ?>
            </p>

            <hr>

            <div class="conteudo-noticia">
                <?= nl2br($row['conteudo']); ?>
            </div>

        </div>
    </div>

</main>

<footer>
    <?php include('rodape.php'); ?>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php mysqli_free_result($lista); ?>
