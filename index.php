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

    <main class="container">
        <!-- CARROUSSEL -->
        <?php include('carroussel.php'); ?>

        <!-- Torneios -->
        <a name="torneios"></a>
        <hr>
        <?php include('torneios_destaque.php'); ?>

        <!-- Atletas -->
        <a name="atletas"></a>
        <hr>
        <?php include('atletas_geral.php'); ?>

         <!-- Historia -->
        <a name="historia"></a>
        <hr>
        <?php include('historia.php'); ?>

        <!-- RODAPÉ -->
        <footer>
            <?php include('rodape.php'); ?>
            <a name="contato"></a>
        </footer>
    </main>
</body>
</html>