<?php 
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_atletas.php");

//selecionar os dados
$consulta   = "
            SELECT *
            FROM tbusuarios
            ORDER BY login_usuario ASC;  
            "; 

//Fazer a lista completa dos dados
$lista  = $conn_produtos->query($consulta);

//Separar os dados em linhas (row)
$row    = $lista->fetch_assoc();

//Contar o total de linhas
$totalRows  = ($lista)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários - Lista</title>

    <!-- CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- link para css especifico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">

    <style>
        /* Tamanho das fotos na lista */
        .foto-usuario {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body class="fundofixo">
<main class="container">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
    
    <h1 class="breadcrumb alert-info">Lista de Usuários</h1>

    <div class="btn btn-info disabled">
        Total de Usuários:
        <small class="badge"><?php echo $totalRows?></small>
    </div>

<table class="table table-hover table-condensed tbopacidade">
    <thead>
        <tr>
            <th>FOTO</th> <!-- NOVA COLUNA (ALTERAÇÃO 1) -->
            <th>ID</th>
            <th>LOGIN</th>
            <th>NÍVEL</th>
            <th>
                <a 
                    href="usuarios_insere.php"
                    target="_self"
                    class="btn btn-primary btn-xs btn-block"
                >
                    <span class="hidden-xs">ADICIONAR <br></span>
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </th>
        </tr>
    </thead>

    <tbody>
        <!-- Estrutura de repetição -->
        <?php do { ?>

        <tr>

            <!-- FOTO DO USUÁRIO (ALTERAÇÃO 2) -->
            <td>
                <?php
                    // Caminho das fotos
                    $caminho_fotos = "../imagens/usuarios/";

                    // Se não existir foto, usa padrão
                    $foto = (!empty($row['foto_usuario'])) 
                                ? $caminho_fotos . $row['foto_usuario']
                                : "../imagens/usuarios/default.png"; // coloque uma imagem padrão aqui
                ?>

                <img src="<?php echo $foto; ?>" class="foto-usuario">
            </td>
            <!-- FIM FOTO -->

            <td><?php echo $row['id_usuario'];?></td>

            <td><?php echo $row['login_usuario'];?></td>

            <td>
                <?php 
                    if($row['nivel_usuario'] == 'sup'){
                        echo('<span class="glyphicon glyphicon-sunglasses text-black"></span>');
                    } 
                    else if($row['nivel_usuario'] == 'com'){
                        echo('<span class="glyphicon glyphicon-user text-info"></span>');
                    }
                ?>
                <?php echo $row['nivel_usuario']; ?>
            </td>

            <td>
            <a 
                            href="usuarios_atualiza.php?id_usuario=<?php echo $row['id_usuario']; ?>"
                            class="btn btn-block btn-warning btn-xs"
                            target="_self"
                            role="button"
                        >
                            <span class="hidden-xs">ALTERAR<br></span>
                            <span class="glyphicon glyphicon-refresh"></span>
                        </a>
                        <button
                        data-id="<?php echo $row['id_usuario']; ?>"
                        data-nome="<?php echo $row['login_usuario']; ?>"                        
                        class="btn btn-danger btn-xs btn-block delete"
                    >
                        <span class="hidden-xs">EXCLUIR<br></span>
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>


        
            </td>

        </tr>

        <?php } while($row = $lista->fetch_assoc()); ?>
        <!-- Fim da repetição -->
    </tbody>
</table>

    </div>
</main>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title text-danger">ATENÇÃO!</h4>
            </div> <!-- fecha modal-header -->
            <div class="modal-body">
                Deseja mesmo EXCLUIR o item?
                <h4><span class="nome text-danger"></span></h4>
            </div> <!-- fecha modal-body -->
            <div class="modal-footer">
                <a 
                    href="#"
                    type="button"
                    class="btn btn-danger delete-yes"
                >
                    Confirmar
                </a>
                <button class="btn btn-success" data-dismiss="modal">
                    Cancelar
                </button>
            </div> <!-- fecha modal-footer -->
        </div> <!-- fecha modal-content -->
    </div> <!-- fecha modal-dialog -->
</div> <!-- fecha myModal -->

<!-- links bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>

<?php mysqli_free_result($lista); ?>
