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
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Resultado da Busca</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundofixo fontetabela"> 
    <?php include('menu_publico.php'); ?> <main class="container">
        <h2 class="breadcrumb fundoatletas titulo">
            Resultados para: "<?php echo $filtro; ?>"
        </h2>
        <hr>
        
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
                <div class="col-xs-12 col-sm-6 col-md-4"> 
                    <div class="thumbnail text-center">
                        <br>
                        <img src="<?php echo $pasta . $row['foto']; ?>" class="img-responsive img-rounded" style="height:20em; margin: 0 auto;">
                        <div class="caption">
                            <h3><?php echo $row['nome']; ?></h3>
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
                        <div class='alert text-center tabela-branca' style='font-size: 24px; padding: 40px; border: 1px solid #ddd;'>
                            <span class='glyphicon glyphicon-search'></span><br>
                            <strong>Nenhum resultado encontrado.</strong>
                        </div>
                      </div>"; // Adicionado o ponto e vírgula aqui
            }
            ?>
        </div>
    </main>

    <footer>
        <?php include('rodape.php'); ?>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
</body>
</html>