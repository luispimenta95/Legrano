<?php
include '../conecta.php'; 



 $msg = false;

   $id_administrador = $_POST["id_adm"];
 $sql_admin = "SELECT senha_administrador from administrador where id_administrador = $id_administrador";
  $result = $conn->query($sql_admin);
  $senha_adm = $_POST["senha_promo"];
  $rowcount=mysqli_num_rows($result);
  if($rowcount >0){
    $administrador = $result->fetch_assoc();
    $senha_bd = $administrador["senha_administrador"];
      if($senha_adm == $senha_bd){
      if(isset($_FILES['arquivo'])){
        $nome = $_FILES['arquivo']['name'];
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); //pega a extensao do arquivo
        $novo_nome =  md5(time()) .$extensao; //define o nome do arquivo
        $diretorio = "upload/"; //define o diretorio para onde enviaremos o arquivo
        $_UP['pasta'] = 'UP/';


        $nome_promo = $_POST["nome_promo"];
                $publico = $_POST["publico"];

           $descricao = $_POST["descricao"];

 





      if(move_uploaded_file($_FILES['arquivo']['tmp_name'],$_UP['pasta'].$novo_nome)){
  
         $sql_code = "INSERT INTO promocoes (nome_promocao,imagem,data,id_administrador,descricao,publico) VALUES('$nome_promo','$novo_nome',NOW(), '$id_administrador','$descricao','$publico')";
       if ($conn->query($sql_code) === TRUE) {
        $mov=6;
$sql_log = "INSERT INTO log_informacoes(id_administrador,id_movimentacao,data) VALUES ('$id_administrador','$mov',NOW())";


            if ($conn->query($sql_log) === TRUE) {

                header("Location:promocoes.php");
              }




}
   
}
else {
    $foto = 'user.png';

         $sql_code = "INSERT INTO promocoes (nome_promocao,imagem,data) VALUES('$nome_promo','$foto',NOW())";
       if ($conn->query($sql_code) === TRUE) {
        $mov=6;
            $sql_log = "INSERT INTO log_informacoes(id_administrador,id_movimentacao,data) VALUES ('$id_administrador','$mov',now())";
            if ($conn->query($sql_log) === TRUE) {

                header("Location:promocoes.php");
              }
              



}
}


}
}
else{
                header("Location:promocoes.php");
  }

}

?>
