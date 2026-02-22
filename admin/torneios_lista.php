<?php
// Incluindo o sistema de identificação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Selecionar os dados
$consulta   =   "
                SELECT  *
                FROM    tbtorneios
                ORDER BY id_torneio ASC;
                ";
// Fazer uma lista completa dos dados
$lista      =   $conn_atletas->query($consulta);
// Separar os dados em linhas (row)
$row        =   $lista->fetch_assoc();
// Contar o total de linhas
//torneios
$totalRows  =   ($lista)->num_rows; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneios Lista</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">
<?php include("menu_adm.php"); ?>
<main class="container">
    <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12 " > <!-- abre dimensionamento -->
        <h1 class="fundocategoria text-center titulo">
            <a href="index.php">
                <button class="btn btntotal">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </button>
            </a>
            <strong><i>Lista de Torneios</i></strong>
        </h1>
        <br>
        <div class="btn btntotal bg-primary text-white">
            Total de Torneios:
            <small><?php echo $totalRows; ?></small>
        </div>
        <!-- table -->
        <table class="table table-hover table-condensed tabela-branca fontetabela">
            <thead> <!--cabeçalho da tabela-->
                <tr> <!--linha da tabela-->
                    <th class="hidden">ID</th> <!--célula do cabeçalho-->
                    <th>TIPO</th>
                    <th>DESCRIÇÃO</th>
                    <th>IMAGEM</th>
                     <th>
                        <a 
                        href="torneios_insere.php"
                        class="btn btn-block btnadicionar btn-xs btnadicionar"
                        >
                        <span class="hidden-xs">ADICIONAR <br></span>
                        <span class="glyphicon glyphicon-plus"></span>
                     </a>
                    </th>
                    </tr>
            </thead> 
             <tbody>
            <!--Abre estrutura de repetição-->
            <?php do { ?>
            <tr>
                <td class="hidden"><?php echo $row['id_torneio']; ?></td>
                <td><?php echo $row['tipo_torneio']; ?></td>
                <td><?php echo $row['descri_torneio']; ?></td>
                 <td>
                    <img 
                        src="../imagens/torneios/<?php echo $row['img_torneio']; ?>" 
                        alt="<?php echo $row['tipo_torneio']; ?>" 
                        class="img-responsive"
                        width="100px"
                    >
                </td>
                <!-- torneios -->

                <!-- AÇÕES -->
                <td>
                    <a href="torneios_atualiza.php?id_torneio=<?php echo $row['id_torneio']; ?>"
                        target="_self"
                        class="btnalterar btn-xs btn-block text-center"
                        role="button"
                    >
                        <span class="hidden-xs">ALTERAR <br></span>
                        <span class="glyphicon glyphicon-wrench"></span>
                    </a>
                    <button
                        data-id="<?php echo $row['id_torneio']; ?>"
                        data-nome="<?php echo $row['tipo_torneio']; ?>"
                        class="btn btn-danger btntotal btn-xs btn-block delete"
                    >
                        <span class="hidden-xs">EXCLUIR<br></span>
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </td>
            </tr>
            <?php } while($row = $lista->fetch_assoc()); ?>
        </tbody>
        </table>
    </div> <!--fecha dimensionamento-->
</main>
<!--modal-->
<div id="myModal" class="modal fade" role="dialog" >
    <div class="modal-dialog text-center">
        <div class="modal-content">
            <div class="modal-header">
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                >
                    &times;
                </button>
                <h4 class="modal-title text-danger "><strong>ATENÇÃO!</strong></h4>
            </div> <!-- fecha modal-header -->
            <div class="modal-body text-center ">
                Deseja mesmo <strong>EXCLUIR</strong> o item?
                <h4><span class="nome text-danger"></span></h4>
            </div> <!-- fecha modal-body -->    

            <div class="modal-footer">
                <a 
                    href="#" 
                    type="button" 
                    class="btn btntotal delete-yes"
                >
                    Confirmar
                </a>
                <button class="btn btnmodal-cancelar" data-dismiss="modal">
                    Cancelar
                </button>
            </div> <!-- fecha modal-footer -->
        </div> <!-- fecha modal-content -->
    </div> <!-- fecha modal-dialog -->
</div> <!-- fecha modal -->
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>  

<!-- sript para o Modal -->
<script type="text/javascript">
    $('.delete').on('click', function() {
        var nome = $(this).data('nome'); 
        var id = $(this).data('id');     

        $('span.nome').text(nome); 
        $('a.delete-yes').attr('href', 'torneios_exclui.php?id_torneio=' + id);
        $('#myModal').modal('show'); // abre modal
    });
</script>
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>
<?php mysqli_free_result($lista); ?>