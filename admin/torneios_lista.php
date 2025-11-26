<?php
// incluir arquivo e fazer a conexão
include ("..//Connections/conn_atletas.php");

// Consulta dos torneios
$consulta = "
    SELECT *
    FROM tbtorneios
    ORDER BY id_torneio DESC;
";

// Executa a consulta
$lista = $conn_atletas->query($consulta);

// Verifica número de linhas
$totalRows = ($lista) ? $lista->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Torneios</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">

    <main class="container">
        <div class="col-xs-12 col-sm-10 col-md-8 col-md-offset-2">
            <h1 class="breadcrumb alert-info">Lista de Torneios</h1>

            <div class="btn btn-info disabled">
                Total de Torneios:
                <small class="badge"><?php echo $totalRows; ?></small>
            </div>

            <table class="table table-hover table-condensed tbopacidade">
                <thead>
                    <tr>
                        <th class="hidden">ID</th>
                        <th>TIPO</th>
                        <th>DESCRIÇÃO</th>
                        <th>IMAGEM</th>
                        <th>
                            <a href="torneios_insere.php" class="btn btn-block btn-primary btn-xs">
                                <span class="hidden-xs">ADICIONAR<br></span>
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($lista && $lista->num_rows > 0): ?>
                        <?php while ($row = $lista->fetch_assoc()): ?>
                            <tr>
                                <td class="hidden"><?php echo (int)$row['id_torneio']; ?></td>

                               

                                <!-- Tipo -->
                                <td><?php echo htmlspecialchars($row['tipo_torneio'], ENT_QUOTES, 'UTF-8'); ?></td>

                                <!-- Descrição (resumida -->
                                <td class="td-descri" title="<?php echo htmlspecialchars($row['descri_torneio'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($row['descri_torneio'], ENT_QUOTES, 'UTF-8'); ?>
                                </td>

                                <!-- Imagem do torneio -->
                                <td>
                                <!-- 
                                    Para exibir uma imagem insira em 'src'
                                    o diretório que ela está armazenada e
                                    a variável com seu nome.
                                -->
                                <img 
                                    src="../imagens/torneios/<?php echo $row['img_torneio']; ?>" 
                                    alt="<?php echo $row['descri_torneio']; ?>"
                                    width="100px"
                                >
                            </td>
              

                                <!-- Ações -->
                                <td>
                                    <a href="torneios_atualiza.php?id_torneio=<?php echo (int)$row['id_torneio']; ?>"
                                       class="btn btn-block btn-warning btn-xs">
                                        <span class="hidden-xs">ALTERAR<br></span>
                                        <span class="glyphicon glyphicon-refresh"></span>
                                    </a>

                                    <button
                                        data-id="<?php echo (int)$row['id_torneio']; ?>"
                                        data-nome="<?php echo htmlspecialchars($row['tipo_torneio'], ENT_QUOTES, 'UTF-8'); ?>"
                                        class="btn btn-danger btn-xs btn-block delete">
                                        <span class="hidden-xs">EXCLUIR<br></span>
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Nenhum torneio encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal de confirmação -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-danger">ATENÇÃO!</h4>
                </div>
                <div class="modal-body">
                    Deseja mesmo EXCLUIR o item?
                    <h4><span class="nome text-danger"></span></h4>
                </div>
                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-danger delete-yes">Confirmar</a>
                    <button class="btn btn-success" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $('.delete').on('click', function() {
            var nome = $(this).data('nome');
            var id   = $(this).data('id');

            $('span.nome').text(nome);
            $('a.delete-yes').attr('href', 'torneios_exclui.php?id_torneio=' + id);
            $('#myModal').modal('show');
        });
    </script>
</body>
</html>
<?php
// libera resultado
if ($lista) mysqli_free_result($lista);
?>
