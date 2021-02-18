<?php 
session_start();
include 'conecta.php';

if($_SESSION['captcha'] == $_POST['captcha']){
	$nome = $_POST["nomeM"];
$email = $_POST["emailM"];
$telefone = $_POST["telefoneM"];
$mensagem = $_POST["mensagem01"];
$sql_code = "INSERT INTO mensagem (remetente, email,telefone,mensagem,data_mensagem) VALUES ('$nome','$email','$telefone','$mensagem',NOW()) ";
if ($conn->query($sql_code) === TRUE) {
	
	$_SESSION['msg_envio'] = "<h3 style='color:green;'>Mensagem enviada, responderemos em breve ! <h3>";
	header("Location: index.php");
}


}else{
	$_SESSION['msg_envio'] = "<h3 style='color:red;'>Por favor tente novamente.<h3>";
	header("Location: index.php");
}
?>
