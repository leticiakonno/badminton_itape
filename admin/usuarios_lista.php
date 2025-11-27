<?php
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
    <title>Lista de Usuários</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
    <main class="container">
    <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-2 col-md-8" > <!-- abre dimensionamento -->
    <h1 class="fundoparceiro text-center"><strong><i>Lista de Usuários</i></strong></h1>
                <div class="btn btntotal bg-primary text-white">
                Total de Usuários:
                <small class="badge"><?php echo $totalRows; ?></small>
            </div>
            <!-- table -->
        <table class="table table-hover table-condensed tabela-branca">
                <thead>
                <tr>
                    <th class="hidden">ID</th>
                    <th>USER</th> <!-- NOVA COLUNA (ALTERAÇÃO 1) -->
                    <th>LOGIN</th>
                    <th>NÍVEL</th>
                    <th>
                        <a 
                            href="usuarios_insere.php"
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

                <td class="hidden"><?php echo $row['id_usuario']; ?></td>

                <!-- FOTO -->
                <td>
                    <?php
                        $caminho_fotos = "../imagens/usuarios/";
                        $foto = (!empty($row['foto_usuario']))
                                    ? $caminho_fotos . $row['foto_usuario']
                                    : "../imagens/usuarios/default.png";
                    ?>
                    <img src="<?php echo $foto; ?>" class="foto-usuario" style="width:90px; height:90px; border-radius:50%;">
                </td>

                <!-- LOGIN -->
                <td><?php echo $row['login_usuario']; ?></td>

                <!-- NÍVEL -->
                <td>
                    <?php
                    if($row['nivel_usuario']=='com') {
                        echo('<span class="glyphicon glyphicon-user text-info"></span>');
                    } else if($row['nivel_usuario']=='sup') {
                        echo('<span class="glyphicon glyphicon-star text-warning"></span>');
                    }
                    ?>
                    <?php echo $row['nivel_usuario']; ?>
                </td>

                <!-- AÇÕES -->
                <td>
                    <a href="usuarios_atualiza.php?id_usuario=<?php echo $row['id_usuario']; ?>"
                        class="btn btn-block btn-warning btn-xs">
                        <span class="hidden-xs">ALTERAR<br></span>
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>

                    <button
                        data-id="<?php echo $row['id_usuario']; ?>"
                        data-nome="<?php echo $row['login_usuario']; ?>"
                        class="btn btn-danger btn-xs btn-block delete">
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title text-danger">ATENÇÃO!</h4>
            </div> <!-- fecha modal-header -->
            <div class="modal-body">
                Deseja mesmo EXCLUIR o item?
                <h4><span class="nome text-danger"></span></h4>
            </div> <!-- fecha modal-body -->
            <div class="modal-footer">
                <a 
                    href="#"
                    type="button"
                    class="btn btn-danger delete-yes"
                >
                    Confirmar
                </a>
                <button class="btn btn-success " data-dismiss="modal">
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
</body>
</html>
<?php mysqli_free_result($lista); ?>