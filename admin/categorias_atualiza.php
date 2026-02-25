<?php
// Incluir o Sistema de Autenticação
include("acesso_sup.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Variáveis Globais
$tabela         = "tbcategorias";
$campo_filtro   = "id_categoria";

if ($_POST) {
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas, $database_conn);

    // Receber os dados do formulário
    $nome_categoria  = $_POST['nome_categoria'];
    $descri_categoria = $_POST['descri_categoria'];
    $filtro_update   = $_POST['id_categoria'];

    // Buscar imagem atual
    $consulta_atual = "SELECT img_categoria FROM $tabela WHERE $campo_filtro = '$filtro_update'";
    $resultado_atual = $conn_atletas->query($consulta_atual);
    $dados_atual = $resultado_atual->fetch_assoc();
    $img_categoria = $dados_atual['img_categoria']; // Mantém imagem atual

    // Upload de nova imagem (se enviada)
    if (!empty($_FILES['img_categoria']['name'])) {
        $nomeArquivo = time() . "_" . $_FILES['img_categoria']['name'];
        $tempArquivo = $_FILES['img_categoria']['tmp_name'];

        // Criar pasta se não existir
        if (!is_dir('../imagens/categorias/')) {
            mkdir('../imagens/categorias/', 0777, true);
        }

        $destino = "../imagens/categorias/" . $nomeArquivo;

        // Excluir imagem antiga se existir
        if (!empty($img_categoria) && file_exists("../imagens/categorias/" . $img_categoria)) {
            unlink("../imagens/categorias/" . $img_categoria);
        }

        if (move_uploaded_file($tempArquivo, $destino)) {
            $img_categoria = $nomeArquivo; // Atualiza com nova imagem
        }
    }

    // Atualização no banco
    $updateSQL = "
        UPDATE $tabela
        SET nome_categoria = '$nome_categoria',
            descri_categoria = '$descri_categoria',
            img_categoria = '$img_categoria'
        WHERE $campo_filtro = '$filtro_update'
    ";

    $resultado = $conn_atletas->query($updateSQL);

    // Redirecionamento
    $destino = "categorias_lista.php";
    header("Location: $destino");
    exit;
}

// Consulta para trazer os dados do registro a ser editado
mysqli_select_db($conn_atletas, $database_conn);
$filtro_select = $_GET['id_categoria'];
$consulta = "SELECT * FROM $tabela WHERE $campo_filtro = $filtro_select";
$lista = $conn_atletas->query($consulta);
$row = $lista->fetch_assoc();
$totalRows = $lista->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias Atualiza</title>
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
            <h2 class="fundocategoria text-center titulo">
                <a href="categorias_lista.php">
                    <button class="btn btntotal">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualiza Categoria
            </h2>
            <br>
            <div class="thumbnail">
                <div class="alert alert">
                    <form action="categorias_atualiza.php"
                          enctype="multipart/form-data"
                          method="post"
                          id="form_atualiza_categorias"
                          name="form_atualiza_categorias">
                        <!-- campo oculto com ID -->
                        <input type="hidden"
                               name="id_categoria"
                               id="id_categoria"
                               value="<?php echo $row['id_categoria']; ?>">

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
                                   value="<?php echo $row['nome_categoria']; ?>">
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
                                      rows="8"><?php echo $row['descri_categoria']; ?></textarea>
                        </div>
                        <br>

                        <!-- Imagem atual -->
                        <label>Imagem atual:</label><br>
                        <?php if (!empty($row['img_categoria'])): ?>
                            <img src="../imagens/categorias/<?php echo $row['img_categoria']; ?>"
                                 alt="Imagem atual"
                                 class="current-image">
                            <br>
                            <small><?php echo $row['img_categoria']; ?></small><br><br>
                        <?php else: ?>
                            <p class="text-muted">Nenhuma imagem cadastrada</p>
                        <?php endif; ?>

                        <!-- Nova imagem com pré-visualização -->
                        <label for="img_categoria">Nova imagem (opcional):</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <img src="#"
                                 alt="Prévia da nova imagem"
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
                               value="Atualizar"
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
<?php mysqli_free_result($lista); ?>