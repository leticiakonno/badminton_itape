<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "tbtorneios";  // ← TABELA DE TIPOS DE TORNEIOS
$ordenar_por    =   "id_torneio ASC";
$consulta       =   "
                    SELECT   *
                    FROM     ".$tabela."
                    ORDER BY ".$ordenar_por.";
                    ";
$lista      =   $conn_atletas->query($consulta);
$row        =   $lista->fetch_assoc();
$totalRows  =   ($lista)->num_rows;
?>

<body class="fundofixo fontetabela">
    <main class="container">
    <h2 class="fundocategoria categoriageral text-center titulo"><strong>TRAJETÓRIA DE CAMPEÕES   <i class="fa-solid fa-medal"></i></strong></h2>
    <br><br>
    <div class="container">
        <div class="row">
            <!-- abre thumbnail -->
            <?php do{ ?>
            <div class="col-sm-6 col-md-4 col-lg-3"> <!-- dimensionamento -->
                <div class="thumbnail">
                    <a 
                    href="torneios_detalhe.php?id_torneio=<?php echo $row['id_torneio']; ?>" 
                    >
                        <img 
                            src="imagens/torneios/<?php echo $row['img_torneio']; ?>" 
                            alt="<?php echo $row['tipo_torneio']; ?>"
                            class="img-responsive img-rounded"
                            style="height: 200px; width: 100%; object-fit: cover;"
                        >
                    </a>
                    <div class="caption text-center">
                        <h5 class="text-dark" style="font-size: 20px; min-height: 60px;">
                            <strong><?php echo $row['tipo_torneio']; ?></strong>
                        </h5>
                        <p class="text-center" style="min-height: 80px;">
                            <?php echo substr($row['descri_torneio'], 0, 100) . '...'; ?>
                        </p>
                        <p>
                            <?php
                            // Converter o tipo do torneio para minúsculo
                            $categoria_param = strtolower($row['tipo_torneio']);
                            ?>
                            <a 
                                href="torneios_noticia.php?categoria=<?php echo $categoria_param; ?>" 
                                class="btn btn-danger btntotal" 
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
    </div> <!-- fecha container -->
</main>
<!-- Link arquivos Bootstrap js-->

</body>
</html>
<?php mysqli_free_result($lista); ?>