<?php 
// Incluir o arquivo e fazer a conexão
include("Connections/conn_atletas.php");

// Consulta para trazer o banco de dados e SE necessário filtrar
$tabela         =   "tbparceiros";
$ordenar_por    =   "id_parceiro ASC";
$consulta       =   "
                    SELECT   *
                    FROM     ".$tabela."
                    ORDER BY ".$ordenar_por.";
                    ";
$lista      =   $conn_atletas->query($consulta);
$row        =   $lista->fetch_assoc();
$totalRows  =   ($lista)->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parceiros</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<body class="fundofixo fontetabela">
        <main class="container">
              <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12" > <!-- abre dimensionamento -->
                 <div class="form-container titulo fundohistoria">
                    <h2 class="fundoatletas titulo text-center historia-resumo"><strong> NOSSOS PARCEIROS</strong></h2>
                </div>
                <br><br>
                <div class="swiper meuCarrossel">
                    <div class="swiper-wrapper">
                            <?php do{ ?>
                                <div class="swiper-slide text-center">
                                <a 
                                    href="parceiros_detalhe.php?id_parceiro=<?php echo $row['id_parceiro']; ?>" 
                                    >
                                    <img 
                                    src="imagens/apoiadores/<?php echo $row['img_parceiro']; ?>" 
                                    alt=""
                                    class="img-responsive img-rounded"
                                    style="width: 150px;height: auto; display: inline-block;"
                                >
                                </a>
                                </div>
                             <?php }while($row=$lista->fetch_assoc()); ?>
                    </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                

                </div>
            <div class="container-botao">
            <a href="formulario_envia.php" class="btn-parceiro">Venha ser nosso parceiro</a>
            </div>
             </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
const swiper = new Swiper('.meuCarrossel', {
  slidesPerView: 1, // 1 foto por vez no celular
  spaceBetween: 10,
  loop: true,
  autoplay: {
    delay: 3000, // Passa a cada 3 segundos
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    // Quando a tela for maior que 768px (Computador)
    768: {
      slidesPerView: 4, // Mostra 3 logos
      spaceBetween: 10,
    }
  }
});
</script>

</body>
</html>