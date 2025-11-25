<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_produtos,$database_conn);

    // Variáveis para acrescentar dados no banco
    $tabela_insert  =   "tbtorneios";
    $campos_insert  =   "
                            tipo_torneio,
                            descri_torneio
                        ";

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $tipo_torneio    =   $_POST['tipo_torneio'];
    $descri_torneio    =   $_POST['descri_torneio'];

    // Reunir os valores a serem inseridos
    $valores_insert =   "
                        '$tipo_torneio',
                        '$descri_torneio'
                        ";

    // Consulta SQL para inserção dos dados
    $insertSQL  =   "
                    INSERT INTO ".$tabela_insert."
                        (".$campos_insert.")
                    VALUES
                        (".$valores_insert.");
                    ";
    $resultado  =   $conn_produtos->query($insertSQL);

    // Após a ação a página será redirecionada
    $destino    =   "torneios_lista.php";
    if(mysqli_insert_id($conn_produtos)){
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
    <title>Inserir Torneios</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">
<main class="container">

    <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
        <h2 class="breadcrumb text-info">
            <a href="torneios_lista.php">
                <button class="btn btn-info">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </button>
            </a>
            Inserindo Torneios
        </h2>

        <div class="thumbnail">
            <div class="alert alert-info" role="alert">

                <form 
                    action="torneios_insere.php"
                    enctype="multipart/form-data"
                    method="post"
                    id="form_torneios"
                >

                    <!-- FOTO DO TORNEIO -->
                    <label for="img_torneio">Imagem do Torneio:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-picture"></span>
                        </span>
                        <input 
                            type="file"
                            name="img_torneio"
                            id="img_torneio"
                            class="form-control"
                            accept="image/*"
                        >
                    </div>
                    <br>

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
                            placeholder="Ex: Municipal, Regional, Aberto..."
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

                    <!-- BOTÃO -->
                    <input 
                        type="submit"
                        value="Cadastrar Torneio"
                        class="btn btn-info btn-block"
                    >

                </form>

            </div>
        </div>
    </div>

</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>
