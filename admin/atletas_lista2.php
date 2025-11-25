<?php
// incluir arquivo e fazer a conexão
include ("../Connections/conn_atletas.php");

// Selecionar os dados (recomendo usar a VIEW depois, mas por enquanto deixei a tabela)
$consulta = "
    SELECT a.*, c.nome_categoria
    FROM tbatletas AS a
    LEFT JOIN tbcategorias AS c
        ON a.id_categoria_atleta = c.id_categoria
    ORDER BY a.id_atleta DESC;
";


$lista = $conn_atletas->query($consulta);

// separa os dados em linhas
$row = $lista->fetch_assoc();

// contar o total de linhas 
$totalRows = $lista->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atletas - Lista</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">

<main class="container">

<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3"> <!---dimensionamento-->

        <h1 class="breadcrumb alert-info">Lista de Atletas</h1>

        <div class="btn btn-info disabled">
            Total de atletas:
            <small class="badge"><?php echo $totalRows; ?></small>
        </div>

        <!-- tabela -->
        <table class="table table-hover table-condensed tbopacidade">
            <thead>
                <tr>
                    <th class="hidden">ID</th>
                    <th>Foto Atleta</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Data Nascimento</th>
                    <th>Descrição</th>
                    <th>Data Cadastro</th>
                    <th>Destaque</th>
                    <th class="hidden">Ações</th>
                    <th>
                        <a 
                            href="atletas_insere.php"
                            class="btn btn-block btn-primary btn-xs"
                        >
                            <span class="hidden-xs">ADICIONAR<br></span>
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </th>
                </tr>
            </thead>

            <tbody>

            <?php do { ?>

                <tr>
                    <!-- ID -->
                    <td class="hidden"><?php echo $row['id_atleta']; ?></td>

                    <!-- FOTO -->
                    <td>
                        <?php
                            $pasta = "../imagens/atletas/";
                            $foto = (!empty($row['img_atleta']))
                                    ? $pasta . $row['img_atleta']
                                    : $pasta . "default.png";
                        ?>
                        <img src="<?php echo $foto; ?>" style="width:55px; height:55px; border-radius:50%;">
                    </td>

                    <!-- NOME -->
                    <td><?php echo $row['nome_atleta']; ?></td>

                    <!-- CATEGORIA -->
                    <td><?php echo $row['nome_categoria']; ?></td>

                    <!-- DATA NASCIMENTO -->
                    <td><?php echo date('d/m/Y', strtotime($row['data_nas_atleta'])); ?></td>

                    <!-- DESCRIÇÃO -->
                    <td style="max-width:250px;"><?php echo $row['descri_atleta']; ?></td>

                    <!-- DATA CADASTRO -->
                    <td><?php echo date('d/m/Y', strtotime($row['data_cad_atleta'])); ?></td>


                    <!-- DESTAQUE -->
                    <td>
                        <?php
                            if($row['destaque_atleta']=='Sim'){
                                echo('<span class="glyphicon glyphicon-star text-warning"></span>');
                            } else if($row['destaque_atleta']=='Não'){ 
                                echo('<span class="glyphicon glyphicon-ok text-danger"></span>');
                            };
                        ?>
                    </td>

                    <!-- teste -->
                     
        

                    <!-- fecha teste -->

                    <!-- AÇÕES -->
                    <td>
                        <a href="atletas_atualiza.php?id_atleta=<?php echo $row['id_atleta']; ?>"
                            class="btn btn-warning btn-xs btn-block">
                            <span class="hidden-xs">ALTERAR<br></span>
                            <span class="glyphicon glyphicon-refresh"></span>
                        </a>

                        <button
                            data-id="<?php echo $row['id_atleta']; ?>"
                            data-nome="<?php echo $row['nome_atleta']; ?>"
                            class="btn btn-danger btn-xs btn-block delete"
                        >
                            <span class="hidden-xs">EXCLUIR<br></span>
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>

            <?php } while($row = $lista->fetch_assoc()); ?>

            </tbody>
        </table>

    </div>

</main>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        
        <div class="modal-content">

            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-danger">ATENÇÃO!</h4>
            </div>

            <div class="modal-body">
                Deseja realmente excluir este atleta?
                <h4><span class="nome text-danger"></span></h4>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn btn-danger delete-yes">Confirmar</a>
                <button class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </div>

        </div>

    </div>
</div>

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script>
    $('.delete').on('click', function() {
        var nome = $(this).data('nome');
        var id = $(this).data('id');

        $('span.nome').text(nome);
        $('a.delete-yes').attr('href', 'atletas_exclui.php?id_atleta=' + id);

        $('#myModal').modal('show');
    });
</script>

</body>
</html>

<?php mysqli_free_result($lista); ?>
