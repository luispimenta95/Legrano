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
$id_cliente= $_SESSION["id_cliente"];

$pagina_atual = "up.php";

 $buscar = "SELECT * FROM cliente c WHERE c.id_cliente = $id_cliente";
$result = $conn->query($buscar);


$row = $result->fetch_assoc();
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
<img src="../admin/assets/images/logo2.jpg" height="35" alt="Legrano Orgânicos">
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
<div class="profile-info" data-lock-name="John Doe" data-lock-Nome="johndoe@JSOFT.com">
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
<a href="home.php"> <li class="list-group-item">Home</li></a>
  <a href="altera_usuario.php"> <li class="<?php if($pagina_atual="up.php"){echo "list-group-item active";}else{echo "list-group-item";} ?>">Dados Pessoais </li></a>


  </ul>

          </div>
        </aside>
        <!-- end: sidebar -->

        <section role="main" class="content-body">
          <header class="page-header">
           
          </header>

      
        <h2 class="text-center">Área de sócios</h2>
        <?php
          if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
          }
          if(isset($_SESSION['msgcad'])){
            echo $_SESSION['msgcad'];
            unset($_SESSION['msgcad']);
          }
        ?>
        <form method="POST" action="up_user.php">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNome4">Nome</label>
      <input type="text" class="form-control" name="nome" value="<?php echo $row["nome_cliente"] ?>"required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputNome4">Email</label>
      <input type="email" class="form-control" id="inputNome4" name="email" value="<?php echo $row["email_cliente"] ?>"required>
          <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir um e-mail válido.
        </small>
    </div>
    <?php 
      if(strlen($row["cpf_cliente"]) <11){

$cpf = "0".$row["cpf_cliente"];
}

else{

  $cpf = $row["cpf_cliente"];
}
    ?>

       <div class="form-group col-md-6">
      <label for="inputNome4">CPF</label>
      <input type="number" class="form-control" id="inputNome4" name="cpf" value="<?php echo $cpf?>" required>
      <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir somente números, sem espaços,pontos ou caracteres especiais.
        </small>
    </div>
    <div class="form-group col-md-6">
      <label for="inputNome4">Telefone</label>
      <input type="text" class="form-control" id="inputNome4" name="telefone" value="<?php echo $row["telefone_cliente"] ?>" required>
                <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir somente números, sem espaços,pontos ou caracteres especiais.
        </small>
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Endereço</label>
      <input type="text" class="form-control" name="endereco" value="<?php echo $row["endereco_cliente"] ?>" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Data de nascimento</label>
     <input type="date" name="nascimento" min="1900-01-01"max="2023-12-31" class="form-control"value="<?php echo $row["nascimento"] ?>"required>
           <small id="passwordHelpBlock" class="form-text text-muted">
          Favor inserir conforme o padrão : 25/12/2019.
        </small>
    </div>

    <div class="text-right">
      <button class="btn-primary">Confirmar alterações</button>
    </div>
</form>

     <div class="form-group col-md-6">
        <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
Alterar senha

        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
         
<?php
          if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
          }
          if(isset($_SESSION['msgcad'])){
            echo $_SESSION['msgcad'];
            unset($_SESSION['msgcad']);
          }
        ?>
        <form method="POST" action="up_senha.php">
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputNome4">Confirme a senha atual</label>
      <input type="password" class="form-control" name="senha" required>
    </div>
    
       <div class="form-group col-md-6">
      <label for="inputNome4">Digite uma nova senha</label>
      <input type="password" class="form-control" id="inputNome4" name="senha1" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputNome4">Confirme a nova senha</label>
      <input type="password" class="form-control" id="inputNome4" name="senha2" required>
    </div>
    <div class="text-right">

      <button class="btn-primary">Confirmar alteração de senha</button>
</div>
</form>

      </div>
    </div>
  </div>
 

</div>
    </div>
    
  </div>

     
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