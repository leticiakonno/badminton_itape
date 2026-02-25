<?php
// Incluindo o sistema de identificação
include("acesso_sup.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if ($_POST) {

    // RECEBE DADOS
    $login_usuario = $_POST['login_usuario'];
    $senha_usuario = $_POST['senha_usuario'];
    $nivel_usuario = $_POST['nivel_usuario'];

    // ==============================================
    // UPLOAD DA IMAGEM
    // ==============================================
    $foto_usuario = ""; // valor que vai para o banco

    if (isset($_FILES['foto_usuario']) && $_FILES['foto_usuario']['error'] == 0) {
        $nomeArquivo = time() . "_" . $_FILES['foto_usuario']['name'];
        $tempArquivo = $_FILES['foto_usuario']['tmp_name'];

        // Criar pasta se não existir
        if (!is_dir('../imagens/usuarios/')) {
            mkdir('../imagens/usuarios/', 0777, true);
        }

        $destino = "../imagens/usuarios/" . $nomeArquivo;

        if (move_uploaded_file($tempArquivo, $destino)) {
            $foto_usuario = $nomeArquivo;
        }
    }

    // ==============================================
    // INSERT
    // ==============================================
    $sql = "
        INSERT INTO tbusuarios
            (login_usuario, senha_usuario, nivel_usuario, foto_usuario)
        VALUES
            ('$login_usuario', '$senha_usuario', '$nivel_usuario', '$foto_usuario')
    ";

    $conn_atletas->query($sql);

    header("Location: usuarios_lista.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Insere</title>
    <script src="https://kit.fontawesome.com/d03c290dd3.js" crossorigin="anonymous"></script>
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
        <div class="col-xs-12 col-sm-offset-3 col-sm-6">
            <h2 class="breadcrumb fundousuarios text-center titulo">
                <a href="usuarios_lista.php">
                    <button class="btn btntotal bg-danger text-white">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Inserir Usuários
            </h2>
            <div class="thumbnail">
                <div class="alert alert">
                    <form action="usuarios_insere.php"
                          enctype="multipart/form-data"
                          method="post"
                          id="form_insere_usuario"
                          name="form_insere_usuario">

                        <!-- Imagem com pré-visualização -->
                        <label for="foto_usuario">Imagem:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <img src="#"
                                 alt="Prévia da imagem"
                                 id="preview"
                                 class="img-responsive">
                            <input type="file"
                                   name="foto_usuario"
                                   id="foto_usuario"
                                   class="form-control"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                        </div>
                        <br>

                        <!-- Login -->
                        <label for="login_usuario">Login:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text"
                                   name="login_usuario"
                                   id="login_usuario"
                                   class="form-control"
                                   placeholder="Digite o seu login."
                                   maxlength="30"
                                   required>
                        </div>
                        <br>

                        <!-- Senha -->
                        <label for="senha_usuario">Senha:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-qrcode"></span>
                            </span>
                            <input type="password"
                                   name="senha_usuario"
                                   id="senha_usuario"
                                   class="form-control"
                                   placeholder="Digite a senha desejada."
                                   maxlength="8"
                                   required>
                        </div>
                        <br>

                        <!-- Nível -->
                        <label for="nivel_usuario">Nível do usuário?</label>
                        <div class="input-group">
                            <label for="nivel_usuario_c" class="radio-inline">
                                <input type="radio"
                                       name="nivel_usuario"
                                       id="nivel_usuario_c"
                                       value="com"
                                       checked>
                                Comum
                            </label>
                            <label for="nivel_usuario_s" class="radio-inline">
                                <input type="radio"
                                       name="nivel_usuario"
                                       id="nivel_usuario_s"
                                       value="sup">
                                Supervisor
                            </label>
                        </div>
                        <br>

                        <!-- Botão enviar -->
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