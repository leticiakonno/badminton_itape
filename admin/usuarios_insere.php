<?php
// Incluindo o sistema de identificação
include("acesso_sup.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if($_POST){

    // RECEBE DADOS
    $login_usuario  = $_POST['login_usuario'];
    $senha_usuario  = $_POST['senha_usuario'];
    $nivel_usuario  = $_POST['nivel_usuario'];

    // ==============================================
    // UPLOAD DA IMAGEM
    // ==============================================
    $foto_usuario = ""; // variavel que VAI para o banco!

    if(isset($_FILES['foto_usuario']) && $_FILES['foto_usuario']['error'] == 0){

        $foto_usuario = $_FILES['foto_usuario']['name'];
        $tmp_img      = $_FILES['foto_usuario']['tmp_name'];

        // Caminho final
        $destino      = "../imagens/" . $foto_usuario;

        // Move arquivo
        move_uploaded_file($tmp_img, $destino);
    }

    // ==============================================
    // INSERT
    // ==============================================

    $sql = "
        INSERT INTO tbusuarios
            (login_usuario, senha_usuario, nivel_usuario, foto_usuario)
        VALUES
            ('$login_usuario', '$senha_usuario', '$nivel_usuario', '$foto_usuario')
    ";

    $conn_atletas->query($sql);

    header("Location: usuarios_lista.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Insere</title>
    <script src="https://kit.fontawesome.com/d03c290dd3.js" crossorigin="anonymous"></script>
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
                <a href="usuarios_lista.php">
                    <button class="btn btntotal bg-danger text-white">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Inserir Usuários
            </h2>
            <div class="thumbnail"> <!-- abre thumbnail -->
                <div class="alert alert">
                    <form 
                        action="usuarios_insere.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_insere_usuario"
                        name="form_insere_usuario"
                    >
                    
                       <!-- file img_atleta -->
                    <label for="foto_usuario">Imagem:</label>
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
                                name="foto_usuario" 
                                id="foto_usuario"
                                class="form-control"
                                accept="image/*"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha file imagem_produto -->
                        <br>

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
                                maxlength="30"
                                required
                            >
                        </div>
                        <br>

                        <!-- text senha_usuario -->
                        <label for="senha_usuario">Senha: </label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-qrcode"></span>
                            </span>
                            <input 
                                type="password" 
                                name="senha_usuario" 
                                id="descri_produto"
                                class="form-control"
                                placeholder="Digite a senha desejada."
                                maxlength="8"
                                required
                            >
                        </div>
                        <br>

                        <!-- radio nivel_usuario -->
                        <label for="nivel_usuario_c">Nível do usuário?</label>
                        <div class="input-group">
                            <label for="nivel_usuario_c" class="radio-inline">
                                <input 
                                    type="radio"
                                    name="nivel_usuario"
                                    id="nivel_usuario"
                                    value="com"
                                    checked
                                >
                                Comum
                            </label>
                            <label for="nivel_usuario_s" class="radio-inline">
                                <input 
                                    type="radio"
                                    name="nivel_usuario"
                                    id="nivel_usuario"
                                    value="sup"
                                >
                                Supervisor
                            </label>
                        </div>
                        <br>

                      
                         <!-- btn enviar -->
                         <input 
                            type="submit" 
                            value="Cadastrar"
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
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>
