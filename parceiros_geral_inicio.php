<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "tbparceiros";
$ordenar_por    =   "id_parceiro ASC";
$consulta       =   "
                    SELECT   *
                    FROM     ".$tabela."
                    ORDER BY ".$ordenar_por."
                    LIMIT 3;
                    ";
$lista      =   $conn_atletas->query($consulta);
$row        =   $lista->fetch_assoc();
$totalRows  =   ($lista)->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
    <link rel="icon" type="image/png" href="/imagens/logobadminton.png">
    <!-- Link CSS do Bootstrap 
    <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <!-- Link para CSS Específico 
    <link rel="stylesheet" href="css/meu_estilo.css">-->
</head>
<body class="fundofixo fontetabela">
    <div class="layout bordacontainer">
    <main class="conteudo container bordacontainer">
        <aside class="sidebarparceiros bordacontainer" id="sidebar">
        <h2 class="text-center titulonoticia"><strong>PARCEIROS   <i class="fa-regular fa-handshake"></i></strong></h2>
        <br>
            <div class="row">
                <!-- abre thumbnail -->
                <?php do{ ?>
                <div class="col-sm-12"> <!-- dimensionamento -->
                    <div class="thumbnail thumbnail-sem-borda">
                        <a 
                        href="parceiros_detalhe.php?id_parceiro=<?php echo $row['id_parceiro']; ?>" 
                    >
                        <img 
                            src="imagens/apoiadores/<?php echo $row['img_parceiro']; ?>" 
                            alt=""
                            class="img-responsive img-rounded"
                            style="height: 220px; width: 80%; object-fit: contain;"
                        >
                    </a>

                    </div> <!--fecha thumbnail-->
                </div> <!--fecha dimensionamento-->
                <?php }while($row=$lista->fetch_assoc()); ?>
        </div> <!-- fecha row -->
    </aside>
</div>
</main>
<!-- Link arquivos Bootstrap js 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>    -->
</body>
</html>
<?php mysqli_free_result($lista); ?>
  