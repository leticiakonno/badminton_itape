<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas,$database_conn);

    // 
    // 1) UPLOAD DA FOTO
    // 
    $foto_nome = NULL;

    if (!empty($_FILES['foto_usuario']['name'])) {

        // Pasta onde as fotos serão salvas
        $pasta = "../imagens/usuarios/";

        // Cria a pasta caso não exista
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        // Nome único da foto
        $foto_nome = time() . "_" . basename($_FILES['foto_usuario']['name']);

        // Caminho final do arquivo
        $destino = $pasta . $foto_nome;

        // Move o arquivo enviado para a pasta de destino
        move_uploaded_file($_FILES['foto_usuario']['tmp_name'], $destino);
    }
    // 
    // FIM UPLOAD DA FOTO
    // 

    // Variáveis para acrescentar dados no banco
    $tabela_insert  =   "tbusuarios";
    $campos_insert  =   "
                            login_usuario,
                            senha_usuario,
                            nivel_usuario,
                            foto_usuario
                        ";

    // Receber os dados do formulário
    $login_usuario     =   $_POST['login_usuario'];
    $senha_usuario     =   $_POST['senha_usuario'];
    $nivel_usuario     =   $_POST['nivel_usuario'];  

    // Campo da foto recebendo o nome salvo
    $foto_usuario      =   $foto_nome;

    // Reunir os valores a serem inseridos
    $valores_insert =   "
                        '$login_usuario',
                        '$senha_usuario',
                        '$nivel_usuario',
                        '$foto_usuario'
                        ";

    // Consulta SQL para inserção dos dados
    $insertSQL  =   "
                    INSERT INTO ".$tabela_insert."
                        (".$campos_insert.")
                    VALUES
                        (".$valores_insert.");
                    ";
    $resultado  =   $conn_atletas->query($insertSQL);

    // Após a ação a página será redirecionada
    $destino    =   "usuarios_lista.php";
    header("Location: $destino");
};
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria Insere</title>
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
                    
                        <!-- CAMPO PARA FOTO DO USUÁRIO -->
                        <!-- (ALTERAÇÃO 1 – adicionado campo de upload) -->
                        <label for="foto_usuario">Foto de Perfil:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <input 
                                type="file"
                                name="foto_usuario"
                                id="foto_usuario"
                                class="form-control"
                                accept="image/*"
                            >
                        </div>
                        <br>
                        <!-- FIM CAMPO FOTO -->

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
