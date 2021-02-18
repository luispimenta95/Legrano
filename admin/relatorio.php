<?php   
$mes = $_GET['mes'];


$ano = date('Y');
$mesn= '0'.$mes;

   //echo $mes. "<br>";
  $data01= $ano.'-'.$mesn.'-01';
  $data02= $ano.'-'.$mesn.'-31';
$meses = array(
    '01'=>'Janeiro',
    '02'=>'Fevereiro',
    '03'=>'Março',
    '04'=>'Abril',
    '05'=>'Maio',
    '06'=>'Junho',
    '07'=>'Julho',
    '08'=>'Agosto',
    '09'=>'Setembro',
    '10'=>'Outubro',
    '11'=>'Novembro',
    '12'=>'Dezembro'
);

echo $meses[date('m')];

    include("../conecta.php");

mysqli_set_charset( $conn, 'utf8');

     $html = '<table';

    $html = '<table  border="1"';  
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>Nome do operador</th>';
 $html .= '<th>Nome do sócio</th>';
    $html .= '<th>Tipo de operação</th>';
    $html .= '<th>Crédito</th>';
    $html .= '<th>Bônus</th>';
    $html .= '<th>Débito</th>';
    $html .= '<th>Data</th>';
      

    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    
   
$sql = "SELECT nome_administrador,nome_cliente,nome_movimentacao,data,credito,debito,bonus FROM log_informacoes l INNER JOIN administrador a on l.id_administrador = a.id_administrador INNER JOIN tipo_movimentacao m on l.id_movimentacao = m.id_movimentacao INNER JOIN cliente c on l.id_cliente = c.id_cliente WHERE l.id_movimentacao <3 order by l.id_log desc";
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) { 

        $html .= '<tr><td>'.$row['nome_administrador'] . "</td>";
        $html .= '<td>'.$row['nome_cliente'] . "</td>";
        $html .= '<td>'.$row['nome_movimentacao'] . "</td>";
      $html .= '<td>'.$row['credito'] . "</td>";
        $html .= '<td>'.$row['bonus'] . "</td>";
        $html .= '<td>'.$row['debito'] . "</td>";
       
        $html .= '<td>'.date('d/m/Y H:i', strtotime($row["data"])) . "</td>";
       
    
}


    
    $html .= '</tbody>';
    $html .= '</table';
 


 
    //referenciar o DomPDF com namespace
    use Dompdf\Dompdf;

    // include autoloader
    require_once("dompdf/autoload.inc.php");

    //Criando a Instancia
    $dompdf = new DOMPDF();
      date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
    $dataLocal = date('d/m/Y H:i:s', time());
    // Carrega seu HTML
    $dompdf->load_html(
         
            '<h1 style="text-align: center;">Legrano - Registro de cadastro de sócios</h1>
            '. $html .'<footer>         
        <br><br>        <br><br>        <br><br>        <br><br>        <br><br>        <br><br>         <br><br>  <br><br>        <br><br>         <br><br>  <br><br>        <br><br>         <br><br>         <br><br>        <br><br>        <br><br>


            <h4 style="text-align: right;">Relatório  gerado em : '.$dataLocal.'
         </h4>  </footer>'

         );

    //Renderizar o html
    ob_clean(); 
    $dompdf->render();

    //Exibibir a página
    $dompdf->stream(
        "relatorio_mes_".$mes.".pdf", 
        array(
            "Attachment" => false //Para realizar o download somente alterar para true
        )
    );

?>