<?php
// Incluir o Sistema de Autenticação
include("acesso_sup.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Variáveis globais
$tabela = 'tbusuarios';
$campo_filtro = 'id_usuario';

if ($_POST) {
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas, $database_conn);

    // Receber os dados do formulário
    $login_usuario = $_POST['login_usuario'];
    $senha_usuario = $_POST['senha_usuario'];
    $nivel_usuario = $_POST['nivel_usuario'];

    // Campo para filtrar o registro (WHERE)
    $filtro_update = $_POST['id_usuario'];

    // *** BUSCAR FOTO ATUAL ***
    $consulta_atual = "SELECT foto_usuario FROM $tabela WHERE $campo_filtro = '$filtro_update'";
    $resultado_atual = $conn_atletas->query($consulta_atual);
    $dados_atual = $resultado_atual->fetch_assoc();
    $foto_usuario = $dados_atual['foto_usuario']; // Mantém foto atual

    // *** PROCESSAR NOVA IMAGEM SE ENVIADA ***
    if (!empty($_FILES['foto_usuario']['name'])) {
        $nomeArquivo = time() . "_" . $_FILES['foto_usuario']['name'];
        $tempArquivo = $_FILES['foto_usuario']['tmp_name'];

        // Criar pasta se não existir
        if (!is_dir('../imagens/usuarios/')) {
            mkdir('../imagens/usuarios/', 0777, true);
        }

        $destino = "../imagens/usuarios/" . $nomeArquivo;

        // Excluir imagem antiga se existir
        if (!empty($foto_usuario) && file_exists("../imagens/usuarios/" . $foto_usuario)) {
            unlink("../imagens/usuarios/" . $foto_usuario);
        }

        if (move_uploaded_file($tempArquivo, $destino)) {
            $foto_usuario = $nomeArquivo; // Atualiza com nova foto
        }
    }

    // *** CONSULTA SQL ***
    $updateSQL = "
        UPDATE $tabela
        SET login_usuario = '$login_usuario',
            senha_usuario = '$senha_usuario',
            nivel_usuario = '$nivel_usuario',
            foto_usuario = '$foto_usuario'
        WHERE $campo_filtro = '$filtro_update'
    ";

    $resultado = $conn_atletas->query($updateSQL);

    // Redirecionamento
    $destino = "usuarios_lista.php";
    header("Location: $destino");
    exit;
}

// Consulta para trazer e filtrar os dados
mysqli_select_db($conn_atletas, $database_conn);

$filtro_select = $_GET['id_usuario'];
$consulta = "
    SELECT *
    FROM $tabela
    WHERE $campo_filtro = $filtro_select
";
$lista = $conn_atletas->query($consulta);
$row = $lista->fetch_assoc();
$totalRows = $lista->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Atualiza</title>
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
                Atualizar Usuários
            </h2>
            <div class="thumbnail">
                <div class="alert alert">
                    <form action="usuarios_atualiza.php"
                          enctype="multipart/form-data"
                          method="post"
                          id="form_atualiza_usuario"
                          name="form_atualiza_usuario">

                        <!-- Campo oculto com ID -->
                        <input type="hidden"
                               name="id_usuario"
                               id="id_usuario"
                               value="<?php echo $row['id_usuario']; ?>">

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
                                   maxlength="100"
                                   required
                                   value="<?php echo $row['login_usuario']; ?>">
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
                                   maxlength="100"
                                   required
                                   value="<?php echo $row['senha_usuario']; ?>">
                        </div>
                        <br>

                        <!-- Nível -->
                        <label for="nivel_usuario">Nível do usuário</label>
                        <div class="input-group">
                            <label for="nivel_usuario_c" class="radio-inline">
                                <input type="radio"
                                       name="nivel_usuario"
                                       id="nivel_usuario_c"
                                       value="com"
                                       <?php echo $row['nivel_usuario'] == "com" ? "checked" : ""; ?>>
                                Comum
                            </label>
                            <label for="nivel_usuario_s" class="radio-inline">
                                <input type="radio"
                                       name="nivel_usuario"
                                       id="nivel_usuario_s"
                                       value="sup"
                                       <?php echo $row['nivel_usuario'] == "sup" ? "checked" : ""; ?>>
                                Supervisor
                            </label>
                        </div>
                        <br>

                        <!-- Foto atual -->
                        <label>Foto atual:</label><br>
                        <?php if (!empty($row['foto_usuario'])): ?>
                            <img src="../imagens/usuarios/<?php echo $row['foto_usuario']; ?>"
                                 alt="Foto atual"
                                 class="current-image">
                            <br>
                            <small><?php echo $row['foto_usuario']; ?></small><br><br>
                        <?php else: ?>
                            <p class="text-warning">Nenhuma foto cadastrada</p>
                        <?php endif; ?>

                        <!-- Nova imagem com pré-visualização -->
                        <label for="foto_usuario">Nova foto (opcional):</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <img src="#"
                                 alt="Prévia da nova imagem"
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