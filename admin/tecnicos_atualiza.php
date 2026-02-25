<?php
// Incluir o Sistema de Autenticação
include("acesso_sup.php");

// Conexão
include("../Connections/conn_atletas.php");

$tabela = "tbtecnicos";
$campo_filtro = "id_tecnico";

// 1) VALIDAR SE TEM ID NA URL
if (!isset($_GET['id_tecnico'])) {
    die("Erro: ID do técnico não informado!");
}

$id = intval($_GET['id_tecnico']);

mysqli_select_db($conn_atletas, $database_conn);

// 2) CARREGAR DADOS DO TÉCNICO
$consulta = "SELECT * FROM $tabela WHERE $campo_filtro = $id";
$lista = $conn_atletas->query($consulta);
$row = $lista->fetch_assoc();

if (!$row) {
    die("Erro: técnico não encontrado.");
}

// 3) PROCESSAR UPDATE QUANDO ENVIAR O FORMULÁRIO
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome_tecnico   = $_POST['nome_tecnico'];
    $nivel_tecnico  = $_POST['nivel_tecnico'];
    $descri_tecnico = $_POST['descri_tecnico'];
    $img_tecnico    = $row['img_tecnico']; // mantém imagem atual

    // Se enviou nova imagem
    if (!empty($_FILES['img_tecnico']['name'])) {
        $nomeArquivo = time() . "_" . $_FILES['img_tecnico']['name'];
        $tempArquivo = $_FILES['img_tecnico']['tmp_name'];

        // Criar pasta se não existir
        if (!is_dir('../imagens/tecnicos/')) {
            mkdir('../imagens/tecnicos/', 0777, true);
        }

        $destino = "../imagens/tecnicos/" . $nomeArquivo;

        // Excluir imagem antiga se existir
        if (!empty($img_tecnico) && file_exists("../imagens/tecnicos/" . $img_tecnico)) {
            unlink("../imagens/tecnicos/" . $img_tecnico);
        }

        if (move_uploaded_file($tempArquivo, $destino)) {
            $img_tecnico = $nomeArquivo;
        }
    }

    // UPDATE
    $updateSQL = "
        UPDATE $tabela SET
            nome_tecnico = '$nome_tecnico',
            nivel_tecnico = '$nivel_tecnico',
            descri_tecnico = '$descri_tecnico',
            img_tecnico = '$img_tecnico'
        WHERE $campo_filtro = $id
    ";

    $conn_atletas->query($updateSQL);

    header("Location: tecnicos_lista.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Técnicos Atualiza</title>
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
                <a href="tecnicos_lista.php">
                    <button class="btn btntotal bg-danger text-white">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualizar Técnicos
            </h2>
            <div class="thumbnail">
                <div class="alert alert">
                    <form action="tecnicos_atualiza.php?id_tecnico=<?php echo $id; ?>"
                          enctype="multipart/form-data"
                          method="post"
                          id="form_atualiza_tecnico"
                          name="form_atualiza_tecnico">

                        <!-- campo oculto com ID (não obrigatório pois já está na URL, mas útil para clareza) -->
                        <input type="hidden" name="id_tecnico" value="<?php echo $id; ?>">

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
                                   value="<?php echo $row['nome_tecnico']; ?>">
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
                                   value="<?php echo $row['nivel_tecnico']; ?>">
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
                                      rows="8"><?php echo $row['descri_tecnico']; ?></textarea>
                        </div>
                        <br>

                        <!-- Imagem atual -->
                        <label>Imagem atual:</label><br>
                        <?php if (!empty($row['img_tecnico'])): ?>
                            <img src="../imagens/tecnicos/<?php echo $row['img_tecnico']; ?>"
                                 alt="Imagem atual do técnico"
                                 class="current-image">
                            <br>
                            <small><?php echo $row['img_tecnico']; ?></small><br><br>
                        <?php else: ?>
                            <p class="text-muted">Nenhuma imagem cadastrada</p>
                        <?php endif; ?>

                        <!-- Nova imagem com pré-visualização -->
                        <label for="img_tecnico">Nova imagem (opcional):</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <img src="#"
                                 alt="Prévia da nova imagem"
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
                               value="Salvar Alterações"
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

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>
<?php mysqli_free_result($lista); ?>