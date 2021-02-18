<?php
  include '../conecta.php';
  $id = $_GET["id"];
  $senha_adm = $_POST["senha_rem"];

  $id = $_POST["id_adm"];
  $id_comprador = $_POST["id_comprador"];
  $id_cliente = $_GET["id"];

   $sql_code = "delete from comprador where id_comprador = $id_comprador";
    //   echo $sql_code;
  $sql_admin = "SELECT senha_administrador from administrador where id_administrador = $id";
  
  $result = $conn->query($sql_admin);
  $rowcount=mysqli_num_rows($result);
  if($rowcount >0){
    $administrador = $result->fetch_assoc();
    $senha_bd = $administrador["senha_administrador"];
      if($senha_adm == $senha_bd){
        if ($conn->query($sql_code) === TRUE) {
            
            $mov=5;
            $sql_log = "INSERT INTO log_informacoes(id_cliente,id_administrador,id_movimentacao,data) VALUES ('$id_cliente','$id','$mov',NOW())";
            if ($conn->query($sql_log) === TRUE) {
              
                header("Location:home.php");
              
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