<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "tbnoticias";
$ordenar_por    =   "id_noticia ASC";
$consulta       =   "
                    SELECT   *
                    FROM     ".$tabela."
                    ORDER BY ".$ordenar_por.";
                    ";
$lista      =   $conn_atletas->query($consulta);
$row        =   $lista->fetch_assoc();
$totalRows  =   ($lista)->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
    <!-- não esquecer de comentar o JS e CSS para não dar conflito no index -->
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head> 
<body class="fundofixo fontetabela">
    <div class="layout bordacontainer">

    <main class="conteudo container bordacontainer">
        <aside class="sidebar bordacontainer" id="sidebar">
            <h2 class="text-center titulonoticia"><strong>FIQUE POR DENTRO!</strong></h2>
            <br>
            <div class="row">
            <!-- abre thumbnail -->
            <?php do{ ?>
            <div class="col-sm-12"> <!-- dimensionamento -->
                <div class="thumbnail">
                    <a 
                    href="noticias_detalhe.php?id_noticia=<?php echo $row['id_noticia']; ?>" 
                    >
                        <img 
                            src="imagens/<?php echo $row['img_noticia']; ?>" 
                            alt="<?php echo $row['titulo_noticia']; ?>"
                            class="img-responsive img-rounded"
                            style="height: 250px; width: 150%; object-fit: cover;"
                        >
                    </a>
                    <div class="caption text-center">
                        <h5 class="text-dark" style="font-size: 15px; min-height: 40px;">
                            <strong><?php echo $row['titulo_noticia']; ?></strong>
                        </h5>
                        <p class="text-center" style="min-height: 80px;">
                            <?php echo substr($row['descri_noticia'], 0, 100) . '...'; ?>
                        </p>
                        <p>
                            <a 
                                href="noticias_detalhe.php?id_torneio=<?php echo $row['id_noticia']; ?>" 
                                class="btn btntotal" 
                                role="button"
                            >
                                <span class="hidden-xs">Clique para saber mais...</span>
                                <span class="visible-xs glyphicon glyphicon-eye-open"></span>
                            </a>
                        </p>
                    </div> <!--fecha caption-->
                </div> <!--fecha thumbnail-->
            </div> <!--fecha dimensionamento-->
            <?php }while($row=$lista->fetch_assoc()); ?>
        </div> <!-- fecha row -->
    </aside>
</div>


<!-- Link arquivos Bootstrap js 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>--> 
<br>

</body>
</html>