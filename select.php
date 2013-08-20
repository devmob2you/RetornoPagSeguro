<?php
	$retorno_host = 'localhost'; // Local da base de dados MySql
	$retorno_database = 'pagseguro'; // Nome da base de dados MySql
	$retorno_usuario = 'root'; // Usuario com acesso a base de dados MySql
	$retorno_senha = '';  // Senha de acesso a base de dados MySql
	
	$lnk = mysql_connect($retorno_host, $retorno_usuario, $retorno_senha) or die ('Nao foi possível conectar ao MySql: ' . mysql_error());
	mysql_select_db($retorno_database, $lnk) or die ('Nao foi possível ao banco de dados selecionado no MySql: ' . mysql_error());	
	
	$result = mysql_query("SELECT * FROM PagSeguroTransacoes");

	while($row = mysql_fetch_array($result))
	{
	echo $row['TransacaoID'] . " " . $row['StatusTransacao'] . " " . $row['Data'];
	echo "<br />";
	}
	mysql_close($lnk);
?>