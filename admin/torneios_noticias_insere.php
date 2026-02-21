<?php
// Incluindo o sistema de identificação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if (isset($_POST['salvar'])) {

    $titulo   = $_POST['titulo'];
    $resumo   = $_POST['resumo'];
    $conteudo = $_POST['conteudo'];
    $categoria = $_POST['categoria'];
    $status   = $_POST['status'];

    /* Upload da imagem */
    $imagem = $_FILES['imagem']['name'];
    $tmp    = $_FILES['imagem']['tmp_name'];

    if (!empty($imagem)) {
        move_uploaded_file($tmp, "../imagens/noticias/" . $imagem);
    }

    $sql = "
        INSERT INTO tb_torneios_noticias
        (titulo, resumo, conteudo, categoria, imagem, status, data_publicacao)
        VALUES
        ('$titulo', '$resumo', '$conteudo', '$categoria', '$imagem', '$status', NOW())
    ";

    $conn_atletas->query($sql);

    header("Location: torneios_noticias_lista.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Notícia de Torneio</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo fontetabela">

<?php include("menu_adm.php"); ?>

<main class="container">

<div class="row">
    <div class="col-xs-12 col-sm-offset-3 col-sm-6">

        <h2 class="breadcrumb fundousuarios text-center titulo">
            <a href="torneios_noticias_lista.php" class="btn btntotal bg-danger">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            Inserir Notícia de Torneio
        </h2>

        <div class="thumbnail">
            <div class="alert alert">

                <form
                    action="torneios_noticias_insere.php"
                    method="post"
                    enctype="multipart/form-data"
                >

                <!-- TÍTULO -->
                <label>Título da Notícia:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-font"></span>
                    </span>
                    <input
                        type="text"
                        name="titulo"
                        class="form-control"
                        maxlength="255"
                        required
                    >
                </div>
                <br>

                <!-- RESUMO -->
                <label>Resumo:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-align-left"></span>
                    </span>
                    <textarea
                        name="resumo"
                        class="form-control"
                        rows="3"
                        maxlength="300"
                    ></textarea>
                </div>
                <br>

                <!-- CONTEÚDO -->
                <label>Conteúdo:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-edit"></span>
                    </span>
                    <textarea
                        name="conteudo"
                        class="form-control"
                        rows="6"
                        required
                    ></textarea>
                </div>
                <br>

                <!-- CATEGORIA -->
                <label>Categoria:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-tags"></span>
                    </span>
                    <select name="categoria" class="form-control" required>
                        <option value="">Selecione</option>
                        <option value="regional">Regional</option>
                        <option value="estadual">Estadual</option>
                        <option value="nacional">Nacional</option>
                        <option value="internacional">Internacional</option>
                    </select>
                </div>
                <br>

                <!-- IMAGEM -->
                <label>Imagem:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-picture"></span>
                    </span>
                    <input
                        type="file"
                        name="imagem"
                        class="form-control"
                        accept="image/*"
                    >
                </div>
                <br>

                <!-- STATUS -->
                <label>Status:</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-ok-circle"></span>
                    </span>
                    <select name="status" class="form-control">
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
                </div>
                <br>

                <!-- BOTÃO -->
                <input
                    type="submit"
                    name="salvar"
                    value="Cadastrar Notícia"
                    class="btn btntotal btn-block"
                >

                </form>

            </div>
        </div>

    </div>
</div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>
