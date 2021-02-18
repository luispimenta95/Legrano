<?php 
session_start();
include '../conecta.php';

$nome_cliente = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$endereco = $_POST["endereco"];
$cpf = $_POST["cpf"];
$nascimento = $_POST["nascimento"];

$id_cliente= $_SESSION["id_cliente"];

$sql_code = "UPDATE cliente SET cpf_cliente = $cpf, nome_cliente='$nome_cliente', endereco_cliente = '$endereco' , telefone_cliente = '$telefone',email_cliente = '$email',nascimento = '$nascimento' WHERE id_cliente=$id_cliente";

if ($conn->query($sql_code) === TRUE) {

 $_SESSION['msg'] = "<div class='alert alert-success'>Dados alterados com sucesso !</div>";
 $_SESSION['nome_cliente'] = $nome_cliente;
 header("Location:altera_usuario.php");


}



?>