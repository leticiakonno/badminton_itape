<?php
//Incluir o Sistema de Autenticação
include("acesso_sup.php");

//incluir arquivo e fazer a conexão
include ("..//Connections/conn_atletas.php");
// Selecionar os dados
$consulta = "
            SELECT *
            FROM    tbusuarios
            ORDER BY id_usuario DESC;
            ";
// Fazer uma lista completa dos dados
$lista      =   $conn_atletas->query($consulta);
//separa os dados em linhas (row)
$row     =   $lista->fetch_assoc();
// contar o total de linhas 
$totalRows  =   ($lista)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Lista</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">
<?php include("menu_adm.php"); ?>
<main class="container">
    <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8" > <!-- abre dimensionamento -->
            <h1 class="fundocategoria text-center titulo">
                <a href="index.php" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%);">
                    <button class="btn btntotal bg-danger text-white" style="width: 40px; height: 40px; padding: 0;">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                <strong><i>Lista de Usuários</i></strong>
            </h1>
            <br>
            <div class="btn btntotal bg-primary text-white">
                Total de Usuários:
                <small><?php echo $totalRows; ?></small>
            </div>
            <!-- table -->
        <table class="table table-hover table-condensed tabela-branca fontetabela">
                <thead>
                <tr>
                    <th class="hidden">ID</th>
                    <th>LOGIN</th>
                    <th>NÍVEL DO USUÁRIO</th>
                    <th>FOTO DO USUÁRIO</th> <!-- NOVA COLUNA (ALTERAÇÃO 1) -->
                    
                    <th>
                        <a 
                            href="usuarios_insere.php"
                            class="btn btn-block btnadicionar btn-xs btnadicionar"
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

                <td class="hidden"><?php echo $row['id_usuario']; ?></td>

                

                <!-- LOGIN -->
                <td><?php echo $row['login_usuario']; ?></td>

                <!-- NÍVEL -->
                <td>
                    <?php
                    if($row['nivel_usuario']=='com') {
                        echo('<span class="glyphicon glyphicon-star-empty texticon"></span>');
                    } else if($row['nivel_usuario']=='sup') {
                        echo('<span class="glyphicon glyphicon-star texticon"></span>');
                    }
                    ?>
                    <?php echo $row['nivel_usuario']; ?>
                </td>

                <!-- FOTO -->
                <td style="padding-left: 60px;">
                    <img 
                        src="../imagens/usuarios/<?php echo $row['foto_usuario']; ?>" 
                        alt="<?php echo $row['login_usuario']; ?>" 
                        class="img-responsive img-circle"
                        width="100px"
                    >
                </td>

                <!-- AÇÕES -->
                <td>
                    <a href="usuarios_atualiza.php?id_usuario=<?php echo $row['id_usuario']; ?>"
                        target="_self"
                        class="btnalterar btn-xs btn-block text-center"
                        role="button"
                    >
                        <span class="hidden-xs">ALTERAR <br></span>
                        <span class="glyphicon glyphicon-wrench"></span>
                    </a>
                    <button
                        data-id="<?php echo $row['id_usuario']; ?>"
                        data-nome="<?php echo $row['login_usuario']; ?>"
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
<!-- Modal -->
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
</div> <!-- fecha myModal -->



<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>  

<!-- sript para o Modal -->
<script type="text/javascript">
    $('.delete').on('click', function() {
        var nome = $(this).data('nome'); 
        var id = $(this).data('id');     

        $('span.nome').text(nome); 
        $('a.delete-yes').attr('href', 'usuarios_exclui.php?id_usuario=' + id);
        $('#myModal').modal('show'); // abre modal
    });
</script>
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>
<?php mysqli_free_result($lista); ?>