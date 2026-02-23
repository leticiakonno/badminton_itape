<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Após 15 segundos a página sera redirecionada para index.php -->
    <meta http-equiv="refresh" content="15;URL=index.php">
    <title>Verificação do Formulário</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundo2 fontetabela">
<?php include('menu_publico.php'); ?>
<main class="container">
    <section>
        <div class="jumbotron fundoatletas">
            <h1><strong><i>Agradecemos seu contato!</i> </strong></h1>
            <?php
                $destino        =   "leticia.konno@hotmail.com";
                $nome_formulario   =   $_POST['nome_formulario'];
                $date_formulario = $_POST['date_formulario'];
                $telefone_formulario = $_POST['telefone_formulario'];
                $email_formulario  =   $_POST['email_formulario'];
                $assunto_contato = $_POST['assunto_contato'];
                $msg_contato    =   "Mensagem de:".$nome_formulario."\n".$_POST['comentarios_contato'];
                $mailsend   =   mail($destino,"Formulário de comentário",$msg_contato,"From:",$email_formulario);
            ?>
            <div class="text-center">
                <p>
                    Obrigado por enviar seus comentários,
                    <b><?php echo $nome_formulario; ?></b>!
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
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- rodapé -->
<footer>
    <?php include('rodape.php'); ?>
</footer>

</body>
</html>