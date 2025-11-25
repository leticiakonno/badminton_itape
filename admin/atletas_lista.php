<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Selecionar os dados
$consulta   =   "
                SELECT  *
                FROM    vw_tbatletas
                ORDER BY descri_atleta ASC;
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
    <title>Modelo</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundofixo">
    <!--main>h1-->
    <main class="container">
        <h1 class="breadcrumb alert-danger">Lista de Atletas</h1>
        <div class="btn btn-danger disabled">
            Total de Atletas:
            <small class="badge"><?php echo $totalRows; ?></small>
        </div>
    </main>

    <!--table-->
    <table class="table table-hover table-condensed tbopacidade">
        <thead> <!--cabeçalho da tabela-->
            <tr> <!--linha da tabela-->
                <th class="hidden">ID</th> <!--célula do cabeçalho-->
                <th>ATLETAS</th>
                <th>NOME</th>
                <th>CATEGORIA</th>
                <th>DESTAQUE</th>
                <th>DATA DE NASCIMENTO</th>
                <th>DATA DE CADASTRO</th>
                <th>DESCRIÇÃO</th>
                <th>ATLETA</th>
            </tr>
        </thead> 
    </table>

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>    
</body>
</html>