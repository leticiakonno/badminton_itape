 <script src="https://kit.fontawesome.com/d03c290dd3.js" crossorigin="anonymous"></script>
<body class="fundofixo">
<div class= "row panel-footer margem" style="background-color:rgba(3, 33, 104, 0.9);"> <!-- abre painel de rodapé -->

<!-- ÁREA DE LOCALIZAÇÃO -->
<div class="col-xs-12 col-sm-6 col-md-4" >
    <div class="textrodape" style="background:none; padding: 15px;">
        <img src="imagens/logochurrascopequeno.png" alt="">
        <br>
        <i>Badminton Itapê, juntos pelo crescimento dentro e fora da quadra!</i>
        <address>
            <i>Rua Aristides Lobo, 17 - Centro - Itapetininga - SP - CEP 18200-185</i>
            <br>
            <span class="glyphicon glyphicon-phone-alt"></span>
            &nbsp;Fone: (15) 99715-1143
            <br>
            <span class="glyphicon glyphicon-envelope"></span>
            &nbsp;E-mail:
            <a 
                class="textrodape"
                href="mailto:leiko_konno@hotmail.com?subject=Contato&cc=seuemail@mail.com"
            >
            leiko_konno@hotmail.com
            </a>
            <div class="embed-responsive embed-responsive-16by9"> <!-- mapa -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.3526027249522!2d-48.05764850321044!3d-23.5916841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c5cc93b46246ed%3A0x6ec0870ce87bb6fd!2sSenac%20Itapetininga!5e0!3m2!1spt-BR!2sbr!4v1761610404615!5m2!1spt-BR!2sbr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> <!-- fecha mapa -->
        </address>
    </div> <!-- fecha panel-footer --> 
</div> <!-- fecha dimensionamento / área -->

<!-- ÁREA DE NAVEGAÇÃO -->
<div class="col-xs-12 col-sm-6 col-md-4" >
    <div class="textrodape" style="background:none;">
        <h4>LINKS</h4>
        <ul class="nav nav-pills nav-stacked">
            <li>
                <a href="index.php#home" class="textrodape">
                    <span class="glyphicon glyphicon-home">&nbsp;HOME</span>
                </a>
            </li>
            <li>
                <a href="atletas_destaque.php" class="textrodape">
                    <span class="glyphicon glyphicon-star">&nbsp;DESTAQUES</span>
                </a>
            </li>
            <li>
                <a href="atletas_geral.php" class="textrodape">
                <span> <i class="fa-solid fa-star"></i>&nbsp;ATLETAS</span>
                </a>
            </li>
            <li>
                <a href="categorias_geral.php" class="textrodape">
                    <span class="glyphicon glyphicon-tasks">&nbsp;CATEGORIAS</span>
                </a>
            </li>
            <li>
                <a href="formulario_envia.php" class="textrodape">
                    <span class="glyphicon glyphicon-envelope">&nbsp;CONTATO</span>
                </a>
            </li>
             <li>
                <a href="historia.php" class="textrodape">
                    <span class="glyphicon glyphicon-book">&nbsp;CONTATO</span>
                </a>
            </li>
            <li>
                <a href="admin/index.php" class="textrodape">
                    <span class="glyphicon glyphicon-user">&nbsp;ADMINISTRAÇÃO</span>
                </a>
            </li>
        </ul>
    </div> <!-- fecha panel-footer --> 
</div> <!-- fecha dimensionamento / área -->

<!-- ÁREA DE CONTATO -->
<div class="col-xs-12 col-sm-6 col-md-4" >
    <div class="textrodape" style="background:none;">
        <h4>CONTATO</h4>
        <form 
            action="rodape_contato.php"
            name="form_contato"
            id="form_contato"
            method="post"
        >
            <!-- input group NOME -->
            <p>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><!-- basic-addon  -->
                        <span class="glyphicon glyphicon-user"></span>
                    </span>
                    <input 
                        type="text"
                        name="nome_contato"
                        id="nome_contato"
                        placeholder="Digite seu nome."
                        aria-describedby="basic-addon1"
                        required
                        class="form-control"
                    >
                </div> <!-- fecha input-group -->
            </p>

            <!-- construa o input group email use glyphicon-envelope -->
            <p>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">
                        <span class="glyphicon glyphicon-envelope"></span>
                    </span>
                    <input
                        type="email"
                        name="email_contato"
                        id="email_contato"
                        placeholder="Digite seu e-mail."
                        aria-describedby="basic-addon2"
                        required
                        class="form-control"
                    > 
                </div> <!--fecha input group email-->
            </p>
            <!-- construa o textarea comentários use glyphicon-pencil -->
            <p>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </span>
                    <textarea name="comentarios_contato" 
                        id="comentarios_contato"
                        placeholder="Comentários, solicitações, dúvidas e/ou sugestões."
                        aria-describedby="basic-addon3"
                        required
                        class="form-control"
                        cols="30"
                        rows="5"></textarea> <!-- fecha text-area -->
                </div> <!--fecha textarea comentaroios-->
            </p>
            <!-- construa o botão enviar use glyphicon-send -->
            <p>
                <button class="btn btntotal btn-block" aria-label="Enviar">
                    Enviar
                    <span class="glyphicon glyphicon-send"></span>
                </button>
             </p>
        </form>
    </div> <!-- fecha panel-footer --> 
</div> <!-- fecha dimensionamento / área -->

<!-- ÁREA DE DESENVOLVEDOR -->
<div class="col-xs-12" >
    <div style="background:none;">
        <h6 class="textrodape text-center">
            Developed by 
            <a href="https://site-da-leticia-konno.com" target="_blank">Leticia Konno</a>, 
            <a href="https://site-da-leticia-eduarda.com" target="_blank">Leticia Eduarda</a> e 
            <a href="https://site-da-mavelyn.com" target="_blank">Mavelyn Leme</a>&trade; 2025
            <br>
            <a href="https://www.iwanezuk.com.br" target="_blank">
                www.iwanezuk.com.br
            </a>
        </h6>
    </div> <!-- fecha panel-footer --> 
</div> <!-- fecha dimensionamento / área -->    
</div> <!-- fecha painel principal do rodapé -->

</body>
</html>
