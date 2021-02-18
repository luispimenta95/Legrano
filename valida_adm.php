<?php 
session_start();
include 'conecta.php';

$usuario = $_POST["username"];
$senha = $_POST["pass"];



$sql = "SELECT nome_administrador,id_administrador FROM administrador WHERE LPAD(cpf_administrador,11,'0') = '$usuario' and senha_administrador = '$senha'";    
$result=$conn->query($sql);
     $rowcount=mysqli_num_rows($result);

if ($rowcount >0) {
	$acesso = $result->fetch_assoc();
	$_SESSION['nome_administrador'] = $acesso["nome_administrador"];
	$_SESSION['id_administrador'] = $acesso["id_administrador"];

	$_SESSION["logado"] = true;
	$_SESSION["senha"] = $senha;


	header("Location:admin/home.php");
}
else{
 $_SESSION['msg'] = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";

 header("Location:administrativo.php");
}



?>