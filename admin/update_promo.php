<?php

include '../conecta.php';

$id = $_GET['id'];
   $id_administrador = $_POST["id_adm"];



 $buscar = "SELECT * FROM promocoes WHERE id_promocao = $id";
$result = $conn->query($buscar);


$promocao = $result->fetch_assoc();


 $msg = false;
 $sql_admin = "SELECT senha_administrador from administrador where id_administrador = $id_administrador";
  $result = $conn->query($sql_admin);
  $senha_adm = $_POST["senha_up"];
  $rowcount=mysqli_num_rows($result);
  if($rowcount >0){
    $administrador = $result->fetch_assoc();
    $senha_bd = $administrador["senha_administrador"];
      if($senha_adm == $senha_bd){
      if(isset($_FILES['arquivo02'])){
        $nome02 = $_FILES['arquivo02']['name'];
        $extensao = strtolower(substr($_FILES['arquivo02']['name'], -4)); //pega a extensao do arquivo
        $novo_nome =  md5(time()) .$extensao; //define o nome do arquivo
        $diretorio = "upload/"; //define o diretorio para onde enviaremos o arquivo
        $_UP['pasta'] = 'UP/';
        $nome_promocao = $_POST["nome02"];
                        $publico = $_POST["publico"];

        $descricao = $_POST["descricao02"];
        $situacao = $_POST["situacao"];
                if(move_uploaded_file($_FILES['arquivo02']['tmp_name'],$_UP['pasta'].$novo_nome)){
                  $sql = "UPDATE promocoes SET nome_promocao ='$nome_promocao' , descricao = '$descricao',imagem = '$novo_nome' , ativo = '$situacao',publico = '$publico' WHERE id_promocao=$id";
                  if ($conn->query($sql) === TRUE) {
               $mov=7;
$sql_log = "INSERT INTO log_informacoes(id_administrador,id_movimentacao,data) VALUES ('$id_administrador','$mov',NOW())";


            if ($conn->query($sql_log) === TRUE) {

                header("Location:promocoes.php");
              }
} else {
    echo "Error updating record: " . $conn->error;
}



}

else{

//SEm dar upload na foto


 $foto = $promocao["imagem"];


                   $sql = "UPDATE promocoes SET nome_promocao ='$nome_promocao' , descricao = '$descricao',imagem = '$foto' , ativo = '$situacao' , publico = '$publico' WHERE id_promocao=$id";
                  if ($conn->query($sql) === TRUE) {
               $mov=7;
$sql_log = "INSERT INTO log_informacoes(id_administrador,id_movimentacao,data) VALUES ('$id_administrador','$mov',NOW())";


            if ($conn->query($sql_log) === TRUE) {

                header("Location:promocoes.php");
              }
} else {
    echo "Error updating record: " . $conn->error;
}
}


      }
    }
  
else{
    header("Location:promocoes.php");
  }

  }
  
?>