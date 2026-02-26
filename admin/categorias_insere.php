<?php
// Incluindo o sistema de identificação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if ($_POST) {
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas, $database_conn);

    // Receber os dados do formulário
    $nome_categoria  = $_POST['nome_categoria'];
    $descri_categoria = $_POST['descri_categoria'];

    // Upload da imagem
    $img_categoria = ""; // valor padrão

    if (isset($_FILES['img_categoria']) && $_FILES['img_categoria']['error'] == 0) {
        $nomeArquivo = time() . "_" . $_FILES['img_categoria']['name'];
        $tempArquivo = $_FILES['img_categoria']['tmp_name'];

        // Criar pasta se não existir
        if (!is_dir('../imagens/categorias/')) {
            mkdir('../imagens/categorias/', 0777, true);
        }

        $destino = "../imagens/categorias/" . $nomeArquivo;

        if (move_uploaded_file($tempArquivo, $destino)) {
            $img_categoria = $nomeArquivo;
        }
    }

    // Inserção no banco
    $insertSQL = "
        INSERT INTO tbcategorias (nome_categoria, descri_categoria, img_categoria)
        VALUES ('$nome_categoria', '$descri_categoria', '$img_categoria')
    ";

    $resultado = $conn_atletas->query($insertSQL);

    // Redirecionamento
    $destino = "categorias_lista.php";
    if (mysqli_insert_id($conn_atletas)) {
        header("Location: $destino");
        exit;
    }
}

// Selecionar o banco de dados (USE)
mysqli_select_db($conn_atletas, $database_conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria Insere</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
    <style>
        #preview {
            max-height: 150px;
            margin-bottom: 10px;
            display: none;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 4px;
        }
    </style>
</head>
<body class="fundofixo">
<?php include("menu_adm.php"); ?>
<main class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8">
            <h2 class="fundocategoria text-center titulo">
                <a href="categorias_lista.php">
                    <button class="btn btntotal">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Inserir Categoria
            </h2>
            <br>
            <div class="thumbnail">
                <div class="alert alert">
                    <form action="categorias_insere.php"
                          enctype="multipart/form-data"
                          method="post"
                          id="form_insere_categoria"
                          name="form_insere_categoria">
                        <!-- nome_categoria -->
                        <label for="nome_categoria">Nome:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-th-large"></span>
                            </span>
                            <input type="text"
                                   name="nome_categoria"
                                   id="nome_categoria"
                                   class="form-control"
                                   autofocus
                                   maxlength="15"
                                   required
                                   placeholder="Digite o nome da categoria.">
                        </div>
                        <br>

                        <!-- descri_categoria -->
                        <label for="descri_categoria">Descrição da categoria:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-align-justify"></span>
                            </span>
                            <textarea name="descri_categoria"
                                      id="descri_categoria"
                                      class="form-control"
                                      placeholder="Digite a descrição da categoria."
                                      cols="30"
                                      rows="8"></textarea>
                        </div>
                        <br>

                        <!-- img_categoria com pré-visualização -->
                        <label for="img_categoria">Imagem:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <img src="#"
                                 alt="Prévia da imagem"
                                 id="preview"
                                 class="img-responsive">
                            <input type="file"
                                   name="img_categoria"
                                   id="img_categoria"
                                   class="form-control"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                        </div>
                        <br>

                        <!-- botão enviar -->
                        <input type="submit"
                               value="Cadastrar"
                               name="enviar"
                               id="enviar"
                               role="button"
                               class="btn btntotal btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>