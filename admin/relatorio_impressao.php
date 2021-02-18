<?php   
$id_cliente = $_GET['id_cliente'];



    include("../conecta.php");

mysqli_set_charset( $conn, 'utf8');

     $html = '<table  align="center" ';

    $html = '<table  border="1"';  
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>Relatório de consumo</th>';
      

    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    
   
$sql = "SELECT id_log,nome_administrador ,nome_cliente, nome_comprador,saldo_cliente,nome_movimentacao,credito,debito,bonus,data,nome_forma FROM log_financeiro l INNER JOIN cliente cl on cl.id_cliente = l.id_cliente inner JOIN administrador a on a.id_administrador=l.id_administrador inner JOIN comprador co on co.id_comprador = l.id_comprador INNER JOIN tipo_movimentacao m on m.id_movimentacao = l.id_movimentacao inner join forma_pagamento f on f.id_forma= l.id_forma where l.id_movimentacao > 7 and cl.id_cliente=$id_cliente order by l.id_log desc limit 1";
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) { 

        $html .= '<tr><td>Data : '.date('d/m/Y', strtotime($row["data"])) . "</td>";

        $html .= '<tr><td > Operador : '.$row['nome_administrador'] . "</td>";
        $html .= '<tr><td>Sócio titular : '.$row['nome_cliente'] . "</td>";
        $html .= '<tr><td>Comprador : '.$row['nome_comprador'] . "</td>";
        $html .= '<tr><td>Operação : '.$row['nome_movimentacao'] . "</td>";
        $html .= '<tr><td>Pagamento : '.$row['nome_forma'] . "</td>";
        $saldo_anterior= ($row['saldo_cliente'] - $row['credito'] - $row['bonus'] )+ $row['debito'];
        $saldo_anterior = number_format($saldo_anterior, 2, '.', '');
        $credito = number_format($row["credito"], 2, '.', '');
        $bonus = number_format($row["bonus"], 2, '.', '');
        $debito = number_format($row["debito"], 2, '.', '');
        $saldo = number_format($row["saldo_cliente"], 2, '.', '');


    
        $html .= '<tr><td>Saldo anterior : '.$saldo_anterior . "</td>";
 
        $html .= '<tr><td>Crédito : '.$credito . "</td>";
        $html .= '<tr><td>Bônus : '.$bonus . "</td>";
        $html .= '<tr><td>Débito : '.$debito . "</td>";
 $html .= '<tr><td>Saldo atual : '.$saldo . "</td>";
 

              
    
}


    
    $html .= '</tbody>';
    $html .= '</table';
  


 
    //referenciar o DomPDF com namespace
    use Dompdf\Dompdf;

    // include autoloader
    require_once("dompdf/autoload.inc.php");

    //Criando a Instancia
    $dompdf = new DOMPDF();
      date_default_timezone_set('America/Bahia');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
    $dataLocal = date('d/m/Y H:i:s', time());
    // Carrega seu HTML
    $dompdf->load_html(
         
            '<h3 style="text-align: left;">Club Legrano</h3>
            '. $html .'<footer>         
        <br>
            <h4 style="text-align: left;">Não é válido como documento fiscal
         </h4>  </footer>'

         );

    //Renderizar o html
    ob_clean(); 
    $dompdf->render();

    //Exibibir a página
    $dompdf->stream(
        
        "relatorio_individual_".$hora.".pdf", 
        array(
            "Attachment" => false //Para realizar o download somente alterar para true
        )
    );

