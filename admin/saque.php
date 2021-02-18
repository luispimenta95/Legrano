<?php
session_start();
if (!isset($_SESSION["logado"])) {
  header("Location:../index.php");
  session_destroy();
}
include '../conecta.php';

$id = $_GET["id"];

$valor = $_POST["valor"];
$autor = $_POST["autor"];
$forma = $_POST["forma"];




$id_administrador = $_POST["id_adm"];
$senha_adm = $_POST["senha_deb"];

      $sql_admin = "SELECT senha_administrador from administrador where id_administrador = $id_administrador";
$result = $conn->query($sql_admin);

 $rowcount=mysqli_num_rows($result);

if ($rowcount >0) {

	$administrador = $result->fetch_assoc();

	$senha_bd = $administrador["senha_administrador"];
	if($senha_adm == $senha_bd){
		$buscar = "SELECT * FROM cliente WHERE id_cliente = $id";
$result = $conn->query($buscar);


$cliente = $result->fetch_assoc();



$saldo = $cliente['saldo_cliente'];

$valor=str_replace(",",".",$valor);
$val = floatval ($valor);
$saldo = floatval ($saldo);

$saldo2 = $saldo - $val;




 $up = "UPDATE cliente SET saldo_cliente = $saldo2 WHERE id_cliente = $id";

 if ($conn->query($up) === TRUE) {


    $mov=9;
    $sql_log = "INSERT INTO log_financeiro(id_cliente,id_administrador,id_movimentacao,data,debito,id_comprador,id_forma) VALUES ('$id','$id_administrador','$mov',NOW(),'$val','$autor','$forma')";
       if ($conn->query($sql_log) === TRUE) {
          $_SESSION['msg'] = "<div class='alert alert-success'>Venda registrada com sucesso!</div>";


header("Location:clientes.php");

}

        else{





  echo("Error description: " . $conn -> error);
}

}
else {
    echo $sql_code;
}
}

		else{

			echo "Senha administrativa incorreta";
		}
}







     

?>