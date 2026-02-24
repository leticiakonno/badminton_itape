<?php
// Incluindo o sistema de identificação
include("acesso_com.php");

// Incluir arquivo e fazer conexão
include("../Connections/conn_atletas.php");

if($_POST){

    mysqli_select_db($conn_atletas,$database_conn);

    $tabela_insert  = "tbtecnicos";

    $campos_insert  = "
        nome_tecnico,
        nivel_tecnico,
        descri_tecnico,
        img_tecnico
    ";

    // Receber dados
    $nome_tecnico   = $_POST['nome_tecnico'];
    $nivel_tecnico  = $_POST['nivel_tecnico'];
    $descri_tecnico = $_POST['descri_tecnico'];

    // IMAGEM (vem de $_FILES!)
    $img_tecnico = $_FILES['img_tecnico']['name'];

    // Mover a imagem para a pasta correta
    $destino = "../imagens/" . $img_tecnico;
    move_uploaded_file($_FILES['img_tecnico']['tmp_name'], $destino);

    // Inserir na mesma ordem dos campos
    $valores_insert = "
        '$nome_tecnico',
        '$nivel_tecnico',
        '$descri_tecnico',
        '$img_tecnico'
    ";

    $insertSQL = "
        INSERT INTO $tabela_insert
            ($campos_insert)
        VALUES
            ($valores_insert)
    ";

    $resultado = $conn_atletas->query($insertSQL);

    $destino = "tecnicos_lista.php";
    header("Location: $destino");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Técnicos Insere</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo fontetabela">
<?php include("menu_adm.php"); ?>
    <main class="container">
 <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-6" > <!-- abre dimensionamento -->
            <h2 class="breadcrumb fundousuarios text-center titulo">
                <a href="tecnicos_lista.php">
                    <button class="btn btntotal bg-danger text-white">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Inserir Técnicos
            </h2>
            <div class="thumbnail"> <!-- abre thumbnail -->
                <div class="alert alert">
                    <form 
                        action="tecnicos_insere.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_insere_tecnico"
                        name="form_insere_tecnico"
                    >
            <!-- text nome_tecnico -->
            <label for="nome_tecnico">Nome:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <input 
                                type="text" 
                                name="nome_tecnico" 
                                id="nome_tecnico"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                placeholder="Digite o nome do técnico."
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text nome_tecnico -->
                        <br>
            
             <!-- text nome_tecnico -->
             <label for="nome_tecnico">Nivel:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <input 
                                type="text" 
                                name="nivel_tecnico" 
                                id="nivel_tecnico"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                placeholder="Digite o nível do técnico."
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text nivel_tecnico -->
                        <br>

            <!-- textarea descri_tecnico -->
            <label for="descri_tecnico">Descrição de técnico:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-align-justify"></span>
                            </span>
                            <textarea 
                                name="descri_tecnico" 
                                id="descri_tecnico"
                                class="form-control"
                                placeholder="Digite a descrição da técnico."
                                cols="30"
                                rows="8"
                            ></textarea>
                        </div> <!-- fecha input-group -->
                        <!-- fecha textarea descri_parceira -->
                        <br>

              <!-- file img_atleta -->
              <label for="img_tecnico">Imagem:</label>
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
                                name="img_tecnico" 
                                id="img_tecnico"
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
</div>
</main>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script> 
<footer>
    <?php include('../rodape.php'); ?>
</footer>  
</body>
</html>