<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atletas Insere</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
    <main class="container">
 <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4" > <!-- abre dimensionamento -->
            <h2 class="breadcrumb text-warning">
                <a href="categorias_lista.php">
                    <button class="btn btn-warning">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Inserir Categorias
            </h2>
            <div class="thumbnail">
                <div class="alert alert-warning">
                    <form 
                        action="categorias_insere.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_insere_categoria"
                        name="form_insere_categoria"
                    >
                        <!-- text nome_categoria -->
                        <label for="nome_categoria">Nome:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-apple"></span>
                            </span>
                            <input 
                                type="text" 
                                name="nome_categoria" 
                                id="nome_categoria"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                placeholder="Digite o nome da categoria."
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text nome_categoria -->
                        <br>

                         <!-- textarea descri_categoria -->
                        <label for="descri_categoria">Resumo:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-list-alt"></span>
                            </span>
                            <textarea 
                                name="descri_categoria" 
                                id="descri_categoria"
                                class="form-control"
                                placeholder="Digite a descrição da categoria."
                                cols="30"
                                rows="8"
                            ></textarea>
                        </div> <!-- fecha input-group -->
                        <!-- fecha textarea descri_categoria -->
                        <br>


                        <!-- btn enviar -->
                        <input 
                            type="submit" 
                            value="Cadastrar"
                            name="enviar"
                            id="enviar"
                            role="button"
                            class="btn btn-warning btn-block"
                        >
                    </form>
                </div> <!-- fecha alert alert-warning  -->
            </div> <!-- thumbnail -->
        </div> <!-- dimensionamento -->
    </div> <!-- fecha row -->
</main>



<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>