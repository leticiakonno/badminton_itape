<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "tbparceiros";
$ordenar_por    =   "id_parceiro ASC";
$consulta       =   "
                    SELECT   *
                    FROM     ".$tabela."
                    ORDER BY ".$ordenar_por.";
                    ";
$lista      =   $conn_atletas->query($consulta);
$row        =   $lista->fetch_assoc();
$totalRows  =   ($lista)->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parceiros</title>
    <link rel="icon" type="image/png" href="imagens/logobadminton.png">
</head>
<body class="fundofixo fontetabela">
        <main class="container">
              <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12" > <!-- abre dimensionamento -->
                 <div class="form-container titulo fundohistoria">
                    <h2 class="fundoatletas titulo text-center historia-resumo"><strong> NOSSOS PARCEIROS</strong></h2>
                </div>
               <div>
                   <div>
                    <img src="imagens/parceiros_index.png" 
                    style="width: 200px; height: 200px;">
            
               </div>
        </main>
</body>
</html>