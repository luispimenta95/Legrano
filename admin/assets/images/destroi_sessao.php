<?php
	session_start();
	unset($_SESSION['ultimo_id_usuario']);
	unset($_SESSION['nome']);
	unset($_SESSION['cpf']);
	unset($_SESSION['control_aba']);
	header("Location: index.php");
?>