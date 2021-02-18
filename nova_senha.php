<?php 
session_start();
include 'conecta.php';
$email = $_POST["email"];
$cpf = $_POST["cpf"];
 
$sql = "SELECT * FROM cliente WHERE LPAD(cpf_cliente,11,'0') = '$cpf' and email_cliente = '$email'";    
$result=$conn->query($sql);
     $rowcount=mysqli_num_rows($result);

if ($rowcount >0) {

	$nova_senha = substr((md5(time())),0,6);
$sql_code = "UPDATE cliente set senha_cliente = '$nova_senha' WHERE LPAD(cpf_cliente,11,0) = '$cpf'";

	if ($conn->query($sql_code) === TRUE) {
	 
//Fazer configuração envio email

	 $_SESSION['msg_senha'] = "<div class='alert alert-success'>Senha alterada com sucesso , por favor verifique seu email !</div>";
 	header("Location:esqueceu.php");

 			}

	}
	else{
		 $_SESSION['msg_senha'] = "<div class='alert alert-danger'>Não encontramos os dados no sistema!</div>";
 									header("Location:esqueceu.php");

	}

  



?>