<?php
include("Connections/conn_atletas.php");

$filtro_select = $_GET['buscar'];

// SQL UNIFICADO: Buscamos em todas as tabelas e damos nomes genéricos às colunas
$consulta_unificada = "
    SELECT id_atleta AS id, nome_atleta AS nome, descri_atleta AS descri, 'atletas' AS tipo, img_atleta AS imagem 
    FROM tbatletas 
    WHERE nome_atleta LIKE '%$filtro_select%' OR descri_atleta LIKE '%$filtro_select%'

    UNION
    
    SELECT id_categoria AS id, nome_categoria AS nome, descri_categoria AS descri, 'torneios' AS tipo, img_categoria AS imagem  
    FROM tbcategorias 
    WHERE nome_torneio LIKE '%$filtro_select%'

    UNION
    
    SELECT id_tecnico AS id, nome_tecnico AS nome, descri_tecnico AS descri, 'parceiros' AS tipo, img_tecnico AS imagem 
    FROM tbtecnicos 
    WHERE nome_parceiro LIKE '%$filtro_select%' OR descri_tecnico LIKE '%$filtro_select%'

    
    UNION
    
    SELECT id_parceiro AS id, nome_parceiro AS nome, descri_parceiro AS descri, 'parceiros' AS tipo, img_parceiro AS imagem 
    FROM tbparceiros 
    WHERE nome_parceiro LIKE '%$filtro_select%' OR descri_parceiro LIKE '%$filtro_select%'
    
    UNION
    
    SELECT id_torneio AS id, tipo_torneio AS nome, descri_torneio AS descri, 'torneios' AS tipo, img_torneio AS imagem 
    FROM tbtorneios 
    WHERE nome_torneio LIKE '%$filtro_select%'
";

$lista = $conn_atletas->query($consulta_unificada);
$totalRows = $lista->num_rows;
$row = $lista->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Busca Geral - Badminton Itapetininga</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container">
    <h2>Você pesquisou por: "<?php echo $filtro_select; ?>"</h2>
    <hr>

    <?php if($totalRows > 0) { ?>
        <div class="row">
            <?php do { 
                // Ajustamos o link e a pasta da imagem conforme o TIPO do resultado
                $link_detalhe = $row['tipo'] . "_detalhe.php?id_" . substr($row['tipo'], 0, -1) . "=" . $row['id'];
                $pasta_img = ($row['tipo'] == 'parceiros') ? 'apoiadores/' : '';
            ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="imagens/<?php echo $pasta_img . $row['imagem']; ?>" style="height: 15em;">
                        <div class="caption">
                            <h4><?php echo $row['nome']; ?></h4>
                            <p><span class="label label-info"><?php echo ucfirst($row['tipo']); ?></span></p>
                            <p><?php echo substr($row['descri'], 0, 100); ?>...</p>
                            <a href="<?php echo $link_detalhe; ?>" class="btn btn-danger">Ver mais</a>
                        </div>
                    </div>
                </div>
            <?php } while($row = $lista->fetch_assoc()); ?>
        </div>
    <?php } else { ?>
        <div class="alert alert-warning">Nenhum resultado encontrado para sua busca.</div>
    <?php } ?>
</body>
</html>