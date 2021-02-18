<?php
$conn = new MySQLi('localhost', 'u822682575_legrano', '13151319', 'u822682575_projeto');
if($conn->connect_error){
   echo "Desconectado! Erro: " . $conn->connect_error;
}



?>