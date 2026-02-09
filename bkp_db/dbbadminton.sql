    -- Backup Geral do banco de dados dbbadminton
    -- Excluir o usuário dbbadminton caso ele exista
    DROP USER IF EXISTS 'dbbadminton'@'localhost';
    
    -- Criar o usuário dbbadminton se ele não existir
    CREATE USER IF NOT EXISTS 'dbbadminton'@'localhost'
        IDENTIFIED BY 'badmintonitape';
    GRANT ALL PRIVILEGES ON *.* TO 'dbbadminton'@'localhost'
        WITH GRANT OPTION;
        FLUSH PRIVILEGES;
    
    -- Excluir o banco de dados dbbadminton caso ele exista
    DROP DATABASE IF EXISTS dbbadminton;
    
    -- Criar o banco de dados dbbadminton se ele não existir
    CREATE DATABASE IF NOT EXISTS dbbadminton
        DEFAULT CHARACTER SET utf8
        COLLATE utf8_general_ci;
    
    -- Usamos o banco de dados dbbadminton
    USE dbbadminton;

    -- Estruta da tabela tbcategorias
    CREATE TABLE tbcategorias(
        id_categoria INT(11) NOT NULL,
        nome_categoria VARCHAR(15) NOT NULL,
        descri_categoria VARCHAR(200) NOT NULL,
        img_categoria VARCHAR(50) NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- Extraindo dados da tabela tbcategorias
    INSERT INTO tbcategorias (id_categoria, nome_categoria, descri_categoria, img_categoria) VALUES
    (1, 'Sub9', 'Atletas nascidos em 2016 ou depois.', 'sub9.jpeg'),
    (2, 'Sub11', 'Atletas nascidos em 2014 ou depois.', 'sub11.jpeg'),
    (3, 'Sub13', 'Atletas nascidos em 2012 ou depois.', 'sub13.jpeg'),
    (4, 'Sub15', 'Atletas nascidos em 2010 ou depois.', 'sub15.jpeg'),
    (5, 'Sub17', 'Atletas nascidos em 2008 ou depois.', 'sub17.jpeg'),
    (6, 'Sub19', 'Atletas nascidos em 2006 ou depois.', 'sub19.jpeg'),
    (7, 'Aberto', 'Abrange atletas de todas as idades.', 'aberto.jpeg'),
    (8, 'Sênior I', 'Atletas nascidos em 1994 ou antes.', 'seniorI.jpeg'),
    (9, 'Sênior II', 'Atletas nascidos em 1989 ou antes.', 'seniorII.png'),
    (10, 'Veterano I', 'Atletas nascidos em 1984 ou antes.', 'veteranoI.png'),
    (11, 'Veterano II', 'Atletas nascidos em 1979 ou antes.', 'veteranoII.png'),
    (12, 'Master I', 'Atletas nascidos em 1974 ou antes.', 'masterI.png'),
    (13, 'Master II', 'Atletas nascidos em 1969 ou antes.', 'masterII.png'),
    (14, 'Master III', 'Atletas nascidos em 1964 ou antes.', 'masterIII.png'),
    (15, 'Master IV', 'Atletas nascidos em 1959 ou antes.', 'masterIV.png');

    -- Estrutura da tabela tbatletas
    CREATE TABLE tbatletas(
        id_atleta INT(11) NOT NULL,
        id_categoria_atleta INT(11) NOT NULL,
        nome_atleta VARCHAR(30) NOT NULL,
        data_nas_atleta DATE NOT NULL, 
        data_cad_atleta DATE NOT NULL,
        descri_atleta VARCHAR(500) NOT NULL,
        img_atleta VARCHAR(50) NOT NULL,
        destaque_atleta enum('Sim','Não') NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    -- Extraindo dados da tabela `tbatletas`
    INSERT INTO tbatletas (id_atleta, id_categoria_atleta, nome_atleta, data_nas_atleta, data_cad_atleta, descri_atleta, img_atleta, destaque_atleta) VALUES
    (1, 7, 'Letícia Konno', '1997/08/22', '2025/11/17', 'Leticia é a atleta pioneira do esporte em Itapetininga, destaque de nível internacional!', 'leticia.png', 'Sim'),
    (2, 7, 'Isabela Galvão', '2004/04/19', '2025/11/17', 'Isinha é uma atleta super talentosa, todos se encantam ao ver ela jogar. Joga na categoria aberta e brilha em quadra!', 'isabela.png','Sim'),
    (3, 7, 'Douglas Oliveira', '1997/06/21', '2025/11/17', 'Douglas é o destaque das fintas, joga muito e sempre ajuda todos ao seu redor!', 'douglas.png', 'Sim'),
    (4, 3, 'Vitor Takashi', '2003/02/23', '2025/11/17', 'Vitor é um menino muito inteligente e esforçado, o que o torna um grande atleta. Adora tirar uma selfie e brilha na categoria Sub13!', 'vitor.png', 'Sim'),
    (5, 3, 'Marina Mori', '2014/08/20', '2025/11/17', 'Marina é reservada, mas adora brincar com as amigas e está cada dia melhor, surpreendendo na categoria Sub13!', 'marina.png', 'Não'),
    (6, 5, 'Larissa Ueno', '2010/07/21', '2025/11/17', 'Larissa, Sub17, é a sincera do time, mas que brilha nas quadras brasileiras e internacionais também!', 'larissa.png', 'Sim'),
    (7, 6, 'Julio Paiva', '2007/07/07', '2025/11/17', 'Julio é carismático, simpático e amigo de todos, joga muito e brilha na categoria Sub19.', 'julio.png', 'Sim'),
    (8, 6, 'Milena Ueno', '2006/09/15', '2025/11/17', 'Milena é a criativa e dedicada do time, joga na Sub19 e adora as crianças.', 'milena.png', 'Não'),
    (9, 2, 'Tiago Matiazzo', '2016/03/05', '2025/11/17', 'Tiaguinho é um atleta muito talentoso e dedicado. Brilha na categoria Sub11 e promete ser a estrela da temporada.', 'tiago.png', 'Sim'),
    (10, 1, 'Vinicius Lima', '2017/09/08', '2025/11/17', 'Vinicius tem energia de sobra e cansa seus adversários, brilha na categoria Sub9!', 'vinicius.png', 'Não'),
    (11, 3, 'Aylla Maeseki', '2014/09/08', '2025/11/17', 'Aylla é engraçada e adora fazer uma gracinha, joga muito na categoris Sub13!', 'aylla.png', 'Não'),
    (12, 4, 'Theo Maeseki', '2011/02/19', '2025/11/17', 'Theo é um menino esforçado e está brilhando cada vez mais nos torneios na categoria Sub15.', 'theo.png', 'Não'),
    (13, 4, 'Pedro Lima', '2011/03/14', '2025/11/17', 'Pedro joga na categoria Sub15, é quieto e reservado, mas sempre muito esforçado e dedicado!', 'pedro.png', 'Não'),
    (14, 2, 'Catarina Takashi','2015/05/02', '2025/11/17', 'Catarina é uma atleta da categoria Sub11, treina desde os 9 anos de idade e tem muita energia.', 'catarina.png', 'Não'),
    (15, 7, 'Eduardo Takahagui', '1990/12/06', '2025/11/17', 'Eduardo é dedicado e enérgico. Sempre dando o seu melhor nos torneios.', 'eduardo.png', 'Não'),
    (16, 7, 'Cristiane Matiazzo', '1985/12/20', '2025/11/17', 'Cris gosta de se aventurar e se arriscar no meio das crianças, e nos torneios estaduais. Além de ser a fisioterapeuta.', 'cristiane.png', 'Não'),
    (17, 1, 'Lucas Mendes', '2017/12/31', '2025/11/17', 'Lucas está começando agora na categoria Sub9 e promete ser um grande atleta no futuro.', 'lucas.png', 'Não'),
    (18, 5, 'Emilly Mendes', '2011/06/17', '2025/11/17', 'Emilly é dedicada e esforçada, está na categoria Sub17 e tem um futuro brilhante pela frente.', 'emilly.png', 'Não'),
    (19, 11,'Pedro Lanas', '1979/03/24', '2025/11/17', 'Pedro é um dos atletas mais experientes no esporte, ', 'pedrolanas.png', 'Não');

    -- Estrutura da tabela técnicos
    CREATE TABLE tbtecnicos(
    id_tecnico INT(11) NOT NULL,
    nome_tecnico VARCHAR(20) NOT NULL,
    nivel_tecnico VARCHAR(20) NOT NULL,
    descri_tecnico VARCHAR(500) NOT NULL,
    img_tecnico VARCHAR(50) NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- Extraindodados da tabela tbtecnicos
    INSERT INTO tbtecnicos(id_tecnico,nome_tecnico,nivel_tecnico,descri_tecnico,img_tecnico) VALUES
    (1, 'Leiko Konno', 'Técnica Principal', 'Técnica voluntária de badminton pioneira na cidade de Itapetininga. Acredita que o esporte vai muito além de vencer o tempo todo, mas sim de transformar atletas e pessoas para a vida, com dignidade e humildade.', 'leiko.png'),
    (2, 'Shogo Konno', 'Técnico Assistente', 'Técnico voluntário de badminton junto com a sua esposa Leiko e também é árbitro de nível nacional. Adora fazer uma piada e sempre com muita paciência para ajudar e ensinar.', 'shogo.png'),
    (3, 'Letícia Konno', 'Técnica Assistente', 'Assistente técnica, ajuda voluntariamente a ministrar os treinos com seus pais. Atleta, mas também sempre disposta a ensinar através da experiência.', 'leticia.png');

    -- Estrutura da tabela tbparceiros
    CREATE TABLE tbparceiros(
        id_parceiro INT(11) NOT NULL,
        nome_parceiro VARCHAR(50) NOT NULL,
        descri_parceiro VARCHAR(500) NOT NULL,
        img_parceiro VARCHAR(50) NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- Extraindo dados da tabela tbparceiros
    INSERT INTO tbparceiros(id_parceiro,nome_parceiro,descri_parceiro,img_parceiro) VALUES
        (1,'Prefeitura de Itapetininga', 'A Prefeitura de Itapetininga é a principal parceira do projeto Badminton Itapetininga, apoiando e incentivando o esporte na cidade.', 'prefeitura.png'),
        (2,'Colégio Dom Bosco de Itapetininga', 'Primeira e fiel patrocinadora do badminton na cidade, promovendo o esporte e oferecendo suporte aos atletas.', 'dombosco.jpeg'),
        (3,'Universal Chemical', 'Uma das maiores empresas da região, são apoiadores do esporte, sempre prestando suporte à equipe.', 'chemical.jpg'),
        (4,'Ligia', 'Uma das maiores apoiadoras da equipe, faz por amor ao esporte e toda a equipe. Coração e alma enormes.', 'ligia.jpeg'),
        (5,'Cristina Mori', 'Psicóloga voluntária, mãe de atleta, proporciona acompanhamento da saúde mental dos nossos atletas.', 'crismori.png'),
        (6,'Dr.Thiago', 'Médico voluntário que cuida da saúde dos atletas, realizando exames e acompanhamentos regulares.', 'drthiago.jpeg'),
        (7,'Laura Takamori', 'Mãe de atletas e grande apoiadora do esporte, prestativa e sempre à disposição. Presta ajuda de forma voluntária em prol de toda a equipe.', 'laura.png'),
        (8,'Roberto Ueno', 'Pai de atletas, sempre disposto a ajudar e a alavancar o time para outros patamares.', 'roberto.jpeg'),
        (9,'Cristiane Matiazzo', 'Fisioterapeuta voluntária que cuida dos atletas, prevenindo lesões e promovendo a recuperação física.', 'cristiane.png');

    -- Estrutura da tabela tbtorneios
    CREATE TABLE tbtorneios(
        id_torneio INT(11) NOT NULL,
        tipo_torneio VARCHAR(20) NOT NULL,
        descri_torneio VARCHAR(255) NOT NULL,
        img_torneio VARCHAR(50) NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    -- Extraindo dados da tabela tbtorneios
    INSERT INTO tbtorneios(id_torneio,tipo_torneio,descri_torneio,img_torneio) VALUES
        (1,'Regional', 'Torneios realizados na 8ª região, que abrange itapetininga e muitas outras cidades.', 'regional.png'),
        (2,'Estadual', 'Torneio que abrenge os melhores atletas do estado de São Paulo.', 'estadual.png'),
        (3,'Nacional', 'Torneio para os melhores atletas em território brasileiro na categoria.', 'nacional.png'),
        (4,'Internacional', 'Torneios de nível, Sulamericano, Panamericano e Mundial, abrange os melhores atletas do mundo.', 'internacional.png');

    -- Estrutura para tabela tb_torneios_noticias
    

    CREATE TABLE tb_torneios_noticias (
        id_noticia_torneio int(11) NOT NULL,
        titulo varchar(255) NOT NULL,
        resumo varchar(300) DEFAULT NULL,
        conteudo text NOT NULL,
        categoria varchar(20) DEFAULT NULL,
        imagem varchar(255) DEFAULT NULL,
        data_publicacao datetime DEFAULT current_timestamp(),
        status enum('ativo','inativo') DEFAULT 'ativo'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

    --
    -- Despejando dados para a tabela `tb_torneios_noticias`
    --

    INSERT INTO tb_torneios_noticias (id_noticia_torneio, titulo, resumo, conteudo, categoria, imagem, data_publicacao, status) VALUES
    (3, 'NACIONAL', 'edsasdsd', 'dfssdsdsd', 'nacional', '', '2026-02-04 19:24:49', 'ativo'),
    (4, 'REGIONAL TESTE ', 'BLABLABLA', 'DASDDSDAASD', 'regional', '', '2026-02-04 19:40:25', 'ativo'),
    (5, 'ESTADUAL TESTE ', 'BLABALA', 'DEFDSDF', 'estadual', '', '2026-02-04 19:40:54', 'ativo'),
    (6, 'INTERNACIONAL TESTE', 'DFSDFDSDFSSSDF', 'DSDSASDASASDASD', 'internacional', '', '2026-02-04 19:41:15', 'ativo'),
    (7, 'noticia regional', 'jnfkjdsfjhjs', 'dssdffd', 'estadual', 'CEFFAEA2-90C4-4ADF-9C3A-583FB28AC6CF.png', '2026-02-09 19:39:43', 'ativo');


    -- Estrutura da tabela tbusuario
    CREATE TABLE tbusuarios (
        id_usuario INT(11) NOT NULL,
        login_usuario VARCHAR(30) NOT NULL,
        senha_usuario VARCHAR(8) NOT NULL,
        foto_usuario VARCHAR (255) NULL, 
        nivel_usuario ENUM('sup','com') NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    -- Extraindo dados da tabela tbusuarios
    INSERT INTO tbusuarios (id_usuario,login_usuario,senha_usuario,nivel_usuario) VALUES
    (1,'eduarda','1234','sup'),
    (2,'mari','456','sup'),
    (3,'mav','789','sup'),
    (4,'iwanezuk','1234','sup');

    -- Estrutura da tabela tbnoticias
    CREATE TABLE tbnoticias (
        id_noticia INT(11) NOT NULL,
        titulo_noticia VARCHAR(500) NOT NULL,
        descri_noticia VARCHAR(1000000) NOT NULL,
        img_noticia VARCHAR(50) NOT NULL
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- Extraindo dados da tabela tbnoticias
    INSERT INTO tbnoticias (id_noticia,titulo_noticia,descri_noticia,img_noticia) VALUES
    (1,'Pioneira do Badminton em Itapetininga é citada em livro histórico da cidade','Badminton de Itapetininga: O Legado de Leiko Konno Eternizado em Livro
    \nA história do esporte em Itapetininga ganha um registro oficial e emocionante. A treinadora Leiko Konno, reconhecida como a pioneira do badminton na cidade, celebrou recentemente sua inclusão no livro "Itapetininga: Entre Memoriais e Registros", de autoria de Milton Cardoso.
    
    \nUm Reconhecimento Além das Quadras\n
    Em um relato sensível, Leiko expressou a honra de ver a trajetória do badminton local — um trabalho iniciado com pioneirismo e dedicação — impressa nas páginas da história itapetiningana. Para a treinadora, o projeto vai muito além da prática esportiva: trata-se de um projeto social que transformou e continua transformando muitas vidas na comunidade.
    
    \n"Ver a nossa trajetória de pioneirismo no Badminton impressa nessas páginas é uma honra que não cabe no peito. Mais do que esporte, este projeto social transformou e continua transformando muitas vidas." — Leiko Konno.
    
    \nSuperando Obstáculos
    O reconhecimento vem como uma validação de anos de esforço. Leiko destacou que, apesar da indiferença e dos duros obstáculos enfrentados ao longo da jornada, ver esse legado documentado confirma que o caminho escolhido foi o correto. Graças ao trabalho de resgate histórico, a dedicação de todos os envolvidos no projeto agora está eternizada para as futuras gerações.
    
    \nDestaques da publicação:
    
    \nPioneirismo: Registro oficial do início da modalidade em Itapetininga.
    
    \nValor Social: O impacto do esporte como ferramenta de transformação de vida.
    
    \nHistória Viva: A garantia de que o legado não será esquecido pelos anos que virão.', 'noticia1.jpg'),
    (2,'Atletas de badminton conquistam 14 medalhas em etapa Estadual no Sesi de Votorantim','Os atletas de Badminton de Itapetininga conquistaram 14 medalhas de ouro, prata e bronze, neste último fim de semana na 4ª Etapa Estadual de Badminton (categorias Aberta e Jovens) e na 2ª Etapa Estadual Parabadminton (pontos válidos para o RK nacional). As competições foram realizadas no SESI de Votorantim.
    
    \nItapetininga contou com os atletas Vinícius, Catarina, Tiago, Vitor, Aylla, Marina, Theo, Pedro, Larissa, Milena, Julio, Douglas, Cristiane e Eduardo, nas categorias sub 9, sub 11, sub 13, sub 15, sub 17, sub 19 e Aberta C e D, sob a coordenação da técnica e professora Leiko Konno que conta com apoio da Secretaria de Esporte, Lazer e Juventude.
    
    \nOuro:
    
    \nTiago Matiazzo - Dupla Mista
    
    \nPrata:
    
    \nJulio Paiva - Simples
    
    \nAylla Maeseki - Dupla Feminina
    
    \nMarina Mori - Dupla Feminina
    
    \nCatarina Takashi - Dupla Feminina
    
    \nBronze:
    
    \nVitor Takashi - 2 bronze - Simples e Dupla Masculina
    
    \nVinicius Lima - 2 bronze - Dupla Masculina e Dupla Mista
    
    \nCatarina Takashi - Dupla Mista
    
    \nTheo Maeseki - Dupla Masculina
    
    \nPedro Lima - Dupla Masculina
    
    \nJulio Paiva - Dupla Masculina
    
    \nCristiane Matiazzo - Dupla Feminina', 'noticia2.jpeg'),
    (3,'Atletas de Badminton conquistam o título de Heptacampeão para Itapetininga nos Jogos Regionais','Ouro para as equipes masculina e feminina de Badminton de Itapetininga em todas as categorias, em três dias de provas nos Jogos Regionais. Os atletas venceram na categoria Simples feminina e masculina, na categoria Dupla feminina e masculina e na categoria Equipe feminina e masculina.

    Sob a coordenação da professora Leiko Konno, os atletas Julio Jun Kano Paiva, Pedro Otávio Lima dos Santos, Theo Maeseki Shimatsu, Vitor Eli de Lima Takashi, Aylla Maeseki Shihammatsu, Gabriella Oliveira Cavalcante Santos, Larissa Naomi Takamori Ueno, Marina Akemi Mori de Souza Correia, Milena Namie Takamori Ueno. A técnica contou com os auxiliares Letícia Konno e Isabela Galvão.

    “Fomos novamente campeões nos Jogos Regionais de Itapetininga. Conquistamos o sétimo título para o município. Treinamos bastante e mostramos muita garra e técnica. Uma experiência marcante”, destacou a técnica Leiko Konno.', 'noticia3.jpeg');

    -- ------ CHAVES ------
    ALTER TABLE tbatletas
        ADD PRIMARY KEY (id_atleta),
        ADD KEY id_categoria_atleta_fk(id_categoria_atleta);
    
    ALTER TABLE tbcategorias
        ADD PRIMARY KEY (id_categoria);
    
    ALTER TABLE tbusuarios
        ADD PRIMARY KEY (id_usuario),
        ADD UNIQUE KEY login_usuario_uniq(login_usuario);

    ALTER TABLE tbtorneios
        ADD PRIMARY KEY (id_torneio);

    ALTER TABLE tbtecnicos
    ADD PRIMARY KEY (id_tecnico);

    ALTER TABLE tbparceiros
        ADD PRIMARY KEY (id_parceiro);

    ALTER TABLE tbnoticias
        ADD PRIMARY KEY (id_noticia);

    
    -- ----- AUTO INCREMENTS -----
    ALTER TABLE tbatletas
        MODIFY id_atleta INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
    
    ALTER TABLE tbcategorias
        MODIFY id_categoria INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
    
    ALTER TABLE tbusuarios
        MODIFY id_usuario INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

    ALTER TABLE tbtorneios
        MODIFY id_torneio INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

    ALTER TABLE tbtecnicos
        MODIFY id_tecnico INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

    ALTER TABLE tbparceiros
        MODIFY id_parceiro INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
    
    ALTER TABLE tbnoticias
        MODIFY id_noticia INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


    -- Limitadores e referências da Chave Estrangeira
    ALTER TABLE tbatletas
        ADD CONSTRAINT id_categoria_atleta_fk FOREIGN KEY(id_categoria_atleta)
            REFERENCES tbcategorias(id_categoria)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;
    
    -- -------------- VIEW -------------
    -- Criando a view vw_tbatletas
    CREATE VIEW vw_tbatletas as
    
        SELECT  a.id_atleta,
                a.id_categoria_atleta,
                c.nome_categoria,
                c.descri_categoria,
                c.img_categoria,
                a.data_nas_atleta,
                a.data_cad_atleta,
                a.nome_atleta,
                a.descri_atleta,
                a.img_atleta,
                a.destaque_atleta
        FROM    tbatletas a JOIN tbcategorias c
        WHERE   a.id_categoria_atleta=c.id_categoria
