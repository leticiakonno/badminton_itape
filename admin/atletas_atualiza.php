<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Variáveis Globais
$tabela         =   'tbatletas';
$campo_filtro   =   'id_atleta';

if($_POST){     // ATUALIZANDO NO BANCO DE DADOS
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas,$database_conn);

       // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $id_categoria_atleta    =   $_POST['id_categoria_atleta'];
    $nome_atleta            =   $_POST['nome_atleta'];
    $data_nas_atleta        =   $_POST['data_nas_atleta'];
    $data_cad_atleta        =   $_POST['data_cad_atleta'];
    $descri_atleta          =   $_POST['descri_atleta'];
    $destaque_atleta        =   $_POST['destaque_atleta'];

    // Campo para filtrar o registro (WHERE)
    $filtro_update      =   $_POST['id_atleta'];

     // *** BUSCAR FOTO ATUAL ***
    $consulta_atual = "SELECT img_atleta FROM $tabela WHERE $campo_filtro = '$filtro_update'";
    $resultado_atual = $conn_atletas->query($consulta_atual);
    $dados_atual = $resultado_atual->fetch_assoc();
    $img_atleta = $dados_atual['img_atleta']; // Mantém foto atual

    // Guardar o nome da imagem no banco e o arquivo no diretório
    if(!empty($_FILES['img_atleta']['name']))   {
        $nomeArquivo = time() . "_" . $_FILES['img_atleta']['name'];
        $tempArquivo = $_FILES['img_atleta']['tmp_name'];
        
        // Criar pasta se não existir
        if (!is_dir('../imagens/atletas/')) {
            mkdir('../imagens/atletas/', 0777, true);
        }
        
        $destino = "../imagens/atletas/" . $nomeArquivo;
        move_uploaded_file($tempArquivo, $destino);
        
        $foto_usuario = $nomeArquivo; // Atualiza com nova foto
    }
 
    // Consulta SQL para ATUALIZAÇÃO dos dados
    $updateSQL  =   "
                    UPDATE ".$tabela."
                        SET id_categoria_atleta =   '".$id_categoria_atleta."',
                            nome_atleta         =   '".$nome_atleta."',
                            data_nas_atleta     =   '".$data_nas_atleta."',
                            data_cad_atleta     =   '".$data_cad_atleta."',
                            descri_atleta       =   '".$descri_atleta."',
                            img_atleta          =   '".$img_atleta."',
                            destaque_atleta     =   '".$destaque_atleta."'
                    WHERE ".$campo_filtro." =   '".$filtro_update."';
                    ";
    $resultado  =   $conn_atletas->query($updateSQL);

    // Após a ação a página será redirecionada
    $destino    =   "atletas_lista.php";
        header("Location: $destino");
        exit;
};

// Consulta para trazer e filtrar os dados
// Definir o USE do banco de dados;
mysqli_select_db($conn_atletas,$database_conn);
$filtro_select    =   $_GET['id_atleta'];
$consulta           =   "
                    SELECT *
                    FROM   ".$tabela."
                    WHERE ".$campo_filtro."=".$filtro_select.";
                    ";
$lista          =   $conn_atletas->query($consulta);
$row            =   $lista->fetch_assoc();
$totalRows      =   ($lista)->num_rows;

// Selecionar o banco de dados (USE)
mysqli_select_db($conn_atletas,$database_conn);

// Selecionar os dados da chave estrangeira
$tabela_fk      =   "tbcategorias";
$ordenar_por    =   "nome_categoria ASC";
$consulta_fk    =   "
                    SELECT *
                    FROM    ".$tabela_fk."
                    ORDER BY ".$ordenar_por.";
                    ";
$lista_fk       =   $conn_atletas->query($consulta_fk);
$row_fk         =   $lista_fk->fetch_assoc();
$totalRows_fk   =   ($lista_fk)->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atletas Atualiza</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<?php include("menu_adm.php"); ?>
    <main class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6" > <!-- abre dimensionamento -->
            <h2 class="fundocategoria text-center titulo">
                <a href="atletas_lista.php">
                    <button class="btn btntotal">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualiza Atleta
            </h2>
             <div class="thumbnail">
                <div class="alert alert">
                    <form 
                        action="atletas_atualiza.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_atualiza_atletas"
                        name="form_atualiza_atletas"
                    >
                        <!-- Inserir campo id_atleta OCULTO para uso em filtro -->
                        <input 
                            type="hidden"
                            name="id_atleta"
                            id="id_atleta"
                            value="<?php echo $row['id_atleta']; ?>"
                        >
                         <!-- Select id_tipo_produto -->
                        <label for="id_categoria_atleta">Categoria:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-flag"></span>
                            </span>
                            <!-- select>option*2 -->
                            <select 
                                name="id_categoria_atleta" 
                                id="id_categoria_atleta"
                                class="form-control"
                                required
                            >
                        <!-- Abre estrutura de repetição -->
                                <?php do{ ?>
                                    <option value="<?php echo $row_fk['id_categoria']; ?>"
                                        <?php 
                                            if(!(strcmp($row_fk['id_categoria'],$row['id_categoria_atleta']))){
                                                echo "selected=\"selected\"";
                                            }
                                        ?>
                                    >
                                        <?php echo $row_fk['nome_categoria']; ?> 
                                    </option>
                                <?php }while($row_fk=$lista_fk->fetch_assoc()); ?>
                                <!-- Fecha estrutura de repetição -->
                            </select>
                        </div> <!-- fecha input-group -->
                        <br>

                    <!-- text nome_atleta -->
                    <label for="nome_atleta">Nome:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input 
                                type="text" 
                                name="nome_atleta" 
                                id="nome_atleta"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                value="<?php echo $row['nome_atleta']; ?>"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text nome_atleta -->
                        <br>

                        
                        <!-- text data_nas_atleta -->
                        <label for="data_nas_atleta">Data de Nascimento:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input 
                                type="date" 
                                name="data_nas_atleta" 
                                id="data_nas_atleta"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                value="<?php echo $row['data_nas_atleta']; ?>"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text data_nas_atleta -->
                        <br>

                        <!-- text data_nas_atleta -->
                        <label for="data_cad_atleta">Data de Cadastro:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input 
                                type="date" 
                                name="data_cad_atleta" 
                                id="data_cad_atleta"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                value="<?php echo $row['data_cad_atleta']; ?>"                               
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text data_cad_atleta -->
                        <br>

                        <!-- radio destaque_atleta -->
                        <label for="destaque_atleta">Destaque?</label>
                        <div class="input-group">
                            <label 
                                for="destaque_atleta_s"
                                class="radio-inline"
                            >
                                <input 
                                    type="radio"
                                    name="destaque_atleta"
                                    id="destaque_atleta"
                                    value="Sim"
                                    <?php echo $row['destaque_atleta']=="Sim" ? "checked" : null; ?>
                                >
                                Sim
                            </label>
                            <label 
                                for="destaque_atleta_n"
                                class="radio-inline"
                            >
                                <input 
                                    type="radio"
                                    name="destaque_atleta"
                                    id="destaque_atleta"
                                    value="Não"
                                    <?php echo $row['destaque_atleta']=="Não" ? "checked" : null; ?>
                                >
                                Não
                            </label>
                        </div> <!-- fecha input-group -->
                        <!-- fecha radio destaque_atleta -->
                        <br>

                        <!-- textarea descri_atleta -->
                        <label for="descri_atleta">Descrição:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-list-alt"></span>
                            </span>
                            <textarea 
                                name="descri_atleta" 
                                id="descri_atleta"
                                class="form-control"
                                placeholder="Digite a descrição da atleta."
                                cols="30"
                                rows="8"
                            ><?php echo $row['descri_atleta']; ?></textarea>
                        </div> <!-- fecha input-group -->
                        <!-- fecha textarea descri_atleta -->
                        <br>

                        <!-- Dados da imagem_produto ATUAL -->                        
                        <label for="">Imagem ATUAL:</label>
                        <br>
                        <img 
                            src="../imagens/<?php echo $row['img_atleta']; ?>" 
                            alt=""
                            class="img_responsive"
                            style="max-width:40%"
                        >
                        <br>

                        <!-- type="hidden" campo oculto somente para guardar dados -->
                        <!-- guardamos o nome da imagem caso não seja alterada -->
                        <input 
                            type="hidden"
                            name="img_atleta_atual"
                            id="img_atleta_atual"
                            value="<?php echo $row['img_atleta']; ?>"
                        >
                        <br>

                        <!-- file imagem_produto -->
                        <label for="img_atleta">NOVA Imagem:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <!-- Exibir a imagem a ser inserida -->
                            <img 
                                src="" 
                                alt=""
                                name="imagem"
                                id="imagem"
                                class="img-responsive"
                                style="max-height: 150px;"
                            >
                            <input 
                                type="file" 
                                name="imagem_produto" 
                                id="imagem_produto"
                                class="form-control"
                                accept="image/*"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha file imagem_produto -->
                        <br>

                         <!-- btn enviar -->
                        <input 
                            type="submit" 
                            value="Atualizar"
                            name="enviar"
                            id="enviar"
                            role="button"
                            class="btn btntotal btn-block"
                        >
                    </form>
                </div> <!-- fecha alert alert-warning  -->
            </div> <!-- thumbnail -->
        </div> <!-- dimensionamento -->
    </div> <!-- fecha row -->
</main>

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>
<?php mysqli_free_result($lista); ?>