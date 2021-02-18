<?php

session_start();
unset($_SESSION['id_administrador'], $_SESSION['nome_administrador'], $_SESSION['logado'], $_SESSION['senha']);

$_SESSION['msg'] = "<div class='alert alert-success'>Deslogado com sucesso!</div>";
header("Location: administrativo.php");