<?php
session_start();
	include 'conecta.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Legrano - Login</title>
		<link href="admin/css/bootstrap.css" rel="stylesheet">
		<link href="admin/css/signin.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="form-signin" style="background: #42dea4;">
				<h2 class="text-center">Área de sócios</h2>
				<?php
					if(isset($_SESSION['msg_login'])){
						echo $_SESSION['msg_login'];
						unset($_SESSION['msg_login']);
					}
					if(isset($_SESSION['msgcad'])){
						echo $_SESSION['msgcad'];
						unset($_SESSION['msgcad']);
					}
				?>
				<form method="POST" action="valida_cliente.php">
					<!--<label>Usuário</label>-->
					<input type="number" name="username" placeholder="Digite o seu CPF" class="form-control"><br>
					
					<!--<label>Senha</label>-->
					<input type="password" name="pass" placeholder="Digite a sua senha" class="form-control"><br>
					
					<input type="submit" name="btnLogin" value="Acessar" class="btn btn-success btn-block">

										<a href="esqueceu.php">Esqueceu sua senha ?</a>

					
					
					
					
				</form>
			</div>
		</div>			
		<script src="admin/js/bootstrap.min.js"></script>
		<script src="admin/js/google.js"></script>
	</body>
</html>