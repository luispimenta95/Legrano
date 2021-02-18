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
				<h2 class="text-center">Recupere sua senha</h2>
				<?php
					if(isset($_SESSION['msg_senha'])){
						echo $_SESSION['msg_senha'];
						unset($_SESSION['msg_senha']);
					}
				
				?>
				<form method="POST" action="nova_senha.php">
					<!--<label>Usuário</label>-->
					<input type="number" name="cpf" placeholder="Digite o seu CPF" class="form-control" required><br>
					
					<!--<label>Senha</label>-->
					<input type="email" name="email" placeholder="Digite o email do seu cadastro" class="form-control" required><br>
					
					<input type="submit" name="btnLogin" value="Enviar " class="btn btn-success btn-block">

										<a href="login.php">Lembrou sua senha ?</a>

					
					
					
					
				</form>
			</div>
		</div>			
		<script src="admin/js/bootstrap.min.js"></script>
		<script src="admin/js/google.js"></script>
	</body>
</html>