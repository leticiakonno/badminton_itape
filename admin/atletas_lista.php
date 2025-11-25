<?php
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
<!--main>h1-->
<main class="container">
    <h1 class="breadcrumb alert-danger">Lista de Atletas</h1>
    <div class="btn btn-danger disabled">
        Total de Atletas:
        <small class="badge"><?php echo $totalRows; ?></small>
    </div>
    <!--table-->
    <table class="table table-hover table-condensed tbopacidade">
        <thead> <!--cabeçalho da tabela-->
            <tr> <!--linha da tabela-->
                <th class="hidden">ID</th> <!--célula do cabeçalho-->
                <th>NOME</th>
                <th>CATEGORIA</th>
                <th>DESTAQUE</th>   
                <th>DESCRIÇÃO</th>
                <th>DATA DE NASCIMENTO</th>
                <th>DATA DE CADASTRO</th>
                <th>IMAGEM</th>
                                <th>
                    <a 
                        href="produtos_insere.php"
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
                <td class="hidden"><?php echo $row['id_atleta']; ?></td>
                <td><?php echo $row['nome_atleta']; ?></td>
                <td>
                    <span><?php echo $row['id_categoria_atleta']; ?></span>
                </td>
                <td>
                     <?php
                        if($row['destaque_atleta']=='Sim'){
                            echo('<span class="glyphicon glyphicon-heart text-danger"></span>');
                        } else if($row['destaque_atleta']=='Não'){ 
                            echo('<span class="glyphicon glyphicon-ok text-info"></span>');
                        };
                     ?>
                </td>
                <td><?php echo $row['descri_atleta']; ?></td>
                <td><?php echo $row['data_nas_atleta']; ?></td>
                <td><?php echo $row['data_cad_atleta']; ?></td>
                <td>
                    <img 
                        src="../imagens/<?php echo $row['imagem_atleta']; ?>" 
                        alt="<?php echo $row['nome_atleta']; ?>" 
                        class="img-responsive"
                        width="100px"
                    >
                </td>
                <td>
                    <a href="atletas_atualiza.php?id_produto=<?php echo $row['id_atleta']; ?>"
                        target="_self"
                        class="btn-warning btn-xs btn-block"
                        role="button"
                    >
                        <span class="hidden-xs">ALTERAR <br></span>
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
            <?php }while($row = $lista->fetch_assoc());  ?>
            <!-- Fechar a estrutura de repetição -->
        </tbody>
    </table>
</main>


<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>    
</body>
</html>