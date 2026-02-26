
    <style>
        .carousel.item {
    height: 300px; /* Ajuste a altura desejada */
}

.carousel.item img.img-carrossel {
    width: 100%;
    height: 80%;
    object-fit: cover; /* Faz preencher sem deformar */
}
    </style>
</head>
<body>
<div id="banners" class="carousel slide margemcarrousel" data-ride="carousel">
    <!-- Indicador dos itens -->
    <ol class="carousel-indicators">
        <li data-target="#banners" data-slide-to="0" class="active"></li>
        <li data-target="#banners" data-slide-to="1"></li>
        <li data-target="#banners" data-slide-to="2"></li>
        <li data-target="#banners" data-slide-to="3"></li>
        <li data-target="#banners" data-slide-to="4"></li>
    </ol>

    <!-- imagens -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <a href="historia.php">
            <img src="imagens/banner1.png" alt=""  class="center-block">
            </a>
        </div> <!-- fecha item -->

        <div class="item">
            <a href="noticias_detalhe.php?id_noticia=1">
            <img src="imagens/banner2.png" alt=""  class="center-block">
            </a>

        </div> <!-- fecha item -->
        <div class="item">
            <a href="atletas_geral.php">
            <img src="imagens/carroussel.png" alt=""  class="center-block">
            </a>
        </div> <!-- fecha item -->

        <div class="item">
            <a href="torneios_noticias_detalhe.php?id=1">
            <img src="imagens/banner4.png" alt=""  class="center-block">
            </a>
        </div> <!-- fecha item -->

        <div class="item">
            <a href="noticias_detalhe.php?id_noticia=5">
            <img src="imagens/banner5.png" alt=""  class="center-block">
            </a>
        </div> <!-- fecha item -->
    </div>

        <!-- botões de navegação -->
        <a 
            href="#banners"
            class="left carousel-control"
            role="button"
            data-slide="prev"
        >
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a 
            href="#banners"
            class="right carousel-control"
            role="button"
            data-slide="next"
        >
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div> <!-- fecha carousel-inner -->
</div> <!-- fecha banners/carroussel -->
    
</body>
</html>