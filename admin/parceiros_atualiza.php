<?php
//Incluir o Sistema de Autenticação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Variáveis Globais
$tabela         =   "tbparceiros";
$campo_filtro   =   "id_parceiro";

// Primeiro, precisamos carregar os dados do usuário ANTES do POST  
// para recuperar nome da foto atual caso não seja trocada
if (isset($_GET['id_parceiro'])) {
    mysqli_select_db($conn_atletas, $database_conn);
    $filtro_select  =   $_GET['id_parceiro'];
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
    $nome_parceiro    =   $_POST['nome_parceiro'];
    $descri_parceiro    =   $_POST['descri_parceiro'];
    // Campo para filtrar o registro
    $filtro_update  =   $_POST['id_parceiro'];
    $foto_usuario = $row['img_parceiro']; // mantém a foto atual caso não troque

    // Se o usuário enviou uma nova foto
    if (!empty($_FILES['img_parceiro']['name'])) {

        $nomeArquivo = $_FILES['img_parceiro']['name'];
        $tempArquivo = $_FILES['img_parceiro']['tmp_name'];
        $destino = "../imagens/apoiadores/" . $nomeArquivo;

        move_uploaded_file($tempArquivo, $destino);

        $foto_usuario = $nomeArquivo; 
    }
    // ------------------------------------------

    // Consulta SQL para ATUALIZAÇÃO dos dados
    $updateSQL  =   "
                    UPDATE ".$tabela."
                        SET nome_parceiro  = '".$nome_parceiro."'   ,
                            descri_parceiro  = '".$descri_parceiro."'    ,
                            img_parceiro   = '".$img_parceiro."'
                    WHERE ".$campo_filtro."='".$filtro_update."';
                    ";
    $resultado  =   $conn_atletas->query($updateSQL);

    // Redirecionamento
    $destino    =   "parceiros_lista.php";
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
    <title>Atualiza Parceiros</title>
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
                <a href="parceiros_lista.php">
                    <button class="btn btntotal">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualiza Parceiros
            </h2>
            <br>
            <div class="thumbnail">
                <div class="alert" role="alert">

                    <form 
                        action="parceiros_atualiza.php?id_parceiro=<?php echo $row['id_parceiro']; ?>"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_parceiro_atualiza"
                        name="form_parceiro.atualiza"
                    >

                        <!-- id_usuario oculto -->
                        <input
                            type="hidden"
                            name="id_parceiro"
                            id="id_parceiro"
                            value="<?php echo $row['id_parceiro']; ?>"
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
                                value="<?php echo $row['nome_parceiro']; ?>"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text nome_parceiro -->
                        <br>

                         <!-- textarea descri_parceiro -->
                         <label for="descri_parceiro">Descrição do parceiro:</label>
                         <div class="input-group">
                             <span class="input-group-addon">
                                 <span class="glyphicon glyphicon-align-justify"></span>
                             </span>
                             <textarea 
                                 name="descri_parceiro" 
                                 id="descri_parceiro"
                                 class="form-control"
                                 placeholder="Digite a descrição do parceiro."
                                 cols="30"
                                 rows="8"  
                             ><?php echo $row['descri_parceiro']; ?></textarea>
                         </div> <!-- fecha input-group -->
                         <!-- fecha textarea descri_categoria -->   
                         <br>

                         <!-- FOTO DO USUÁRIO -->
                        <label for="img_parceiro">Foto do parceiro:</label>
                        <input 
                            type="file"
                            name="img_parceiro"
                            id="img_parceiro"
                            class="form-control"
                            accept="image/*"
                        >

                        <!-- exibe foto atual -->
                        <br>
                        <img 
                            src="../imagens/apoiadores/<?php echo $row['img_parceiro']; ?>" 
                            width="80"
                            style="border-radius:50%; object-fit:cover;"
                        >
                        <br><br>
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