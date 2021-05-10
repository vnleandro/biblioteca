CREATE TABLE aluno
(
    idAluno INT PRIMARY KEY AUTO_INCREMENT,
    idTurma INT NOT NULL,
    nomeAluno VARCHAR(200) NOT NULL
) ENGINE = innodb;

CREATE TABLE armario
(
    idArmario INT PRIMARY KEY AUTO_INCREMENT,
    idAluno INT NOT NULL,
    disponivelArmario TEXT
) ENGINE = innodb;

CREATE TABLE autor
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(200) NOT NULL
) ENGINE = innodb;

CREATE TABLE editora
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(200) NOT NULL
) ENGINE = innodb;

CREATE TABLE emprestimo
(
    idEmprestimo INT PRIMARY KEY AUTO_INCREMENT,
    idAluno INT NOT NULL,
	idLivro INT NOT NULL,
	dataEmprestimo DATETIME DEFAULT NOW(),
	dlimite DATETIME DEFAULT NOW(),
    dataDevolvido DATETIME DEFAULT NOW()
) ENGINE = innodb;

CREATE TABLE espera
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    idLivro INT NOT NULL,
    alunoNaFrente VARCHAR(200) NOT NULL
) ENGINE = innodb;

CREATE TABLE genero
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(200) NOT NULL
) ENGINE = innodb;

CREATE TABLE livro
(
    idLivro INT PRIMARY KEY AUTO_INCREMENT,
    idGenero INT NOT NULL,
	idAutor INT NOT NULL,
	idEditora INT NOT NULL,
    nomeLivro VARCHAR(200) NOT NULL,
    descricao TEXT,
	disponivel TEXT
) ENGINE = innodb;

CREATE TABLE penalidade
(
    idPenalidade INT PRIMARY KEY AUTO_INCREMENT,
    idAluno INT NOT NULL,
	dataInicio DATETIME DEFAULT NOW(),
    dataTermino DATETIME DEFAULT NOW()
) ENGINE = innodb;

CREATE TABLE turma
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(200) NOT NULL,
    periodo TEXT
) ENGINE = innodb;

ALTER TABLE 'aluno' ADD CONSTRAINT 'fkTurma' FOREIGN KEY ('idTurma') REFERENCES 'turma' ('id');

ALTER TABLE 'armario' ADD CONSTRAINT 'fkAluno' FOREIGN KEY ('idAluno') REFERENCES 'aluno' ('idAluno');

ALTER TABLE 'emprestimo' ADD CONSTRAINT 'fkAluno' FOREIGN KEY ('idAluno') REFERENCES 'aluno' ('idAluno');

ALTER TABLE 'emprestimo' ADD CONSTRAINT 'fkLivro' FOREIGN KEY ('idLivro') REFERENCES 'livro' ('idLivro');

ALTER TABLE 'espera' ADD CONSTRAINT 'fkLivro' FOREIGN KEY ('idLivro') REFERENCES 'livro' ('idLivro');

ALTER TABLE 'livro' ADD CONSTRAINT 'fkGenero' FOREIGN KEY ('idGenero') REFERENCES 'genero' ('id');

ALTER TABLE 'livro' ADD CONSTRAINT 'fkAutor' FOREIGN KEY ('idAutor') REFERENCES 'autor' ('id');

ALTER TABLE 'livro' ADD CONSTRAINT 'fkEditora' FOREIGN KEY ('idEditora') REFERENCES 'editora' ('id');

ALTER TABLE 'penalidade' ADD CONSTRAINT 'fkAluno' FOREIGN KEY ('idAluno') REFERENCES 'aluno' ('idAluno');