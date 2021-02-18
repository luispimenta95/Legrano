<!--**
 * @author Cesar Szpak - Celke -   cesar@celke.com.br
 * @pagina desenvolvida usando framework bootstrap,
 * o código é aberto e o uso é free,
 * porém lembre -se de conceder os créditos ao desenvolvedor.
 *-->
<?php 
	include_once("conexao.php");
	session_start();
	/* Controlar abas*/
	if(!isset($_SESSION['control_aba'])){
		$_SESSION['control_aba'] = 0;
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Criar pagina com abas</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		
		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<h1>Cadastrar Usuário</h1>
			</div>		
			<div class="row espaco">
				<div class="pull-right">
					<a href="destroi_sessao.php"><button type='button' class='btn btn-sm btn-success'>Novo Usuário</button></a>
				</div>
			</div>
			
			<?php
				if($_SERVER['REQUEST_METHOD']=='POST'){
					$request = md5(implode($_POST));
					if(isset($_SESSION['ultima_request']) && $_SESSION['ultima_request'] == $request){?>
						<div class="alert alert-danger" role="alert">Usuário já inserido!</div>
					<?php }elseif(!isset($_SESSION['ultimo_id_usuario'])){	
						$_SESSION['ultima_request'] = $request;
						$nome = $_POST['nome'];
						$cpf = $_POST['cpf'];
						$_SESSION['nome'] = $nome;
						$_SESSION['cpf'] = $cpf;						
						$result_dados_pessoais = "INSERT INTO usuarios (nome, cpf) VALUES ('$nome', '$cpf')";
						$resultado_dados_pessoais= mysqli_query($conn, $result_dados_pessoais);
						//ID do usuario inserido
						$ultimo_id_usuario = mysqli_insert_id($conn);
						$_SESSION['ultimo_id_usuario'] = $ultimo_id_usuario; ?>							
						<div class="alert alert-success" role="alert">Usuário inserido com sucesso</div>
						<?php $_SESSION['control_aba'] = 1;
					}
					if(isset($_POST['usuario'])){
						$id_usuario_editar = $_SESSION['ultimo_id_usuario'];
						$usuario = $_POST['usuario'];
						$senha = md5($_POST['senha']);						
						$result_ususario_acesso = "UPDATE usuarios SET usuario = '$usuario', senha = '$senha' WHERE id = $id_usuario_editar";
						$resultado_usuario_acesso = mysqli_query($conn, $result_ususario_acesso);?>							
						<div class="alert alert-success" role="alert">Dados de acesso inserido com sucesso</div>
						<?php $_SESSION['control_aba'] = 2;
					}
					if(isset($_POST['endereco'])){
						$id_usuario_editar = $_SESSION['ultimo_id_usuario'];
						$endereco = $_POST['endereco'];
						$numero = $_POST['numero'];
						$result_endereco = "INSERT INTO endereco (endereco, numero, usuario_id ) VALUES ('$endereco', '$numero', '$id_usuario_editar')";
						$resultado_endereco = mysqli_query($conn, $result_endereco);?>							
						<div class="alert alert-success" role="alert">Endereço inserido com sucesso</div>
						<?php $_SESSION['control_aba'] = 3;
					}
				}
			?>
			<div>

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" <?php if($_SESSION['control_aba'] == 0){ echo "class='active'"; } ?> >
					<a href="#dados_pessoais" aria-controls="home" role="tab" data-toggle="tab">Dados Pessoais</a>
				</li>
				
				<li role="presentation" <?php if($_SESSION['control_aba'] == 1){ echo "class='active'"; } ?> >
					<?php if(isset($_SESSION['ultimo_id_usuario'])){
						?><a href="#dados_de_acesso" aria-controls="dados_de_acesso" role="tab" data-toggle="tab"><?php
					}else{
						?><a href="#" aria-controls="dados_de_acesso" role="tab" data-toggle="tab"><?php
					}?>					
						Dados de Acesso
					</a>
				</li>
				<li role="presentation" <?php if($_SESSION['control_aba'] == 2){ echo "class='active'"; } ?> ><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a></li> <?php
				 if($_SESSION['control_aba'] == 3){ ?>
					<li role="presentation" class='active'>
						<a href="#sucesso" aria-controls="home" role="tab" data-toggle="tab">Finalizado</a>
					</li>
				 <?php } ?>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
				<div role="tabpanel" 
					<?php if($_SESSION['control_aba'] == 0){ 
						echo "class='tab-pane active'"; 
						}else{ 
							echo "class='tab-pane'"; 
						} ?> class="" id="dados_pessoais">
					<div style="padding-top:20px;">
						<form class="form-horizontal" action="" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" name='nome' class="form-control" id="nome" placeholder="Nome Completo" value="<?php if(isset($_SESSION['nome'])){ echo $_SESSION['nome']; }?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">CPF</label>
                                <div class="col-sm-10">
                                    <input type="text" name='cpf' class="form-control" id="cpf" placeholder="CPF" value="<?php if(isset($_SESSION['cpf'])){ echo $_SESSION['cpf']; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
				<div role="tabpanel"  
					<?php if($_SESSION['control_aba'] == 1){ 
						echo "class='tab-pane active'"; 
						}else{ 
							echo "class='tab-pane'"; 
						} ?>  id="dados_de_acesso">
					<div style="padding-top:20px;">
					 <form class="form-horizontal"  action="" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Usuário</label>
                                <div class="col-sm-10">
                                    <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuário">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Senha</label>
                                <div class="col-sm-10">
                                    <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
				<div role="tabpanel"  
					<?php if($_SESSION['control_aba'] == 2){ 
						echo "class='tab-pane active'"; 
						}else{ 
							echo "class='tab-pane'"; 
						} ?> id="messages">
					<div style="padding-top:20px;">
					 <form class="form-horizontal"  action="" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Logradouro</label>
                                <div class="col-sm-10">
                                    <input type="text" name="endereco" class="form-control" id="endereco" placeholder="Endereço">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Número</label>
                                <div class="col-sm-10">
                                    <input type="text" name="numero" class="form-control" id="numero" placeholder="Número">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
				
				<?php
					/*Apresenta a aba somente após inserir o endereço*/
					if($_SESSION['control_aba'] == 3){ ?>
						<div role="tabpanel" class='tab-pane active' id="sucesso">
							<div style="padding-top:20px;">
								<div class="alert alert-info" role="alert">Dados do usuário inserido com sucesso! Deseja inserir novo usuário? <a href="destroi_sessao.php">CLIQUE AQUI</a></div>
							</div>
						</div>
					<?php }
				?>
			  </div>

			</div>
		</div>
		
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>