create table cliente (
id_cliente int auto_increment not null primary key,
nome_cliente varchar(255),
nascimento date,
entrada timestamp,
cpf_cliente varchar(11) unique,
email_cliente varchar(255),
endereco_cliente varchar(255),

ativo boolean default 1, 
telefone_cliente varchar(255),
senha_cliente varchar(255) default '12345',

saldo_cliente float default 0
    );

create table administrador (
id_administrador int auto_increment not null primary key,
nome_administrador varchar(255),
nascimento date,
entrada timestamp,
cpf_administrador varchar(11) unique,
email_administrador varchar(255),
senha_administrador varchar(255)  default '12345',

ativo boolean default 1, 
telefone_administrador varchar(255)

    );

CREATE TABLE forma_pagamento(
id_forma int auto_increment not null primary key,
nome_forma varchar(30)
); 



CREATE TABLE pagamento(
id_pagamento int auto_increment not null primary key,
id_cliente int,
desconto int default 0,
valor_pagamento float,
id_forma int,
id_administrador int,
data_pagamento date,
foreign key(id_administrador) references administrador (id_administrador) ON update cascade on delete restrict,

foreign key(id_cliente) references cliente (id_cliente) ON update cascade on delete restrict,
foreign key(id_forma) references forma_pagamento (id_forma) ON update cascade on delete restrict
);

create table meses (
id_mes int auto_increment not null primary key,
nome_mes varchar(25)
);
create table tipo_movimentacao(
id_movimentacao int auto_increment not null primary key,
nome_movimentacao varchar(50)
);

create table comprador(
id_comprador int auto_increment not null primary key,
nome_comprador varchar(200),
id_cliente int,


foreign key(id_cliente) references cliente (id_cliente) ON update cascade on delete restrict

);
create table log_informacoes(
id_log int auto_increment not null primary key,
id_administrador int,
id_cliente int,
data timestamp,
credito float  default 0,
debito float default 0,
bonus float default 0,
id_movimentacao int,
id_comprador int,
id_forma int,

foreign key(id_forma) references forma_pagamento (id_forma) ON update cascade on delete restrict,
foreign key(id_comprador) references comprador (id_comprador) ON update cascade on delete restrict,
foreign key(id_administrador) references administrador (id_administrador) ON update cascade on delete restrict,
foreign key(id_cliente) references cliente (id_cliente) ON update cascade on delete restrict,
foreign key(id_movimentacao) references tipo_movimentacao (id_movimentacao) ON update cascade on delete restrict

);
create table publico(
id_publico int AUTO_INCREMENT not null primary key,
nome_publico varchar(30)
);
create table promocoes(
id_promocao int auto_increment not null primary key,
imagem varchar(255),
ativo boolean default 1,
nome_promocao varchar(200),
descricao varchar(200),
id_administrador int,
data timestamp,
publico int,
foreign key(id_administrador) references administrador (id_administrador) ON update cascade on delete restrict,
foreign key(publico) references publico (id_publico) ON update cascade on delete restrict

);

CREATE TABLE mensagem(
    id_mensagem int AUTO_INCREMENT NOT null PRIMARY key,
    remetente varchar(200),
    email varchar(200),
    telefone varchar(50),
    mensagem longtext,
    data_mensagem timestamp
    );
create table log_financeiro(
id_log int auto_increment not null primary key,
id_administrador int,
id_cliente int,
data timestamp,
credito float  default 0,
debito float default 0,
bonus float default 0,
id_movimentacao int,
id_comprador int,
id_forma int,


foreign key(id_forma) references forma_pagamento (id_forma) ON update cascade on delete restrict,
foreign key(id_comprador) references comprador (id_comprador) ON update cascade on delete restrict,
foreign key(id_administrador) references administrador (id_administrador) ON update cascade on delete restrict,
foreign key(id_cliente) references cliente (id_cliente) ON update cascade on delete restrict,
foreign key(id_movimentacao) references tipo_movimentacao (id_movimentacao) ON update cascade on delete restrict

);