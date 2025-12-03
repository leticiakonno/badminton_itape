<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Variáveis Globais
$tabela         =   "tbcategorias";
$campo_filtro   =   "id_categoria";


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

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $nome_categoria            =   $_POST['nome_categoria'];
    $descri_categoria          =   $_POST['descri_categoria'];
    $img_categoria             =   $nome_img;

    // Campo para filtrar o registro (WHERE)
    $filtro_update      =   $_POST['id_categoria'];

    // Consulta SQL para ATUALIZAÇÃO dos dados
    $updateSQL  =   "
                    UPDATE ".$tabela."
                        SET  nome_categoria         =   '".$nome_categoria."',
                            descri_categoria       =   '".$descri_categoria."',
                            img_categoria          =   '".$img_categoria."
                    WHERE ".$campo_filtro." =   '".$filtro_update."';
                    ";
    $resultado  =   $conn_atletas->query($updateSQL);

    // Após a ação a página será redirecionada
    $destino    =   "categorias_lista.php";
    if(mysqli_insert_id($conn_atletas)){
        header("Location: $destino");
    }else{
        header("Location: $destino");
    };
};

// Consulta para trazer e filtrar os dados
// Definir o USE do banco de dados;
mysqli_select_db($conn_atletas,$database_conn);
$filtro_select    =   $_GET['id_categoria'];
$consulta           =   "
                    SELECT *
                    FROM   ".$tabela."
                    WHERE ".$campo_filtro."=".$filtro_select.";
                    ";
$lista          =   $conn_atletas->query($consulta);
$row            =   $lista->fetch_assoc();
$totalRows      =   ($lista)->num_rows;

// Selecionar o banco de dados (USE)
mysqli_select_db($conn_atletas,$database_conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias Atualiza</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
    <main class="container">
    <div class="row">
    <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6" > <!-- abre dimensionamento -->
    <h2 class="fundocategoria text-center">
                <a href="categorias_lista.php">
                    <button class="btn btnseta">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a><strong><i>
                Atualiza Categoria</i></strong>
            </h2>
            <br>
             <div class="thumbnail">
                <div class="alert alert">
                    <form 
                        action="categorias_atualiza.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_atualiza_categorias"
                        name="form_atualiza_categorias"
                    >
                        <!-- Inserir campo id_categoria OCULTO para uso em filtro -->
                        <input 
                            type="hidden"
                            name="id_categoria"
                            id="id_categoria"
                            value="<?php echo $row['id_categoria']; ?>"
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
                                value="<?php echo $row['nome_categoria']; ?>"
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
                                value="<?php echo $row['descri_categoria']; ?>"
                            >
                            </textarea>
                        </div> <!-- fecha input-group -->
                        <!-- fecha textarea descri_categoria -->  
                         <br>
                          <!-- Dados da imagem_produto ATUAL -->                        
                        <label for="">Imagem ATUAL:</label>
                        <br>
                        <img 
                            src="../imagens/<?php echo $row['img_categoria']; ?>" 
                            alt=""
                            class="img_responsive"
                            style="max-width:40%"
                        >
                        <br>

                        <!-- type="hidden" campo oculto somente para guardar dados -->
                        <!-- guardamos o nome da imagem caso não seja alterada -->
                        <input 
                            type="hidden"
                            name="img_categoria_atual"
                            id="img_categoria_atual"
                            value="<?php echo $row['img_categoria']; ?>"
                        >
                        <br>

                        <!-- file imagem_produto -->
                        <label for="img_categoria">NOVA Imagem:</label>
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
                                name="imagem_categoria" 
                                id="imagem_categoria"
                                class="form-control"
                                accept="image/*"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha file imagem_produto -->
                        <br> 
                        <br>
                         <!-- btn enviar -->
                        <input 
                            type="submit" 
                            value="Atualizar"
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
</body>
</html>
<?php mysqli_free_result($lista); ?>