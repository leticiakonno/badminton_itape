<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
    <!-- não esquecer de comentar o JS e CSS para não dar conflito no index -->
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundofixo">
<?php include('menu_publico.php'); ?>

<main class="container">
<div class="layout">
    <aside class="sidebar-noticias" id="sidebar-noticias">
        <h2>Notícias em Tempo Real</h2>
        <div id="feed-container">
            <?php include 'fetch_news.php'; ?>
        </div>
    </aside>
</div>
</main>

<!-- Link arquivos Bootstrap js --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
</body>
</html>