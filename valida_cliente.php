<?php 
session_start();
include 'conecta.php';

$usuario = $_POST["username"];
$senha = $_POST["pass"];



$sql = "SELECT id_cliente, nome_cliente FROM cliente WHERE LPAD(cpf_cliente,11,'0') = '$usuario' and senha_cliente = '$senha'";    
$result=$conn->query($sql);
     $rowcount=mysqli_num_rows($result);

if ($rowcount >0) {
	$acesso = $result->fetch_assoc();
	$_SESSION['nome_cliente'] = $acesso["nome_cliente"];
	$_SESSION['id_cliente'] = $acesso["id_cliente"];

	$_SESSION["logado"] = true;
	$_SESSION["senha"] = $senha;

	header("Location:cliente/home.php");
}

else{
 $_SESSION['msg_login'] = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";
 									header("Location:login.php");

 } 



?>