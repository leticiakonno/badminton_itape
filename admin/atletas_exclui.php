<?php
//Incluir o Sistema de Autenticação
include("acesso_sup.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Definindo o USE do banco de dados
mysqli_select_db($conn_atletas,$database_conn);

// Definindo e recebendo dados para consulta
$tabela_delete  =   "tbatletas";
$id_tabela_del  =   "id_atleta";
$id_filtro_del  =   $_GET['id_atleta'];

// SQL para exclusão
$deleteSQL  =   "
                DELETE
                FROM    ".$tabela_delete."
                WHERE   ".$id_tabela_del."=".$id_filtro_del.";
                ";
$resultado  =   $conn_atletas->query($deleteSQL);

// Após a ação a página será redirecionada
$destino    =   "atletas_lista.php";
if(mysqli_insert_id($conn_atletas)){
    header("Location: $destino");
}else{
    header("Location: $destino");
};
?>