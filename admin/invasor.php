<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Refresh" content="15000;URL=../index.php">
    <title>Invasor</title>
    <script src="https://kit.fontawesome.com/d03c290dd3.js" crossorigin="anonymous"></script>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
    <main class="containeir">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h1 class="breadcrumb invasortitulo text-center" style="font-weight: bold;">ATENÇÃO!</h1>
                <div class="thumbnail text-center">
                    <span class="fa-stack fa-7x" style="margin-top: 20px;">
                        <i class="fas fa-user-secret fa-stack-1x"></i>
                        <i class="fas fa-ban fa-stack-2x iconinvasor"></i>
                    </span>
                    <br><br>
                    <div class="alert" role="alert">
                        <h4 class="textousuario">
                            <i class="fas fa-spinner fa-pulse fa-lg"></i>
                            Usuário e/ou Senha Inválido
                        </h4>
                        <br>
                        <p class="text-danger">
                            <a href="login.php"class="btn btninvasor">
                                <i class="fas fa-external-link-alt fa-rotate-270 fa-3x"></i>
                                <br><br>
                                Tentar <br> novamente
                            </a>
                            <a href="../index.php"class="btn btninvasor1">
                                <i class="fas fa-person-shelter fa-3x"></i>
                                <br><br>
                                Voltar <br> Área Pública
                            </a>
                        </p>
                            <small class="textousuario">
                                <br>
                                Caso não faça uma escolha em 15 segundos será redirecionado automaticamente para a página inicial.
                            </small>
                        <p>

                        </p>
                    </div> <!-- fecha alert-->
                </div> <!-- fecha thumbnail-->
            </div> <!--fecha dimensionamento-->
        </div> <!--fecha row-->
    </main>

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>