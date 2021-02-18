<?php
  include '../conecta.php';
  $msg = false;
  $nome_cliente = $_POST["nome02"];
  $id = $_GET['id'];
  $email = $_POST["email02"];
  $endereco = $_POST["endereco02"];
  $cpf = $_POST["cpf02"];
  $nascimento = $_POST["aniversario02"];
  $senha = $_POST["senha02"];
  $senha_adm = $_POST["senha_up"];
  $telefone = $_POST["telefone02"];
  $situacao = $_POST["situacao"];

  $id_administrador = $_POST["id_adm"];
  $sql_admin = "SELECT senha_administrador from administrador where id_administrador = $id_administrador";
  $result = $conn->query($sql_admin);
  $rowcount=mysqli_num_rows($result);
  if($rowcount >0){
    $administrador = $result->fetch_assoc();
    $senha_bd = $administrador["senha_administrador"];
      if($senha_adm == $senha_bd){
        $sql_code = "UPDATE cliente SET cpf_cliente = $cpf,ativo = '$situacao', nome_cliente='$nome_cliente', endereco_cliente = '$endereco' , telefone_cliente = '$telefone' , senha_cliente = '$senha', email_cliente = '$email',nascimento = '$nascimento' WHERE id_cliente=$id";

        if ($conn->query($sql_code) === TRUE) {
            
            $mov=2;
            $sql_log = "INSERT INTO log_informacoes(id_cliente,id_administrador,id_movimentacao,data) VALUES ('$id','$id_administrador','$mov',NOW())";
                if ($conn->query($sql_log) === TRUE) {
                          $_SESSION['msg'] = "<div class='alert alert-success'>Venda registrada com sucesso!</div>";


header("Location:clientes.php");

}
            
          }
    else {
      echo $conn->error;
      }

      

    }

    else{
  echo "Senha administrativa incorreta";
    }



  }
  
?>