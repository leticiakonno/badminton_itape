<?php
// Incluindo o sistema de identificação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if ($_POST) {
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas, $database_conn);

    // Receber os dados do formulário
    $nome_parceiro   = $_POST['nome_parceiro'];
    $descri_parceiro = $_POST['descri_parceiro'];

    // Upload da imagem
    $img_parceiro = ""; // valor padrão

    if (isset($_FILES['img_parceiro']) && $_FILES['img_parceiro']['error'] == 0) {
        $nomeArquivo = time() . "_" . $_FILES['img_parceiro']['name'];
        $tempArquivo = $_FILES['img_parceiro']['tmp_name'];

        // Criar pasta se não existir
        if (!is_dir('../imagens/apoiadores/')) {
            mkdir('../imagens/apoiadores/', 0777, true);
        }

        $destino = "../imagens/apoiadores/" . $nomeArquivo;

        if (move_uploaded_file($tempArquivo, $destino)) {
            $img_parceiro = $nomeArquivo;
        }
    }

    // Inserção no banco
    $insertSQL = "
        INSERT INTO tbparceiros (nome_parceiro, descri_parceiro, img_parceiro)
        VALUES ('$nome_parceiro', '$descri_parceiro', '$img_parceiro')
    ";

    $resultado = $conn_atletas->query($insertSQL);

    // Redirecionamento
    $destino = "parceiros_lista.php";
    if (mysqli_insert_id($conn_atletas)) {
        header("Location: $destino");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parceiros Insere</title>
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
        <div class="col-xs-12 col-sm-offset-3 col-sm-8 col-md-offset-3 col-md-6">
            <h2 class="fundoatletas text-center titulo">
                <a href="parceiros_lista.php">
                    <button class="btn btntotal">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Inserir Parceiros
            </h2>
            <div class="thumbnail">
                <div class="alert">
                    <form action="parceiros_insere.php"
                          enctype="multipart/form-data"
                          method="post"
                          id="form_insere_parceiro"
                          name="form_insere_parceiro">

                        <!-- nome_parceiro -->
                        <label for="nome_parceiro">Nome:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <input type="text"
                                   name="nome_parceiro"
                                   id="nome_parceiro"
                                   class="form-control"
                                   autofocus
                                   maxlength="15"
                                   required
                                   placeholder="Digite o nome do parceiro.">
                        </div>
                        <br>

                        <!-- descri_parceiro -->
                        <label for="descri_parceiro">Descrição do parceiro:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-align-justify"></span>
                            </span>
                            <textarea name="descri_parceiro"
                                      id="descri_parceiro"
                                      class="form-control"
                                      placeholder="Digite a descrição do parceiro."
                                      cols="30"
                                      rows="8"></textarea>
                        </div>
                        <br>

                        <!-- img_parceiro com pré-visualização -->
                        <label for="img_parceiro">Imagem:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <img src="#"
                                 alt="Prévia da imagem"
                                 id="preview"
                                 class="img-responsive">
                            <input type="file"
                                   name="img_parceiro"
                                   id="img_parceiro"
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