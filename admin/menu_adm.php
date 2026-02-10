<?php 
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

// Consulta para trazer os dados
$tabela_menu    =   "tbcategorias";
$ordernar_menu  =   "nome_categoria";
$consulta_menu  =   "
                    SELECT *    
                    FROM   ".$tabela_menu."
                    ORDER BY ".$ordernar_menu.";
                    ";
$lista_menu      =   $conn_atletas->query($consulta_menu);
$row_menu        =   $lista_menu->fetch_assoc();
$totalRows_menu  =   ($lista_menu)->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
<!-- o menu publico é o unico que fica com o CSS, Bootstrap e JS ativados-->
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="fundo3 fontetabela">
<!-- Abre a barra de navegação -->
<nav class="navbar navbar navbarbg">
<div class="container-fluid">
    <div class="navbar-header"> <!-- Agrupamento MOBILE -->
        <a href="../index.php" class="navbar-brand">
        <img src="../imagens/logobadminton.png" alt="Logo" class="logo">
        </a>
        <button
        type="button"
        class="navbar-toggle collapsed"
        data-toggle="collapse"
        data-target="#defaultNavbar"
        aria-expanded="false"
        >
            <span class="sr-only">Navegação Mobile</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div> <!-- Fecha agrupamento MOBILE -->
    <div class="collapse navbar-collapse" id="defaultNavbar"> <!-- barra de navegação -->
        <ul class="nav navbar-nav navbar-right">
            <li>
                <button type="button" class="btn navbar-btn disabled">
                    Olá, <?php echo ($_SESSION['login_usuario']); ?>
                </button>
            </li>
            <li class="active">
                <a class="navbartext" href="../index.php">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>
            <li class="dropdown">
                <a href="#"
                   class="dropdown-toggle navbartext" 
                   data-toggle="dropdown" 
                   role="button" 
                   aria-haspopup="true" 
                   aria-expanded="false"
                >
                EQUIPE 
                <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="navbartext" href="../tecnicos_geral.php">Técnicos</a></li>
                    <li><a class="navbartext" href="../atletas_geral.php">Atletas</a></li>
                </ul>
                </li>
            <li class="dropdown">
                <a z
                    class="dropdown-toggle navbartext"
                    data-toggle="dropdown"
                    role="button"
                    aria-expanded="false"
                >
                CATEGORIAS
                <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="navbartext" href="../atletas_categorias.php">
                            TODOS
                        </a>
                    </li>
                    <?php do{ ?> <!-- abre estrutura de repetição -->
                        <li>
                            <a href="../atletas_por_categoria.php?id_categoria=<?php echo $row_menu['id_categoria']; ?>">
                                <?php echo $row_menu['nome_categoria']; ?>
                            </a>
                        </li>
                    <?php } while ($row_menu=$lista_menu->fetch_assoc()); ?>
                    <!-- Fecha estrutura de repetição -->
                </ul>
            </li> <!-- Fecha dropdown -->
            <li><a class="navbartext" href="../formulario_envia.php">FALE CONOSCO</a></li>
            <li><a class="navbartext" href="../historia.php">HISTÓRIA</a></li>
              <li><a class="navbartext" href="../parceiros_geral.php">PARCEIROS</a></li>
            <!-- Form Busca -->
             <form
                action="busca_geral.php"
                method="get"
                name="form_busca"
                id="form_busca"
                class="navbar-form navbar-left"
                role="search"
             >
                <div class="form-group">
                    <div class="input-group">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Buscar..."
                            name="buscar"
                            id="buscar"
                            size="9"
                            required
                        >
                        <span class="input-group-btn">
                            <button 
                                type="submit"
                                class="btn btn-default"
                            >
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div> <!-- Fecha input-group-->
                </div> <!-- Fecha form-group-->
             </form>
            <li class="active">
                <a class="navbartext" href="index.php">
                    <span class="glyphicon glyphicon-user"></span>
                </a>
            </li>
        </ul>
    </div> <!-- Fecha barra de navegação -->
</div> <!-- Fecha container-fluid -->
</nav>
<!-- Fecha barra de navegação -->

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>    
</body>
</html>

<?php mysqli_free_result($lista_menu); ?>