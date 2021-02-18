<?php 
session_start();
if (!isset($_SESSION["logado"])) {
  header("Location:../index.php");
  session_destroy();
}
include '../conecta.php';
include '../funcoes.php';

mysqli_set_charset( $conn, 'utf8');
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
  $pagina_atual = "clientes.php";
//Selecionar todos os logs da tabela
$result_log = "SELECT * from cliente";
$resultado_log = mysqli_query($conn, $result_log);

//Contar o total de logs
$total_logs = mysqli_num_rows($resultado_log);

//Seta a quantidade de logs por pagina
$quantidade_pg = 5;

//calcular o número de pagina necessárias para apresentar os logs
$num_pagina = ceil($total_logs/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os logs a serem apresentado na página
if(!isset($_POST['termo'])){
$result_logs = "SELECT id_cliente,entrada,nascimento, nome_cliente,endereco_cliente,ativo,telefone_cliente, saldo_cliente,cpf_cliente,email_cliente,senha_cliente FROM cliente c order by ativo desc,nome_cliente limit $incio, $quantidade_pg ";

}
else{
  $pesquisa = $_POST["termo"];

  $result_logs = "SELECT id_cliente,entrada,nascimento, nome_cliente,endereco_cliente,ativo,telefone_cliente, saldo_cliente,cpf_cliente,email_cliente,senha_cliente FROM cliente c WHERE c.nome_cliente LIKE '%".$pesquisa."%'  order by ativo desc,nome_cliente limit $incio, $quantidade_pg ";


}

$resultado_logs = mysqli_query($conn, $result_logs);
$total_logs = mysqli_num_rows($resultado_logs);
?>
<!doctype html>
<html lang="pt-BR">

<html class="fixed">
  <head>

    <!-- Basic -->
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
<title>Legrano | Área administrativa</title>
    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Legrano Orgânicos - Responsive HTML5 Template">
    <meta name="author" content="JSOFT.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="shortcut icon" href="assets/images/logo2.jpg" type="image/x-icon" />
<link rel="shouticon"  >
    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
    <link rel="stylesheet" href="assets/vendor/morris/morris.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/stylesheets/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

    <!-- Head Libs -->
    <script src="assets/vendor/modernizr/modernizr.js"></script>

  </head>
  <body>
    <section class="body">

      <!-- start: header -->
       <header class="header">
<div class="logo-container">
<a href="../" class="logo">
<img src="assets/images/logo2.jpg" height="35" alt="Legrano Orgânicos">
</a>
<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
</div>
</div>

<div class="header-right">

<div id="userbox" class="userbox">
<a href="#" data-toggle="dropdown">
<figure class="profile-picture">
<img src="assets/images/user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg">
</figure>
<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com"><span class="name">
  <?php echo $_SESSION["nome_administrador"] ?></span>
<span class="role">Legrano | Administrativo</span>
</div>
<i class="fa custom-caret"></i>
</a>
<div class="dropdown-menu">
<ul class="list-unstyled">
<li class="divider"></li>
<li>
<a role="menuitem" tabindex="-1" href="logout_adm.php"><i class="fa fa-power-off"></i> Logout</a>
</li>
</ul>
</div>
</div>
</div>
</div>

</header>
      <!-- end: header -->

      <div class="inner-wrapper">
        <!-- start: sidebar -->


        <aside id="sidebar-left" class="sidebar-left">
        
          <div class="sidebar-header ">
          
           
          </div>
        
           <div class="nano">
            <!-- Menu Lateral -->   

            <ul class="list-group">
<a href="home.php"> <li class="list-group-item">Home</li></a>
  <a href="clientes.php"> <li class="<?php if($pagina_atual="clientes.php"){echo "list-group-item active";}else{echo "list-group-item";} ?>">Sócios </li></a>
<a href="dependentes.php"> <li class="list-group-item">Dependentes </li></a>
  <a href="movimentacoes.php"> <li class="list-group-item">Registros financeiros </li></a>
    <a href="log.php"> <li class="list-group-item">Registros de cadastro</li></a>

    <a href="mensagens.php"> <li class="list-group-item">Mensagens</li></a>
    <a href="promocoes.php"> <li class="list-group-item">Promoções</li></a>

  </ul>
  <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
Filtar clientes por nome

        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
                <form method="POST" action="clientes.php" class="search nav-form">
<div class="input-group input-search">
<input type="text" class="form-control" name="termo" id="q" placeholder="Pesquisa por nome...">
<span class="input-group-btn">
<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
</span>
</div>
</form>
      </div>
    </div>
  </div>
 

</div>

          </div>
        </aside>
        <!-- end: sidebar -->

        <section role="main" class="content-body">
          <header class="page-header">
           
          </header>

            <div class="row">
            <div class="col-md-12">
             
             <?php 



             if($total_logs ==0){
              $result_logs = "SELECT id_cliente,entrada,nascimento, nome_cliente,endereco_cliente,ativo,telefone_cliente, saldo_cliente,cpf_cliente,email_cliente,senha_cliente FROM cliente c order by ativo desc,nome_cliente limit $incio, $quantidade_pg ";

$resultado_logs = mysqli_query($conn, $result_logs);
$total_logs = mysqli_num_rows($resultado_logs);

  $msg_pesquisa = "<div class='alert alert-warning'>Nenhum cliente encontrado no sistema ! </div>";
  }
?>
              <div class="table-responsive">          
  <table class="table table-bordered">
    <thead>
      <tr>
        
   <th>Cliente </th>
    <th> Endereço </th>
    <th> Telefone </th>
        <th>Situação</th>
        <th>Data de aniversário</th>
<th>Data de associação</th>
    <th> Saldo </th>
    <th>Atualizar saldo</th>
    <th>Atualizar dados</th>
    <th>Dependentes</th>


        </tr>
    </thead>
    <tbody>
             <?php 


             while($row = mysqli_fetch_assoc($resultado_logs)){ ?>


      <tr>

  <th> <?php echo $row["nome_cliente"] ?> </th>
<th> <?php echo $row["endereco_cliente"] ?> </th>
<th> <?php echo mask($row["telefone_cliente"],'(##) ##### - #####');?> </th>
<?php 

if(($row["ativo"]) ==1){
 ?>

<th> Ativo </th>

<?php }

else{


  ?>
<th> Inativo </th>


<?php }




?>
<th> <?php echo date('d/m/Y', strtotime($row["nascimento"])); ?> </th>
<th> <?php echo date('d/m/Y', strtotime($row["entrada"])); ?> </th>


<th> R$ <?php 
$saldo = number_format($row["saldo_cliente"], 2, ',', '');

echo $saldo; ?> </th>

<th>
  
        <a href="#deposito<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-usd' aria-hidden='true'></span></button></a>
       
 <a href="#saque<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-usd' aria-hidden='true'></span></button></a>

                 <a href="#ultimas<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-dark btn-sm'><span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span></button></a>

       

</th>
  
  <th>     
           
       <a href="#edicao<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></a>


          </th>


             <th>
                 <a href="#listar<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></button></a>

                 <a href="#cadDep<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button></a>


          </th>
              <!-- ================================== lista de dependentes ========================== -->


  <form  method="POST" class="form-group">
       
        <div id="listar<?php echo $row["id_cliente"] ?>" class="modal fade" role="dialog" class="form-group">
          <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lista de compradores</h4>
      </div>
      <div class="modal-body">

  

        <div class="col-md-12">


  


    
  <?php 

$id_dep = $row["id_cliente"];
$sql_nova = "SELECT nome_comprador,id_comprador from comprador co inner join cliente cl on co.id_cliente = cl.id_cliente where cl.id_cliente=$id_dep order by co.nome_comprador ";
$resultado = $conn->query($sql_nova);
while($linha = $resultado->fetch_assoc()){?>
    <input  name="nome" type="text" class="form-control" id="inputAddress"value="<?php echo $linha["nome_comprador"] ?>"readonly>

<hr>

<?php }?>

  
</div>


      </div>
      <div class="modal-footer">
          
        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Voltar</button>
      </div>
    </div>

  </div>
                        </div>
          
</form>
 <!-- ================================== lista de movimentações recentes ========================== -->



       
        <div id="ultimas<?php echo $row["id_cliente"] ?>" class="modal fade" role="dialog" class="form-group">
          <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lista de operações recentes</h4>
      </div>
       <div class="modal-body">

  

        <div class="col-md-12">


  


    
  <?php 

$id_dep = $row["id_cliente"];
$sql_nova = "SELECT id_log,nome_administrador ,nome_cliente, nome_comprador,nome_movimentacao,credito,debito,bonus,data,nome_forma FROM log_financeiro l INNER JOIN cliente cl on cl.id_cliente = l.id_cliente inner JOIN administrador a on a.id_administrador=l.id_administrador inner JOIN comprador co on co.id_comprador = l.id_comprador INNER JOIN tipo_movimentacao m on m.id_movimentacao = l.id_movimentacao inner join forma_pagamento f on f.id_forma= l.id_forma where l.id_movimentacao > 7 and cl.id_cliente=$id_dep order by l.id_log desc limit 1";
$resultado = $conn->query($sql_nova);
while($linha = $resultado->fetch_assoc()){?>
    
<form>   


 <div class="row">
      <h3> Operação numero <?php echo $linha["id_log"] ?> </h3> 
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Nome operador : <?php echo $linha["nome_administrador"] ?></a>


        <a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Sócio titular : <?php echo $linha["nome_cliente"] ?></a>
<a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Feito por : <?php echo $linha["nome_comprador"] ?></a>

<a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Tipo de operação : <?php echo $linha["nome_movimentacao"] ?></a>
<a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Crédito : <?php echo $linha["credito"] ?></a>
<a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Bônus : <?php echo $linha["bonus"] ?></a>     

      <a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Débito : <?php echo $linha["debito"] ?></a>
      <a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Forma de pagamento : <?php echo $linha["nome_forma"] ?></a>
      <a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Data : <?php echo date('d/m/Y H:i', strtotime($linha["data"])); ?></a>

    </div>
  </div>


</div>



<?php }?>

  
</div>


      </div>
      <div class="modal-footer">
   <a href="relatorio_individual.php?id_cliente=<?php echo $row["id_cliente"] ?>"><button type='button' class='btn btn-dark'>Ver todas as movimentações</button></a>          

      <a href="relatorio_impressao.php?id_cliente=<?php echo $row["id_cliente"] ?>"><button type='button' class='btn btn-success'>Imprimir relatório de consumo</button></a>          

        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Voltar</button>
      </div>
    </div>

  </div>
                        </div>
          
</form>
       <!-- ================================== Deposito ========================== -->

      
  <form action="deposito.php?id=<?php echo $row["id_cliente"]; ?>" method="POST" class="form-group">
       
        <div id="deposito<?php echo $row["id_cliente"] ?>" class="modal fade" role="dialog" class="form-group">
          <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <?php
          if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
          }
        ?>
        <h4 class="modal-title">Atualizar saldo</h4>
      </div>
      <div class="modal-body">

      <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nome" value="<?php echo $row["nome_cliente"] ?>"readonly >
    </div>
  </div>

                    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Valor depósito</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="valor" required>
    </div>
  </div>

                   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Porcentagem de bonus</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="bonus" required>
    </div>
  </div>
        <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">

                    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Quem depositou</label>
    <div class="col-sm-10">
      <select name="autor" required>
   <option >Selecione</option>
        <?php 
        $idselect=$row["id_cliente"];
        $sql2 = "SELECT * from comprador c where c.id_cliente =$idselect ";
$result2 = $conn->query($sql2);

while($socio2 = $result2->fetch_assoc()) { 

        ?>
    <option value="<?php echo $socio2["id_comprador"]; ?>"><?php echo $socio2["nome_comprador"];?></option>
                            <?php
                        }
                    ?>
</select>
    </div>
  </div>


                   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Forma de pagamento</label>
    <div class="col-sm-10">
      <select name="forma" required>
   <option >Selecione</option>
        <?php 
    //    $idselect=$row["id_cliente"];
        $sql2 = "SELECT * from forma_pagamento limit 3 ";
$result2 = $conn->query($sql2);

while($socio2 = $result2->fetch_assoc()) { 

        ?>
    <option value="<?php echo $socio2["id_forma"]; ?>"><?php echo $socio2["nome_forma"];?></option>
                            <?php
                        }
                    ?>
</select>
    </div>
  </div>

                    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Senha Administrativa</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="senha_dep"required >
    </div>
  </div>




      </div>
      <div class="modal-footer">
                     <button type="submit" class=" btn btn-primary">Realizar depósito</button>

        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
                        </div>
          
</form>
       
  
<!-- ================================== CADASTRO DE SÓCIOS ========================== -->

      
  <form action="cadastro.php" method="POST" class="form-group">
       
        <div id="cadastro" class="modal fade" role="dialog" class="form-group">
          <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <?php
          if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
          }
        ?>
        <h4 class="modal-title">Cadastro de sócio</h4>
      </div>
      <div class="modal-body">

      <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nome" required>
    </div>
  </div>

      <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">CPF</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="cpf" required>
          <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir somente números, sem espaços,pontos ou caracteres especiais.
        </small>

    </div>
  </div>

<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Endereço</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="endereco"required>
    </div>
  </div>

<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Telefone</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="telefone"required>
          <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir somente números, sem espaços,pontos ou caracteres especiais.
        </small>
    </div>
  </div>

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Data de aniversário</label>
    <div class="col-sm-10">
     <input type="date" name="aniversario" min="1900-01-01"max="2023-12-31" class="form-control"required>
      <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir conforme o padrão : 25/12/2019.
        </small>
    </div>
  </div>


<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email"required>
       <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir um e-mail válido.
        </small>
    </div>


  </div>




  
    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Senha Administrativa</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="senha_add" required>
    </div>
  </div>
        <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">




      </div>
      <div class="modal-footer">
                     <button type="submit" class=" btn btn-primary">Realizar cadastro</button>

        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
                        </div>
          
</form>
       

<!-- ================================== Edição ========================== -->

      
  <form action="update.php?id=<?php echo $row["id_cliente"]; ?>" method="POST" class="form-group">
       
        <div id="edicao<?php echo $row["id_cliente"] ?>" class="modal fade" role="dialog" class="form-group">
          <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <?php
          if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']

          );
          }
        ?>
        <h4 class="modal-title">Atualizar sócio</h4>
      </div>
      <div class="modal-body">

      <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nome02" value="<?php echo $row["nome_cliente"] ?>"required>
    </div>
  </div>


  

      <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">CPF</label>
    <div class="col-sm-10">
      <?php 
      if(strlen($row["cpf_cliente"]) <11 ){
        $cpf = "0".$row["cpf_cliente"];



        ?>
              <input type="number" class="form-control" name="cpf02" value="<?php echo$cpf?>"required>
                    <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir somente números, sem espaços,pontos ou caracteres especiais.
        </small>


      <?php }

      else {
                $cpf =$row["cpf_cliente"];
                ?>


              <input type="number" class="form-control" name="cpf02" value="<?php echo$cpf?>"required>
                    <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir somente números, sem espaços,pontos ou caracteres especiais.
        </small>


     <?php  } 


      ?>
   

    </div>
  </div>


<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Endereço</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="endereco02" value="<?php echo $row["endereco_cliente"] ?>"required>
    </div>
  </div>

<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Telefone</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="telefone02" value="<?php echo $row["telefone_cliente"]?>"required>
            <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir somente números, sem espaços,pontos ou caracteres especiais.
        </small>
    </div>
  </div>

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Data de aniversário</label>
    <div class="col-sm-10">
     <input type="date" name="aniversario02" min="1900-01-01"max="2023-12-31" class="form-control"value="<?php echo $row["nascimento"] ?>"required>
           <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserirconforme o padrão : 25/12/2019.
        </small>

    </div>
  </div>


<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email02" value="<?php echo $row["email_cliente"] ?>"required>
            <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir um e-mail válido.
        </small>
    </div>


  </div>

<div class="form-group row" required>
    <label for="inputEmail3" class="col-sm-2 col-form-label">Situação do sócio</label>
    <div class="col-sm-10">
           <label class="radio-inline"> 
            <input type="radio" name="situacao" value="1"required><span class="label label-success">Ativo</span> 
          </label> 
            
          
          <label class="radio-inline"> 
            <input type="radio" name="situacao" value="0" required><span class="label label-danger">Inativo</span> 
          </label> 
    </div>


  </div>

<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Senha</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="senha02" value="<?php echo $row["senha_cliente"] ?>"required>
    </div>


  </div>
    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Senha Administrativa</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="senha_up" required>
    </div>
  </div>
        <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">




      </div>
      <div class="modal-footer">
                     <button type="submit" class=" btn btn-primary">Realizar alterações</button>

        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
                        </div>
          
</form>
       
  

  <!-- ================================== Saque ========================== -->

      
  <form action="saque.php?id=<?php echo $row["id_cliente"]; ?>" method="POST" class="form-group">
       
        <div id="saque<?php echo $row["id_cliente"] ?>" class="modal fade" role="dialog" class="form-group">
          <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
 <?php
          if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
          }
        ?>
        <h4 class="modal-title">Atualizar saldo</h4>
      </div>
      <div class="modal-body">

      <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nome" value="<?php echo $row["nome_cliente"] ?>"readonly >
    </div>
  </div>

                    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-3 col-form-label">Valor da ultima compra</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="valor" required>
    </div>
  </div>

        
        <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">

                    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Quem comprou</label>
    <div class="col-sm-10">
      <select name="autor" required>
   <option >Selecione</option>
        <?php 
        $idselect=$row["id_cliente"];
        $sql2 = "SELECT * from comprador c where c.id_cliente =$idselect ";
$result2 = $conn->query($sql2);

while($socio2 = $result2->fetch_assoc()) { 

        ?>
    <option value="<?php echo $socio2["id_comprador"]; ?>"><?php echo $socio2["nome_comprador"];?></option>
                            <?php
                        }
                    ?>
</select>
    </div>
  </div>


                   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Forma de pagamento</label>
    <div class="col-sm-10">
      <select name="forma" required>
   <option >Selecione</option>
        <?php 
    //    $idselect=$row["id_cliente"];
        $sql2 = "SELECT * from forma_pagamento ";
$result2 = $conn->query($sql2);

while($socio2 = $result2->fetch_assoc()) { 

        ?>
    <option value="<?php echo $socio2["id_forma"]; ?>"><?php echo $socio2["nome_forma"];?></option>
                            <?php
                        }
                    ?>
</select>
    </div>
  </div>

                    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Senha Administrativa</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="senha_deb" required>
    </div>
  </div>




      </div>
      <div class="modal-footer">
                     <button type="submit" class=" btn btn-primary">Realizar venda</button>

        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
                        </div>
          
</form>

  <!-- ================================== Cadastro de dependente ========================== -->

      
  <form action="cadastro_dep.php?id=<?php echo $row["id_cliente"]; ?>" method="POST" class="form-group">
       
        <div id="cadDep<?php echo $row["id_cliente"] ?>" class="modal fade" role="dialog" class="form-group">
          <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
 <?php
          if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
          }
        ?>
        <h4 class="modal-title">Cadastrar dependentes</h4>
      </div>
      <div class="modal-body">

      <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nome" value="<?php echo $row["nome_cliente"] ?>"readonly >
    </div>
  </div>

                    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-3 col-form-label">Nome da pessoa autorizada</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="nome_comprador" required>
    </div>
  </div>

        
        <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">

            
                    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Senha Administrativa</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="senha_depen" required>
    </div>
  </div>




      </div>
      <div class="modal-footer">
                     <button type="submit" class=" btn btn-primary">Cadastrar dependente</button>

        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
                        </div>
          
</form>
       



        <?php } ?>
        </tr>
          
    </tbody>
  </table>
  <?php
          if(isset($msg_pesquisa)){
            echo $msg_pesquisa;
            unset($msg_pesquisa);
          }
        ?>
<?php
$result_log = "SELECT * from cliente";

$resultado_log = mysqli_query($conn, $result_log);

//Contar o total de logs
$total_logs = mysqli_num_rows($resultado_log);
$limitador =1;
if($total_logs > $quantidade_pg){?>
            <nav class="text-center">
               <ul class="pagination">

              <li><a href="clientes.php?pagina=1"> Primeira página </a></li>


                 <?php
                for($i = $pagina - $limitador; $i <= $pagina-1; $i++){
                  if($i>=1){
                    ?>
                        <li><a href="clientes.php?pagina=<?php echo $i; ?>"> <?php echo $i;?></a></li>


                  <?php }
                }
              ?>
                <li class="active">  <span><?php echo $pagina; ?></span></li>

                  <?php
                      for ($i = $pagina+1; $i <= $pagina+$limitador; $i++){
                        if($i<=$num_pagina){?>
                              <li><a href="clientes.php?pagina=<?php echo $i; ?>"> <?php echo $i;?></a></li>

                  <?php }
                      } 
                        
                      

                   ?>
              <li><a href="clientes.php?pagina=<?php echo $num_pagina; ?>"> <span aria-hidden="true"> Ultima página </span></a></li>



<?php } ?>
</ul>
</nav>
      		        <a href="#cadastro" data-toggle="modal"><button type='button' class='btn btn-success'>Cadastrar sócio</button></a>


    <a href = "relatorio_clientes.php"><button type="button" class="btn btn-dark">Gerar relatório </button>
  

  </div>

              

            </div>
            
          
          <!-- start: page -->
          
         
                

  </div>

    </div>
        
                
              </section>
            </div>
          </div>
          <!-- end: page -->
        </section>
      </div>

     
    </section>

    <!-- Vendor -->
    <script src="assets/vendor/jquery/jquery.js"></script>
    <script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
    
    <!-- Specific Page Vendor -->
    <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
    <script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
    <script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    <script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
    <script src="assets/vendor/flot/jquery.flot.js"></script>
    <script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
    <script src="assets/vendor/flot/jquery.flot.pie.js"></script>
    <script src="assets/vendor/flot/jquery.flot.categories.js"></script>
    <script src="assets/vendor/flot/jquery.flot.resize.js"></script>
    <script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
    <script src="assets/vendor/raphael/raphael.js"></script>
    <script src="assets/vendor/morris/morris.js"></script>
    <script src="assets/vendor/gauge/gauge.js"></script>
    <script src="assets/vendor/snap-svg/snap.svg.js"></script>
    <script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
    <script src="assets/vendor/jqvmap/jquery.vmap.js"></script>
    <script src="assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
    <script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
    <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
    <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
    <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
    <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
    <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
    
    <!-- Theme Base, Components and Settings -->
    <script src="assets/javascripts/theme.js"></script>
    
    <!-- Theme Custom -->
    <script src="assets/javascripts/theme.custom.js"></script>
    
    <!-- Theme Initialization Files -->
    <script src="assets/javascripts/theme.init.js"></script>


    <!-- Examples -->
    <script src="assets/javascripts/dashboard/examples.dashboard.js"></script>
  </body>
</html>