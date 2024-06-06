PRAGMA foreign_keys = OFF;

-- ----------------------------
-- Table structure for Clientes
-- ----------------------------
DROP TABLE IF EXISTS "main"."Clientes";
CREATE TABLE Clientes (
    cliente_id INTEGER PRIMARY KEY,
    nome TEXT NOT NULL,
    email TEXT,
    telefone TEXT
);

-- ----------------------------
-- Table structure for Comentarios
-- ----------------------------
DROP TABLE IF EXISTS "main"."Comentarios";
CREATE TABLE Comentarios (
    comentario_id INTEGER PRIMARY KEY,
    texto TEXT NOT NULL,
    data_criacao_id INTEGER NOT NULL,
    ticket_id INTEGER NOT NULL,
    funcionario_id INTEGER NOT NULL,
    FOREIGN KEY (data_criacao_id) REFERENCES Data(data_id),
    FOREIGN KEY (ticket_id) REFERENCES Tickets(ticket_id),
    FOREIGN KEY (funcionario_id) REFERENCES Funcionarios(funcionario_id)
);

-- ----------------------------
-- Table structure for Data
-- ----------------------------
DROP TABLE IF EXISTS "main"."Data";
CREATE TABLE Data (
    data_id INTEGER PRIMARY KEY,
    data DATE NOT NULL
);

-- ----------------------------
-- Table structure for Funcionarios
-- ----------------------------
DROP TABLE IF EXISTS "main"."Funcionarios";
CREATE TABLE Funcionarios (
    funcionario_id INTEGER PRIMARY KEY,
    nome TEXT NOT NULL,
    email TEXT
);

-- ----------------------------
-- Table structure for Tickets
-- ----------------------------
DROP TABLE IF EXISTS "main"."Tickets";
CREATE TABLE Tickets (
    ticket_id INTEGER PRIMARY KEY,
    titulo TEXT NOT NULL,
    descricao TEXT,
    data_criacao_id INTEGER NOT NULL,
    tipo_servico_id INTEGER NOT NULL,
    prioridade TEXT,
    status_chamado TEXT,
    FOREIGN KEY (data_criacao_id) REFERENCES Data(data_id),
    FOREIGN KEY (tipo_servico_id) REFERENCES " Tipos_de_Servico"(tipo_servico_id)
);

-- ----------------------------
-- Table structure for Tipos_de_Servico
-- ----------------------------
DROP TABLE IF EXISTS "main"."Tipos_de_Servico";
CREATE TABLE "Tipos_de_Servico" (
    tipo_servico_id INTEGER PRIMARY KEY,
    nome TEXT NOT NULL
);
