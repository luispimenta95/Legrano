<?php   

    include("../conecta.php");

mysqli_set_charset( $conn, 'utf8');

     $html = '<table';

    $html = '<table  border="1"';  
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>Nome do sócio</th>';
 $html .= '<th>Endereço</th>';
    $html .= '<th>Telefone</th>';
    $html .= '<th>Data de aniversário</th>';
    $html .= '<th>Data de associação</th>';
    $html .= '<th>Saldo</th>';
    $html .= '<th>Situação</th>';
      

    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    
   
$sql = "SELECT id_cliente,entrada,nascimento, nome_cliente,endereco_cliente,ativo,telefone_cliente, saldo_cliente,cpf_cliente,email_cliente,senha_cliente FROM cliente a  order by ativo desc,nome_cliente";
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) { 

        $html .= '<tr><td>'.$row['nome_cliente'] . "</td>";
        $html .= '<td>'.$row['endereco_cliente'] . "</td>";
        $html .= '<td>'.$row['telefone_cliente'] . "</td>";
      $html .= '<td>'.date('d/m/Y', strtotime($row["nascimento"])) . "</td>";
       
        $html .= '<td>'.date('d/m/Y', strtotime($row["entrada"])) . "</td>";
       
      
        $html .= '<td>'.$row['saldo_cliente'] . "</td>";
        
        if($row["ativo"]==1){
            $html .= '<td>'.Ativo . "</td>";
      

        
       }
        
        else {
$html .= '<td>'.Inativo . "</td>";
            
         

        }
    
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
         
            '<h2 style="text-align: center;">Legrano - Registro de cadastro de sócios</h2>
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
        "relatorio_clientes.pdf", 
        array(
            "Attachment" => false //Para realizar o download somente alterar para true
        )
    );
