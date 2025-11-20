<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_produtos.php");

// Variáveis Globais
$tabela         =   "tbusuarios";
$campo_filtro   =   "id_usuario";

// Primeiro, precisamos carregar os dados do usuário ANTES do POST  
// para recuperar nome da foto atual caso não seja trocada
if (isset($_GET['id_usuario'])) {
    mysqli_select_db($conn_produtos, $database_conn);
    $filtro_select  =   $_GET['id_usuario'];
    $consulta       =   "
                        SELECT *
                        FROM    ".$tabela."
                        WHERE   ".$campo_filtro."=".$filtro_select.";
                        ";
    $lista          =   $conn_produtos->query($consulta);
    $row            =   $lista->fetch_assoc();
}

// Se o formulário foi enviado
if($_POST){

    mysqli_select_db($conn_produtos,$database_conn);

    // Receber os dados do formulário
    $login_usuario    =   $_POST['login_usuario'];
    $senha_usuario    =   $_POST['senha_usuario'];
    $nivel_usuario    =   $_POST['nivel_usuario'];

    // Campo para filtrar o registro
    $filtro_update  =   $_POST['id_usuario'];

    // FOTO DO USUÁRIO --------------------------
    $foto_usuario = $row['foto_usuario']; // mantém a foto atual caso não troque

    // Se o usuário enviou uma nova foto
    if (!empty($_FILES['foto_usuario']['name'])) {

        $nomeArquivo = $_FILES['foto_usuario']['name'];
        $tempArquivo = $_FILES['foto_usuario']['tmp_name'];
        $destino = "../imagens/usuarios/" . $nomeArquivo;

        move_uploaded_file($tempArquivo, $destino);

        $foto_usuario = $nomeArquivo; 
    }
    // ------------------------------------------

    // Consulta SQL para ATUALIZAÇÃO dos dados
    $updateSQL  =   "
                    UPDATE ".$tabela."
                        SET login_usuario  = '".$login_usuario."'   ,
                            senha_usuario  = '".$senha_usuario."'    ,
                            nivel_usuario  = '".$nivel_usuario."'   ,
                            foto_usuario   = '".$foto_usuario."'
                    WHERE ".$campo_filtro."='".$filtro_update."';
                    ";
    $resultado  =   $conn_produtos->query($updateSQL);

    // Redirecionamento
    $destino    =   "usuarios_lista.php";
    header("Location: $destino");
    exit;
}

// Contar linhas (mantido do seu código)
$totalRows = ($lista)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Atualiza</title>
      <!-- Link CSS do Bootstrap -->
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <!-- Link para CSS Específico -->
      <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">

<main class="container">
    <div>
        <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
            <h2 class="breadcrumb text-info">
                <a href="usuarios_lista.php">
                    <button class="btn btn-info">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualiza Usuários
            </h2>
            <div class="thumbnail">
                <div class="alert alert-info" role="alert">

                    <form 
                        action="usuarios_atualiza.php?id_usuario=<?php echo $row['id_usuario']; ?>"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_usuario_atualiza"
                        name="form_usuario.atualiza"
                    >

                        <!-- id_usuario oculto -->
                        <input
                            type="hidden"
                            name="id_usuario"
                            id="id_usuario"
                            value="<?php echo $row['id_usuario']; ?>"
                        >

                        <!-- login -->
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
                                maxlength="30"
                                required
                                value="<?php echo $row['login_usuario']; ?>"
                            >
                        </div>
                        <br>

                        <!-- senha -->
                        <label for="senha_usuario">Senha: </label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-qrcode"></span>
                            </span>
                            <input 
                                type="password" 
                                name="senha_usuario" 
                                id="senha_usuario"
                                class="form-control"
                                maxlength="8"
                                required
                                value="<?php echo $row['senha_usuario']; ?>"
                            >
                        </div>
                        <br>

                        <!-- nível -->
                        <label for="nivel_usuario_c">Nível do usuário?</label>
                        <div class="input-group">
                            <label class="radio-inline">
                                <input 
                                    type="radio"
                                    name="nivel_usuario"
                                    value="com"
                                    <?php echo $row['nivel_usuario']=="com" ? "checked" : null; ?>
                                >   Comum
                            </label>
                            <label class="radio-inline">
                                <input 
                                    type="radio"
                                    name="nivel_usuario"
                                    value="sup"
                                    <?php echo $row['nivel_usuario']=="sup" ? "checked" : null; ?>
                                > Supervisor
                            </label>
                        </div>

                        <br>

                        <!-- FOTO DO USUÁRIO -->
                        <label for="foto_usuario">Foto do usuário:</label>
                        <input 
                            type="file"
                            name="foto_usuario"
                            id="foto_usuario"
                            class="form-control"
                            accept="image/*"
                        >

                        <!-- exibe foto atual -->
                        <br>
                        <img 
                            src="../imagens/usuarios/<?php echo $row['foto_usuario']; ?>" 
                            width="80"
                            style="border-radius:50%; object-fit:cover;"
                        >
                        <br><br>

                        <!-- botão -->
                        <input 
                            type="submit" 
                            value="Atualizar"
                            name="enviar"
                            id="enviar"
                            class="btn btn-info btn-block"
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
