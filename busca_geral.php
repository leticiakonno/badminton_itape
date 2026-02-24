<?php
// Conexão com o banco
include("Connections/conn_atletas.php");

// Pega o que o usuário digitou no formulário
$filtro = isset($_GET['buscar']) ? $_GET['buscar'] : "";

if ($filtro != "") {
    // SQL unificado: busca nas duas tabelas e junta os resultados
    $consulta = "
        SELECT id_atleta AS id, nome_atleta AS nome, descri_atleta AS descri, img_atleta AS foto, 'atleta' AS tipo 
        FROM tbatletas 
        WHERE nome_atleta LIKE '%$filtro%'
        
        UNION 
        
        SELECT id_parceiro AS id, nome_parceiro AS nome, descri_parceiro AS descri, img_parceiro AS foto, 'parceiro' AS tipo 
        FROM tbparceiros 
        WHERE nome_parceiro LIKE '%$filtro%'

        UNION 
        
        SELECT id_tecnico AS id, nome_tecnico AS nome, descri_tecnico AS descri, img_tecnico AS foto, 'tecnico' AS tipo 
        FROM tbtecnicos 
        WHERE nome_tecnico LIKE '%$filtro%'
    ";
    
    $lista = $conn_atletas->query($consulta);
} else {
    $totalRows = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Busca</title>
     <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
 <?php include('menu_publico.php'); ?>
<body class="fundofixo fontetabela"> 
<main class="container">
    <h2 class="breadcrumb  fundoatletas titulo">
          <a href="javascript:window.history.go(-1)" class="btn btntotal">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    Resultados para: "<?php echo $filtro; ?>"</h3>
    <hr>
    </h2>
    <div class="row">
        <?php 
        if(isset($lista) && $lista->num_rows > 0) {
            while($row = $lista->fetch_assoc()) { 
                // Ajusta o link e a pasta conforme o tipo
                if($row['tipo'] == 'atleta') {
                    $link = "atletas_detalhe.php?id_atleta=" . $row['id'];
                    $pasta = "imagens/atletas/";
                } else if ($row['tipo'] == 'parceiro'){
                    $link = "parceiros_detalhe.php?id_parceiro=" . $row['id'];
                    $pasta = "imagens/apoiadores/";
                } else {
                    $link = "tecnicos_detalhe.php?id_tecnico=" . $row['id'];
                    $pasta = "imagens/tecnicos/";
                }
        ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail text-center">
                    <br>
                    <img src="<?php echo $pasta . $row['foto']; ?>" class="img-responsive img-rounded" style="height:20em;">
                    <div class="caption">
                        <h3 class=""><?php echo $row['nome']; ?></h3>
                        <p><span class="label btnadicionar"><?php echo ucfirst($row['tipo']); ?></span></p>
                        <a href="<?php echo $link; ?>" class="btn btntotal">
                        <span class="hidden-xs">Ver Detalhes</span>  
                        <span class="visible-xs glyphicon glyphicon-eye-open"></span> 
                        </a>
                    </div>
                </div>
            </div>
          
        <?php 
            }
        } else {
                echo "<div class='container'>
                <div class='alert  text-center tabela-branca' style='font-size: 24px; padding: 40px; border: 1px solid #ddd;'>
                <span class='glyphicon glyphicon-search'></span><br>
                <strong>Nenhum resultado encontrado.</strong>
                    </div>
                </div>"
                ;
}
        ?>
         </div>
 
<!-- Link arquivos Bootstrap js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>  
</main>
<footer>
    <?php include('rodape.php'); ?>
</footer>
</body>
</html>