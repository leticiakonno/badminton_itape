<?php
//Incluir o Sistema de Autenticação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Variáveis Globais
$tabela         =   "tbnoticias";
$campo_filtro   =   "id_noticia";

// Primeiro, precisamos carregar os dados do usuário ANTES do POST  
// para recuperar nome da foto atual caso não seja trocada
if (isset($_GET['id_noticia'])) {
    mysqli_select_db($conn_atletas, $database_conn);
    $filtro_select  =   $_GET['id_noticia'];
    $consulta       =   "
                        SELECT *
                        FROM    ".$tabela."
                        WHERE   ".$campo_filtro."=".$filtro_select.";
                        ";
    $lista          =   $conn_atletas->query($consulta);
    $row            =   $lista->fetch_assoc();
}

// Se o formulário foi enviado
if($_POST){

    mysqli_select_db($conn_atletas,$database_conn);

    // Receber os dados do formulário
    $titulo_noticia    =   $_POST['titulo_noticia'];
    $descri_noticia    =   $_POST['descri_noticia'];
    // Campo para filtrar o registro
    $filtro_update  =   $_POST['id_noticia'];
    $img_noticia = $row['img_noticia']; // mantém a foto atual caso não troque

    // Se o usuário enviou uma nova foto
    if (!empty($_FILES['img_noticia']['name'])) {

        $nomeArquivo = $_FILES['img_noticia']['name'];
        $tempArquivo = $_FILES['img_noticia']['tmp_name'];
        $destino = "../imagens/noticias/" . $nomeArquivo;

        move_uploaded_file($tempArquivo, $destino);

        $img_noticia = $nomeArquivo; 
    }
    // ------------------------------------------

    // Consulta SQL para ATUALIZAÇÃO dos dados
    $updateSQL  =   "
                    UPDATE ".$tabela."
                        SET titulo_noticia  = '".$titulo_noticia."'   ,
                            descri_noticia  = '".$descri_noticia."'    ,
                            img_noticia   = '".$img_noticia."'
                    WHERE ".$campo_filtro."='".$filtro_update."';
                    ";
    $resultado  =   $conn_atletas->query($updateSQL);

    // Redirecionamento
    $destino    =   "noticias_lista.php";
    header("Location: $destino");
    exit;
}

// Contar linhas (mantido do seu código)
$totalRows = ($lista)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualiza Notícias</title>
      <!-- Link CSS do Bootstrap -->
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <!-- Link para CSS Específico -->
      <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<?php include("menu_adm.php"); ?>
    <main class="container">
    <div class="row">
    <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6" > <!-- abre dimensionamento -->
    <h2 class="fundoatletas text-center titulo">
                <a href="noticias_lista.php">
                    <button class="btn btntotal">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualiza Notícias
            </h2>
            <br>
            <div class="thumbnail">
                <div class="alert" role="alert">

                    <form 
                        action="noticias_atualiza.php?id_noticia=<?php echo $row['id_noticia']; ?>"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_noticia_atualiza"
                        name="form_noticia.atualiza"
                    >

                        <!-- id_usuario oculto -->
                        <input
                            type="hidden"
                            name="id_noticia"
                            id="id_noticia"
                            value="<?php echo $row['id_noticia']; ?>"
                        >
                        <!-- text titulo_noticia -->
                        <label for="titulo_noticia">Título da Notícia:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <input 
                                type="text" 
                                name="titulo_noticia" 
                                id="titulo_noticia"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                placeholder="Digite o titulo do noticia."
                                value="<?php echo $row['titulo_noticia']; ?>"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text nome_noticia -->
                        <br>

                         <!-- textarea descri_noticia -->
                         <label for="descri_noticia">Descrição:</label>
                         <div class="input-group">
                             <span class="input-group-addon">
                                 <span class="glyphicon glyphicon-align-justify"></span>
                             </span>
                             <textarea 
                                 name="descri_noticia" 
                                 id="descri_noticia"
                                 class="form-control"
                                 placeholder="Digite a descrição do noticia."
                                 cols="30"
                                 rows="8"
                                 ><?php echo $row['descri_noticia']; ?>
                             </textarea>
                         </div> <!-- fecha input-group -->
                         <!-- fecha textarea descri_noticia -->   
                         <br>

                         <!-- Dados da imagem_noticia ATUAL -->                        
                        <label for="">Imagem ATUAL:</label>
                        <br>
                        <img 
                            src="../imagens/<?php echo $row['img_noticia']; ?>" 
                            alt=""
                            class="img_responsive"
                            style="max-width:40%"
                        >
                        <br>

                        <!-- type="hidden" campo oculto somente para guardar dados -->
                        <!-- guardamos o nome da imagem caso não seja alterada -->
                        <input 
                            type="hidden"
                            name="img_noticia_atual"
                            id="img_noticia_atual"
                            value="<?php echo $row['img_noticia']; ?>"
                        >
                        <br>

                        <!-- file imagem_produto -->
                        <label for="img_noticia">NOVA Imagem:</label>
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
                                name="img_noticia" 
                                id="img_noticia"
                                class="form-control"
                                accept="image/*"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha file img_noticiao -->
                        <br>

                    <!-- botão -->
                    <input 
                    type="submit" 
                    value="Atualizar"
                    name="enviar"
                    id="enviar"
                    class="btn btntotal btn-block"
                >
            </form>

    
        </div>
    </div>
</div>
</div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php mysqli_free_result($lista); ?>