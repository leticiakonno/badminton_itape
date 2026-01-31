<!DOCTYPE html>
<html lang="pt-br">
<head class="">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton Itapetininga</title>
        <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundofixo fontetabela">
    <!-- MENU -->
    <a name="home"></a>
    <?php include('menu_publico.php'); ?>
    <!-- CARROUSSEL -->
    <?php include('carroussel.php'); ?>

    <main class="containerpri tabela-branca container-fluid">
    <div class="principal">
    <!-- Torneios -->
    <a name="torneios" ></a>
    <hr>
    <?php include('torneios_geral.php'); ?>

    <!-- Atletas -->
    <a name="atletas"></a>
    <hr>
    <?php include('atletas_destaque_inicio.php'); ?>
            <a 
            href="atletas_destaque.php" 
            class="btn btnvermais" 
            role="button"
        >
            <span>Clique para saber mais...</span>
            <span class="visible-xs glyphicon glyphicon-eye-open"></span>
        </a>

        <!-- Historia -->
        <a name="historia"></a>
        <hr>
        <?php include('historiaresumo.php'); ?>
        <br>

    <!-- Historia -->
        <a name="parceiros"></a>
        <hr>
        <?php include('parceiros_index.php'); ?>
        <br>
    </div>

    <aside class="sidebar-news">
     <!-- Notícias -->
    <a name="noticias" ></a>
    <hr>
    <?php include ('noticias_geral.php')?>
    </aside>
</main>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
<!-- RODAPÉ -->
    <footer>
        <?php include('rodape.php'); ?>
        <a name="contato"></a>
    </footer>
</body>
</html>