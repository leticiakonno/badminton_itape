<?php
// Incluir o Sistema de Autenticação
include("acesso_sup.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Variáveis Globais
$tabela         = "tbparceiros";
$campo_filtro   = "id_parceiro";

// Se o formulário foi enviado
if ($_POST) {
    mysqli_select_db($conn_atletas, $database_conn);

    // Receber os dados do formulário
    $nome_parceiro   = $_POST['nome_parceiro'];
    $descri_parceiro = $_POST['descri_parceiro'];
    $filtro_update   = $_POST['id_parceiro'];

    // Buscar imagem atual
    $consulta_atual = "SELECT img_parceiro FROM $tabela WHERE $campo_filtro = '$filtro_update'";
    $resultado_atual = $conn_atletas->query($consulta_atual);
    $dados_atual = $resultado_atual->fetch_assoc();
    $img_parceiro = $dados_atual['img_parceiro']; // Mantém imagem atual

    // Se o usuário enviou uma nova imagem
    if (!empty($_FILES['img_parceiro']['name'])) {
        $nomeArquivo = time() . "_" . $_FILES['img_parceiro']['name'];
        $tempArquivo = $_FILES['img_parceiro']['tmp_name'];

        // Criar pasta se não existir
        if (!is_dir('../imagens/apoiadores/')) {
            mkdir('../imagens/apoiadores/', 0777, true);
        }

        $destino = "../imagens/apoiadores/" . $nomeArquivo;

        // Excluir imagem antiga se existir
        if (!empty($img_parceiro) && file_exists("../imagens/apoiadores/" . $img_parceiro)) {
            unlink("../imagens/apoiadores/" . $img_parceiro);
        }

        if (move_uploaded_file($tempArquivo, $destino)) {
            $img_parceiro = $nomeArquivo; // Atualiza com nova imagem
        }
    }

    // Consulta SQL para ATUALIZAÇÃO dos dados
    $updateSQL = "
        UPDATE $tabela
        SET nome_parceiro = '$nome_parceiro',
            descri_parceiro = '$descri_parceiro',
            img_parceiro = '$img_parceiro'
        WHERE $campo_filtro = '$filtro_update'
    ";

    $resultado = $conn_atletas->query($updateSQL);

    // Redirecionamento
    $destino = "parceiros_lista.php";
    header("Location: $destino");
    exit;
}

// Carregar dados do registro para exibir no formulário
mysqli_select_db($conn_atletas, $database_conn);
$filtro_select = $_GET['id_parceiro'];
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
    <title>Atualiza Parceiros</title>
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
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
            <h2 class="fundoatletas text-center titulo">
                <a href="parceiros_lista.php">
                    <button class="btn btntotal">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualiza Parceiros
            </h2>
            <br>
            <div class="thumbnail">
                <div class="alert" role="alert">
                    <form action="parceiros_atualiza.php"
                          enctype="multipart/form-data"
                          method="post"
                          id="form_parceiro_atualiza"
                          name="form_parceiro_atualiza">

                        <!-- id_parceiro oculto -->
                        <input type="hidden"
                               name="id_parceiro"
                               id="id_parceiro"
                               value="<?php echo $row['id_parceiro']; ?>">

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
                                   value="<?php echo $row['nome_parceiro']; ?>">
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
                                      rows="8"><?php echo $row['descri_parceiro']; ?></textarea>
                        </div>
                        <br>

                        <!-- Imagem atual -->
                        <label>Imagem atual:</label><br>
                        <?php if (!empty($row['img_parceiro'])): ?>
                            <img src="../imagens/apoiadores/<?php echo $row['img_parceiro']; ?>"
                                 alt="Imagem atual"
                                 class="current-image">
                            <br>
                            <small><?php echo $row['img_parceiro']; ?></small><br><br>
                        <?php else: ?>
                            <p class="text-warning">Nenhuma imagem cadastrada</p>
                        <?php endif; ?>

                        <!-- Nova imagem com pré-visualização -->
                        <label for="img_parceiro">Nova imagem (opcional):</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <img src="#"
                                 alt="Prévia da nova imagem"
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