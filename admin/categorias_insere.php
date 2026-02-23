<?php
// Incluindo o sistema de identificação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas,$database_conn);

        // Guardar o nome da imagem no banco e o arquivo no diretório
    if($_FILES['img_categoria']['name']){
        $nome_img   =   $_FILES['img_categoria']['name'];
        $tmp_img    =   $_FILES['img_categoria']['tmp_name'];
        $dir_img    =   "../imagens/categoria/".$nome_img;
        move_uploaded_file($tmp_img,$dir_img);
    }else{
        $nome_img=$_POST['img_categoria_atual'];
    };

    // Variáveis para acrescentar dados no banco
    $tabela_insert  =   "tbcategorias";
    $campos_insert  =   "
                            nome_categoria,
                            descri_categoria,
                            img_categoria
                        ";

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $nome_categoria      =   $_POST['nome_categoria'];
    $descri_categoria     =   $_POST['descri_categoria'];
    $img_categoria        =   $nome_img;

    // Reunir os valores a serem inseridos
    $valores_insert =   "
                        '$nome_categoria',
                        '$descri_categoria',
                        '$img_categoria'
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
    $destino    =   "categorias_lista.php";
    if(mysqli_insert_id($conn_atletas)){
        header("Location: $destino");
    }else{
        header("Location: $destino");
    };
};

// Selecionar o banco de dados (USE)
mysqli_select_db($conn_atletas,$database_conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria Insere</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<?php include("menu_adm.php"); ?>
<main class="container">
<div class="row">
    <div class="col-xs-12 col-sm-offset-2 col-sm-8 " > <!-- abre dimensionamento -->
        <h2 class="fundocategoria text-center titulo">
            <a href="categorias_lista.php">
                <button class="btn btntotal">
                    <span class="glyphicon glyphicon-chevron-left"></span>  
                </button>
            </a>
                Inserir Categoria 
            </h2>
            <br>
            <div class="thumbnail"> <!--abrir thumbnail-->
                <div class="alert alert">
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
                                <span class="glyphicon glyphicon-th-large"></span>
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
                        <label for="descri_categoria">Descrição da categoria:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-align-justify"></span>
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
                         <!-- file img_atleta -->
                         <label for="img_categoria">Imagem:</label>
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
                                name="img_categoria" 
                                id="img_categoria"
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
                            class="btn btntotal btn-block"
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
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>