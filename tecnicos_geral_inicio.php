<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "tbtecnicos";
$ordenar_por    =   "id_tecnico ASC";
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

<body class="fundofixo fontetabela">
    <main class="container">
    <h2 class="fundoatletas titulo text-center"><strong>NOSSOS MENTORES   <span class="glyphicon glyphicon-flash"></span></i></strong></h2>
    <br>
    <div class="row">
    <br>
        <!-- abre thumbnail -->
        <?php do{ ?>
        <div class="col-sm-6 col-md-4"> <!-- dimensionamento -->
            <div class="thumbnail">
                <a 
                href="tecnicos_detalhe.php?id_tecnico=<?php echo $row['id_tecnico']; ?>" 
                >
                    <img 
                        src="imagens/tecnicos/<?php echo $row['img_tecnico']; ?>" 
                        alt=""
                        class="img-responsive img-rounded"
                        style="height: 20em;"
                    >
                </a>
                <div class="caption text-left">
                    <h5 class="text" style="font-size: 25px;"><strong><?php echo $row['nome_tecnico']; ?></strong></h5>
                    <p class="texticon">
                    <strong><?php echo $row['nivel_tecnico']; ?></strong>
                    </p>
                    <p class="text-left">
                        <?php echo mb_strimwidth ($row['descri_tecnico'],0,45,"...");?>
                    </p>
                    <p class="text-right">
                        <a 
                            href="tecnicos_detalhe.php?id_tecnico=<?php echo $row['id_tecnico']; ?>" 
                            class="btn btntotal" 
                            role="button"
                        >
                            <span class="hidden-xs">Saiba mais...</span>
                            <span class="visible-xs glyphicon glyphicon-eye-open"></span>
                        </a>
                    </p>
                </div> <!--fecha caption-->
            </div> <!--fecha thumbnail-->
        </div> <!--fecha dimensionamento-->
        <?php }while($row=$lista->fetch_assoc()); ?>
    </div> <!-- fecha div container -->
</main>
</body>
</html>
<?php mysqli_free_result($lista); ?>