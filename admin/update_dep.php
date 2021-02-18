<?php
  include '../conecta.php';
  $msg = false;
  $nome_cliente = $_POST["nome_comprador"];
  $id = $_GET['id'];
  $senha_adm = $_POST["senha_upD"];
  $id_administrador = $_POST["id_adm"];
  $id_comprador = $_POST["id_comprador"];
        $sql_code = "UPDATE comprador SET nome_comprador = '$nome_cliente' WHERE id_comprador=$id_comprador";




  $sql_admin = "SELECT senha_administrador from administrador where id_administrador = $id_administrador";
  $result = $conn->query($sql_admin);
  $rowcount=mysqli_num_rows($result);
  if($rowcount >0){
    $administrador = $result->fetch_assoc();
    $senha_bd = $administrador["senha_administrador"];
      if($senha_adm == $senha_bd){

        if ($conn->query($sql_code) === TRUE) {
            
            $mov=4;
            $sql_log = "INSERT INTO log_informacoes(id_cliente,id_administrador,id_movimentacao,data) VALUES ('$id','$id_administrador','$mov',NOW())";
            if ($conn->query($sql_log) === TRUE) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Dependente registrado com sucesso!</div>";

                header("Location:home.php");
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