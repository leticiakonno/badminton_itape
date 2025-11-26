<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Definindo o USE do banco de dados
mysqli_select_db($conn_atletas,$database_conn);

// Definindo e recebendo dados para consulta
$tabela_delete  =   "tbcategorias";
$id_tabela_del  =   "id_categoria";
$id_filtro_del  =   $_GET['id_categoria'];

// SQL para exclusão
$deleteSQL  =   "
                DELETE
                FROM    ".$tabela_delete."
                WHERE   ".$id_tabela_del."=".$id_filtro_del.";
                ";
$resultado  =   $conn_atletas->query($deleteSQL);

// Após a ação a página será redirecionada
$destino    =   "categorias_lista.php";
if(mysqli_insert_id($conn_atletas)){
    header("Location: $destino");
}else{
    header("Location: $destino");
};
?>