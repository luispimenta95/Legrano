<?php 
session_start();
if (!isset($_SESSION["logado"])) {
  header("Location:../index.php");
  session_destroy();
}
include '../conecta.php';
$pagina_atual = "home.php";
mysqli_set_charset( $conn, 'utf8');
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

//Selecionar todos os logs da tabela
$id_cliente= $_SESSION["id_cliente"];
$result_log = "SELECT * from log_financeiro l WHERE l.id_movimentacao >7 and l.id_cliente=$id_cliente";
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
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Wpp CSS -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- WPP CSS -->

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
<img src="../admin/assets/images/logo2.jpg" height="35" alt="Legrano Orgânicos"> Voltar para a página inicial
</a>
<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
</div>
</div>

<div class="header-right">



<div id="userbox" class="userbox">
<a href="#" data-toggle="dropdown">
<figure class="profile-picture">
<img src="../admin/assets/images/user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg">
</figure>
<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
<span class="name"><?php echo $_SESSION["nome_cliente"] ?></span>
<span class="role">Legrano | Club de sócios </span>

</div>
<i class="fa custom-caret"></i>
</a>
<div class="dropdown-menu">
<ul class="list-unstyled">
<li class="divider"></li>
<li>
<a role="menuitem" tabindex="-1" href="../logout_cliente.php"><i class="fa fa-power-off"></i> Logout</a>
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
            <ul class="list-group">
<a href="home.php"> <li class="<?php if($pagina_atual="home.php"){echo "list-group-item active";}else{echo "list-group-item";} ?>">Home</li></a>
  <a href="altera_usuario.php"> <li class="list-group-item">Dados pessoais </li></a>

          </div>
        </aside>
        <!-- end: sidebar -->

        <section role="main" class="content-body">
          <header class="page-header">
           
          </header>

            <div class="row">
            <div class="col-md-12">


    <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
    <ol class="carousel-indicators">
      <?php

    $result_logs = "SELECT p.id_promocao,imagem,ativo,nome_promocao,data from promocoes p where p.ativo =1 and p.publico = 2 order by p.nome_promocao ";
    $resultado_logs = mysqli_query($conn, $result_logs);
$total_logs = mysqli_num_rows($resultado_logs);
$marcadores =0;
  while($row = mysqli_fetch_assoc($resultado_logs)){ ?>
      <li data-target="#myCarousel" data-slide-to=<?php echo $marcadores ?> class="active"></li>


<?php 
$marcadores++;
}
?> 
   </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <?php
            $controle_ativo = 2;            
            $result_carousel = "SELECT p.id_promocao,imagem,ativo,nome_promocao,data from promocoes p where p.ativo =1 and p.publico = 2 order by p.id_promocao desc ";
            $resultado_carousel = mysqli_query($conn, $result_carousel);
            while($row_carousel = mysqli_fetch_assoc($resultado_carousel)){ 
              if($controle_ativo == 2){ ?>
                <div class="item active">
                  <img src="../admin/UP/<?php echo $row_carousel['imagem']; ?>" alt="<?php echo $row_carousel['nome_promocao']; ?>">
                </div><?php
                $controle_ativo = 1;
              }else{ ?>
                <div class="item">
                  <img src="../admin/UP/<?php echo $row_carousel['imagem']; ?>" alt="<?php echo $row_carousel['nome_promocao']; ?>">
                </div> <?php
              }
            }
          ?>      
      
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

<br>

             <div class="table-responsive"> 
             <?php 

             $result_logs = "SELECT nome_administrador ,nome_cliente,saldo_cliente, nome_comprador,nome_movimentacao,credito,debito,bonus,data,nome_forma
 FROM log_financeiro l INNER JOIN cliente cl on cl.id_cliente = l.id_cliente inner JOIN administrador a on a.id_administrador=l.id_administrador inner JOIN comprador co on co.id_comprador = l.id_comprador INNER JOIN tipo_movimentacao m on m.id_movimentacao = l.id_movimentacao inner join forma_pagamento f on f.id_forma= l.id_forma WHERE l.id_movimentacao >7 and l.id_cliente=$id_cliente order by l.id_log desc limit $incio, $quantidade_pg";
$resultado_logs = mysqli_query($conn, $result_logs);
$total_logs = mysqli_num_rows($resultado_logs);

if ($total_logs==0){
  echo "<h2>Você não tem registros financeiros em nosso sistema </h2>";
}
else{?>
                      
  <table class="table table-bordered">
    <thead>
      <tr>

            <th> Operador </th>
    <th> Sócio titular </th>
    <th>Quem fez</th>
    
    <th> Operacao </th>
    <th> Crédito </th>
    <th> Bônus </th>
    <th> Débito </th>
    <th>Forma de pagamento</th>
    <th>Data</th>
</tr>
    </thead>
    <tbody>
        
        <?php while($linha = mysqli_fetch_assoc($resultado_logs)){ ?>
  


           <tr>
   <th><?php echo $linha["nome_administrador"] ?></th>
  <th><?php echo $linha["nome_cliente"] ?></th>
  <th><?php echo $linha["nome_comprador"] ?></th>
  
  <th><?php echo $linha["nome_movimentacao"] ?></th>
  
  
   <th><?php echo $linha["credito"] ?></th>
  <th><?php echo $linha["bonus"] ?></th>

<th><?php echo $linha["debito"] ?></th>

<th><?php echo $linha["nome_forma"] ?></th>

<th> <?php echo date('d/m/Y', strtotime($linha["data"])); ?> </th>


   

        <?php } ?>
        </tr>
        <tr>
          
<td colspan="10">
  
<?php
$sql = "SELECT saldo_cliente AS soma FROM cliente c WHERE c.id_cliente = $id_cliente ";

    $result=$conn->query($sql);
    $soma = $result->fetch_assoc();
    ?>

    <h3 class="text-right">Seu saldo atual é de : R$ <?php echo $soma["soma"] ?></h3>

  

</td>

        </tr>
     </table>


      <?php
      }
        //Verificar a pagina anterior e posterior
        $pagina_anterior = $pagina - 1;
        $pagina_posterior = $pagina + 1;
      ?>
       <?php
$result_log = "SELECT * from log_financeiro l WHERE l.id_movimentacao >7 and l.id_cliente=$id_cliente";

$resultado_log = mysqli_query($conn, $result_log);

//Contar o total de logs
$total_logs = mysqli_num_rows($resultado_log);
$limitador =1;
if($total_logs > $quantidade_pg){?>
            <nav class="text-center">
               <ul class="pagination">

              <li><a href="home.php?pagina=1"> Primeira página </a></li>


                 <?php
                for($i = $pagina - $limitador; $i <= $pagina-1; $i++){
                  if($i>=1){
                    ?>
                        <li><a href="home.php?pagina=<?php echo $i; ?>"> <?php echo $i;?></a></li>


                  <?php }
                }
              ?>
                <li class="active">  <span><?php echo $pagina; ?></span></li>

                  <?php
                      for ($i = $pagina+1; $i <= $pagina+$limitador; $i++){
                        if($i<=$num_pagina){?>
                              <li><a href="home.php?pagina=<?php echo $i; ?>"> <?php echo $i;?></a></li>

                  <?php }
                      } 
                        
                      

                   ?>
              <li><a href="home.php?pagina=<?php echo $num_pagina; ?>"> <span aria-hidden="true"> Ultima página </span></a></li>



<?php } ?>
</ul>
</nav>
    </div>

<div class="text-right">
  <?php

                    $telefone = 5561998690313;
                    ?>


<h5>Dúvidas ? Fale conosco agora mesmo </h5><a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $telefone ?>"> <button class="btn-lg btn-warning"><i class="fa fa-whatsapp"></i></button></a>
 </div>         
          <!-- start: page -->
          

  
        
                
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