<?php 
session_start();
if (!isset($_SESSION["logado"])) {
  header("Location:../index.php");
  session_destroy();
}
include '../conecta.php';
$id_cliente= $_SESSION["id_cliente"];


mysqli_set_charset( $conn, 'utf8');

 $buscar = "SELECT * FROM cliente WHERE id_cliente = $id_cliente";
$result = $conn->query($buscar);


$cliente = $result->fetch_assoc();
$senha_cliente = $_POST["senha"];
$senhaBD= $cliente["senha_cliente"];
$senha1 = $_POST["senha1"];
$senha2 = $_POST["senha2"];

if($senha_cliente==$senhaBD){
    if($senha1 == $senha2){


      $sql_code = "UPDATE cliente SET senha_cliente = $senha1 WHERE id_cliente=$id_cliente";

if ($conn->query($sql_code) === TRUE) {
        $_SESSION['msg'] = "<div class='alert alert-success'>Senha alterada com sucesso !</div>";
          $_SESSION["senha"] = $senha1;

        header("Location:altera_usuario.php");
            }
          }
      else{
            $_SESSION['msg'] = "<div class='alert alert-danger'> As senhas digitadas não conferem,por favor tente novamente ! </div>";
             header("Location:altera_usuario.php");
            }


}

else{
$_SESSION['msg'] = "<div class='alert alert-danger'> Erro ao atualizar senha, por favor entre em contato com nossa loja ! </div>";
 header("Location:altera_usuario.php");
}
