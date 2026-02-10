<?php 
session_name("badmintonnnn");

if(!isset($_SESSION)){
    session_start();
};

// Verificar se o usuário está logado na sessão
//Identificar o usuário
if(!isset($_SESSION['login_usuario'])){
    // Se não existir, redirecionamos para login
    header("Location: login.php"); exit;
};

$nome_da_sessao =  session_name();
// Verificar o nome da sessão
if(!isset($_SESSION['nome_da_sessao'])OR($_SESSION['nome_da_sessao']!=$nome_da_sessao)){
    // Se não existir, destruimos a sessão por segurança
    session_destroy();
    header("Location: login.php"); exit;
};

// Verificar se o login é válido
if(!isset($_SESSION['login_usuario'])){
    // Se não existir, destruimos a sessão por segurança
    session_destroy();
    header("Location: login.php"); exit;
};
?>