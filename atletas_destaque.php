<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela_destaque        =   "vw_tbatletas";
$campo_filtro_destaque  =   "destaque_atleta";
$ordenar_por_destaque   =   "descri_atleta ASC";
$filtro_select_destaque =   "Sim";
$consulta_destaque      =   "
                            SELECT   *
                            FROM     ".$tabela_destaque."
                            WHERE    ".$campo_filtro_destaque."='".$filtro_select_destaque."'
                            ORDER BY ".$ordenar_por_destaque.";
                            ";
$lista_destaque          =   $conn_atletas->query($consulta_destaque);
$row_destaque   =   $lista_destaque->fetch_assoc();
$totalRows_destaque      =   ($lista_destaque)->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atletas</title>
    <link rel="icon" type="image/png" href="/imagens/logobadminton.png">
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css"> 
</head>
<body class="fundofixo fontetabela">
<?php include('menu_publico.php'); ?>
<main class="container">
<i>
  <h2 class="fundocategoria categoriageral text-center titulo" style="position: relative; padding: 10px 50px;">
                    <a href="index.php" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%);">
                        <button class="btn btntotal bg-danger text-white" style="width: 40px; height: 40px; padding: 0;">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>    
<strong>TALENTOS</strong></h2></i>
 <br><br>
    <div class="fundo-index" style="padding-top: 50px;border-radius: 15px;">
    <div class="row" style="padding-left: 50px; padding-right: 50px;">  
<br>
    <!-- Abre thumbnail/card (card no bootstrap em inglês) -->
     <?php do{ ?> <!-- abre estrutura de repetição -->
    <div class="col-xs-12 col-sm-6 col-md-4"> <!-- dimensionamento -->  
        <br>
        <div class="thumbnail ">
            <br>
            <a 
                href="atletas_detalhe.php?id_atleta=<?php echo $row_destaque['id_atleta']; ?>"
            >
            <img 
                src="imagens/atletas/<?php echo $row_destaque['img_atleta']; ?>" 
                alt=""
                class="img-responsive img-rounded"
                style="height: 20em;"               
            >                                                                                       <!-- height "em" deixa o tamanho da imagem relativo ao tamanho da página -->
            </a>                                       
            <div class="caption text-left">
                <h3 class="text">
                    <strong><?php echo $row_destaque['nome_atleta']; ?></strong>
                </h3>
                <p class="texticon">
                    <strong><?php echo $row_destaque['nome_categoria']; ?></strong>
                    </p>
                <p class="text-left">
                <?php echo mb_strimwidth ($row_destaque['descri_atleta'],0,30,"...");?>
                </p>   
                <p class="text-right">        
                    <a 
                        href="atletas_detalhe.php?id_atleta=<?php echo $row_destaque['id_atleta']; ?>"
                        class="btn btntotal "
                        role="button"
                    >
                        <span class="hidden-xs">Saiba mais...</span>
                        <span class="visible-xs glyphicon glyphicon-eye-open"></span>
                    </a>
                    </p> 
            </div>
        </div> <!-- fecha thumbnail -->
    </div> <!-- fecha dimensionamento -->
    <?php }while($row_destaque=$lista_destaque->fetch_assoc()); ?> <!-- fecha estrutura de repetição -->
    <!-- Fecha thumbnail/card -->
</div> <!-- fecha row -->
</div>
<br>
     </main>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>  
<?php include('rodape.php'); ?>
</body>
</html>
<?php mysqli_free_result($lista_destaque); ?>