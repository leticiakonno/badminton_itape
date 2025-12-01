<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if($_POST){
    // Selecionar o banco de dados
    mysqli_select_db($conn_atletas,$database_conn);

    // Variáveis
    $tabela_insert  = "tbusuarios";
    $campos_insert  = "
                        login_usuario,
                        senha_usuario,
                        nivel_usuario,
                        foto_usuario
                       ";

    // Receber valores normais
    $login_usuario  = $_POST['login_usuario'];
    $senha_usuario  = $_POST['senha_usuario'];
    $nivel_usuario  = $_POST['nivel_usuario'];

    // ------------------------------------------------------------------------------------
    // UPLOAD DA IMAGEM
    // ------------------------------------------------------------------------------------

   // Guardar o nome da imagem no banco e o arquivo no diretório
   if(isset($_POST['enviar'])){
    $nome_img   =   $_FILES['foto_usuario']['name'];
    $tmp_img    =   $_FILES['foto_usuario']['tmp_name'];
    $dir_img    =   "../imagens/".$nome_img;
    move_uploaded_file($tmp_img,$dir_img);
};
    // ------------------------------------------------------------------------------------

    // Montar valores
    $valores_insert = "
                        '$login_usuario',
                        '$senha_usuario',
                        '$nivel_usuario',
                        '$foto_usuario'
                      ";

    // SQL de inserção
    $insertSQL  = "
                    INSERT INTO $tabela_insert
                        ($campos_insert)
                    VALUES
                        ($valores_insert);
                  ";

    $resultado  = $conn_atletas->query($insertSQL);

    // redirecionar
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
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
    <main class="container">
 <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6" > <!-- abre dimensionamento -->
            <h2 class="fundocategoria text-center">
                <a href="usuarios_lista.php">
                    <button class="btn btnseta">
                        <span class="glyphicon glyphicon-chevron-left"></span>  
                    </button>
                </a><strong><i>
                Inserir Usuários </i></strong>
            </h2>
            <br>
            <div class="thumbnail"> <!--abrir thumbnail-->
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
</body>
</html>
