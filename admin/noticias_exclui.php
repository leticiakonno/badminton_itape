<?php
// Incluir o Sistema de Autenticação
include("acesso_sup.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Definindo o USE do banco de dados
mysqli_select_db($conn_atletas, $database_conn);

// Definindo e recebendo dados para consulta
$tabela_delete = "tbnoticias";
$id_tabela_del = "id_noticia";
$id_filtro_del = $_GET['id_noticia'];

// Primeiro, buscar a imagem para excluir do diretório
$consulta_imagem = "SELECT img_noticia FROM $tabela_delete WHERE $id_tabela_del = $id_filtro_del";
$resultado_imagem = $conn_atletas->query($consulta_imagem);
$dados_imagem = $resultado_imagem->fetch_assoc();

// Excluir imagem do diretório se existir
if (!empty($dados_imagem['img_noticia'])) {
    $caminho_imagem = "../imagens/noticias/" . $dados_imagem['img_noticia'];
    if (file_exists($caminho_imagem)) {
        unlink($caminho_imagem);
    }
}

// SQL para exclusão
$deleteSQL = "
    DELETE
    FROM $tabela_delete
    WHERE $id_tabela_del = $id_filtro_del
";

$resultado = $conn_atletas->query($deleteSQL);

// Redirecionamento
$destino = "noticias_lista.php";
header("Location: $destino");
exit;
?>