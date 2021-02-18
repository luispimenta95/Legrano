<?php 
session_start();
include 'conecta.php';

?>
<!DOCTYPE html>
<html>

<head>
  <title>LEGRANO ORGÂNICOS</title>
  <link rel="stylesheet" href="admin/css/index.css">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="admin/css/estilo1.css">
<link rel="shortcut icon" href="admin/assets/images/legrano/icon.jpg""  />

  

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



</head>
<body class="fundo">

  
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
          <a class="navbar-brand" href="#">  <img src="admin/assets/images/legrano/icon.jpg" width="30" height="30" alt=""><!--Legrano Orgânicos --></a>
      <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#myNavbar">

        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a target="_self" href="#what-we-do">QUEM SOMOS</a></li>
        <li><a href="#fazenda">CLUB LEGRANO</a></li>
        <li><a href="#cestas">PLANO DE CESTAS</a></li>
     <li><a href="#contato">CONTATO</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> CLUB DE SÓCIOS</a></li>
      <?php
                          $telefone = 5561999789022;

      ?>
      <li><a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $telefone ?>"> <button class="btn-sm btn-success"><i class="fa fa-whatsapp"></i></button></a></li>
     
        </ul>
    </div>
  </div>
</nav> 


 <!--
 <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#myNavbar">

        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a target="_self" href="#what-we-do">QUEM SOMOS</a></li>
        <li><a href="#fazenda">CLUB LEGRANO</a></li>
        <li><a href="#cestas">PLANO DE CESTAS</a></li>
     <li><a href="#contato">CONTATO</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> CLUB DE SÓCIOS</a></li>
     
        </ul>
    </div>
  </div>
</nav> 
 -->
<!--<nav class="navbar navbar-inverse">
  <div  class="container-fluid ">
    <div class="navbar-header ">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">HOME</a>
    </div>
    <div class="collapse navbar-collapse " id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="nav-item">
        <a class="nav-link" href="#what-we-do">QUEM SOMOS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#fazenda">CLUB LEGRANO</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#cestas">PLANO DE CESTAS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#contato">FALE CONOSCO</a>
      </li>

      <li class="nav-item"><a href="login.php"><span class="glyphicon glyphicon-user"></span> CLUB DE SÓCIOS</a></li>
      
      
      </ul>
     
    </div>
  </div>
</nav>
 -->
    <div class="text-right">
  <?php

                    $telefone = 5561999789022;
                    ?>


<a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $telefone ?>"> <button class="btn-lg btn-success"><i class="fa fa-whatsapp"></i></button></a>
 </div>         
<section>
    

 <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
    <ol class="carousel-indicators">
      <?php

    $result_logs = "SELECT p.id_promocao,imagem,ativo,nome_promocao,data from promocoes p where p.ativo =1 and p.publico =1 order by p.nome_promocao ";
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
            $result_carousel = "SELECT p.id_promocao,imagem,ativo,nome_promocao,data from promocoes p where p.ativo =1 and p.publico =1 order by p.id_promocao desc ";
            $resultado_carousel = mysqli_query($conn, $result_carousel);
            while($row_carousel = mysqli_fetch_assoc($resultado_carousel)){ 
              if($controle_ativo == 2){ ?>
                <div class="item active">
                  <img src="admin/UP/<?php echo $row_carousel['imagem']; ?> " alt="<?php echo $row_carousel['nome_promocao']; ?>"style="width:100%;">
                </div><?php
                $controle_ativo = 1;
              }else{ ?>
                <div class="item">
                  <img src="admin/UP/<?php echo $row_carousel['imagem']; ?>" alt="<?php echo $row_carousel['nome_promocao']; ?>" style="width:100%;">
                </div> <?php
              }
            }
          ?>      
      
    </div>


  </section>


   <section id="what-we-do" class="fundo">
        <div class="container-fluid fundo">
<h2 class="text-center font-weight-bold bg-dark text-success"><strong>Quem somos</strong></h2>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 ">
                    <div class="card ">
                        <div class="card-block ">
                            <strong><h3 class="card-title bg-dark text-success">SOBRE A LEGRANO</h3></strong>
                            <strong><p class="card-text bg-dark text-success text-justify">
                            <strong>A Legrano Orgânicos é uma marca premium de produtos orgânicos de produção própria, uma opção saudável a quem tem como prioridade uma alimentação mais equilibrada e nutritiva, com produtos diferenciados. Somos uma empresa familiar com valores fincados na agricultura orgânica:
                            <ul>
<li class=" bg-dark text-success"> Economicamente viável </li>
<li class=" bg-dark text-success"> Ecologicamente correto </li>
<li class=" bg-dark text-success"> Socialmente justos </li>
</ul>                            
                            
                            
                            </p></strong>
                           
                        </div>
                    </div>
                </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 ">
                    <div class="card">
                        <div class="card-block ">
                            <strong><h3 class="card-title bg-dark text-success">ORGÂNICOS SELECIONADOS E CERTIFICADOS </h3></strong>
                            <strong><p class="card-text bg-dark text-success text-justify">
                            As verduras, legumes e frutas da Legrano Orgânicos  são cultivadas em sua maioria, na propriedade da nossa família, denominada Fazenda Proteção Divina, de forma orgânica, de acordo com a legislação exigida pelo Ministério da Agricultura, Pecuária e Abastecimento (MAPA) e pelo Instituto Nacional de Metrologia, Normalização e Qualidade Industrial (Inmetro), recebendo os selos de Produto Orgânico e Ecocert.
                            
                            </p></strong>
                            </div>
                    </div>
                </div>

 <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 ">
                    <div class="card">
                        <div class="card-block ">
                            <strong><h3 class="card-title bg-dark text-success">NATURAIS E SAUDÁVEIS</h3><strong>
                            <p class="card-text bg-dark text-success text-justify">Além dos produtos orgânicos, na Legrano você também encontra uma grande variedade de produtos naturais e saudáveis. Nosso objetivo é oferecer cada vez mais uma variedade maior de produtos, para você e sua família se alimentarem cada vez melhor. Oferecemos uma opção de alimentação saudável para a sociedade, sustentada por um modelo de atuação responsável.
</p>
                           
                        </div>
                    </div>
                </div>

   
            </div>
            <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4  col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-block ">
                            <strong><h3 class="card-title bg-dark text-success">1º PILAR : ECOLOGICAMENTE CORRETO</h3></strong>
                            <strong><p class="card-text bg-dark text-success text-justify">Com produção própria de FOLHAGENS, LEGUMES e HORTALIÇAS, estabelecemos o equilíbrio com a natureza, utilizando técnicas naturais de adubação e controle do solo e de pragas, baseado em sistemas ecológicos vivos e cíclicos, trabalhando com eles, imitando-os e ajudando a mantê-los.
Este pilar privilegia a qualidade de vida do ser humano e a preservação do meio ambiente.
</p></strong>
                           
                        </div>
                    </div>
                </div>
                          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  col-xl-4">
                    <div class="card">
                        <div class="card-block ">
             <strong>               <h3 class="card-title bg-dark text-success">2º PILAR: ECONOMICAMENTE VIÁVEL</h3></strong>
                            <p class="card-text bg-dark text-success text-justify">A agricultura orgânica é considerada distante da realidade de muitos, mas a LEGRANO ORGÂNICOS tem essa preocupação e atua no mercado de forma a viabilizar o acesso aos alimentos orgânicos.
Os produtos de produção própria não passam por atravessadores, vão da fazenda direto para sua mesa, e isso torna viável uma prática de preço acessível, fazendo disso o nosso segundo pilar sendo ECONOMICAMENTE VIÁVEL.
Com preços acessíveis, a população pode se alimentar mais e melhor!
</p>
                           
                        </div>
                    </div>
                </div>
                          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 ">
                    <div class="card">
                        <div class="card-block ">
                            <strong><h3 class="card-title bg-dark text-success">3º PILAR: SOCIALMENTE JUSTO </h3></strong>
                            <strong><p class="card-text bg-dark text-success text-justify">Como produtores da agricultura orgânica, ser SOCIALMENTE JUSTO não poderia deixar de ser um de nossos pilares.
A LEGRANO ORGÂNICOS tem esse compromisso em retribuir o que faz de melhor para a sociedade. Além de praticar preços justos, mantém uma tabela de preços praticamente estáveis durante todo o ano. 
Nosso objetivo é oferecer o que há de melhor para você e sua família de forma justa, por este motivo os nossos produtos são cuidadosamente selecionados e embalados.

</p></strong>
                           
                        </div>
                    </div>
                </div>
                    </div>
                </div>
      
          
    
    </section>


    <section class="fundo">

    <h2 id="fazenda" class="text-center font-weight-bold bg-dark text-success"><strong>FAÇA PARTE DO CLUB LEGRANO</strong></h2>

<div class="container content">
    <div class="row">
        <!-- Pricing -->
       
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
         
        <img src="admin/assets/images/legrano/2.jpg" alt="Los Angeles" style="width:100%;">
      </div>
     
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
</section>

  <section id="what-we-do ">
        <div class="container-fluid fundo">
            <h1 id="club" class="text-center font-weight-bold bg-dark text-success"><strong>CLUB LEGRANO</strong></h1>
<h3>><strong><p class="text-center bg-dark text-success text-justify">CLUB LEGRANO é um clube de vantagens para clientes LEGRANO.</p></strong></h3>
                                          <div class="row mt-5">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="card fundo">
                        <div class="card-block ">
                            <strong><h3 class="card-title bg-dark text-success">Veja como se associar ao CLUB LEGRANO</h3></strong>
                            <strong><p class="card-text bg-dark text-success">No CLUB LEGRANO o consumidor se associa adquirindo um cartão de consumo, e conforme sua necessidade vai creditando novos valores.
A cada valor mínimo de R$ 100,00 creditado, o associado ganha um bônus adicional de 10% sobre o valor. </p></strong>
                           
                        </div>
                    </div>
                </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-block ">
                            <strong><h3 class="card-title bg-dark text-success">VANTAGENS DO CLUB</h3></strong>
                            <strong><p class="card-text bg-dark text-success text-justify"></strong>
             <ul>
  <strong><li class=" bg-dark text-success">10% DE BÔNUS do valor creditado válido para compra de qualquer produto da loja</li></strong>
  <strong><li class=" bg-dark text-success">VANTAGEM EM DOBRO nas promoções</li></strong>
  <strong><li class=" bg-dark text-success">Entrega grátis no PLANO DE CESTAS</li></strong>
  <strong><li class=" bg-dark text-success">Entrega grátis no DELIVERY para pedido mínimo de R$50,00</li></strong>
  <strong><li class=" bg-dark text-success">Promoções EXCLUSIVAS</li></strong>
</ul> 
                                
                                
                            </p>
                            </div>
                    </div>
                </div>

 

   
            </div>


    </section>


    <section class="fundo">
  



 <h2 id="cestas" class="text-center font-weight-bold bg-dark text-success"><strong>CONTRATE UM PLANO DE CESTAS LEGRANO</strong></h2>

<div class="container content">
    <div class="row">
        <!-- Pricing -->
       

    
          <div class="col-md-4">
            <div class="pricing hover-effect">
               
<img  src="admin/assets/images/legrano/cesta1.jpg" class="img-thumbnail" alt="Cinque Terre">

              
            </div>
        </div>

        <div class="col-md-4">
            <div class="pricing hover-effect">
               
<img  src="admin/assets/images/legrano/cesta2.jpg" class="img-thumbnail" alt="Cinque Terre">

            </div>
        </div>
           
    <div class="col-md-4">
            <div class="pricing hover-effect">
               
<img  src="admin/assets/images/legrano/cesta3.jpg" class="img-thumbnail" alt="Cinque Terre">

            
            </div>
        </div>
        <br><br>
       
    </section>


    <div class="text-center">
  <?php

                            $telefone = 5561999789022;
            
                    ?>


<h3 class="bg-dark text-success">FAÇA SEU PEDIDO DE DELIVERY </h3><a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $telefone ?>"> <button class="btn-lg btn-success"><i class="fa fa-whatsapp"></i></button></a>
 </div>  
    <section class="fundo">
      <h2 id="contato" class="text-center bg-dark text-success"><strong>Entre em contato</strong></h2>
<div class="container">
    <div class="row">
        <div class="col">
          
        </div>

        <div class="col-12 col-sm-6">
            <div class="card bg-light mb-3">
                <div class="card-header bg-dark text-success text-uppercase">Informações de contato</div>
                <div class="card-body">
                    <br>
                    <p class="bg-dark text-success"><i class="fa fa-phone-square"> (61)3389.8415 | 99978.9022</i></p>
                    <p class="bg-dark text-success"><i class="fa fa-map-marker"> Avenida Floriano Peixoto Q68A LT 4 Lj 1 - Planaltina DF</i></p>
                    <p class="bg-dark text-success"><i class="fa fa-envelope"> contato@legrano.com.br</p></i>
                    <p class="bg-dark text-success"><a class="bg-dark text-success" target="_blank" href="https://www.instagram.com/legranoorganicos/?hl=pt-br"><i class="fa fa-instagram"> Nos siga no Instagram</i></a></p>
                    <p class="bg-dark text-success"><a class="bg-dark text-success" target="_blank" href="https://www.facebook.com/clublegrano/"><i class="fa fa-facebook"> Curta nossa página no Facebook</i></a></p>

                </div>

            </div>
        </div>

              <div class="col-12 col-sm-6">
            <div class="card bg-light mb-3">
                <div class="card-header bg-dark text-success text-uppercase"><i class="fa fa-envelope-o"></i> Nos envie uma mensagem</div>
                <div class="card-body">
                    	<?php
		if(isset($_SESSION['msg_envio'])){
			echo $_SESSION['msg_envio'];
			unset($_SESSION['msg_envio']);
		}
		?>
              <form method="POST" action="mensagem.php">
                           <div class="form-group">
                            <label for="name" class=" bg-dark text-success">Nome</label>
                            <input type="text" class="form-control  bg-dark text-success" id="name" aria-describedby="emailHelp" name="nomeM" placeholder="Digite um nome" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class=" bg-dark text-success">Telefone</label>
                            <input type="text" class="form-control  bg-dark text-success" id="email" aria-describedby="emailHelp" placeholder="Digite seu telefone de contato" name="telefoneM" required>
                            <small id="emailHelp" class="form-text text-muted">Não iremos compartilhar seus dados.</small>
                        </div>
                        <div class="form-group">
                            <label for="email" class=" bg-dark text-success">Email</label>
                            <input type="email" class="form-control  bg-dark text-success" id="email" aria-describedby="emailHelp" placeholder="Digite um email válido" name="emailM" required>
                            <small id="emailHelp" class="form-text text-muted">Não iremos compartilhar seus dados.</small>
                        </div>
                        <div class="form-group">
                            <label  for="message" class=" bg-dark text-success">Mensagem</label>
                            <textarea class="form-control" id="message" rows="6" name="mensagem01" required></textarea>
                        </div>
                        
                              <div class="form-group">
                               
                                <label for="name" class=" bg-dark text-success">Confirme sua identidade</label>
                            <input type="text" class="form-control  bg-dark text-success" id="name" aria-describedby="emailHelp" name="captcha" placeholder="Digite o código a seguir" required>
                               <img src="captcha.php" alt="Código captcha"><br>
			
			
                       
                        </div>

                        <div class="mx-auto">

                        <button type="submit" class="btn btn-primary text-right">Enviar</button></div>




                    </form>

                </div>

            </div>
        </div>


    </section>
    
    <section>
        
        <footer>
            <div class= "align-middle" >
                <hr>
              <strong> <h4  class=" bg-dark text-success"> Razão social : LEGRANO ORGÂNICOS EIRELI <br> CNPJ : 30.019.956.0001-04</h4></strong>
                
            </div>
            
        </footer>
        
    </section>
    <script type="text/javascript">
    	
    	 $(document).on('click','.navbar-collapse.in',function(e) {
    if( $(e.target).is('a') ) {
        $(this).collapse('hide');
    }
});

    </script>
    
</body>
</html>