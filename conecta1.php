<?php
$conn = new MySQLi('localhost', 'admin', '13151319', 'projeto');
if($conn->connect_error){
   echo "Desconectado! Erro: " . $conn->connect_error;
}


?>