<?php
//Incluir o Sistema de Autenticação
include("acesso_sup.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Definindo o USE do banco de dados
mysqli_select_db($conn_atletas,$database_conn);

// Definindo e recebendo dados para consulta
$tabela_delete  =   "tb_torneios_noticias";
$id_tabela_del  =   "id_noticia_torneio";
$id_filtro_del  =   $_GET['id_noticia_torneio'];

// Primeiro, buscar a imagem para excluir do diretório
$consulta_imagem = "SELECT imagem FROM $tabela_delete WHERE $id_tabela_del = $id_filtro_del";
$resultado_imagem = $conn_atletas->query($consulta_imagem);
$dados_imagem = $resultado_imagem->fetch_assoc();

// Excluir imagem do diretório se existir
if (!empty($dados_imagem['imagem'])) {
    $imagem_path = "../imagens/noticias/" . $dados_imagem['imagem'];
    if (file_exists($imagem_path)) {
        unlink($imagem_path);
    }
}

// SQL para exclusão
$deleteSQL  =   "
                DELETE
                FROM    ".$tabela_delete."
                WHERE   ".$id_tabela_del."=".$id_filtro_del.";
                ";
$resultado  =   $conn_atletas->query($deleteSQL);

// Após a ação a página será redirecionada
$destino    =   "torneios_noticias_lista.php";
if(mysqli_insert_id($conn_atletas)){
    header("Location: $destino");
}else{
    header("Location: $destino");
};
?>