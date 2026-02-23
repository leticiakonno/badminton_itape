<?php
// Incluindo o sistema de identificação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas,$database_conn);

    // Variáveis para acrescentar dados no banco
    $tabela_insert  =   "tbtorneios";
    $campos_insert  =   "
                            tipo_torneio,
                            descri_torneio,
                            img_torneio
                        ";

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $tipo_torneio    =   $_POST['tipo_torneio'];
    $descri_torneio    =   $_POST['descri_torneio'];

    // Guardar o nome da imagem no banco e o arquivo no diretório
    if(isset($_POST['enviar'])){
        $nome_img   =   $_FILES['img_torneio']['name'];
        $tmp_img    =   $_FILES['img_torneio']['tmp_name'];
        $dir_img    =   "../imagens/".$nome_img;
        move_uploaded_file($tmp_img,$dir_img);
    };


    // Reunir os valores a serem inseridos
    $valores_insert =   "
                        '$tipo_torneio',
                        '$descri_torneio',
                        '$nome_img'
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
    $destino    =   "torneios_lista.php";
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
    <title>Torneios Insere</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo fontetabela">
<?php include("menu_adm.php"); ?>
    <main class="container">
 <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6" > <!-- abre dimensionamento -->
            <h2 class="breadcrumb fundousuarios text-center titulo">
                <a href="torneios_lista.php">
                    <button class="btn btntotal bg-danger text-white">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Inserir Torneios
            </h2>
            <div class="thumbnail"> <!-- abre thumbnail -->
                <div class="alert alert">
                    <form 
                        action="torneios_insere.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_insere_torneio"
                        name="form_insere_torneio"
                    >


                    <!-- TIPO DO TORNEIO -->
                    <label for="tipo_torneio">Tipo do Torneio:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-flag"></span>
                        </span>
                        <input 
                            type="text"
                            name="tipo_torneio"
                            id="tipo_torneio"
                            class="form-control"
                            placeholder="Ex: Municipal, Regional, Estadual..."
                            maxlength="50"
                            required
                        >
                    </div>
                    <br>

                    <!-- DESCRIÇÃO DO TORNEIO -->
                    <label for="descri_torneio">Descrição:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-edit"></span>
                        </span>
                        <input 
                            type="text"
                            name="descri_torneio"
                            id="descri_torneio"
                            class="form-control"
                            placeholder="Ex: Torneio aberto de badminton"
                            maxlength="150"
                            required
                        >
                    </div>
                    <br>

         <!-- file imagem_produto -->
         <label for="img_torneio">Imagem:</label>
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
                                name="img_torneio" 
                                id="img_torneio"
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

            </div>
        </div>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>
