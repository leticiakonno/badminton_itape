<?php
// Conexão
include("../Connections/conn_atletas.php");

$tabela = "tbtorneios";
$campo_filtro = "id_torneio";

// 1) VALIDAR SE TEM ID NA URL
if (!isset($_GET['id_torneio'])) {
    die("Erro: ID do torneio não informado!");
}

$id = intval($_GET['id_torneio']);

mysqli_select_db($conn_atletas, $database_conn);

// 2) CARREGAR DADOS DO TORNEIO
$consulta = "
    SELECT *
    FROM $tabela
    WHERE $campo_filtro = $id
";

$lista = $conn_atletas->query($consulta);
$row = $lista->fetch_assoc();

// Se não achou o torneio
if (!$row) {
    die("Erro: Torneio não encontrado.");
}

// 3) PROCESSAR UPDATE QUANDO ENVIAR O FORMULÁRIO
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tipo_torneio   = $_POST['tipo_torneio'];
    $descri_torneio = $_POST['descri_torneio'];
    $img_torneio    = $row['img_torneio']; // mantém foto atual

    // Se enviou nova imagem
    if (!empty($_FILES['img_torneio']['name'])) {

        $nomeArquivo = time() . "_" . $_FILES['img_torneio']['name'];
        $tempArquivo = $_FILES['img_torneio']['tmp_name'];
        $destino     = "../imagens/" . $nomeArquivo;

        move_uploaded_file($tempArquivo, $destino);

        $img_torneio = $nomeArquivo;
    }

    // UPDATE
    $updateSQL = "
        UPDATE $tabela SET
            tipo_torneio = '$tipo_torneio',
            descri_torneio = '$descri_torneio',
            img_torneio = '$img_torneio'
        WHERE $campo_filtro = $id
    ";

    // DEBUG - REMOVA DEPOIS
    // echo "<pre>SQL: $updateSQL</pre>";
    // exit();

    $resultado = $conn_atletas->query($updateSQL);

    if ($resultado) {
        header("Location: torneios_lista.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . $conn_atletas->error;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneios Atualiza</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
                <h2 class="fundocategoria text-center">
                    <a href="torneios_lista.php">
                        <button class="btn btnseta">
                            <span class="glyphicon glyphicon-chevron-left"></span>  
                        </button>
                    </a><strong><i>Atualizar Torneio</i></strong>
                </h2>
                <br>
                <div class="thumbnail">
                    <div class="alert alert">
                        <!-- FORMULÁRIO CORRETO: -->
                        <form 
                            action="torneios_atualiza.php?id_torneio=<?php echo $id; ?>"
                            enctype="multipart/form-data"
                            method="post"
                            id="form_atualiza_torneio"
                            name="form_atualiza_torneio"
                        >

                            <!-- Tipo -->
                            <label>Tipo do Torneio:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-flag"></span>
                                </span>
                                <input type="text" name="tipo_torneio" class="form-control"
                                       value="<?php echo $row['tipo_torneio']; ?>" required>
                            </div>
                            <br>

                            <!-- Descrição -->
                            <label>Descrição:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </span>
                                <input type="text" name="descri_torneio" class="form-control"
                                       value="<?php echo $row['descri_torneio']; ?>" required>
                            </div>
                            <br>

                            <!-- Foto -->
                            <label>Imagem do Torneio:</label><br>
                            <?php if (!empty($row['img_torneio'])): ?>
                                <img src="../imagens/<?php echo $row['img_torneio']; ?>" 
                                     alt="<?php echo $row['tipo_torneio']; ?>" 
                                     class="img-responsive"
                                     style="max-height: 150px; margin-bottom: 10px;"><br>
                                <small>Imagem atual: <?php echo $row['img_torneio']; ?></small><br><br>
                            <?php else: ?>
                                <p class="text-warning">Nenhuma imagem cadastrada</p>
                            <?php endif; ?>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-picture"></span>
                                </span>
                                <input type="file" name="img_torneio" class="form-control">
                            </div>
                            <br>

                            <!-- Botão -->
                            <input 
                                type="submit" 
                                value="Atualizar"
                                name="enviar"
                                id="enviar"
                                role="button"
                                class="btn btntotal btn-block"
                            >

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>

<?php mysqli_free_result($lista); ?>