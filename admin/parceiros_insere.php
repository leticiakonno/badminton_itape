<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_atletas,$database_conn);

    // Variáveis para acrescentar dados no banco
    $tabela_insert  =   "tbparceiros";
    $campos_insert  =   "
                            nome_parceiro,
                            descri_parceiro,
                            img_parceiro
                        ";

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $nome_parceiro    =   $_POST['nome_parceiro'];
    $descri_parceiro     =   $_POST['descri_parceiro'];
    $img_parceiro       =     $_POST['img_parceiro'];

    // Reunir os valores a serem inseridos
    $valores_insert =   "
                        '$nome_parceiro',
                        '$descri_parceiro',
                        '$img_parceiro'
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
    $destino    =   "parceiros_lista.php";
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
    <title>Parceiros Insere</title>
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
        <h2 class="fundoatletas text-center">
                <a href="parceiros_lista.php">
                    <button class="btn btseta ">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                <strong><i>Inserir Parceiros</i></strong>
            </h2>
            <div class="thumbnail"> <!-- abre thumbnail -->
                <div class="alert">
                    <form 
                        action="parceiros_insere.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_insere_parceiro"
                        name="form_insere_parceiro"
                    >
            <!-- text nome_parceiro -->
            <label for="nome_parceiro">Nome:</label>
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

            <!-- textarea descri_parceiro -->
            <label for="descri_parceiro">Descrição de parceiro:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-align-justify"></span>
                            </span>
                            <textarea 
                                name="descri_parceiro" 
                                id="descri_parceiro"
                                class="form-control"
                                placeholder="Digite a descrição da parceiro."
                                cols="30"
                                rows="8"
                            ></textarea>
                        </div> <!-- fecha input-group -->
                        <!-- fecha textarea descri_parceira -->
                        <br>

              <!-- file img_atleta -->
              <label for="img_parceiro">Imagem:</label>
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
                                name="img_parceiro" 
                                id="img_parceiro"
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