<?php
session_name('badmintonnnn');
session_start();
// Destrói a sessão limpando todos os dados
session_destroy();
// Após a ação a página será redirecionada
$destino    =   "../index.php";
header("Location: $destino");
exit;
?>