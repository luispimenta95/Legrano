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
  $pagina_atual = "dependentes.php";
//Selecionar todos os logs da tabela
$result_log = "SELECT * from comprador";
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
$pesquisa = "";
if(!isset($_POST['termo'])){
$result_logs = "SELECT c.id_cliente,co.id_comprador,co.nome_comprador,nome_cliente from cliente c inner join comprador co on c.id_cliente = co.id_cliente order by c.nome_cliente,co.nome_comprador limit $incio, $quantidade_pg" ;

}
else{
  $pesquisa = $_POST["termo"];

  $result_logs = "SELECT c.id_cliente,co.id_comprador,co.nome_comprador,nome_cliente from cliente c inner join comprador co on c.id_cliente = co.id_cliente WHERE co.nome_comprador LIKE '%".$pesquisa."%' order by c.nome_cliente,co.nome_comprador";

}


$resultado_logs = mysqli_query($conn, $result_logs);
$total_logs = mysqli_num_rows($resultado_logs);
?>
<!doctype html>
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



<span class="separator"></span> 
<div id="userbox" class="userbox">
<a href="#" data-toggle="dropdown">
<figure class="profile-picture">
<img src="assets/images/user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg">
</figure>
<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
<span class="name"><?php echo $_SESSION["nome_administrador"] ?></span>
<span class="role">Legrano | Administrativo</span>

</div>
<i class="fa custom-caret"></i>
</a>
<div class="dropdown-menu">
<ul class="list-unstyled">
<li class="divider"></li>
<li>
<a role="menuitem" tabindex="-1" href="../logout_adm.php"><i class="fa fa-power-off"></i> Logout</a>
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
  <a href="clientes.php"> <li class="list-group-item">Sócios </li></a>
<a href="dependentes.php"> <li class="<?php if($pagina_atual="dependentes.php"){echo "list-group-item active";}else{echo "list-group-item";} ?>">Dependentes </li></a>
  <a href="movimentacoes.php"> <li class="list-group-item">Registros financeiros </li></a>
    <a href="log.php"> <li class="list-group-item">Registros de cadastro</li></a>
    
<a href="mensagens.php"> <li class="list-group-item">Mensagens </li></a>
<a href="promocoes.php"> <li class="list-group-item">Promoções </li></a>




  </ul>
   <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
Filtar compradores por nome

        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
                <form method="POST" action="dependentes.php" class="search nav-form">
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
              $result_logs = "SELECT c.id_cliente,co.id_comprador,co.nome_comprador,nome_cliente from cliente c inner join comprador co on c.id_cliente = co.id_cliente order by c.nome_cliente,co.nome_comprador limit $incio, $quantidade_pg" ;


$resultado_logs = mysqli_query($conn, $result_logs);
$total_logs = mysqli_num_rows($resultado_logs);

  $msg_pesquisa = "<div class='alert alert-warning'>Nenhum cliente encontrado no sistema ! </div>";
  }
?>
              <div class="table-responsive">          
  <table class="table table-bordered">
    <thead>
      <tr>
        
   <th>Sócio titular </th>
    <th> Pessoa autorizada </th>
    <th> Alterar dados </th>
        

        </tr>
    </thead>
    <tbody>
             <?php 


             while($row = mysqli_fetch_assoc($resultado_logs)){ ?>


      <tr>

  <th> <?php echo $row["nome_cliente"] ?> </th>
<th> <?php echo $row["nome_comprador"] ?> </th>
<th>  <a href="#edicao<?php echo $row["id_comprador"] ?>" data-toggle="modal"><button type='button' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></a>

<a href="#remover<?php echo $row["id_comprador"] ?>" data-toggle="modal"><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></a>



 </th>

  <!-- ================================== EDIÇÃO ========================== -->

    <form action="update_dep.php?id=<?php echo $row["id_cliente"]; ?>" method="POST" enctype="multipart/form-data">


        <div id="edicao<?php echo $row["id_comprador"] ?>" class="modal fade" role="dialog" class="form-group">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alterar dados de um dependente</h4>
      </div>
      <div class="modal-body">
<div class="form-group col-md-12">
            <label for="inputAddress">Sócio titular</label>
              <input  name="nome02" type="text" class="form-control" id="inputAddress"value="<?php echo $row["nome_cliente"] ?>" readonly>
  </div>
       




<div class="form-group col-md-12">
            <label for="inputAddress">Comprador autorizado</label>
              <input  name="nome_comprador" type="text" class="form-control" id="inputAddress"value="<?php echo $row["nome_comprador"] ?>">
  </div>

           <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">
           <input type="hidden" id="custId" name="id_comprador" value=" <?php  echo $row["id_comprador"]?>">

        
 <div class="form-group col-md-12">
      <label for="inputCity"> Senha administrativa</label>
      <input type="password" name="senha_upD" class="form-control" id="inputCity" maxlength="11" placeholder="Para confirmar cadastro confirme a senha administrativa">
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



    <form action="delete_dep.php?id=<?php echo $row["id_cliente"]; ?>" method="POST" enctype="multipart/form-data">


        <div id="remover<?php echo $row["id_comprador"] ?>" class="modal fade" role="dialog" class="form-group">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Excluir um dependente</h4>
      </div>
      <div class="modal-body">
<div class="form-group col-md-12">
            <label for="inputAddress">Sócio titular</label>
              <input  name="nome02" type="text" class="form-control" id="inputAddress"value="<?php echo $row["nome_cliente"] ?>" readonly>
  </div>
       




<div class="form-group col-md-12">
            <label for="inputAddress">Comprador autorizado</label>
              <input  name="nome_comprador" type="text" class="form-control" id="inputAddress"value="<?php echo $row["nome_comprador"] ?>" readonly>
  </div>

           <input type="hidden" id="custId" name="id_adm" value=" <?php  echo $_SESSION["id_administrador"]?>">
           <input type="hidden" id="custId" name="id_comprador" value=" <?php  echo $row["id_comprador"]?>">

        
 <div class="form-group col-md-12">
      <label for="inputCity"> Senha administrativa</label>
      <input type="password" name="senha_rem" class="form-control" id="inputCity" maxlength="11" placeholder="Para confirmar cadastro confirme a senha administrativa">
    </div>


      </div>
      <div class="modal-footer">
                     <button type="submit" class=" btn btn-primary">Confirmar exclusão</button>

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
$result_log = "SELECT * from comprador";

$resultado_log = mysqli_query($conn, $result_log);

//Contar o total de logs
$total_logs = mysqli_num_rows($resultado_log);
$limitador =1;
if($total_logs > $quantidade_pg){?>
            <nav class="text-center">
               <ul class="pagination">

              <li><a href="dependentes.php?pagina=1"> Primeira página </a></li>


                 <?php
                for($i = $pagina - $limitador; $i <= $pagina-1; $i++){
                  if($i>=1){
                    ?>
                        <li><a href="dependentes.php?pagina=<?php echo $i; ?>"> <?php echo $i;?></a></li>


                  <?php }
                }
              ?>
                <li class="active">  <span><?php echo $pagina; ?></span></li>

                  <?php
                      for ($i = $pagina+1; $i <= $pagina+$limitador; $i++){
                        if($i<=$num_pagina){?>
                              <li><a href="dependentes.php?pagina=<?php echo $i; ?>"> <?php echo $i;?></a></li>

                  <?php }
                      } 
                        
                      

                   ?>
              <li><a href="dependentes.php?pagina=<?php echo $num_pagina; ?>"> <span aria-hidden="true"> Ultima página </span></a></li>



<?php } ?>
</ul>
</nav>
               

    <a href = "relatorio_dependentes.php"><button type="button" class="btn btn-dark">Gerar relatório </button>
  

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