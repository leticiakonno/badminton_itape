<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

//inicar a verificação do login
if($_POST){
    // Definir o USE do banco de dados
    mysqli_select_db($conn_atletas,$database_conn);

    // Verificar o login e a senha recebidos
    $login_usuario  =   $_POST['login_usuario'];
    $senha_usuario  =   $_POST['senha_usuario'];

    $verificaSQL    =   "
                        SELECT *
                        FROM    tbusuarios
                        WHERE   login_usuario='$login_usuario'
                                AND senha_usuario='$senha_usuario';
                        ";

    // Carregar os dados e verificar as linhas
    $lista_session      =   mysqli_query($conn_atletas,$verificaSQL);
    $row_session        =   $lista_session->fetch_assoc();
    $totalRows_session  =   mysqli_num_rows($lista_session);

    // Se a sessão não existir, inicia uma
    if(!isset($_SESSION)){
        $sessao_antiga  =   session_name("badmintonnnn");
        session_start();
        $session_name_new   =   session_name(); // recupero o nome da atual sessão
    };

    // Carregar informações em uma sessão
    if($totalRows_session>0){
        $_SESSION['login_usuario']  =   $login_usuario;
        $_SESSION['nivel_usuario']  =   $row_usuario['nivel_usuario'];
        $_SESSION['nome_da_sessao'] =  session_name();
        echo "<script>window.open('index.php','_self')</script>";
    }else{
        echo "<script>window.open('invasor.php','_self')</script>";
    };
};
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Refresh" content="15;URL=../index.php" >
    <title>Login</title>
    <script src="https://kit.fontawesome.com/d03c290dd3.js" crossorigin="anonymous"></script>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<main class="container fontetabela">
<section>
    <article>
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6">
                <h1 class="breadcrumb text-center titulo fundousuarios">Faça seu login</h1>
                <div class="thumbnail fundousuarios">
                    <p class="text text-center" role="alert">
                        <i class="fa-solid fa-user-lock fa-10x icone-login"></i>
                    </p>
                    <br>
                    <div class="alert text-dark" role="alert">
                        <form action="login.php" name="form_login" id="form_login" method="post" enctype="multipart/form-data">
                            <label for="login_usuario">Login:</label>
                            <p class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user text" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="login_usuario" id="login_usuario" class="form-control" autofocus required placeholder="Digite seu login." autocomplete="off">
                            </p>
                            <label for="senha_usuario">Senha:</label>
                            <p class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-qrcode text" aria-hidden="true"></span>
                                </span>
                                <input type="password" name="senha_usuario" id="senha_usuario" class="form-control" required placeholder="Digite sua senha.">
                            </p>
                            <p class="text-right">
                                <input type="submit" value="Entrar" class="btn btnhistoria">
                            </p>
                        </form>
                        <p class="text-center textousuario">
                            <small>
                                <br>
                                Caso não faça um escolha em 15 segundos será redirecionado automaticamente para página inicial.
                            </small>
                        </p>                       
                    </div> <!-- fecha alert -->
                </div> <!-- fecha thumbnail -->
            </div> <!-- fecha dimensionamento -->
        </div> <!-- fecha row -->
    </article>
</section>
</main>
<!-- Link arquivos bootstrap script js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>

</html>