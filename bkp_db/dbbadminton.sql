-- Backup Geral do banco de dados dbbadminton
-- Excluir o usuário dbbadminton caso ele exista
DROP USER IF EXISTS 'dbbadminton'@'localhost';
 
-- Criar o usuário dbbadminton se ele não existir
CREATE USER IF NOT EXISTS 'dbbadminton'@'localhost'
    IDENTIFIED BY 'senacti19';
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
(8, 'Sênior I', 'Atletas nascidos em 1994 ou antes'),
(9, 'Sênior II', 'Atletas nascidos em 1989 ou antes'),
(10, 'Veterano I', 'Atletas nascidos em 1984 ou antes'),
(11, 'Veterano II', 'Atletas nascidos em 1979 ou antes'),
(12, 'Master I', 'Atletas nascidos em 1974 ou antes'),
(13, 'Master II', 'Atletas nascidos em 1969 ou antes'),
(14, 'Master III', 'Atletas nascidos em 1964 ou antes'),
(15, 'Master IV', 'Atletas nascidos em 1959 ou antes');

-- Estrutura da tabela tbatletas
CREATE TABLE tbatletas(
    id_atleta INT(11) NOT NULL,
    id_categoria_atleta INT(11) NOT NULL,
    nome_atleta VARCHAR(30) NOT NULL,
    data_nas_atleta DATE(11) NOT NULL,
    data_cad_atleta DATE(11) NOT NULL,
    descri_atleta VARCHAR(500) NOT NULL,
    img_atleta VARCHAR(50) NOT NULL,
    destaque_atleta enum('Sim','Não') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
-- Extraindo dados da tabela `tbatletas`
INSERT INTO tbatletas (id_atleta, id_categoria_atleta, nome_atleta, data_nas_atleta, data_cad_atleta, descri_atleta, img_atleta, destaque_atleta) VALUES
(1, 2, 'Letícia Konno', '22/08/1997', '17/11/2025', 'Leticia é a atleta pioneira do esporte em Itapetininga, destaque de nível internacional!', 'leticia.jpeg', 'Sim' ),
(2, 2, 'Isabela Galvão', '19/04/2004', '17/11/2025', 'Isinha é uma atleta super talentosa, todos se encantam ao ver ela jogar. Joga na categoria aberta e brilha em quadra!', 'isabela.jpeg','Sim'),
(3, 3, 'Douglas Oliveira', '21/06/1997', '17/11/2025', 'Douglas é o destaque das fintas, joga muito e sempre ajuda todos ao seu redor!', 'douglas.jpeg', 'Sim'),
(4, 3, 'Cristiane Matiazzo', '20/12/1985', '17/11/2025', 'Cris gosta de se aventurar e se arriscar no meio das crianças, e nos torneios estaduais. Além de ser a fisioterapeuta.', 'cristiane.jpeg', 'Não'),
(5, 4, 'Pedro Lima', '14/03/2011', '17/11/2025', 'Pedro joga na categoria Sub15, é quieto e reservado, mas sempre muito esforçado e dedicado!', 'pedro.jpeg', 'Não'),
(6, 5, 'Larissa Ueno', '21/07/2010', '17/11/2025', 'Larissa, Sub17, é a sincera do time, mas que brilha nas quadras brasileiras e internacionais também!', 'larissa.jpeg', 'Sim'),
(7, 6, 'Julio Paiva', '07/07/2007', '17/11/2025', 'Julio é carismático, simpático e amigo de todos, joga muito e brilha na categoria Sub19.', 'julio.jpeg', 'Sim'),
(8, 6, 'Milena Ueno', '15/09/2006', '17/11/2025', 'Milena é a criativa e dedicada do time, joga na Sub19 e adora as crianças.', 'milena.jpeg', 'Não'),
(9, 7, 'Tiago Matiazzo', '05/03/2016', '17/11/2025', 'Tiaguinho é um atleta muito talentoso e dedicado. Brilha na categoria Sub11 e promete ser a estrela da temporada.', 'tiago.jpeg', 'Sim'),
(10, 1, 'Vinicius Lima', '08/09/2017', '17/11/2025', 'Vinicius tem energia de sobra e cansa seus adversários, brilha na categoria Sub9!', 'vinicius.jpeg', 'Não'),
(11, 3, 'Aylla Maeseki', '08/09/2014', '17/11/2025', 'Aylla é engraçada e adora fazer uma gracinha, joga muito na categoris Sub13!', 'aylla.jpeg', 'Não'),
(12, 4, 'Theo Maeseki', '19/02/2011', '17/11/2025', 'Theo é um menino esforçado e está brilhando cada vez mais nos torneios na categoria Sub15.', 'theo.jpeg', 'Não'),
(13, 7, 'Vitor Takashi', '23/02/2003', '17/11/2025', 'Vitor é um menino muito inteligente e esforçado, o que o torna um grande atleta. Adora tirar uma selfie e brilha na categoria Sub13!', 'vitor.jpeg', 'Sim'),
(14, 7, 'Catarina Takashi','02/05/2015', '17/11/2025', 'Catarina é uma atleta da categoria Sub11, treina desde os 9 anos de idade e tem muita energia.', 'catarina.jpeg', 'Não'),
(15, 7, 'Eduardo Takahagui', '06/12/1990', '17/11/2025', 'Eduardo é dedicado e enérgico. Sempre dando o seu melhor nos torneios.', 'eduardo.jpeg', 'Não'),
(16, 10, 'Marina Mori', '20/08/2014', '17/11/2025', 'Marina é ', 'marina.jpeg', 'Não'),
(17, 11, 'Pedro Lanas', '24/03/1979', '17/11/2025', 'Pedro é um dos atletas mais experientes no esporte, ', 'pedrolanas.jpeg', 'Não');

-- Estrutura da tabela tbtorneios
CREATE TABLE tbtorneios(
    id_torneio INT(11) NOT NULL,
    tipo_torneio VARCHAR(20) NOT NULL,
    descri_torneio VARCHAR(255) NOT NULL,
    img_torneio VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
-- Extraindo dados da tabela tbtorneios
INSERT INTO tbtorneios(id_torneio,tipo_torneio,descri_torneio,img_torneio) VALUES
    (1,'reg','Regional','regional.jpeg'),
    (2,'est','Estadual','estadual.jpeg'),
    (3,'nac','Nacional','nacional.jpeg'),
    (4,'int','Internacional','internacional.jpeg');

-- Estrutura da tabela tbusuario
CREATE TABLE tbusuarios (
    id_usuario INT(11) NOT NULL,
    login_usuario VARCHAR(30) NOT NULL,
    senha_usuario VARCHAR(8) NOT NULL,
    nivel_usuario ENUM('sup','com') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
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

 
-- ----- AUTO INCREMENTS -----
ALTER TABLE tbatletas
    MODIFY id_atleta INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
 
ALTER TABLE tbcategorias
    MODIFY id_categorias INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
 
ALTER TABLE tbusuarios
    MODIFY id_usuario INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE tbtorneios
    MODIFY id_torneio INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


-- Limitadores e referências da Chave Estrangeira
ALTER TABLE tbatletas
    ADD CONSTRAINT id_categoria_atleta_fk FOREIGN KEY(id_categoria_atleta)
        REFERENCES tbcategoria(id_categoria)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION;
 
-- -------------- VIEW -------------
-- Criando a view vw_tbatletas
CREATE VIEW vw_tbatletas as
 
    SELECT  p.id_atleta,
            p.id_categoria_atleta,
            t.data_nas_atleta,
            t.data_cad_atleta,
            p.nome_atleta,
            p.descri_atleta,
            p.img_atleta,
            p.destaque_atleta
    FROM    tbatletas a JOIN tbcategorias c
    WHERE   p.id_categoria_atleta=t.id_categoria