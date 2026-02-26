<?php
// Incluir o Sistema de Autenticação
include("acesso_sup.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Variáveis Globais
$tabela         = "tbnoticias";
$campo_filtro   = "id_noticia";

// Se o formulário foi enviado
if ($_POST) {
    mysqli_select_db($conn_atletas, $database_conn);

    // Receber os dados do formulário
    $titulo_noticia = $_POST['titulo_noticia'];
    $descri_noticia = $_POST['descri_noticia'];
    $filtro_update  = $_POST['id_noticia'];

    // Buscar imagem atual
    $consulta_atual = "SELECT img_noticia FROM $tabela WHERE $campo_filtro = '$filtro_update'";
    $resultado_atual = $conn_atletas->query($consulta_atual);
    $dados_atual = $resultado_atual->fetch_assoc();
    $img_noticia = $dados_atual['img_noticia']; // Mantém imagem atual

    // Se o usuário enviou uma nova imagem
    if (!empty($_FILES['img_noticia']['name'])) {
        $nomeArquivo = time() . "_" . $_FILES['img_noticia']['name'];
        $tempArquivo = $_FILES['img_noticia']['tmp_name'];

        // Criar pasta se não existir
        if (!is_dir('../imagens/noticias/')) {
            mkdir('../imagens/noticias/', 0777, true);
        }

        $destino = "../imagens/noticias/" . $nomeArquivo;

        // Excluir imagem antiga se existir
        if (!empty($img_noticia) && file_exists("../imagens/noticias/" . $img_noticia)) {
            unlink("../imagens/noticias/" . $img_noticia);
        }

        if (move_uploaded_file($tempArquivo, $destino)) {
            $img_noticia = $nomeArquivo; // Atualiza com nova imagem
        }
    }

    // Atualização no banco
    $updateSQL = "
        UPDATE $tabela
        SET titulo_noticia = '$titulo_noticia',
            descri_noticia = '$descri_noticia',
            img_noticia = '$img_noticia'
        WHERE $campo_filtro = '$filtro_update'
    ";

    $resultado = $conn_atletas->query($updateSQL);

    // Redirecionamento
    $destino = "noticias_lista.php";
    header("Location: $destino");
    exit;
}

// Carregar dados do registro para exibir no formulário
if (isset($_GET['id_noticia'])) {
    mysqli_select_db($conn_atletas, $database_conn);
    $filtro_select = $_GET['id_noticia'];
    $consulta = "SELECT * FROM $tabela WHERE $campo_filtro = $filtro_select";
    $lista = $conn_atletas->query($consulta);
    $row = $lista->fetch_assoc();
    $totalRows = $lista->num_rows;
} else {
    die("Erro: ID da notícia não informado!");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualiza Notícias</title>
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
        .current-image {
            max-height: 150px;
            margin-bottom: 10px;
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
        <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
            <h2 class="fundoatletas text-center titulo">
                <a href="noticias_lista.php">
                    <button class="btn btntotal">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualiza Notícias
            </h2>
            <br>
            <div class="thumbnail">
                <div class="alert" role="alert">
                    <form action="noticias_atualiza.php"
                          enctype="multipart/form-data"
                          method="post"
                          id="form_noticia_atualiza"
                          name="form_noticia_atualiza">

                        <!-- ID oculto -->
                        <input type="hidden"
                               name="id_noticia"
                               value="<?php echo $row['id_noticia']; ?>">

                        <!-- Título -->
                        <label for="titulo_noticia">Título da Notícia:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <input type="text"
                                   name="titulo_noticia"
                                   id="titulo_noticia"
                                   class="form-control"
                                   autofocus
                                   maxlength="15"
                                   required
                                   value="<?php echo $row['titulo_noticia']; ?>">
                        </div>
                        <br>

                        <!-- Descrição -->
                        <label for="descri_noticia">Descrição:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-align-justify"></span>
                            </span>
                            <textarea name="descri_noticia"
                                      id="descri_noticia"
                                      class="form-control"
                                      placeholder="Digite a descrição da notícia."
                                      cols="30"
                                      rows="8"><?php echo $row['descri_noticia']; ?></textarea>
                        </div>
                        <br>

                        <!-- Imagem atual -->
                        <label>Imagem atual:</label><br>
                        <?php if (!empty($row['img_noticia'])): ?>
                            <img src="../imagens/noticias/<?php echo $row['img_noticia']; ?>"
                                 alt="Imagem atual"
                                 class="current-image">
                            <br>
                            <small><?php echo $row['img_noticia']; ?></small><br><br>
                        <?php else: ?>
                            <p class="text-warning">Nenhuma imagem cadastrada</p>
                        <?php endif; ?>

                        <!-- Nova imagem com pré-visualização -->
                        <label for="img_noticia">Nova imagem (opcional):</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <img src="#"
                                 alt="Prévia da nova imagem"
                                 id="preview"
                                 class="img-responsive">
                            <input type="file"
                                   name="img_noticia"
                                   id="img_noticia"
                                   class="form-control"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                        </div>
                        <br>

                        <!-- Botão enviar -->
                        <input type="submit"
                               value="Atualizar"
                               name="enviar"
                               id="enviar"
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>
<?php mysqli_free_result($lista); ?>