<?php
// Mostrar erros para depuração (opcional — remove em produção)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_produtos.php");

// Definir banco
mysqli_select_db($conn_produtos, $database_conn);

// Verificar se o ID foi enviado
if (!isset($_GET['id_usuario']) || !is_numeric($_GET['id_usuario'])) {
    die("ID de usuário inválido.");
}

$id = intval($_GET['id_usuario']); // proteção contra SQL Injection

// SQL para exclusão
$deleteSQL = "
    DELETE FROM tbusuarios 
    WHERE id_usuario = $id 
    LIMIT 1;
";

// Executar
$resultado = $conn_produtos->query($deleteSQL);

// Redirecionar
header("Location: usuarios_lista.php");
exit;
?>
