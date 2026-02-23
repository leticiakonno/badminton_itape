<?php
//Incluir o Sistema de Autenticação
include("acesso_sup.php");

// Conexão
include("../Connections/conn_atletas.php");

$tabela = "tbtorneios";
$campo_filtro = "id_torneio";

if($_POST){     // ATUALIZANDO NO BANCO DE DADOS
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas,$database_conn);


$tipo_torneio       =   $_POST['tipo_torneio'];
$descri_torneio     =   $_POST['descri_torneio'];

$filtro_update      =   $_POST['id_torneio'];

   // *** BUSCAR FOTO ATUAL ***
    $consulta_atual = "SELECT img_torneio FROM $tabela WHERE $campo_filtro = '$filtro_update'";
    $resultado_atual = $conn_atletas->query($consulta_atual);
    $dados_atual = $resultado_atual->fetch_assoc();
    $img_torneio = $dados_atual['img_torneio']; // Mantém foto atual

    // Guardar o nome da imagem no banco e o arquivo no diretório
    if(!empty($_FILES['img_torneio']['name']))   {
        $nomeArquivo = time() . "_" . $_FILES['img_torneio']['name'];
        $tempArquivo = $_FILES['img_torneio']['tmp_name'];
        
        // Criar pasta se não existir
        if (!is_dir('../imagens/torneio/')) {
            mkdir('../imagens/torneio/', 0777, true);
        }
        
        $destino = "../imagens/torneio/" . $nomeArquivo;
        move_uploaded_file($tempArquivo, $destino);
        
        $img_torneio = $nomeArquivo; // Atualiza com nova foto
    }

    // Consulta SQL para ATUALIZAÇÃO dos dados
    $updateSQL  =   "
                    UPDATE ".$tabela."
                        SET tipo_torneio =   '".$tipo_torneio."',
                            descri_torneio         =   '".$descri_torneio."',
                            img_torneio          =   '".$img_torneio."'
                    WHERE ".$campo_filtro." =   '".$filtro_update."';
                    ";
    $resultado  =   $conn_atletas->query($updateSQL);

    // Após a ação a página será redirecionada
    $destino    =   "torneios_lista.php";
        header("Location: $destino");
        exit;
};

// Definir o USE do banco de dados;
mysqli_select_db($conn_atletas,$database_conn);
$filtro_select    =   $_GET['id_torneio'];
$consulta           =   "
                    SELECT *
                    FROM   ".$tabela."
                    WHERE ".$campo_filtro."=".$filtro_select.";
                    ";
$lista          =   $conn_atletas->query($consulta);
$row            =   $lista->fetch_assoc();
$totalRows      =   ($lista)->num_rows;

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
</head>
<body class="fundofixo fontetabela">
<?php include("menu_adm.php"); ?>
    <main class="container">
 <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6" > <!-- abre dimensionamento -->
            <h2 class="breadcrumb fundousuarios text-center titulo">
                <a href="torneios_lista.php">
                    <button class="btn btntotal bg-danger text-white">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualizar Torneios
            </h2>
            <div class="thumbnail"> <!-- abre thumbnail -->
                <div class="alert alert">
                    <form 
                        action="torneios_atualiza.php"
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
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>
<?php mysqli_free_result($lista); ?>