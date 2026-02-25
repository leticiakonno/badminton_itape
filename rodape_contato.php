<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Após 15 segundos a página sera redirecionada para index.php -->
    <meta http-equiv="refresh" content="15;URL=index.php">
        <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
    <title>Verificação do Contato</title>
</head>
<body class="fundo2">
<?php include('menu_publico.php'); ?>
<main class="container">
    <section>
        <div class="jumbotron fundoatletas">
            <h1><strong><i>Agradecemos seu contato!</i> </strong></h1>
            <?php
                $destino        =   "leticia.konno@hotmail.com";
                $nome_contato   =   $_POST['nome_contato'];
                $email_contato  =   $_POST['email_contato'];
                $msg_contato    =   "Mensagem de:".$nome_contato."\n".$_POST['comentarios_contato'];
                $mailsend   =   mail($destino,"Formulário de comentário",$msg_contato,"From:",$email_contato);
            ?>
            <div class="text-center">
                <p>
                    Obrigado por enviar seus comentários,
                    <b><?php echo $nome_contato; ?></b>!
                </p>
                <p>Mensagem enviada com sucesso!</p>
                <h5>
                    Caso não visualize a mensagem de agradecimento,
                    entre em contato através do email:
                    <br>
                    <b><i><?php echo $destino; ?></i></b>
                </h5>
            </div> <!-- fecha text-center -->
        </div> <!-- fecha jumbotron -->

    </section>
    <!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
</main>

<!-- rodapé -->
<footer>
    <?php include('rodape.php'); ?>
</footer>

</body>
</html>