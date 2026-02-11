<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_atletas.php");

//Incluindo as páginas criadas de busca
include("atletas_busca.php");
include("categorias_busca.php");
include("parceiros_busca.php");
include("tecnicos_busca.php");
include("torneios_busca.php");

// Consulta para trazer os dados e SE necessário filtrar
$tabela         =   "tbparceiros";
$campo_filtro   =   "descri_parceiro";
$ordenar_por    =   "nome_parceiro ASC";
$filtro_select  =   $_GET['buscar'];
$consulta       =   "
                    SELECT  *
                    FROM    ".$tabela."
                    WHERE   ".$campo_filtro." LIKE ('%".$filtro_select."%')
                    ORDER BY ".$ordenar_por.";
                    ";
$lista      =   $conn_atletas->query($consulta);
$row        =   $lista->fetch_assoc();
$totalRows  =   ($lista)->num_rows;


?>