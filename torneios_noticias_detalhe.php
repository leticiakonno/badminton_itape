<?php
include("Connections/conn_atletas.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: torneios_geral.php");
    exit();
}

$id = (int) $_GET['id'];

$sql = "
    SELECT *
    FROM tb_torneios_noticias
    WHERE id_noticia_torneio = $id
    AND status = 'ativo'
";

$lista = $conn_atletas->query($sql);

if ($lista->num_rows == 0) {
    header("Location: torneios_geral.php");
    exit();
}

$row = $lista->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row['titulo']); ?></title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meu_estilo.css">
    
    <style>
        /* APENAS FUNDO BRANCO PARA A NOTÍCIA */
        .conteudo-noticia-branco {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="fundo3 fontetabela">

<?php include('menu_publico.php'); ?>

<main class="container">

    <h2 class="breadcrumb alert-success fundoatletas titulo">
        <a href="torneios_noticia.php?categoria=<?php echo $row['categoria']; ?>" class="btn btntotal">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <?php echo htmlspecialchars($row['titulo']); ?>
    </h2>

    <div class="row">
         <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 conteudo-noticia-branco">
        

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
                    style="max-width: 700px; width: 100%; height: auto;"
                >
            <?php } ?>

            <p class="text-muted">
                <strong>Publicado em:</strong>
                <?php echo date('d/m/Y H:i', strtotime($row['data_publicacao'])); ?>
                &nbsp;|&nbsp;
                <strong>Categoria:</strong>
                <?php echo ucfirst($row['categoria']); ?>
            </p>

            <hr>

            <h4 class="text-primary">Resumo:</h4>
            <p class="lead"><?php echo nl2br(htmlspecialchars($row['resumo'])); ?></p>
            
            <hr>

            <h4 class="text-primary">Conteúdo:</h4>
            <div style="font-size: 16px; line-height: 1.6;">
                <?php echo nl2br(htmlspecialchars($row['conteudo'])); ?>
            </div>

            <hr>
            
            <p class="text-center">
                <a href="torneios_noticia.php?categoria=<?php echo $row['categoria']; ?>" class="btn btn-default">
                    <span class="glyphicon glyphicon-list"></span> Ver mais notícias <?php echo ucfirst($row['categoria']); ?>
                </a>
                <a href="javascript:window.history.go(-2)" class="btn btn-danger">
                    <span class="glyphicon glyphicon-home"></span> Voltar para Torneios
                </a>
            </p>

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