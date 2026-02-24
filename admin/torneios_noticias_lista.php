<?php
// Incluindo o sistema de identificação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Selecionar os dados
$consulta   =   "
                SELECT  *
                FROM    tb_torneios_noticias
                ORDER BY data_publicacao DESC;
                ";
// Fazer uma lista completa dos dados
$lista      =   $conn_atletas->query($consulta);
// Separar os dados em linhas (row)
$row        =   $lista->fetch_assoc();
// Contar o total de linhas
$totalRows  =   ($lista)->num_rows; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Notícias de Torneios</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">
<?php include("menu_adm.php"); ?>
<main class="container">
    <div class="col-xs-12 col-sm-8  col-md-12" > <!-- abre dimensionamento -->
    <h1 class="fundoatletas categoriageral text-center titulo">
        <a href="index.php">
            <button class="btn btntotal">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </button>
        </a>
        <strong><i>Lista de Notícias de Torneios </i></strong>
    </h1>
            <div class=" btn btntotal bg-primary text-white">
                Total de Notícias:
                <small><?php echo $totalRows; ?></small>
            </div>
            <!-- table -->
        <table class="table table-hover table-condensed tabela-branca fontetabela">
            <thead> <!--cabeçalho da tabela-->
                <tr> <!--linha da tabela-->
                    <th class="hidden">ID</th> <!--célula do cabeçalho-->
                    <th>TÍTULO</th>
                    <th>CATEGORIA</th>
                    <th>RESUMO</th>
                    <th class="hidden-xs">IMAGEM</th>
                    <th class="hidden-xs">STATUS</th>
                    <th class="hidden-xs">DATA PUBLICAÇÃO</th>
                    <th>
                        <a 
                        href="torneios_noticias_insere.php"
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
            <?php if($totalRows > 0) { do { ?>
            <tr>
                <td class="hidden"><?php echo $row['id_noticia_torneio']; ?></td>
                <td>
                    <strong><?php echo substr($row['titulo'], 0, 50); ?></strong><br>
                    <small class="text-muted"><?php echo strlen($row['titulo']) > 50 ? '...' : ''; ?></small>
                </td>
                <td><?php echo ucfirst($row['categoria']); ?></td>
                <td><?php echo substr($row['resumo'], 0, 50) . (strlen($row['resumo']) > 50 ? '...' : ''); ?></td>
                 <td class="hidden-xs">
                    <?php if(!empty($row['imagem'])) { 
                        // Verifica se o caminho da imagem já tem o diretório
                        $imagem_path = $row['imagem'];
                        if (strpos($imagem_path, 'imagens/noticias/') === false && strpos($imagem_path, '../') === false) {
                            $imagem_path = "../imagens/noticias/" . $imagem_path;
                        }
                    ?>
                    <img 
                        src="<?php echo $imagem_path; ?>" 
                        alt="<?php echo $row['titulo']; ?>" 
                        class="img-responsive"
                        width="100px"
                        style="max-height: 80px; object-fit: cover;"
                    >
                    <?php } else { ?>
                    <span class="text-muted">Sem imagem</span>
                    <?php } ?>
                </td>
                <td class="hidden-xs">
                    <?php if($row['status'] == 'ativo') { ?>
                        <span class="label label-success">Ativo</span>
                    <?php } else { ?>
                        <span class="label label-danger">Inativo</span>
                    <?php } ?>
                </td>
                <td class="hidden-xs"><?php echo date('d/m/Y H:i', strtotime($row['data_publicacao'])); ?></td>

                <!-- AÇÕES -->
                <td>
                    <a href="torneios_noticias_atualiza.php?id_noticia_torneio=<?php echo $row['id_noticia_torneio']; ?>"
                        class="btnalterar btn-xs btn-block text-center"
                    >
                        <span class="hidden-xs">ALTERAR <br></span>
                        <span class="glyphicon glyphicon-wrench"></span>
                    </a>
                    <button
                        data-id="<?php echo $row['id_noticia_torneio']; ?>"
                        data-nome="<?php echo htmlspecialchars($row['titulo']); ?>"
                        class="btn btn-danger btntotal btn-xs btn-block delete"
                    >
                        <span class="hidden-xs">EXCLUIR<br></span>
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </td>
            </tr>
            <?php } while($row = $lista->fetch_assoc()); } else { ?>
            <tr>
                <td colspan="8" class="text-center">Nenhuma notícia de torneio encontrada.</td>
            </tr>
            <?php } ?>
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
                Deseja mesmo <strong>EXCLUIR</strong> a notícia?
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
    $(document).ready(function() {
        $('.delete').on('click', function() {
            var nome = $(this).data('nome'); 
            var id = $(this).data('id');     

            $('span.nome').text(nome); 
            $('a.delete-yes').attr('href', 'torneios_noticias_exclui.php?id_noticia_torneio=' + id);
            $('#myModal').modal('show'); // abre modal
        });
    });
</script>
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>
<?php mysqli_free_result($lista); ?>