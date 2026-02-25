<?php
// Incluir o Sistema de Autenticação
include("acesso_sup.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Definindo o USE do banco de dados
mysqli_select_db($conn_atletas, $database_conn);

// Definindo e recebendo dados para consulta
$tabela_delete = "tbusuarios";
$id_tabela_del = "id_usuario";
$id_filtro_del = $_GET['id_usuario'];

// Primeiro, buscar a foto para excluir do diretório
$consulta_foto = "SELECT foto_usuario FROM $tabela_delete WHERE $id_tabela_del = $id_filtro_del";
$resultado_foto = $conn_atletas->query($consulta_foto);
$dados_foto = $resultado_foto->fetch_assoc();

// Excluir foto do diretório se existir
if (!empty($dados_foto['foto_usuario'])) {
    $caminho_foto = "../imagens/usuarios/" . $dados_foto['foto_usuario'];
    if (file_exists($caminho_foto)) {
        unlink($caminho_foto);
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
$destino = "usuarios_lista.php";
header("Location: $destino");
exit;
?>