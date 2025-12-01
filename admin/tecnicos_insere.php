<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas,$database_conn);

    // Variáveis para acrescentar dados no banco
    $tabela_insert  =   "tbtecnicos";
    $campos_insert  =   "
                            nome_tecnico,
                            nivel_tecnico, 
                            descri_tecnico,
                            img_tecnico
                        ";

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $nome_tecnico    =   $_POST['nome_tecnico'];
    $nivel_tecnico    =   $_POST['nivel_tecnico'];
    $descri_tecnico     =   $_POST['descri_tecnico'];
    $img_tecnico       =     $_POST['img_tecnico'];

    // Reunir os valores a serem inseridos
    $valores_insert =   "
                        '$nome_tecnico',
                        '$nivel_tecnico',
                        '$descri_tecnico',
                        '$img_tecnico'
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
    $destino    =   "tecnicos_lista.php";
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
    <title>Técnicos Insere</title>
     <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<main class="container">
 <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6" > <!-- abre dimensionamento -->
        <h2 class="fundoparceiro text-center">
                <a href="tecnicos_lista.php">
                    <button class="btn btseta ">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                <strong><i>Inserir Técnicos</i></strong>
            </h2>
            <div class="thumbnail"> <!-- abre thumbnail -->
                <div class="alert">
                    <form 
                        action="tecnicos_insere.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_insere_tecnico"
                        name="form_insere_tecnico"
                    >
            <!-- text nome_parceiro -->
            <label for="nome_tecnico">Nome:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <input 
                                type="text" 
                                name="nome_parceiro" 
                                id="nome_parceiro"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                placeholder="Digite o nome do parceiro."
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text nome_parceiro -->
                        <br>

            <!-- radio nivel_usuario -->
            <label for="nivel_usuario_c">Nível do usuário?</label>
                        <div class="input-group">
                            <label for="nivel_usuario_c" class="radio-inline">
                                <input 
                                    type="radio"
                                    name="nivel_usuario"
                                    id="nivel_usuario"
                                    value="com"
                                    checked
                                >
                                Comum
                            </label>
                            <label for="nivel_usuario_s" class="radio-inline">
                                <input 
                                    type="radio"
                                    name="nivel_usuario"
                                    id="nivel_usuario"
                                    value="sup"
                                >
                                Supervisor
                            </label>
                        </div>
                        <!-- fecha radio nivel_tecnico -->
                        <br>

            <!-- textarea descri_tecnico -->
            <label for="descri_tecnico">Descrição do Técnico:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-align-justify"></span>
                            </span>
                            <textarea 
                                name="descri_tecnico" 
                                id="descri_tecnico"
                                class="form-control"
                                placeholder="Digite a descrição da tecnico."
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
</body>
</html>