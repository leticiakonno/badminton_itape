<?php
// Incluir o Sistema de Autenticação
include("acesso_sup.php");

// Conexão
include("../Connections/conn_atletas.php");

$tabela = "tbtorneios";
$campo_filtro = "id_torneio";

// Se o formulário foi enviado
if ($_POST) {
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas, $database_conn);

    $tipo_torneio   = $_POST['tipo_torneio'];
    $descri_torneio = $_POST['descri_torneio'];
    $filtro_update  = $_POST['id_torneio'];

    // Buscar imagem atual
    $consulta_atual = "SELECT img_torneio FROM $tabela WHERE $campo_filtro = '$filtro_update'";
    $resultado_atual = $conn_atletas->query($consulta_atual);
    $dados_atual = $resultado_atual->fetch_assoc();
    $img_torneio = $dados_atual['img_torneio']; // Mantém imagem atual

    // Se enviou nova imagem
    if (!empty($_FILES['img_torneio']['name'])) {
        $nomeArquivo = time() . "_" . $_FILES['img_torneio']['name'];
        $tempArquivo = $_FILES['img_torneio']['tmp_name'];

        // Criar pasta se não existir
        if (!is_dir('../imagens/torneios/')) {
            mkdir('../imagens/torneios/', 0777, true);
        }

        $destino = "../imagens/torneios/" . $nomeArquivo;

        // Excluir imagem antiga se existir
        if (!empty($img_torneio) && file_exists("../imagens/torneios/" . $img_torneio)) {
            unlink("../imagens/torneios/" . $img_torneio);
        }

        if (move_uploaded_file($tempArquivo, $destino)) {
            $img_torneio = $nomeArquivo; // Atualiza com nova imagem
        }
    }

    // Atualização no banco
    $updateSQL = "
        UPDATE $tabela
        SET tipo_torneio = '$tipo_torneio',
            descri_torneio = '$descri_torneio',
            img_torneio = '$img_torneio'
        WHERE $campo_filtro = '$filtro_update'
    ";

    $resultado = $conn_atletas->query($updateSQL);

    // Redirecionamento
    $destino = "torneios_lista.php";
    header("Location: $destino");
    exit;
}

// Carregar dados do registro para exibir no formulário
mysqli_select_db($conn_atletas, $database_conn);
$filtro_select = $_GET['id_torneio'];
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
    <title>Torneios Atualiza</title>
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
                <a href="torneios_lista.php">
                    <button class="btn btntotal bg-danger text-white">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualizar Torneios
            </h2>
            <div class="thumbnail">
                <div class="alert alert">
                    <form action="torneios_atualiza.php"
                          enctype="multipart/form-data"
                          method="post"
                          id="form_atualiza_torneio"
                          name="form_atualiza_torneio">

                        <!-- Campo oculto com ID -->
                        <input type="hidden"
                               name="id_torneio"
                               value="<?php echo $row['id_torneio']; ?>">

                        <!-- Tipo -->
                        <label for="tipo_torneio">Tipo do Torneio:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-flag"></span>
                            </span>
                            <input type="text"
                                   name="tipo_torneio"
                                   id="tipo_torneio"
                                   class="form-control"
                                   value="<?php echo $row['tipo_torneio']; ?>"
                                   required>
                        </div>
                        <br>

                        <!-- Descrição -->
                        <label for="descri_torneio">Descrição:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-edit"></span>
                            </span>
                            <input type="text"
                                   name="descri_torneio"
                                   id="descri_torneio"
                                   class="form-control"
                                   value="<?php echo $row['descri_torneio']; ?>"
                                   required>
                        </div>
                        <br>

                        <!-- Imagem atual -->
                        <label>Imagem atual:</label><br>
                        <?php if (!empty($row['img_torneio'])): ?>
                            <img src="../imagens/torneios/<?php echo $row['img_torneio']; ?>"
                                 alt="Imagem atual do torneio"
                                 class="current-image">
                            <br>
                            <small><?php echo $row['img_torneio']; ?></small><br><br>
                        <?php else: ?>
                            <p class="text-warning">Nenhuma imagem cadastrada</p>
                        <?php endif; ?>

                        <!-- Nova imagem com pré-visualização -->
                        <label for="img_torneio">Nova imagem (opcional):</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <img src="#"
                                 alt="Prévia da nova imagem"
                                 id="preview"
                                 class="img-responsive">
                            <input type="file"
                                   name="img_torneio"
                                   id="img_torneio"
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