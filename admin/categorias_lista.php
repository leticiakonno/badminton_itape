<?php 
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

//selecionar os dados
$consulta   = "
            SELECT *
            FROM tbcategorias
            ORDER BY descri_categoria DESC;  
            "; 

//Fazer a lista completa dos dados
$lista  = $conn_atletas->query($consulta);

//Separar os dados em linhas (row)
$row    = $lista->fetch_assoc();

//Contar o total de linhas
$totalRows  = ($lista)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"></head>
<body>
    <main class="container">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-12">
            <h1 class="alert alert-warning text-center">Lista de Categorias</h1>
            <br>
             <a 
                        href="categorias_insere.php"
                        class="btn btn-warning btn-xs"
                        role="group"
                    >
                        <span class="hidden-xs">ADICIONAR <br></span>
                        <span class="glyphicon glyphicon-plus"></span>
                        
                </a>
            <br>
            <div class="row row-cols-1 row-cols-md-3 g-5"> <!--Inicio dos cards-->
                <!--Abre estrutura de repetição -->
                   <?php do { ?>
                <div class="col"> 
                    <div class="card text-center border-warning mb-3">
                    <img src="../imagens/<?php echo $row['imagem_categoria']; ?>" class="card-img-top" 
                        alt=""
                        width="100px">
                    <div class="card-body">
                        <H6><?php echo $row['id_categoria']; ?></H6>
                        <h5><?php echo $row['nome_categoria']; ?></h5>
                        <p><?php echo $row['descri_categoria']; ?></p>
                        <a href="#" class="btn btn-warning btn-block">Saiba mais sobre os atletas.</a>
                    </div>
                     <a 
                        href="categoria_atualiza.php?id_categoria=<?php echo $row['id_categoria']; ?>"
                        target="_self"
                        class="btn btn-info btn-xs "
                        role="button"
                    >
                        <span class="hidden-xs">ALTERAR<br></span>
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>
                    <button
                        data-id="<?php echo $row['id_categoria']; ?>"
                        data-nome="<?php echo $row['descri_categoria']; ?>"                        
                        class="btn btn-danger btn-xs delete"
                    >
                        <span class="hidden-xs">EXCLUIR<br></span>
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    </div>
                </div>
                  <?php } while($row = $lista->fetch_assoc()); ?>
                </div> <!--fim dos cards-->
        </div> <!--fecha div dimensionamento-->
    </main>

    <!--modal-->
    <div id="myModal" class="modal fade" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                >
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
                <button class="btn btn-success" data-dismiss="modal">
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
        $('a.delete-yes').attr('href','categoria_exclui.php?id_categoria='+id);
        // mudar dinamicamente o id do link no botão confirmar
        $('#myModal').modal('show'); // abre modal
    });
</script>
</body>
</html>
<?php mysqli_free_result($lista); ?>