<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>História do Badminton em Itapetininga</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundofixo fontetabela">
<?php include('menu_publico.php'); ?>

    <main class="container">
        <div class="row"> 
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-0">
                <div class="form-container tabela-branca" style="border-radius:10px; padding:20px;">

                    <h2 class="fundoatletas titulo text-center">
                        <strong>Saiba mais sobre nossa história:</strong>
                    </h2>
                    <hr>

                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 col-md-5">
                            <p class="historia">
                                A história do badminton em Itapetininga se funde com a dedicação da pioneira
                                <strong>Leiko Konno</strong>. O esporte, inicialmente desconhecido na cidade,
                                começou a ganhar forma após o marido dela, Shogo, trazer raquetes do Japão.
                                O que era uma prática informal em praças tornou-se um projeto sério quando
                                Leiko, motivada pelo interesse da filha caçula, Letícia, decidiu se especializar
                                em Educação Física para ensinar a modalidade.
                            </p>

                            <h6 class="historia" style="font-weight:bolder; font-style:italic;">
                                Destaques da Trajetória:
                            </h6>

                            <p class="historia">
                                <strong>Projetos Sociais:</strong> Em 2010, Leiko iniciou um trabalho voluntário
                                na Casa do Adolescente, utilizando o esporte como ferramenta contra a ociosidade
                                e auxílio no desenvolvimento de crianças e jovens.
                            </p>
                            <p class="historia">
                                <strong>Formação de Atletas:</strong> O projeto revelou talentos como
                                <i>Douglas Vieira</i>, hoje árbitro profissional, e a própria filha de Leiko,
                                <i>Letícia</i>, que alcançou o 6º lugar no ranking nacional e foi
                                <strong>pentacampeã regional</strong> por Itapetininga.
                            </p>
                            <p class="historia">
                                <strong>Impacto Educacional:</strong> Além do físico, o badminton na cidade é
                                reconhecido por melhorar a concentração e o raciocínio dos alunos, com treinos
                                que passaram por locais como o Clube dos Bancários e a EMEIF Maria Aparecida
                                Brisola Franci.
                            </p>
                        </div>

                        <!-- COLUNA DA IMAGEM E TEXTO FINAL -->
                        <div class="col-xs-12 col-sm-12 col-md-7 text-center">
                            <img src="imagens/familia.jpeg.png" 
                                 alt="Família Konno e a história do badminton"
                                 class="img-responsive img-historia" 
                                 style="border-radius:8px; margin-bottom:20px;">

                            <p class="historia" style="font-style:italic;">
                                Hoje, o badminton itapetiningano é fruto do esforço familiar que transformou
                                a modalidade em um pilar de disciplina e cidadania, mantendo vivo o sonho de
                                um centro de treinamento exclusivo para as futuras gerações.
                            </p>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.form-container -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    <!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
    </main>
<br><br>
    <footer>
        <?php include('rodape.php'); ?>
    </footer>
</body>
</html>
<?php mysqli_free_result($lista_menu); ?>