<?php
// Incluindo o sistema de identificação
include("acesso_com.php");
//
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Selecionar os dados
$consulta   =   "
                SELECT  *
                FROM    vw_tbatletas
                ORDER BY nome_atleta ASC;
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
    <title>Atletas</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<?php include("menu_adm.php"); ?>
<!--main>h1-->
<main class="container" style="width: 90%;">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-1 col-md-12 col-md-offset-0"> <!-- dimensionamento -->
        <h1 class="fundoatletas text-center titulo">
                <a href="index.php" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%);">
                    <button class="btn btntotal bg-danger text-white" style="width: 40px; height: 40px; padding: 0;">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
            <strong>Lista de Atletas</strong>
        </h1>
        <div class="btn btntotal bg-danger text-white">
            Total de Atletas:
            <small><?php echo $totalRows; ?></small>
        </div>
 
    <!--table-->
    <table class="table table-hover table-condensed tabela-branca fontetabela tabelacenter">
        <thead > <!--cabeçalho da tabela-->
            <tr> <!--linha da tabela-->
                <th class="hidden">ID</th> <!--célula do cabeçalho-->
                <th>NOME</th>
                <th>CATEGORIA</th>
                <th>DESTAQUE</th>   
                <th class="hidden-xs">DESCRIÇÃO</th>
                <th class="hidden-xs hidden-sm">DATA DE NASCIMENTO</th>
                <th class="hidden-xs hidden-sm">DATA DE CADASTRO</th>
                <th class="hidden-xs">IMAGEM</th>
                                <th>
                    <a 
                        href="atletas_insere.php"
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
                <td class="hidden"><?php echo $row['id_atleta']; ?></td>
                <td><?php echo $row['nome_atleta']; ?></td>
                <td>
                    <span><?php echo $row['nome_categoria']; ?></span>
                </td>
                <td>
                     <?php
                        if($row['destaque_atleta']=='Sim'){
                            echo('<span class="glyphicon glyphicon-star texticon"></span>');
                        } else if($row['destaque_atleta']=='Não'){ 
                            echo('<span class="glyphicon glyphicon-star-empty texticon"></span>');
                        };
                     ?>
                </td>
                <td class="hidden-xs"><?php echo $row['descri_atleta']; ?></td>
                <td class="hidden-xs hidden-sm"><?php echo $row['data_nas_atleta']; ?></td>
                <td class="hidden-xs hidden-sm"><?php echo $row['data_cad_atleta']; ?></td>
                <td class="hidden-xs">
                    <img 
                        src="../imagens/atletas/<?php echo $row['img_atleta']; ?>" 
                        alt="<?php echo $row['nome_atleta']; ?>" 
                        class="img-circle"
                        width="100px"
                    >
                </td>
                <td>
                    <a href="atletas_atualiza.php?id_atleta=<?php echo $row['id_atleta']; ?>"
                        target="_self"
                        class="btnalterar btn-xs btn-block text-center"
                        role="button"
                    >
                        <span class="hidden-xs">ALTERAR <br></span>
                        <span class="glyphicon glyphicon-wrench"></span>
                    </a>
                    <button
                        data-id="<?php echo $row['id_atleta']; ?>"
                        data-nome="<?php echo $row['nome_atleta']; ?>"
                        class="btn btn-danger btntotal btn-xs btn-block delete"
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
</div>  <!-- fecha dimensionamento -->
<br>
</div>



 
</main>
<!-- Script para o Modal -->
<script type="text/javascript">
    $('.delete').on('click',function(){
        var nome    =   $(this).data('nome');
        // buscar o valor do atributo data-nome
        var id      =   $(this).data('id');
        // buscar o valor do atributo data-id
        $('span.nome').text(nome);
        // Inserir o nome do item na pergunta de confirmação
        $('a.delete-yes').attr('href','atletas_exclui.php?id_atleta='+id);
        // mudar dinamicamente o id do link no botão confirmar
        $('#myModal').modal('show'); // abre modal
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>  
<footer>
    <?php include('../rodape.php'); ?>
</footer>
</body>
</html>
<?php mysqli_free_result($lista); ?>