<?php   

    include("../conecta.php");

mysqli_set_charset( $conn, 'utf8');

     $html = '<table';

    $html = '<table  border="1"';  
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>Nome do sócio titular</th>';
    $html .= '<th>Nome do dependente</th>';
      

    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    
   
$sql = "SELECT c.id_cliente,co.id_comprador,co.nome_comprador,nome_cliente from cliente c inner join comprador co on c.id_cliente = co.id_cliente order by c.nome_cliente,co.nome_comprador";
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) { 

        $html .= '<tr>
        <td>'.$row['nome_cliente'] . "</td>";
        $html .= '<td>'.$row['nome_comprador'] . "</td>";
       
       
    
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
         
            '<h2 style="text-align: center;">Legrano - Registro de compradores autorizados</h2>
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
        "relatorio_dep.pdf", 
        array(
            "Attachment" => false //Para realizar o download somente alterar para true
        )
    );

