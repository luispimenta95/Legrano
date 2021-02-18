 CREATE TRIGGER `trg_bk_pagamento` AFTER DELETE ON
 `pagamento` FOR EACH ROW insert into 
 bk_pagamento (id_pagamento,id_aluno,desconto,valor_pagamento,data_pagamento,id_forma) 
 VALUES (old.id_pagamento,old.id_aluno,old.desconto,old.valor_pagamento,old.data_pagamento,old.id_forma);


    SELECT pagamento.id_pagamento,aluno.nome_aluno,forma_pagamento.nome_forma,pagamento.valor,pagamento.dia FROM pagamento 
    INNER JOIN aluno ON pagamento.aluno = aluno.id_aluno 
    INNER JOIN forma_pagamento ON pagamento.forma = forma_pagamento.id_forma

    SELECT id_aluno,foto_aluno,nome_aluno,cpf,email,nascimento,
    telefone,entrada,nome_plano,valor FROM aluno a INNER JOIN plano p on a.plano = p.id_plano";

