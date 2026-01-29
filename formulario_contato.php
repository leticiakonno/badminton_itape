<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Após 15 segundos a página sera redirecionada para index.php -->
    <meta http-equiv="refresh" content="15;URL=index.php">
    <title>Verificação do Formulário</title>
</head>
<body class="fundo2">
<?php include('menu_publico.php'); ?>
<main class="container">
    <section>
        <div class="jumbotron fundoatletas">
            <h1><strong><i>Agradecemos seu contato!</i> </strong></h1>
            <?php
                $destino        =   "leiko_konno@hotmail.com";
                $nome_formulario   =   $_POST['nome_formualario'];
                $date_formulario = $_POST['date_formulario'];
                $telefone_formulario = $_POST['telefone_formulario'];
                $email_formulario  =   $_POST['email_formulario'];
                $assunto_contato = $_POST['assunto_contato'];
                $msg_contato    =   "Mensagem de:".$nome_contato."\n".$_POST['comentarios_contato'];
                $mailsend   =   mail($destino,"Formulário de comentário",$msg_contato,"From:",$email_contato);
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

<!-- rodapé -->
<footer>
    <?php include('rodape.php'); ?>
</footer>

</body>
</html>