<?php
//Incluir o Sistema de Autenticação
include("acesso_com.php");

// Conexão
include("../Connections/conn_atletas.php");

$tabela = "tbtecnicos";
$campo_filtro = "id_tecnico";

// 1) VALIDAR SE TEM ID NA URL
if (!isset($_GET['id_tecnico'])) {
    die("Erro: ID do tecnico não informado!");
}

$id = intval($_GET['id_tecnico']);

mysqli_select_db($conn_atletas, $database_conn);

// 2) CARREGAR DADOS DO tecnico
$consulta = "
    SELECT *
    FROM $tabela
    WHERE $campo_filtro = $id
";

$lista = $conn_atletas->query($consulta);
$row = $lista->fetch_assoc();

// Se não achou o tecnico
if (!$row) {
    die("Erro: tecnico não encontrado.");
}

// 3) PROCESSAR UPDATE QUANDO ENVIAR O FORMULÁRIO
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome_tecnico   = $_POST['nome_tecnico'];
    $nivel_tecnico  = $_POST['nivel_tecnico'];
    $descri_tecnico = $_POST['descri_tecnico'];
    $img_tecnico    = $row['img_tecnico']; // mantém foto atual

    // Se enviou nova imagem
    if (!empty($_FILES['img_tecnico']['name'])) {

        $nomeArquivo = time() . "_" . $_FILES['img_tecnico']['name'];
        $tempArquivo = $_FILES['img_tecnico']['tmp_name'];
        $destino     = "../imagens/tecnicos/" . $nomeArquivo;

        move_uploaded_file($tempArquivo, $destino);

        $img_tecnico = $nomeArquivo;
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
</head>
<body class="fundofixo fontetabela">
<?php include("menu_adm.php"); ?>
    <main class="container">
 <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6" > <!-- abre dimensionamento -->
            <h2 class="breadcrumb fundousuarios text-center titulo">
                <a href="tecnicos_lista.php">
                    <button class="btn btntotal bg-danger text-white">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualizar Técnicos
            </h2>
            <div class="thumbnail"> <!-- abre thumbnail -->
                <div class="alert alert">
                    <form 
                        action="tecnicos_atualiza.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_atualiza_tecnico"
                        name="form_atualiza_tecnico"
                    >
            <!-- text nome_tecnico -->
            <label for="nome_tecnico">Nome:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <input 
                                type="text" 
                                name="nome_tecnico" 
                                id="nome_tecnico"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                placeholder="Digite o nome do tecnico."
                                value="<?php echo $row['nome_tecnico']; ?>"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text nome_tecnico -->
                        <br>
            
             <!-- text nivel_tecnico -->
             <label for="nivel_tecnico">Nivel:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <input 
                                type="text" 
                                name="nivel_tecnico" 
                                id="nivel_tecnico"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                placeholder="Digite o nivel do tecnico."
                                value="<?php echo $row['nivel_tecnico']; ?>"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text nivel_tecnico -->
                        <br>

            <!-- textarea descri_tecnico -->
            <label for="descri_tecnico">Descrição do técnico:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-align-justify"></span>
                            </span>
                            <textarea 
                                name="descri_tecnico" 
                                id="descri_tecnico"
                                class="form-control"
                                placeholder="Digite a descrição do técnico."
                                cols="30"
                                rows="8"
                            ><?php echo $row['descri_tecnico']; ?></textarea>
                        </div> <!-- fecha input-group -->
                        <!-- fecha textarea descri_parceira -->
                        <br>

              <!-- file img_tecnico -->
              <label for="img_tecnico">Imagem Atual:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <!-- Exibir a imagem atual do banco -->
                            <?php if(!empty($row['img_tecnico'])): ?>
                            <img 
                                src="../imagens/tecnicos/<?php echo $row['img_tecnico']; ?>" 
                                alt="Imagem atual do técnico"
                                name="imagem_atual"
                                id="imagem_atual"
                                class="img-responsive"
                                style="max-height: 150px;"
                            >
                            <?php else: ?>
                            <p class="text-muted">Nenhuma imagem cadastrada</p>
                            <?php endif; ?>
                        </div>
                        
                        <label for="img_tecnico">Nova Imagem (opcional):</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-upload"></span>
                            </span>
                            <input 
                                type="file" 
                                name="img_tecnico" 
                                id="img_tecnico"
                                class="form-control"
                                accept="image/*"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha file imagem_produto -->
                        <br>

                        <!-- btn enviar -->
                        <input 
                            type="submit" 
                            value="Salvar Alterações"
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