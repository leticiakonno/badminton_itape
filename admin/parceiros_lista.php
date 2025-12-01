<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Selecionar os dados
$consulta   =   "
                SELECT  *
                FROM    tbparceiros
                ORDER BY nome_parceiro ASC;
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
    <title>Lista de Parceiros</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
    <main class="container">
    <h1 class="fundoparceiro text-center"><strong><i>Lista de Parceiros</i></strong></h1>
                <div class="btn btntotal bg-primary text-white">
                Total de Parceiros:
                <small><?php echo $totalRows; ?></small>
            </div>
            <!-- table -->
        <table class="table table-hover table-condensed tabela-branca">
            <thead> <!--cabeçalho da tabela-->
                <tr> <!--linha da tabela-->
                    <th class="hidden">ID</th> <!--célula do cabeçalho-->
                    <th>NOME</th>
                    <th>DESCRIÇÃO</th>
                    <th>IMAGEM</th>
                     <th>
                        <a 
                        href="parceiros_insere.php"
                        class="btn btn-block btn-primary btn-xs"
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
                <td class="hidden"><?php echo $row['id_parceiro']; ?></td>
                <td><?php echo $row['nome_parceiro']; ?></td>
                <td><?php echo $row['descri_parceiro']; ?></td>
                 <td>
                    <img 
                        src="../imagens/apoiadores/<?php echo $row['img_parceiro']; ?>" 
                        alt="<?php echo $row['nome_parceiro']; ?>" 
                        class="img-circle img-fixed"
                        width="100px"
                    >
                </td>
                <td>
                    <a href="parceiros_atualiza.php?id_parceiro=<?php echo $row['id_parceiro']; ?>"
                        target="_self"
                        class="btn-warning btn-xs btn-block text-center"
                        role="button"
                    >
                        <span class="hidden-xs">ALTERAR <br></span>
                        <span class="glyphicon glyphicon-wrench"></span>
                    </a>
                    <button
                        data-id="<?php echo $row['id_parceiro']; ?>"
                        data-nome="<?php echo $row['nome_parceiro']; ?>"
                        class="btn btn-danger btn-xs btn-block delete"
                    >
                        <span class="hidden-xs">EXCLUIR<br></span>
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </td>
            </tr>
            <?php }while($row = $lista->fetch_assoc());  ?>
            <!-- Fechar a estrutura de repetição -->
             </tbody>
    </table>
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
            <div class="modal-body text-center">
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

<!-- Script para o Modal -->
<script type="text/javascript">
    $('.delete').on('click',function(){
        var nome    =   $(this).data('nome');
        // buscar o valor do atributo data-nome
        var id      =   $(this).data('id');
        // buscar o valor do atributo data-id
        $('span.nome').text(nome);
        // Inserir o nome do item na pergunta de confirmação
        $('a.delete-yes').attr('href','parceiros_exclui.php?id_parceiro='+id);
        // mudar dinamicamente o id do link no botão confirmar
        $('#myModal').modal('show'); // abre modal
    });
</script>
</body>
</html>
<?php mysqli_free_result($lista); ?>