<?php
session_name("badmintonnnn");

if(!isset($_SESSION)){
    session_start();
};

// Verificar se o usuário está logado na sessão
// Identificar o usuário
if(!isset($_SESSION['login_usuario'])){
    // Se não existir, redirecionamos para login
    header("Location: login.php"); exit;
};

$nome_da_sessao = session_name();
// Verificar o nome da sessão
if(!isset($_SESSION['nome_da_sessao'])OR($_SESSION['nome_da_sessao']!=$nome_da_sessao)){
    // se não existir, destruimos a sessão por segurança
    session_destroy();
    header("Location: login.php"); exit;
};

// Determinar o nível de acesso
$nivel_acesso=  'sup';
// VERIFICAR o nível de acesso
if(!isset($_SESSION['login_usuario'])OR($_SESSION['nivel_usuario']!=$nivel_acesso)){
    // Redireciona para página de autorização]
    header("Location: invasor_user.php"); exit;
};

// Verificar se o login é valido
if(!isset($_SESSION['login_usuario'])){
    // se não existir, destruimos a sessão por segurança
    session_destroy();
    header("Location: login.php"); exit;
};
?>