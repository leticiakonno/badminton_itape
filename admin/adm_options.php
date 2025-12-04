<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<main class="container">
<h1 class="adm text-center">Área Administrativa</h1>
<div class="row">

    <!-- ADM ATLETAS -->
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail fundoatletas">
            <img src="../imagens/atletas.jpg" width="200px" height="responsive" alt="">
            <br>
            <div class="fundoatletas">
                <!-- botão principal -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <button 
                            class="btn btn-default disabled"
                            style="cursor: default;"
                        >
                         <strong>ATLETAS</strong> 
                        </button>
                    </div> <!-- fecha btn-group -->
                 </div> <!-- fecha btn-group-justified -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group btnadm"> <!-- botão Listar -->
                        <a href="atletas_lista.php">
                            <button class="btn btntotal ">Listar</button>
                        </a>
                    </div> <!-- fecha btn-group Listar -->
                    <div class="btn-group"> <!-- botão Inserir -->
                        <a href="atletas_insere.php">
                            <button class="btn btntotal">Inserir</button>
                        </a>
                    </div> <!-- fecha btn-group Inserir -->
                 </div> <!-- fecha btn-group-justified -->
            </div> <!-- fecha alert-danger -->
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->

    <!-- ADM CATEGORIAS -->
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail fundoatletas">
            <img src="../imagens/categorias.jpg" width="200px" height="responsive"  alt="">
            <br>
            <div class="fundoatletas">
                <!-- botão principal -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <button 
                            class="btn btn-default disabled"
                            style="cursor: default;"
                        >
                            <strong>CATEGORIAS</strong>
                        </button>
                    </div> <!-- fecha btn-group -->
                 </div> <!-- fecha btn-group-justified -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group btnadm" > <!-- botão Listar -->
                        <a href="categorias_lista.php">
                            <button class="btn btntotal">Listar</button>
                        </a>
                    </div> <!-- fecha btn-group Listar -->
                    <div class="btn-group"> <!-- botão Inserir -->
                        <a href="categorias_insere.php">
                            <button class="btn btntotal">Inserir</button>
                        </a>
                    </div> <!-- fecha btn-group Inserir -->
                 </div> <!-- fecha btn-group-justified -->
            </div> <!-- fecha alert-warning -->
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->

    <!-- ADM USUÁRIOS -->
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail fundoatletas">
            <img src="../imagens/usuario.png" width="200px" height="responsive" alt="">
            <br>
            <div class="fundoatletas">
                <!-- botão principal -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <button 
                            class="btn btn-default disabled"
                            style="cursor: default;"
                        >
                           <strong> USUÁRIOS</strong>
                        </button>
                    </div> <!-- fecha btn-group -->
                 </div> <!-- fecha btn-group-justified -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group"> <!-- botão Listar -->
                        <a href="usuarios_lista.php">
                            <button class="btn btntotal">Listar</button>
                        </a>
                    </div> <!-- fecha btn-group Listar -->
                    <div class="btn-group btnadm"> <!-- botão Inserir -->
                        <a href="usuarios_insere.php">
                            <button class="btn btntotal">Inserir</button>
                        </a>
                    </div> <!-- fecha btn-group Inserir -->
                 </div> <!-- fecha btn-group-justified -->
            </div> <!-- fecha alert-info -->
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->
    
    <!-- ADM PARCEIROS -->
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail fundoatletas">
            <img src="../imagens/parceiros.jpg" width="200px" height="responsive" alt="">
            <br>
            <div class="fundoatletas">
                <!-- botão principal -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <button 
                            class="btn btn-default disabled"
                            style="cursor: default;"
                        >
                            <strong>PARCEIROS</strong>
                        </button>
                    </div> <!-- fecha btn-group -->
                 </div> <!-- fecha btn-group-justified -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group btnadm"> <!-- botão Listar -->
                        <a href="parceiros_lista.php">
                            <button class="btn btntotal">Listar</button>
                        </a>
                    </div> <!-- fecha btn-group Listar -->
                    <div class="btn-group"> <!-- botão Inserir -->
                        <a href="parceiros_insere.php">
                            <button class="btn btntotal">Inserir</button>
                        </a>
                    </div> <!-- fecha btn-group Inserir -->
                 </div> <!-- fecha btn-group-justified -->
            </div> <!-- fecha alert-warning -->
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->

    <!-- ADM TÉCNICOS   -->
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail fundoatletas">
            <img src="../imagens/tecnicos.jpg" width="200px" height="50px"  alt="">
            <br>
            <div class="fundoatletas">
                <!-- botão principal -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <button 
                            class="btn btn-default disabled"
                            style="cursor: default;"
                        >
                            <strong>TÉCNICOS</strong>
                        </button>
                    </div> <!-- fecha btn-group -->
                 </div> <!-- fecha btn-group-justified -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group btnadm"> <!-- botão Listar -->
                        <a href="tecnicos_lista.php">
                            <button class="btn btntotal">Listar</button>
                        </a>
                    </div> <!-- fecha btn-group Listar -->
                    <div class="btn-group"> <!-- botão Inserir -->
                        <a href="tecnicos_insere.php">
                            <button class="btn btntotal">Inserir</button>
                        </a>
                    </div> <!-- fecha btn-group Inserir -->
                 </div> <!-- fecha btn-group-justified -->
            </div> <!-- fecha alert-warning -->
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->

    <!-- ADM TORNEIOS -->
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail fundoatletas">
            <img src="../imagens/torneios.jpg" width="200px" height="responsive"  alt="">
            <br>
            <div class="fundoatletas">
                <!-- botão principal -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <button 
                            class="btn btn-default disabled"
                            style="cursor: default;"
                        >
                            <strong>TORNEIOS</strong>
                        </button>
                    </div> <!-- fecha btn-group -->
                 </div> <!-- fecha btn-group-justified -->
                 <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group btnadm"> <!-- botão Listar -->
                        <a href="torneios_lista.php">
                            <button class="btn btntotal">Listar</button>
                        </a>
                    </div> <!-- fecha btn-group Listar -->
                    <div class="btn-group"> <!-- botão Inserir -->
                        <a href="torneios_insere.php">
                            <button class="btn btntotal">Inserir</button>
                        </a>
                    </div> <!-- fecha btn-group Inserir -->
                 </div> <!-- fecha btn-group-justified -->
            </div> <!-- fecha alert-warning -->
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->
</div> <!-- fecha row -->
</main>

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>