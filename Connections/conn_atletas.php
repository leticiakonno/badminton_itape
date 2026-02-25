<?php
// Definindo variáveis para conexão
$hostname_conn  =   "localhost";
$database_conn  =   "iwanez83_dbbadminton";
$username_conn  =   "iwanez83_dbbadminton";
$password_conn  =   "badmintonitape";
$charset_conn   =   "utf8";

$conn_atletas  =   
    new mysqli(
        $hostname_conn,
        $username_conn,
        $password_conn,
        $database_conn
    );
// Definir o conjunto de caracteres da conexão
mysqli_set_charset($conn_atletas,$charset_conn);

// Verificando possíveis erros na conexão
if($conn_atletas->connect_error){
    echo "Error: ".$conn_atletas->connect_error;
};
// Não deixar espaços vazios depois do fechamento do PHP pois causa erro HEADER
?>