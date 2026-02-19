<?php
// Se estiver fora de uma classe, remova o "public"
function processadorBuscas(string $tipo, $filtro, $conn_atletas) {
    $resultado = null;

    switch ($tipo) {
        case 'tbatletas':
            // Aqui chamamos a query para atletas
            $sql = "SELECT * FROM tbatletas WHERE nome_atleta LIKE '%$filtro%'";
            $resultado = $conn_atletas->query($sql);
            break;
            
        case 'tbtecnicos':
            $sql = "SELECT * FROM tbtecnicos WHERE nome_tecnico LIKE '%$filtro%'";
            $resultado = $conn_atletas->query($sql);
            break;

        case 'tbparceiros':
            $sql = "SELECT * FROM tbparceiros WHERE nome_parceiro LIKE '%$filtro%'";
            $resultado = $conn_atletas->query($sql);
            break;
    }

    if ($resultado && $resultado->num_rows > 0) {
        echo 'A busca deu certo!';
        return $resultado;
    } else {
        echo 'Nenhum resultado encontrado.';
        return null;
    }
}

// Exemplo de como usar:
// $busca = processadorBuscas('tbatletas', $_GET['buscar'], $conn_atletas);
?>