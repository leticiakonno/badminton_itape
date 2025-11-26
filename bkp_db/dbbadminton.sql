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
    descri_categoria VARCHAR(200) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Extraindo dados da tabela tbcategorias
INSERT INTO tbcategorias (id_categoria, nome_categoria, descri_categoria) VALUES
(1, 'Sub9', 'Atletas nascidos em 2016 ou depois.'),
(2, 'Sub11', 'Atletas nascidos em 2014 ou depois.'),
(3, 'Sub13', 'Atletas nascidos em 2012 ou depois.'),
(4, 'Sub15', 'Atletas nascidos em 2010 ou depois.'),
(5, 'Sub17', 'Atletas nascidos em 2008 ou depois.'),
(6, 'Sub19', 'Atletas nascidos em 2006 ou depois.'),
(7, 'Aberto', 'Abrange atletas de todas as idades.'),
(8, 'Sênior I', 'Atletas nascidos em 1994 ou antes.'),
(9, 'Sênior II', 'Atletas nascidos em 1989 ou antes.'),
(10, 'Veterano I', 'Atletas nascidos em 1984 ou antes.'),
(11, 'Veterano II', 'Atletas nascidos em 1979 ou antes.'),
(12, 'Master I', 'Atletas nascidos em 1974 ou antes.'),
(13, 'Master II', 'Atletas nascidos em 1969 ou antes.'),
(14, 'Master III', 'Atletas nascidos em 1964 ou antes.'),
(15, 'Master IV', 'Atletas nascidos em 1959 ou antes.');

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
(1, 7, 'Letícia Konno', '1997/08/22', '2025/11/17', 'Leticia é a atleta pioneira do esporte em Itapetininga, destaque de nível internacional!', 'leticia.jpeg', 'Sim'),
(2, 7, 'Isabela Galvão', '2004/04/19', '2025/11/17', 'Isinha é uma atleta super talentosa, todos se encantam ao ver ela jogar. Joga na categoria aberta e brilha em quadra!', 'isabela.jpeg','Sim'),
(3, 7, 'Douglas Oliveira', '1997/06/21', '2025/11/17', 'Douglas é o destaque das fintas, joga muito e sempre ajuda todos ao seu redor!', 'douglas.jpeg', 'Sim'),
(4, 3, 'Vitor Takashi', '2003/02/23', '2025/11/17', 'Vitor é um menino muito inteligente e esforçado, o que o torna um grande atleta. Adora tirar uma selfie e brilha na categoria Sub13!', 'vitor.jpeg', 'Sim'),
(5, 3, 'Marina Mori', '2014/08/20', '2025/11/17', 'Marina é reservada, mas adora brincar com as amigas e está cada dia melhor, surpreendendo na categoria Sub13!', 'marina.jpeg', 'Não'),
(6, 5, 'Larissa Ueno', '2010/07/21', '2025/11/17', 'Larissa, Sub17, é a sincera do time, mas que brilha nas quadras brasileiras e internacionais também!', 'larissa.jpeg', 'Sim'),
(7, 6, 'Julio Paiva', '2007/07/07', '2025/11/17', 'Julio é carismático, simpático e amigo de todos, joga muito e brilha na categoria Sub19.', 'julio.jpeg', 'Sim'),
(8, 6, 'Milena Ueno', '2006/09/15', '2025/11/17', 'Milena é a criativa e dedicada do time, joga na Sub19 e adora as crianças.', 'milena.jpeg', 'Não'),
(9, 2, 'Tiago Matiazzo', '2016/03/05', '2025/11/17', 'Tiaguinho é um atleta muito talentoso e dedicado. Brilha na categoria Sub11 e promete ser a estrela da temporada.', 'tiago.jpeg', 'Sim'),
(10, 1, 'Vinicius Lima', '2017/09/08', '2025/11/17', 'Vinicius tem energia de sobra e cansa seus adversários, brilha na categoria Sub9!', 'vinicius.jpeg', 'Não'),
(11, 3, 'Aylla Maeseki', '2014/09/08', '2025/11/17', 'Aylla é engraçada e adora fazer uma gracinha, joga muito na categoris Sub13!', 'aylla.jpeg', 'Não'),
(12, 4, 'Theo Maeseki', '2011/02/19', '2025/11/17', 'Theo é um menino esforçado e está brilhando cada vez mais nos torneios na categoria Sub15.', 'theo.jpeg', 'Não'),
(13, 4, 'Pedro Lima', '2011/03/14', '2025/11/17', 'Pedro joga na categoria Sub15, é quieto e reservado, mas sempre muito esforçado e dedicado!', 'pedro.jpeg', 'Não'),
(14, 2, 'Catarina Takashi','2015/05/02', '2025/11/17', 'Catarina é uma atleta da categoria Sub11, treina desde os 9 anos de idade e tem muita energia.', 'catarina.jpeg', 'Não'),
(15, 7, 'Eduardo Takahagui', '1990/12/06', '2025/11/17', 'Eduardo é dedicado e enérgico. Sempre dando o seu melhor nos torneios.', 'eduardo.jpeg', 'Não'),
(16, 7, 'Cristiane Matiazzo', '1985/12/20', '2025/11/17', 'Cris gosta de se aventurar e se arriscar no meio das crianças, e nos torneios estaduais. Além de ser a fisioterapeuta.', 'cristiane.jpeg', 'Não'),
(17, 11,'Pedro Lanas', '1979/03/24', '2025/11/17', 'Pedro é um dos atletas mais experientes no esporte, ', 'pedrolanas.jpeg', 'Não');

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
 (1, 'Leiko Konno', 'Técnica Principal', 'Técnica voluntária de badminton pioneira na cidade de Itapetininga. Acredita que o esporte vai muito além de vencer o tempo todo, mas sim de transformar atletas e pessoas para a vida, com dignidade e humildade.', 'leiko.jpeg'),
 (2, 'Shogo Konno', 'Técnico Assistente', 'Técnico voluntário de badminton junto com a sua esposa Leiko e também é árbitro de nível nacional. Adora fazer uma piada e sempre com muita paciência para ajudar e ensinar.', 'shogo.jpeg'),
 (3, 'Letícia Konno', 'Técnica Assitente', 'Assistente técnica, ajuda voluntariamente a ministrar os treinos com seus pais. Atleta, mas também sempre disposta a ensinar através da experiência.', 'leticia.jpeg');

-- Estrutura da tabela tbparceiros
CREATE TABLE tbparceiros(
    id_parceiro INT(11) NOT NULL,
    nome_parceiro VARCHAR(50) NOT NULL,
    descri_parceiro VARCHAR(500) NOT NULL,
    img_parceiro VARCHAR(50) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Extraindo dados da tabela tbparceiros
INSERT INTO tbparceiros(id_parceiro,nome_parceiro,descri_parceiro,img_parceiro) VALUES
    (1,'Prefeitura de Itapetininga', 'A Prefeitura de Itapetininga é a principal parceira do projeto Badminton Itapetininga, apoiando e incentivando o esporte na cidade.', 'prefeitura.jpeg'),
    (2,'Colégio Dom Bosco de Itapetininga', 'Primeira e fiel patrocinadora do badminton na cidade, promovendo o esporte e oferecendo suporte aos atletas.', 'dombosco.jpeg'),
    (3,'Universal Chemical', 'Uma das maiores empresas da região, são apoiadores do esporte, sempre prestando suporte à equipe.', 'chemical.jpeg'),
    (4,'Ligia', 'Uma das maiores apoiadoras da equipe, faz por amor ao esporte e toda a equipe. Coração e alma enormes.', 'ligia.jpeg'),
    (5,'Cristina Mori', 'Psicóloga voluntária, mãe de atleta, proporciona acompanhamento da saúde mental dos nossos atletas.', 'cristinaethiago.jpeg'),
    (6, 'Dr,Thiago', 'Médico voluntário que cuida da saúde dos atletas, realizando exames e acompanhamentos regulares.', 'drthiago.jpeg'),
    (7,'Laura Takamori', 'Mãe de atletas e grande apoiadora do esporte, prestativa e sempre à disposição. Presta ajuda de forma voluntária em prol de toda a equipe.', 'laura.jpeg'),
    (8, 'ROberto Ueno', 'Pai de atletas, sempre disposto a ajudar e a alavancar o time para outros patamares.', 'roberto.jpeg'),
    (9,'Cristiane Matiazzo', 'Fisioterapeuta voluntária que cuida dos atletas, prevenindo lesões e promovendo a recuperação física.', 'cristiane.jpeg');

-- Estrutura da tabela tbtorneios
CREATE TABLE tbtorneios(
    id_torneio INT(11) NOT NULL,
    tipo_torneio VARCHAR(20) NOT NULL,
    descri_torneio VARCHAR(255) NOT NULL,
    img_torneio VARCHAR(50) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
-- Extraindo dados da tabela tbtorneios
INSERT INTO tbtorneios(id_torneio,tipo_torneio,descri_torneio,img_torneio) VALUES
    (1,'Regional', 'Torneios realizados na 8ª região, que abrange itapetininga e muitas outras cidades.', 'regional.jpeg'),
    (2,'Estadual', 'Torneio que abrenge os melhores atletas do estado de São Paulo.', 'estadual.jpeg'),
    (3,'Nacional', 'Torneio para os melhores atletas em território brasileiro na categoria.', 'nacional.jpeg'),
    (4,'Internacional', 'Torneios de nível, Sulamericano, Panamericano e Mundial, abrange os melhores atletas do mundo.', 'internacional.jpeg');

-- Estrutura da tabela tbusuario
CREATE TABLE tbusuarios (
    id_usuario INT(11) NOT NULL,
    login_usuario VARCHAR(30) NOT NULL,
    senha_usuario VARCHAR(8) NOT NULL,
    foto_usuario VARCHAR (255) NULL, 
    nivel_usuario ENUM('sup','com') NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
-- Extraindo dados da tabela `tbusuarios`
INSERT INTO tbusuarios (id_usuario,login_usuario,senha_usuario,nivel_usuario) VALUES
(1,'eduarda','1234','sup'),
(2,'mari','456','sup'),
(3,'mav','789','sup'),
(4,'iwanezuk','1234','sup');
 
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

 
-- ----- AUTO INCREMENTS -----
ALTER TABLE tbatletas
    MODIFY id_atleta INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
 
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
            a.data_nas_atleta,
            a.data_cad_atleta,
            a.nome_atleta,
            a.descri_atleta,
            a.img_atleta,
            a.destaque_atleta
    FROM    tbatletas a JOIN tbcategorias c
    WHERE   a.id_categoria_atleta=c.id_categoria
