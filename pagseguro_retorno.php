<?php
##############################################################
#                         CONFIGURAÇÕES
##############################################################

$retorno_token = '68CDCC8D7189467AA90AA10F19EE9A0C'; // Token gerado pelo PagSeguro

$retorno_host = 'localhost'; // Local da base de dados MySql
$retorno_database = 'pagseguro'; // Nome da base de dados MySql
$retorno_usuario = 'root'; // Usuario com acesso a base de dados MySql
$retorno_senha = '';  // Senha de acesso a base de dados MySql


###############################################################
#              NÃO ALTERE DESTA LINHA PARA BAIXO
################################################################

$lnk = mysql_connect($retorno_host, $retorno_usuario, $retorno_senha) or die ('Nao foi possível conectar ao MySql: ' . mysql_error());
mysql_select_db($retorno_database, $lnk) or die ('Nao foi possível ao banco de dados selecionado no MySql: ' . mysql_error());	

// Validando dados no PagSeguro

$PagSeguro = 'Comando=validar';
$PagSeguro .= '&Token=' . $retorno_token; 
$Cabecalho = "Retorno PagSeguro";

foreach ($_POST as $key => $value)
{
 $value = urlencode(stripslashes($value));
 $PagSeguro .= "&$key=$value";
}

if (function_exists('curl_exec'))
{
 $curl = true;
}
elseif ( (PHP_VERSION >= 4.3) && ($fp = @fsockopen ('ssl://pagseguro.uol.com.br', 443, $errno, $errstr, 30)) )
{
 $fsocket = true;
}
elseif ($fp = @fsockopen('pagseguro.uol.com.br', 80, $errno, $errstr, 30))
{
 $fsocket = true;
}

if ($curl == true)
{
 $ch = curl_init();

 curl_setopt($ch, CURLOPT_URL, 'http://localhost:9090/pagseguro-ws/checkout/NPI.jhtml');
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $PagSeguro);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HEADER, false);
 curl_setopt($ch, CURLOPT_TIMEOUT, 30);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  curl_setopt($ch, CURLOPT_URL, 'http://localhost:9090/pagseguro-ws/checkout/NPI.jhtml');
  $resp = curl_exec($ch);

 curl_close($ch);
 $confirma = (strcmp ($resp, "VERIFICADO") == 0);
}
elseif ($fsocket == true)
{
 $Cabecalho  = "POST /Security/NPI/Default.aspx HTTP/1.0\r\n";
 $Cabecalho .= "Content-Type: application/x-www-form-urlencoded\r\n";
 $Cabecalho .= "Content-Length: " . strlen($PagSeguro) . "\r\n\r\n";

 if ($fp || $errno>0)
 {
    fputs ($fp, $Cabecalho . $PagSeguro);
    $confirma = false;
    $resp = '';
    while (!feof($fp))
    {
       $res = @fgets ($fp, 1024);
       $resp .= $res;
       if (strcmp ($res, "VERIFICADO") == 0)
       {
          $confirma=true;
          break;
       }
    }
    fclose ($fp);
 }
 else
 {
    echo "$errstr ($errno)<br />\n";
 }
}


if ($confirma) {
echo "deu certo";
 // Recebendo Dados
 $TransacaoID = $_POST['TransacaoID'];
 $VendedorEmail  = $_POST['VendedorEmail'];
 $Referencia = $_POST['Referencia'];
 $TipoFrete = $_POST['TipoFrete'];
 $ValorFrete = $_POST['ValorFrete'];
 $Extras = $_POST['Extras'];
 $Anotacao = $_POST['Anotacao'];
 $TipoPagamento = $_POST['TipoPagamento'];
 $StatusTransacao = $_POST['StatusTransacao'];
 $CliNome = $_POST['CliNome'];
 $CliEmail = $_POST['CliEmail'];
 $CliEndereco = $_POST['CliEndereco'];
 $CliNumero = $_POST['CliNumero'];
 $CliComplemento = $_POST['CliComplemento'];
 $CliBairro = $_POST['CliBairro'];
 $CliCidade = $_POST['CliCidade'];
 $CliEstado = $_POST['CliEstado'];
 $CliCEP = $_POST['CliCEP'];
 $CliTelefone = $_POST['CliTelefone'];
 $NumItens = $_POST['NumItens'];
 
 	if (isset($_POST)) {
	  $f=fopen ('pagseguro.log', 'a'); # o "a" é para ele "appendar" o conteúdo, ou seja, colocar ao final
	  fwrite($f, "'Recebeu o post, verificando junto ao PagSeguro'\n"); # escrevendo a mensagem, mais uma quebra de linha
	  fwrite($f, var_export( $_POST, true)); # imprime os dados no arquivo de log
	  fwrite($f, "\n---------\n\n"); # um espaço para separar as ocorrencias
	  fclose($f);  
	}
	function retorno_automatico (
	$VendedorEmail, $TransacaoID, $Referencia, $TipoFrete,
	$ValorFrete, $Anotacao, $DataTransacao, $TipoPagamento,
	$StatusTransacao, $CliNome, $CliEmail, $CliEndereco,
	$CliNumero, $CliComplemento, $CliBairro, $CliCidade,
	$CliEstado, $CliCEP, $CliTelefone, $NumItens
	) {
	  $f=fopen ('pagseguro.log', 'a'); # o "a" é para ele "appendar" o conteúdo, ou seja, colocar ao final
	  fwrite($f, "'Dados Verificados! Agora minha função funciona normalmente.'\n"); # escrevendo a mensagem, mais uma quebra de linha
	  fwrite($f, var_export(array ($VendedorEmail, $TransacaoID, $Referencia, $TipoFrete,
			$ValorFrete, $Anotacao, $DataTransacao, $TipoPagamento,
			$StatusTransacao, $CliNome, $CliEmail, $CliEndereco,
			$CliNumero, $CliComplemento, $CliBairro, $CliCidade,
			$CliEstado, $CliCEP, $CliTelefone, $NumItens
	  ), true)); # imprime os dados no arquivo de log
	  fwrite($f, "\n---------\n\n"); # um espaço para separar as ocorrencias
	  fclose($f);  
	}
 
 // Gravando Dados
mysql_query("INSERT into PagSeguroTransacoes SET
	TransacaoID='$TransacaoID',	
	VendedorEmail='$VendedorEmail',	
	Referencia='$Referencia',	
	TipoFrete='$TipoFrete',	
	ValorFrete='$ValorFrete',	
	Extras='$Extras',	
	Anotacao='$Anotacao',	
	TipoPagamento='$TipoPagamento',	
	StatusTransacao='$StatusTransacao',	
	CliNome='$CliNome',	
	CliEmail='$CliEmail',	
	CliEndereco='$CliEndereco',	
	CliNumero='$CliNumero',	
	CliComplemento='$CliComplemento',	
	CliBairro='$CliBairro',	
	CliCidade='$CliCidade',	
	CliEstado='$CliEstado',	
	CliCEP='$CliCEP',	
	CliTelefone='$CliTelefone',	
	NumItens='$NumItens',	
	Data=now();");

}
else
{
echo "n deu certo";
}
?>