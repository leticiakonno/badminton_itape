<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Refresh" content="15;URL=../index.php">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Não autorizado</title>
    <script src="https://kit.fontawesome.com/d03c290dd3.js" crossorigin="anonymous"></script>
    <!-- Link arquivos Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/d03c290dd3.js" crossorigin="anonymous"></script>
    <!-- Link para CSS específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<main class="container">
<section>
    <article>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h1 class="breadcrumb invasortitulo text-center" style="font-weight: bold;">Atenção</h1>
                <div class="thumbnail text-center">
                    <span class="fa-7x fa-stack" style="margin-top: 20px;">>
                        <i class="fas fa-user-secret fa-stack-1x "></i>
                        <i class="fas fa-ban  fa-stack-2x iconinvasor"></i>
                    </span>
                    <br>
                    <br>
                    <div class="alert " role="alert">
                        <h4 class="textousuario">
                            <i class="fas fa-spinner fa-lg fa-pulse"></i>
                            NÃO AUTORIZADO!
                            <br>
                            <br>
                            Solicite acesso ao Supervisor
                            <br>
                        </h4>
                        <p class="text-danger">
                            <a href="index.php" class="btn btninvasor">
                                <i class="fas fa-external-link-alt fa-3x fa-rotate-270"></i>
                                <br>
                                <br>
                                Voltar <br> Área Admin
                            </a>
                            <a href="../index.php" class="btn btninvasor1">
                                <i class="fas fa-home fa-3x"></i>
                                <br>
                                <br>
                                Voltar <br> Área Pública
                            </a>
                        </p>
                        <p>
                            <small class="textousuario">
                                <br>
                                Caso não faça uma escolha em 15 segundos será redirecionado
                                automaticamente para página inicial.
                            </small>
                        </p>

                    </div> <!-- fecha alert -->

                </div> <!-- fecha thumbnail -->
            </div> <!-- fecha dimensionamento -->
        </div> <!-- fecha row -->
    </article>
</section>
</main>

    
<!-- Link arquivos Bootstrap js -->        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>