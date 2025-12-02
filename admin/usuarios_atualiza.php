<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

//Variaveis globais
$tabela = 'tbusuarios';
$campo_filtro = 'id_usuario';

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas,$database_conn);

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
        move_uploaded_file($tempArquivo, $destino);
        
        $foto_usuario = $nomeArquivo; // Atualiza com nova foto
    }

    // *** CONSULTA SQL CORRIGIDA - SEM VÍRGULA ANTES DO WHERE ***
    $updateSQL = "
        UPDATE $tabela 
        SET login_usuario = '$login_usuario',
            senha_usuario = '$senha_usuario',
            nivel_usuario = '$nivel_usuario',
            foto_usuario = '$foto_usuario'
        WHERE $campo_filtro = '$filtro_update';
    ";
    
    // DEBUG - Remova depois de testar
    // echo "<pre>SQL: " . htmlspecialchars($updateSQL) . "</pre>";
    // exit();
    
    $resultado = $conn_atletas->query($updateSQL);

    // Após a ação a página será redirecionada
    $destino = "usuarios_lista.php";
    header("Location: $destino");
    exit;
}

// Consulta para trazer e filtrar os dados
mysqli_select_db($conn_atletas,$database_conn);

$filtro_select = $_GET['id_usuario'];
$consulta = "
    SELECT *
    FROM $tabela
    WHERE $campo_filtro = $filtro_select;
";
$lista = $conn_atletas->query($consulta);
$row = $lista->fetch_assoc();
$totalRows = ($lista)->num_rows;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualiza Usuários</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
                <h2 class="fundoparceiro text-center">
                    <a href="usuarios_lista.php">
                        <button class="btn btnseta">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    <strong><i>Atualiza Usuários</i></strong>
                </h2>
                <br>
                <div class="thumbnail">
                    <div class="alert" role="alert">
                        <form 
                            action="usuarios_atualiza.php?id_usuario=<?php echo $row['id_usuario']; ?>"
                            enctype="multipart/form-data"
                            method="post"
                            id="form_usuario_atualiza"
                            name="form_usuario_atualiza"
                        >
                            <!-- Inserir campo id_usuario OCULTO para uso em filtro -->
                            <input 
                                type="hidden"
                                name="id_usuario"
                                id="id_usuario"
                                value="<?php echo $row['id_usuario']; ?>"
                            >
                            
                            <!-- text login_usuario -->
                            <label for="login_usuario">Login:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input 
                                    type="text" 
                                    name="login_usuario" 
                                    id="login_usuario"
                                    class="form-control"
                                    placeholder="Digite o seu login."
                                    maxlength="100"
                                    required
                                    value="<?php echo $row['login_usuario']; ?>"
                                >
                            </div>
                            <br>

                            <!-- text senha_usuario -->
                            <label for="senha_usuario">Senha:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-qrcode"></span>
                                </span>
                                <input 
                                    type="password" 
                                    name="senha_usuario" 
                                    id="senha_usuario"
                                    class="form-control"
                                    placeholder="Digite a senha desejada."
                                    maxlength="100"
                                    required
                                    value="<?php echo $row['senha_usuario']; ?>"
                                >
                            </div>
                            <br>

                            <!-- radio nivel_usuario -->
                            <label for="nivel_usuario">Nível do usuário</label>
                            <div class="input-group">
                                <label for="nivel_usuario_c" class="radio-inline">
                                    <input 
                                        type="radio"
                                        name="nivel_usuario"
                                        id="nivel_usuario_c"
                                        value="com"
                                        <?php echo $row['nivel_usuario']=="com" ? "checked" : null; ?>
                                    >
                                    Comum
                                </label>
                                <label for="nivel_usuario_s" class="radio-inline">
                                    <input 
                                        type="radio"
                                        name="nivel_usuario"
                                        id="nivel_usuario_s"
                                        value="sup"
                                        <?php echo $row['nivel_usuario']=="sup" ? "checked" : null; ?>
                                    >
                                    Supervisor
                                </label>
                            </div>
                            <br>

                            <!-- FOTO DO USUÁRIO -->
                            <label for="foto_usuario">Foto atual:</label><br>
                            <?php if(!empty($row['foto_usuario'])): ?>
                                <img 
                                    src="../imagens/usuarios/<?php echo $row['foto_usuario']; ?>" 
                                    width="100"
                                    style="border-radius:100%; object-fit:cover; margin-bottom:10px;"
                                ><br>
                                <small><?php echo $row['foto_usuario']; ?></small>
                            <?php else: ?>
                                <p class="text-warning">Nenhuma foto cadastrada</p>
                            <?php endif; ?>
                            <br>

                            <label for="foto_usuario">Nova foto (opcional):</label>
                            <input 
                                type="file"
                                name="foto_usuario"
                                id="foto_usuario"
                                class="form-control"
                                accept="image/*"
                            >
                            <br>

                            <!-- btn enviar -->
                            <input 
                                type="submit" 
                                value="Atualizar"
                                name="enviar"
                                id="enviar"
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