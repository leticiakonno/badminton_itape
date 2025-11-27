<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas,$database_conn);

    // Variáveis para acrescentar dados no banco
    $tabela_insert  =   "tbatletas";
    $campos_insert  =   "
                            nome_atleta,
                            descri_atleta
                        ";

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $nome_atleta       =   $_POST['nome_atleta'];
    $descri_atleta     =   $_POST['descri_atleta'];
    $data_nas_atleta   =   $_POST['data_nas_atleta'];
    $data_cad_atleta   =   $_POST['data_cad_atleta'];
    $destaque_atleta   =   $_POST['destaque_atleta'];
    $img_atleta        =   $_POST['img_atleta'];

    // Reunir os valores a serem inseridos
    $valores_insert =   "
                        '$nome_atleta',
                        '$descri_atleta',
                        '$data_nas_atleta',
                        '$data_cad_atleta',
                        '$destaque_atleta',
                        '$img_atleta'
                        ";

    // Consulta SQL para inserção dos dados
    $insertSQL  =   "
                    INSERT INTO ".$tabela_insert."
                        (".$campos_insert.")
                    VALUES
                        (".$valores_insert.");
                    ";
    $resultado  =   $conn_atletas->query($insertSQL);

    // Após a ação a página será redirecionada
    $destino    =   "atletas_lista.php";
    if(mysqli_insert_id($conn_atletas)){
        header("Location: $destino");
    }else{
        header("Location: $destino");
    };
};
?>
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
            <h2 class="breadcrumb text-danger">
                <a href="atletas_lista.php">
                    <button class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Inserir Atletas
            </h2>
            <div class="thumbnail"> <!-- abre thumbnail -->
                <div class="alert alert-danger">
                    <form 
                        action="atletas_insere.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_insere_atleta"
                        name="form_insere_atleta"
                    >
                        <!-- text nome_atleta -->
                        <label for="nome_atleta">Nome:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-apple"></span>
                            </span>
                            <input 
                                type="text" 
                                name="nome_atleta" 
                                id="nome_atleta"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                placeholder="Digite o nome do atleta."
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text nome_atleta -->
                        <br>

                        
                        <!-- text data_nas_atleta -->
                        <label for="data_nas_atleta">Data de Nascimento:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input 
                                type="date" 
                                name="data_nas_atleta" 
                                id="data_nas_atleta"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text data_nas_atleta -->
                        <br>

                        <!-- text data_nas_atleta -->
                        <label for="data_cad_atleta">Data de Cadastro:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input 
                                type="date" 
                                name="data_cad_atleta" 
                                id="data_cad_atleta"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text data_cad_atleta -->
                        <br>

                         <!-- textarea descri_atleta -->
                        <label for="descri_atleta">Resumo:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-list-alt"></span>
                            </span>
                            <textarea 
                                name="descri_atleta" 
                                id="descri_atleta"
                                class="form-control"
                                placeholder="Digite a descrição da atleta."
                                cols="30"
                                rows="8"
                            ></textarea>
                        </div> <!-- fecha input-group -->
                        <!-- fecha textarea descri_atleta -->
                        <br>

                         <!-- file img_atleta -->
                        <label for="img_atleta">Imagem:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture"></span>
                            </span>
                            <!-- Exibir a imagem a ser inserida -->
                            <img 
                                src="" 
                                alt=""
                                name="imagem"
                                id="imagem"
                                class="img-responsive"
                                style="max-height: 150px;"
                            >
                            <input 
                                type="file" 
                                name="img_atleta" 
                                id="img_atleta"
                                class="form-control"
                                accept="image/*"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha file imagem_produto -->
                        <br>

                        <!-- btn enviar -->
                        <input 
                            type="submit" 
                            value="Cadastrar"
                            name="enviar"
                            id="enviar"
                            role="button"
                            class="btn btn-danger btn-block"
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