<?php 
session_start();
if (!isset($_SESSION["logado"])) {
  header("Location:../index.php");
  session_destroy();
}
include '../conecta.php';

mysqli_set_charset( $conn, 'utf8');
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

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
$result_logs = "SELECT id_cliente,entrada,nascimento,nome_cliente,endereco_cliente,telefone_cliente,saldo_cliente,cpf_cliente,email_cliente,senha_cliente FROM cliente a  order by nome_cliente limit $incio, $quantidade_pg ";
$resultado_logs = mysqli_query($conn, $result_logs);
$total_logs = mysqli_num_rows($resultado_logs);
?>

<!doctype html>
<html class="fixed">
  <head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>Dashboard | JSOFT Themes | JSOFT-Admin</title>
    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
    <meta name="author" content="JSOFT.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="shortcut icon" href="assets/images/argus.jpg" type="image/x-icon" />
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
       
      
        <!-- start: search & user box -->
        <div class="header-right">
      
     
      
       
      
              
      
      
          <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
              <figure class="profile-picture">
                <img src="assets/images/argus.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
              </figure>
              <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                <span class="name">CrossFit Argus</span>
                <span class="role">Administração | <?php  echo $_SESSION["nome_administrador"]?></span>
              </div>
      
              <i class="fa fa-user"></i>
            </a>
      
            <div class="dropdown-menu">
              <ul class="list-unstyled">
                <li class="divider"></li>
               <li>
                  <a role="menuitem" tabindex="-1" href="../logout_cliente.php"><i class="fa fa-power-off"></i> Encerrar o sistema</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end: search & user box -->
      </header>
      <!-- end: header -->

      <div class="inner-wrapper">
        <!-- start: sidebar -->
        <aside id="sidebar-left" class="sidebar-left">
        
          <div class="sidebar-header">
           
           
          </div>
        
          <div class="nano">
           
          </div>
        
        </aside>
        <!-- end: sidebar -->

        <section role="main" class="content-body">
          <header class="page-header">
           
          </header>

            <div class="row">
            <div class="col-md-12">
            
              

            </div>
            
          
          <!-- start: page -->
          
         
                

                                   <table  class="table ">
<tr>
    
    
   <td>Cliente </td>
    <td> Endereço </td>
    <td> Telefone </td>
    <td> Saldo </td>
    <td>Atualizar saldo</td>
    <td>Atualizar dados</td>
    <td>Dependentes</td>

</tr>

        <?php while($row = mysqli_fetch_assoc($resultado_logs)){ ?>
  
           <tr>
  
  <td> <?php echo $row["nome_cliente"] ?> </td>
<td> <?php echo $row["endereco_cliente"] ?> </td>
<td> <?php echo $row["telefone_cliente"] ?> </td>
<td> R$ <?php echo $row["saldo_cliente"] ?> </td>

<td>
  
        <a href="#deposito<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-usd' aria-hidden='true'></span></button></a>
       
 <a href="#saque<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-usd' aria-hidden='true'></span></button></a>

                 <a href="#ultimas<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-dark btn-sm'><span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span></button></a>

       

</td>
  
  <td>     
           
       <a href="#edicao<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></a>


          </td>


             <td>
                 <a href="#listar<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></button></a>

                 <a href="#cadDep<?php echo $row["id_cliente"] ?>" data-toggle="modal"><button type='button' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button></a>


          </td>
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
$sql_nova = "SELECT nome_administrador,id_log ,nome_cliente, nome_comprador,nome_movimentacao,credito,debito,bonus,data FROM log_informacoes l INNER JOIN cliente cl on cl.id_cliente = l.id_cliente inner JOIN administrador a on a.id_administrador=l.id_administrador inner JOIN comprador co on co.id_comprador = l.id_comprador INNER JOIN tipo_movimentacao m on m.id_movimentacao = l.id_movimentacao where l.id_movimentacao > 5 and cl.id_cliente=$id_dep order by l.id_log desc limit 3";
$resultado = $conn->query($sql_nova);
while($linha = $resultado->fetch_assoc()){?>
    
<form>   


 <div class="row">
      <h3> Operação numero <?php echo $linha["id_log"] ?> </h3> 
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Sócio titular : <?php echo $linha["nome_cliente"] ?></a>
<a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Feito por : <?php echo $linha["nome_comprador"] ?></a>

<a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Tipo de operação : <?php echo $linha["nome_movimentacao"] ?></a>
<a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Crédito : <?php echo $linha["credito"] ?></a>
<a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Bônus : <?php echo $linha["bonus"] ?></a>     

      <a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Débito : <?php echo $linha["debito"] ?></a>
      <a class="list-group-item" id="list-home-list" data-toggle="list" href="#lista-home" role="tab" >Data : <?php echo date('d/m/Y H:i', strtotime($linha["data"])); ?></a>

    </div>
  </div>


</div>
<hr>


<?php }?>

  
</div>


      </div>
      <div class="modal-footer">
   <a href="relatorio_individual.php?id_cliente=<?php echo $row["id_cliente"] ?>"><button type='button' class='btn btn-dark'>Ver todas as movimentações</button></a>          
        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Voltar</button>
      </div>
    </div>

  </div>
                        </div>
          
</form>
       
       <!-- ================================== cadastro de dependentes ========================== -->


    <form action="cadastro_dep.php?id=<?php echo $row["id_cliente"]; ?>" method="POST">
       
        <div id="cadDep<?php echo $row["id_cliente"] ?>" class="modal fade" role="dialog" class="form-group">
          <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Adicionar comprador</h4>
      </div>
      <div class="modal-body">

<div class="form-group col-md-12">


    <label for="inputAddress">Nome do titular</label>
    <input  name="nome" type="text" class="form-control" id="inputAddress"value="<?php echo $row["nome_cliente"] ?>"readonly>
  </div>

<div class="form-group col-md-12">


    <label for="inputAddress">Nome do comprador</label>
    <input  name="nome_comprador" type="text" class="form-control" id="inputAddress">
  </div>


 <div class="form-group col-md-8">
      <label for="inputCity"> Senha administrativa</label>
      <input type="password" name="senha_depen" class="form-control" id="inputCity" maxlength="11" placeholder="Para confirmar cadastro confirme a senha administrativa">
    </div>  

         <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">



      </div>
      <div class="modal-footer">
                             <button type="submit" class=" btn btn-primary">Cadastrar dependente</button>

          
        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Voltar</button>
      </div>
    </div>

  </div>
                        </div>
          
</form>




<!-- ================================== CADASTRO DE SÓCIOS ========================== -->

<form action="cadastro.php" method="POST" class="form-group" enctype="multipart/form-data">


<div id="cadastro" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastrar sócio</h4>
      </div>
      <div class="modal-body">
       
<div class="form-group col-md-12">


    <label for="inputAddress">Nome</label>
    <input  name="nome" type="text" class="form-control" id="inputAddress">
  </div>
<div class="form-group col-md-12">
      <label for="inputCity">Endereço</label>
      <input type="text" name="endereco" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-12">
      <label for="inputCity">Email</label>
      <input type="text" name="email" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-6">
      <label for="inputCity">CPF</label>
      <input type="text" name="cpf" class="form-control" id="inputCity" maxlength="11">
    </div>  

    

        <div class="form-group col-md-6">
      <label for="inputCity">Telefone</label>
      <input type="text" class="form-control" name="telefone" id="inputCity"maxlength="11">
    </div>  

  <div class="form-group col-md-6">
      <label for="inputCity">Senha</label>
      <input type="password" name="senha" class="form-control" id="inputCity" maxlength="11">
    </div>  
     <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">
  <div class="form-group col-md-6">
      <label for="inputCity">Data de nascimento</label>
      <input type="date" name="aniversario" min="1000-01-01"
        max="3000-12-31" class="form-control">

    </div>  
         <div class="form-group col-md-6">
      <label for="inputCity">Data da associação</label>
      <input type="date" name="matricula" min="1000-01-01"
        max="3000-12-31" class="form-control">

    </div>  

        
 <div class="form-group col-md-8">
      <label for="inputCity"> Senha administrativa</label>
      <input type="password" name="senha_add" class="form-control" id="inputCity" maxlength="11" placeholder="Para confirmar cadastro confirme a senha administrativa">
    </div>  
    

      </div>
      <div class="modal-footer">
                     <button type="submit" class=" btn btn-primary">Cadastrar sócio</button>

        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>




</form>


<!-- ================================== EDIÇÃO ========================== -->

    <form action="update.php?id=<?php echo $row["id_cliente"]; ?>" method="POST" enctype="multipart/form-data">


        <div id="edicao<?php echo $row["id_cliente"] ?>" class="modal fade" role="dialog" class="form-group">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alterar dados pessoais</h4>
      </div>
      <div class="modal-body">
       
<div class="form-group col-md-12">


    <label for="inputAddress">Nome</label>
    <input  name="nome02" type="text" class="form-control" id="inputAddress"value="<?php echo $row["nome_cliente"] ?>">
  </div>
<div class="form-group col-md-12">
      <label for="inputCity">Endereço</label>
    <input  name="endereco02" type="text" class="form-control" id="inputAddress"value="<?php echo $row["endereco_cliente"] ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputCity">CPF</label>
    <input  name="cpf02" type="text" class="form-control" id="inputAddress"value="<?php echo $row["cpf_cliente"] ?>">
    </div>  

    

        <div class="form-group col-md-6">
      <label for="inputCity">Telefone</label>
  <input  name="telefone02" type="text" class="form-control" id="inputAddress"value="<?php echo $row["telefone_cliente"] ?>">    </div>  


     
   <div class="form-group col-md-6">
      <label for="inputCity">Email</label>
  <input  name="email02" type="text" class="form-control" id="inputAddress"value="<?php echo $row["email_cliente"] ?>">    </div>  





      <div class="form-group col-md-6">
      <label for="inputCity">Data de nascimento</label>
  <input  name="aniversario02" type="date" class="form-control" id="inputAddress"value="<?php echo $row["nascimento"] ?>">    </div>  

      <div class="form-group col-md-6">
      <label for="inputCity">Data de associação</label>
  <input  name="matricula02" type="date" class="form-control" id="inputAddress"value="<?php echo $row["entrada"] ?>">    </div>  

  <div class="form-group col-md-6">
      <label for="inputCity">Senha</label>
      <input  name="senha02" type="password" class="form-control" id="inputAddress"value="<?php echo $row["senha_cliente"] ?>">
    </div>  
    
            <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">

        
 <div class="form-group col-md-8">
      <label for="inputCity"> Senha administrativa</label>
      <input type="password" name="senha_up" class="form-control" id="inputCity" maxlength="11" placeholder="Para confirmar cadastro confirme a senha administrativa">
    </div>   


      </div>
      <div class="modal-footer">
                     <button type="submit" class=" btn btn-primary">Confirmar alteração</button>

        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>




</form>



  <form action="deposito.php?id=<?php echo $row["id_cliente"]; ?>" method="POST" class="form-group">
       
        <div id="deposito<?php echo $row["id_cliente"] ?>" class="modal fade" role="dialog" class="form-group">
          <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Atualizar saldo</h4>
      </div>
      <div class="modal-body">

<div class="form-group col-md-12">


    <label for="inputAddress">Nome</label>
    <input  name="nome" type="text" class="form-control" id="inputAddress"value="<?php echo $row["nome_cliente"] ?>"readonly>
  </div>
<div class="form-group col-md-6">
      <label for="inputCity">Valor do ultimo depósito</label>
      <input type="text"  name="valor" class="form-control" id="inputCity">
    </div>

    <div class="form-group col-md-6">
      <label for="inputCity">Porcentagem de bonificação</label>
      <input type="number"  name="bonus" class="form-control" id="inputCity" value="0">
    </div>
        <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">

        
 <div class="form-group col-md-6">
      <label for="inputCity">Autor do depósito</label>
<select name="autor" class="form-control form-control-lg" >
   <option >Selecione</option>
        <?php 
        $idselect=$row["id_cliente"];
        $sql2 = "SELECT * from comprador c where c.id_cliente =$idselect ";
$result2 = $conn->query($sql2);

while($aluno2 = $result2->fetch_assoc()) { 

        ?>
    <option value="<?php echo $aluno2["id_comprador"]; ?>"><?php echo $aluno2["nome_comprador"];?></option>
                            <?php
                        }
                    ?>
</select>
    </div>

 <div class="form-group col-md-8">
      <label for="inputCity"> Senha administrativa</label>
      <input type="password" name="senha_dep" class="form-control" id="inputCity" maxlength="11" placeholder="Para confirmar cadastro confirme a senha administrativa">
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
       
<!-- SACAR -->

<form action="saque.php?id=<?php echo $row["id_cliente"]; ?>" method="POST" class="form-group">
       
        <div id="saque<?php echo $row["id_cliente"] ?>" class="modal fade" role="dialog" class="form-group">
          <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Atualizar saldo</h4>
      </div>
      <div class="modal-body">

<div class="form-group col-md-12">


    <label for="inputAddress">Nome</label>
    <input  name="nome" type="text" class="form-control" id="inputAddress"value="<?php echo $row["nome_cliente"] ?>"readonly>
  </div>
<div class="form-group col-md-6">
      <label for="inputCity">Valor da ultima venda</label>
      <input type="text"  name="valor" class="form-control" id="inputCity">
    </div>
   
 <div class="form-group col-md-6">
      <label for="inputCity">Autor da compra</label>
<select name="autor" class="form-control form-control-lg" >
   <option >Selecione</option>
        <?php 
        $idselect=$row["id_cliente"];
        $sql2 = "SELECT * from comprador c where c.id_cliente =$idselect ";
$result2 = $conn->query($sql2);

while($aluno2 = $result2->fetch_assoc()) { 

        ?>
    <option value="<?php echo $aluno2["id_comprador"]; ?>"><?php echo $aluno2["nome_comprador"];?></option>
                            <?php
                        }
                    ?>
</select>
    </div>

      </div>

           <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">

        
 <div class="form-group col-md-8">
      <label for="inputCity"> Senha administrativa</label>
      <input type="password" name="senha_deb" class="form-control" id="inputCity" maxlength="11" placeholder="Para confirmar cadastro confirme a senha administrativa">
    </div>  
      <div class="modal-footer">
                     <button type="submit" class=" btn btn-primary">Atualizar saldo</button>

        <button type="submit" class=" btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
                        </div>
          
</form>

  
       
</tr>
        <?php } ?>
        <tr>
          
<td colspan="7">
  
<?php
$sql = "SELECT SUM(saldo_cliente) AS soma FROM cliente WHERE ativo = '1' ";

    $result=$conn->query($sql);
    $row = $result->fetch_assoc();
    ?>

   

</td>

        </tr>
     </table>


      <?php
        //Verificar a pagina anterior e posterior
        $pagina_anterior = $pagina - 1;
        $pagina_posterior = $pagina + 1;
      ?>
      <nav class="text-center">
        <ul class="pagination">
          <li>
            <?php
            if($pagina_anterior != 0){ ?>
              <a href="clientes.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            <?php }else{ ?>
              <span aria-hidden="true">&laquo;</span>
          <?php }  ?>
          </li>
          <?php 
          //Apresentar a paginacao
          for($i = 1; $i < $num_pagina + 1; $i++){ ?>
            <li><a href="clientes.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php } ?>
          <li>
            <?php
            if($pagina_posterior <= $num_pagina){ ?>
              <a href="clientes.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                <span aria-hidden="true">&raquo;</span>
              </a>
            <?php }else{ ?>
              <span aria-hidden="true">&raquo;</span>
          <?php }  ?>
          </li>
        </ul>
      </nav>
    </div>
    <a href = "home.php"><button type="button" class="btn btn-primary">Voltar </button>

    <a href = "relatorio_clientes.php"><button type="button" class="btn btn-success">Gerar relatório </button>
  
        
                
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