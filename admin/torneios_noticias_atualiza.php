<?php
// Conexão
include("../Connections/conn_atletas.php");

$tabela = "tb_torneios_noticias";
$campo_filtro = "id_noticia_torneio";

if($_POST){     // ATUALIZANDO NO BANCO DE DADOS
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas,$database_conn);

    $titulo   = $_POST['titulo'];
    $resumo   = $_POST['resumo'];
    $conteudo = $_POST['conteudo'];
    $categoria = $_POST['categoria'];
    $status   = $_POST['status'];
    
    $filtro_update = $_POST['id_noticia_torneio'];

    // *** BUSCAR IMAGEM ATUAL ***
    $consulta_atual = "SELECT imagem FROM $tabela WHERE $campo_filtro = '$filtro_update'";
    $resultado_atual = $conn_atletas->query($consulta_atual);
    $dados_atual = $resultado_atual->fetch_assoc();
    $imagem = $dados_atual['imagem']; // Mantém imagem atual

    // Guardar o nome da imagem no banco e o arquivo no diretório
    if(!empty($_FILES['imagem']['name']))   {
        $nomeArquivo = time() . "_" . $_FILES['imagem']['name'];
        $tempArquivo = $_FILES['imagem']['tmp_name'];
        
        // Criar pasta se não existir
        if (!is_dir('../imagens/noticias/')) {
            mkdir('../imagens/noticias/', 0777, true);
        }
        
        $destino = "../imagens/noticias/" . $nomeArquivo;
        
        // Excluir imagem antiga se existir
        if (!empty($imagem) && file_exists("../imagens/noticias/" . $imagem)) {
            unlink("../imagens/noticias/" . $imagem);
        }
        
        move_uploaded_file($tempArquivo, $destino);
        
        $imagem = $nomeArquivo; // Atualiza com nova imagem
    }

    // Consulta SQL para ATUALIZAÇÃO dos dados
    $updateSQL  =   "
                    UPDATE ".$tabela."
                        SET titulo =   '".$titulo."',
                            resumo =   '".$resumo."',
                            conteudo = '".$conteudo."',
                            categoria = '".$categoria."',
                            imagem =   '".$imagem."',
                            status =   '".$status."'
                    WHERE ".$campo_filtro." =   '".$filtro_update."';
                    ";
    $resultado  =   $conn_atletas->query($updateSQL);

    // Após a ação a página será redirecionada
    $destino    =   "torneios_noticias_lista.php";
        header("Location: $destino");
        exit;
};

// Definir o USE do banco de dados;
mysqli_select_db($conn_atletas,$database_conn);
$filtro_select    =   $_GET['id_noticia_torneio'];
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
    <title>Atualizar Notícia de Torneio</title>
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
                <a href="torneios_noticias_lista.php">
                    <button class="btn btntotal bg-danger text-white">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualizar Notícia de Torneio
            </h2>
            <div class="thumbnail"> <!-- abre thumbnail -->
                <div class="alert alert">
                    <form 
                        action="torneios_noticias_atualiza.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_atualiza_noticia"
                        name="form_atualiza_noticia"
                    >

                            <!-- Título -->
                            <label>Título da Notícia:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-font"></span>
                                </span>
                                <input type="text" name="titulo" class="form-control"
                                       value="<?php echo $row['titulo']; ?>" required maxlength="255">
                            </div>
                            <br>

                            <!-- Resumo -->
                            <label>Resumo:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-align-left"></span>
                                </span>
                                <textarea name="resumo" class="form-control" rows="3" maxlength="300"><?php echo $row['resumo']; ?></textarea>
                            </div>
                            <br>

                            <!-- Conteúdo -->
                            <label>Conteúdo:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </span>
                                <textarea name="conteudo" class="form-control" rows="6" required><?php echo $row['conteudo']; ?></textarea>
                            </div>
                            <br>

                            <!-- Categoria -->
                            <label>Categoria:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-tags"></span>
                                </span>
                                <select name="categoria" class="form-control" required>
                                    <option value="">Selecione</option>
                                    <option value="regional" <?php echo ($row['categoria'] == 'regional') ? 'selected' : ''; ?>>Regional</option>
                                    <option value="estadual" <?php echo ($row['categoria'] == 'estadual') ? 'selected' : ''; ?>>Estadual</option>
                                    <option value="nacional" <?php echo ($row['categoria'] == 'nacional') ? 'selected' : ''; ?>>Nacional</option>
                                    <option value="internacional" <?php echo ($row['categoria'] == 'internacional') ? 'selected' : ''; ?>>Internacional</option>
                                </select>
                            </div>
                            <br>

                            <!-- Status -->
                            <label>Status:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-ok-circle"></span>
                                </span>
                                <select name="status" class="form-control">
                                    <option value="ativo" <?php echo ($row['status'] == 'ativo') ? 'selected' : ''; ?>>Ativo</option>
                                    <option value="inativo" <?php echo ($row['status'] == 'inativo') ? 'selected' : ''; ?>>Inativo</option>
                                </select>
                            </div>
                            <br>

                            <!-- Foto -->
                            <label>Imagem da Notícia:</label><br>
                            <?php if (!empty($row['imagem'])): 
                                // Verifica se o caminho da imagem já tem o diretório
                                $imagem_path = $row['imagem'];
                                if (strpos($imagem_path, 'imagens/noticias/') === false && strpos($imagem_path, '../') === false) {
                                    $imagem_path = "../imagens/noticias/" . $imagem_path;
                                }
                            ?>
                                <img src="<?php echo $imagem_path; ?>" 
                                     alt="<?php echo $row['titulo']; ?>" 
                                     class="img-responsive"
                                     style="max-height: 150px; margin-bottom: 10px;"><br>
                                <small>Imagem atual: <?php echo $row['imagem']; ?></small><br><br>
                            <?php else: ?>
                                <p class="text-warning">Nenhuma imagem cadastrada</p>
                            <?php endif; ?>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-picture"></span>
                                </span>
                                <input type="file" name="imagem" class="form-control" accept="image/*">
                            </div>
                            <br>

                            <!-- Campo oculto para o ID -->
                            <input type="hidden" name="id_noticia_torneio" value="<?php echo $row['id_noticia_torneio']; ?>">

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