<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton Itapetininga</title>
</head>
<body class="fundofixo">
    <!-- MENU -->
    <a name="home"></a>
    <?php include('menu_publico.php'); ?>

    <!-- CARROUSSEL -->
    <?php include('carroussel.php'); ?>

<main class="container">
    <!-- Notícias -->
    <a name="noticias"></a>
    <hr>
    <?php include ('noticias_geral.php')?>

    <!-- Torneios -->
    <a name="torneios"></a>
    <hr>
    <?php include('torneios_geral.php'); ?>

    <!-- Atletas -->
    <a name="atletas"></a>
    <hr>
    <?php include('atletas_destaque.php'); ?>

    <div>
        <!-- Historia -->
        <a name="historia"></a>
        <hr>
        <?php include('historiaresumo.php'); ?>
    </div>

</main>
</body>
<!-- RODAPÉ -->
    <footer>
        <?php include('rodape.php'); ?>
        <a name="contato"></a>
    </footer>
</html>