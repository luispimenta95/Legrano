<?php   
$id_cliente = $_GET['id_cliente'];



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
     $html .= '<th>Forma de pagamento</th>';

    $html .= '<th>Data</th>';
      

    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    
   
$sql = "SELECT nome_administrador,nome_cliente,nome_movimentacao,saldo_cliente,data,credito,debito,bonus,nome_forma FROM log_financeiro l INNER JOIN administrador a on l.id_administrador = a.id_administrador INNER JOIN tipo_movimentacao m on l.id_movimentacao = m.id_movimentacao INNER JOIN cliente c on l.id_cliente = c.id_cliente inner join forma_pagamento f on f.id_forma = l.id_forma WHERE l.id_movimentacao >7 and l.id_cliente=$id_cliente order by l.id_log desc";
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) { 

        $html .= '<tr><td>'.$row['nome_administrador'] . "</td>";
        $html .= '<td>'.$row['nome_cliente'] . "</td>";
        $html .= '<td>'.$row['nome_movimentacao'] . "</td>";
      $html .= '<td>'.$row['credito'] . "</td>";
        $html .= '<td>'.$row['bonus'] . "</td>";
        $html .= '<td>'.$row['debito'] . "</td>";
         $html .= '<td>'.$row['nome_forma'] . "</td>";

       
        $html .= '<td>'.date('d/m/Y', strtotime($row["data"])) . "</td>";
       
    
}

$sql2 = "SELECT saldo_cliente AS soma FROM cliente c WHERE c.id_cliente = $id_cliente ";

    $result=$conn->query($sql2);
    $row1 = $result->fetch_assoc();
    
            $total = number_format($row1["soma"], 2, '.', '');

    $html .= '<tr>';

    $html .= '<td colspan="8"> Saldo atual : '.$total . "</td>";
    $html .= '</tr>';    
    
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
         
            '<h3 style="text-align: center;">Legrano - Registro de movimentação financeira individual</h3>
            '. $html .'<footer>         
        <br>
            <h4 style="text-align: right;">Relatório  gerado em : '.$dataLocal.'
         </h4>  </footer>'

         );

    //Renderizar o html
    ob_clean(); 
    $dompdf->render();

    //Exibibir a página
    $dompdf->stream(
        "relatorio_individual.pdf", 
        array(
            "Attachment" => false //Para realizar o download somente alterar para true
        )
    );

