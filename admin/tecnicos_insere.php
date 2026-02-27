<?php
// Incluindo o sistema de identificação
include("acesso_com.php");

// Incluir arquivo e fazer conexão
include("../Connections/conn_atletas.php");

if ($_POST) {

    mysqli_select_db($conn_atletas, $database_conn);

    // Receber dados
    $nome_tecnico   = $_POST['nome_tecnico'];
    $nivel_tecnico  = $_POST['nivel_tecnico'];
    $descri_tecnico = $_POST['descri_tecnico'];

    // Upload da imagem
    $img_tecnico = ""; // valor padrão

    if (isset($_FILES['img_tecnico']) && $_FILES['img_tecnico']['error'] == 0) {
        $nomeArquivo = time() . "_" . $_FILES['img_tecnico']['name'];
        $tempArquivo = $_FILES['img_tecnico']['tmp_name'];

        // Criar pasta se não existir
        if (!is_dir('../imagens/tecnicos/')) {
            mkdir('../imagens/tecnicos/', 0777, true);
        }

        $destino = "../imagens/tecnicos/" . $nomeArquivo;

        if (move_uploaded_file($tempArquivo, $destino)) {
            $img_tecnico = $nomeArquivo;
        }
    }

    // Inserção no banco
    $insertSQL = "
        INSERT INTO tbtecnicos (nome_tecnico, nivel_tecnico, descri_tecnico, img_tecnico)
        VALUES ('$nome_tecnico', '$nivel_tecnico', '$descri_tecnico', '$img_tecnico')
    ";

    $resultado = $conn_atletas->query($insertSQL);

    $destino = "tecnicos_lista.php";
    header("Location: $destino");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Técnicos Insere</title>
    <link rel="icon" type="image/png" href="../imagens/logobadminton.png">
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
<body class="fundofixo fontetabela">
<?php include("menu_adm.php"); ?>
<main class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-6">
            <h2 class="breadcrumb fundousuarios text-center titulo">
                <a href="tecnicos_lista.php">
                    <button class="btn btntotal bg-danger text-white">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Inserir Técnicos
            </h2>
            <div class="thumbnail">
                <div class="alert alert">
                    <form action="tecnicos_insere.php"
                          enctype="multipart/form-data"
                          method="post"
                          id="form_insere_tecnico"
                          name="form_insere_tecnico">

                        <!-- nome_tecnico -->
                        <label for="nome_tecnico">Nome:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <input type="text"
                                   name="nome_tecnico"
                                   id="nome_tecnico"
                                   class="form-control"
                                   autofocus
                                   maxlength="15"
                                   required
                                   placeholder="Digite o nome do técnico.">
                        </div>
                        <br>

                        <!-- nivel_tecnico -->
                        <label for="nivel_tecnico">Nível:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <input type="text"
                                   name="nivel_tecnico"
                                   id="nivel_tecnico"
                                   class="form-control"
                                   maxlength="15"
                                   required
                                   placeholder="Digite o nível do técnico.">
                        </div>
                        <br>

                        <!-- descri_tecnico -->
                        <label for="descri_tecnico">Descrição do técnico:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-align-justify"></span>
                            </span>
                            <textarea name="descri_tecnico"
                                      id="descri_tecnico"
                                      class="form-control"
                                      placeholder="Digite a descrição do técnico."
                                      cols="30"
                                      rows="8"></textarea>
                        </div>
                        <br>

                        <!-- img_tecnico com pré-visualização -->
                        <label for="img_tecnico">Imagem:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <img src="#"
                                 alt="Prévia da imagem"
                                 id="preview"
                                 class="img-responsive">
                            <input type="file"
                                   name="img_tecnico"
                                   id="img_tecnico"
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