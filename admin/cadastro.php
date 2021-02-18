<?php
  include '../conecta.php';
  $msg = false;
  $nome_cliente = $_POST["nome"];
  $email = $_POST["email"];
  $endereco = $_POST["endereco"];
  $cpf = $_POST["cpf"];
  $nascimento = $_POST["aniversario"];
  
  $senha_adm = $_POST["senha_add"];
  $telefone = $_POST["telefone"];
  $id = $_POST["id_adm"];
  $sql_admin = "SELECT senha_administrador from administrador where id_administrador = $id";
  $result = $conn->query($sql_admin);
  $rowcount=mysqli_num_rows($result);
  if($rowcount >0){
    $administrador = $result->fetch_assoc();
    $senha_bd = $administrador["senha_administrador"];
      if($senha_adm == $senha_bd){
        $sql_code = "INSERT INTO cliente (nome_cliente, cpf_cliente,endereco_cliente,telefone_cliente,email_cliente,nascimento,entrada) VALUES ('$nome_cliente','$cpf','$endereco','$telefone','$email','$nascimento',NOW()) ";
        if ($conn->query($sql_code) === TRUE) {
            $last_id = $conn->insert_id;
            $mov=1;
            $sql_log = "INSERT INTO log_informacoes(id_cliente,id_administrador,id_movimentacao,data) VALUES ('$last_id','$id','$mov',NOW())";
            if ($conn->query($sql_log) === TRUE) {
              $sql_comprador = "INSERT INTO comprador(id_cliente,nome_comprador) VALUES ('$last_id','$nome_cliente')";
              if ($conn->query($sql_comprador) === TRUE) {
                header("Location:clientes.php");
              }
            }
          }
    else {
      echo "erro no sql";
      }
      

    }


else{
  echo "Senha administrativa incorreta";
    }

  }
  
?>