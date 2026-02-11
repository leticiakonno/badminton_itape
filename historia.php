 <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundofixo fontetabela">
<?php include('menu_publico.php'); ?>
<main class="container">
    <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12" > <!-- abre dimensionamento -->
        <div class="form-container tabela-branca" style="border-radius:10px ;">
        <br>
        <h2 class="fundoatletas titulo text-center" ><strong>Saiba mais sobre nossa história:</strong></h2>
        <br>
        <img src="imagens/familia.jpeg.png" style="float: right; margin: 20px; width: 600px; height: 700px;border-radius: 8px; ">
        <p class="historia">A história do badminton em Itapetininga se funde com  a dedicação da pioneira <strong>Leiko Konno.</strong>
        </strong>O esporte, inicialmente desconhecido na cidade, começou a ganhar forma após o marido dela, Shogo,
        trazer raquetes do Japão.O que era uma prática informal em praças tornou-se um projeto sério quando Leiko, 
        motivada pelo interesse da filha caçula, Letícia, decidiu se especializar em Educação Física para ensinar a modalidade.</p>

        <h6 class="historia" style="font-weight: bolder; font-style: italic;">Destaques da Tragetória:</h6>
        <p class="historia"><strong>Projetos Sociais:</strong> Em 2010, Leiko iniciou um trabalho voluntário na Casa de Adolescente, utilizando o esporte
        como ferramenta contra a ociosidade e auxílio no desenvolvimento de crianças e jovens. <br>
        <strong>Formação de Atletas:</strong> O projeto revelou talentos como <i>Douglas Vieira</i>, hoje árbitro profissional, e a própria filha
        de Leiko, <i>Letícia</i>, que alcançou o 6° lugar no ranking nacional e foi <strong>pentacampeã regional </strong> por Itapetininga. <br>
        <strong>Impacto Educacional:</strong> Além do físico, o badminton na cidade é reconhecido por melhorar a concentração e o raciocínio dos alunos, com
        treinos que passsaram por locais como o Clube dos Bancários e a EMEIF Maria Aparecida Brisola Franci. <br>
        Hoje o badminton itapetiningano é fruto do esforço familiar que transformou a modalidade em um pilar de disciplina e cidadania, mantendo vivo o sonho de um centro de treinamento
        exclusivo para as futuras gerações. 

        </div> <!--fecha tabela-->
    </div> <!--fecha dimensionamento-->
</main>
<footer>
    <?php include('rodape.php'); ?>
</footer>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saiba mais sobre nossa história</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- CSS próprio -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>

<body class="fundofixo fontetabela">

<?php include('menu_publico.php'); ?>

<main class="container">

    <!-- DIMENSIONAMENTO -->
    <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12">

        <!-- CONTEÚDO -->
        <div class="form-container tabela-branca" style="border-radius:10px;">
            <br>

            <h2 class="fundoatletas titulo text-center">
                <strong>Saiba mais sobre nossa história:</strong>
            </h2>

            <br>

            <!-- ROW PRINCIPAL -->
            <div class="row">

                <!-- TEXTO PRINCIPAL -->
                <div class="col-xs-12 col-md-5">
                    <p class="historia">
                        A história do badminton em Itapetininga se funde com a dedicação da pioneira
                        <strong>Leiko Konno.</strong> O esporte, inicialmente desconhecido na cidade,
                        começou a ganhar forma após o marido dela, Shogo, trazer raquetes do Japão.
                        O que era uma prática informal em praças tornou-se um projeto sério quando
                        Leiko, motivada pelo interesse da filha caçula, Letícia, decidiu se especializar
                        em Educação Física para ensinar a modalidade.
                    </p>

                    <h6 class="historia" style="font-weight: bolder; font-style: italic;">
                        Destaques da Trajetória:
                    </h6>

                    <p class="historia">
                        <strong>Projetos Sociais:</strong> Em 2010, Leiko iniciou um trabalho voluntário
                        na Casa do Adolescente, utilizando o esporte como ferramenta contra a ociosidade
                        e auxílio no desenvolvimento de crianças e jovens.<br><br>

                        <strong>Formação de Atletas:</strong> O projeto revelou talentos como
                        <i>Douglas Vieira</i>, hoje árbitro profissional, e a própria filha de Leiko,
                        <i>Letícia</i>, que alcançou o 6º lugar no ranking nacional e foi
                        <strong>pentacampeã regional</strong> por Itapetininga.<br><br>

                        <strong>Impacto Educacional:</strong> Além do físico, o badminton na cidade é
                        reconhecido por melhorar a concentração e o raciocínio dos alunos, com treinos
                        que passaram por locais como o Clube dos Bancários e a EMEIF Maria Aparecida
                        Brisola Franci.<br><br>

                        Hoje, o badminton itapetiningano é fruto do esforço familiar que transformou
                        a modalidade em um pilar de disciplina e cidadania, mantendo vivo o sonho de
                        um centro de treinamento exclusivo para as futuras gerações.
                    </p>
                </div>

                <!-- IMAGEM + TEXTO ABAIXO -->
                <div class="col-xs-12 col-md-7 text-center">

                    <img src="imagens/familia.jpeg.png"
                         alt="Família Konno e a história do badminton"
                         class="img-responsive img-historia">

                    <p class="historia texto-imagem">
                        Família Konno, base do desenvolvimento do badminton em Itapetininga.
                    </p>

                </div>

            </div>
            <!-- FIM ROW -->

        </div>
        <!-- FIM CONTEÚDO -->

    </div>
    <!-- FIM DIMENSIONAMENTO -->

</main>

<footer>
    <?php include('rodape.php'); ?>
</footer>

</body>
</html>
