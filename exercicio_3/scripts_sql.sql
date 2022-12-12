/*CRIAÇÃO DE TABELAS*/

CREATE TABLE info (
  id int(11) NOT NULL AUTO_INCREMENT,
  cpf varchar(64) NOT NULL,
  genero varchar(1) NOT NULL,
  ano_nascimento int(11) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE usuario (
  id int(11) NOT NULL AUTO_INCREMENT,
  cpf varchar(64) NOT NULL,
  nome varchar(64) NOT NULL,
  PRIMARY KEY (id)
);

/*INSERINDO VALORES NA TABELA USUARIO*/

INSERT INTO usuario (cpf, nome)  
VALUES  ( '16798125050', 'Luke Skywalker' ),
        ( '59875804045', 'Bruce Wayne' ),
        ( '04707649025', 'Diane Prince' ),
        ( '21142450040', 'Bruce Banner' ),
        ( '83257946074', 'Harley Quinn' ),
        ( '07583509025', 'Peter Parker' );

/*INSERINDO VALORES NA TABELA INFO*/

INSERT INTO info ( cpf, genero, ano_nascimento ) 
VALUES  ( '16798125050', 'M', '1976' ),
        ( '59875804045', 'M', '1960' ),
        ( '04707649025', 'F', '1988' ),
        ( '21142450040', 'M', '1954' ),
        ( '83257946074', 'F', '1970' ),
        ( '07583509025', 'M', '1972' );


/*SQL PARA RETORNAR RESULTADO NO FORMATO DESEJADO DE RETORNO*/

SELECT  CONCAT( usuario.nome, ' - ', info.genero ) as usuario,
	   CASE
            WHEN YEAR ( CURRENT_DATE ) - info.ano_nascimento > 50 THEN 'SIM'
            WHEN YEAR ( CURRENT_DATE ) - info.ano_nascimento <= 50 THEN 'NÃO' END AS maior_50_anos                       
FROM info, usuario 
WHERE info.cpf = usuario.cpf;


/*SQL PARA OBTER SOMENTE USUARIOS DESEJADOS*/


SELECT  CONCAT( usuario.nome, ' - ', info.genero ) as usuario,
	   CASE
            WHEN YEAR ( CURRENT_DATE ) - info.ano_nascimento > 50 THEN 'SIM'
            WHEN YEAR ( CURRENT_DATE ) - info.ano_nascimento <= 50 THEN 'NÃO' END AS maior_50_anos
FROM info, usuario 
WHERE info.cpf = usuario.cpf AND usuario.cpf IN ('16798125050', '21142450040', '07583509025');


/*SQL COM ORDER BY PARA FICAR NA ORDEM*/

SELECT  CONCAT( usuario.nome, ' - ', info.genero ) as usuario,
	   CASE
            WHEN YEAR ( CURRENT_DATE ) - info.ano_nascimento > 50 THEN 'SIM'
            WHEN YEAR ( CURRENT_DATE ) - info.ano_nascimento <= 50 THEN 'NÃO' END AS maior_50_anos
FROM info, usuario 
WHERE info.cpf = usuario.cpf AND usuario.cpf IN ('16798125050', '21142450040', '07583509025')
ORDER BY maior_50_anos ASC;
