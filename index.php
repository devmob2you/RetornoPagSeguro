<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Retorno PagSeguro</title>
</head>

<body>
	<form id="form1" name="form1" method="post" action="http://localhost:9090/checkout/checkout.jhtml">
		<input type="hidden" name="email_cobranca" value="relojoaria@relojoariasaopaulo.com.br" />
		<input type="hidden" name="cliente_nome" value="Marcelo Torres" />
		<input type="hidden" name="cliente_end" value="Rua dos tra la las" />
		<input type="hidden" name="cliente_num" value="80" />
		<input type="hidden" name="cliente_compl" value="Complemento" />
		<input type="hidden" name="cliente_cidade" value="Ilhabela" />
		<input type="hidden" name="cliente_bairro" value="Praia Grande" />
		<input type="hidden" name="cliente_cep" value="11630000" />
		<input type="hidden" name="cliente_uf" value="SP" />
		<input type="hidden" name="cliente_ddd" value="12" />
		<input type="hidden" name="cliente_tel" value="00009999" />
		<input type="hidden" name="cliente_email" value="cliente@gmail.com" />
		<input name="item_id_1" type="hidden" id="item_id_1" value="1" />
		<input name="item_descr_1" type="hidden" id="item_descr_1" value="Descricao do Produto" />
		<input name="item_quant_1" type="hidden" id="item_quant_1" value="1" />
		<input name="item_valor_1" type="hidden" id="item_valor_1" value="050" />
		<input name="item_frete_1" type="hidden" id="item_frete_1" value="0" />
		<input name="item_peso_1" type="hidden" id="item_peso_1" value="10" />
		<input name="item_id_2" type="hidden" id="item_id_2" value="2" />
		<input name="item_descr_2" type="hidden" id="item_descr_2" value="Descricao do Produto 2" />
		<input name="item_quant_2" type="hidden" id="item_quant_2" value="5" />
		<input name="item_valor_2" type="hidden" id="item_valor_2" value="1050" />
		<input name="item_frete_2" type="hidden" id="item_frete_2" value="0" />
		<input name="item_peso_2" type="hidden" id="item_peso_2" value="100" />
		<input name="ref_transacao" type="hidden" id="ref_transacao" value="123" />
		<input type="hidden" name="tipo_frete" value="EN" />
		<input type="hidden" name="cliente_pais" value="BRA" />
		<input type="hidden" name="tipo" value="CP" />
		<input type="hidden" name="moeda" value="BRL" />
		<input name="button" type="submit" id="button" value="Realizar o Pagamento" />
	</form>
</body>
</html>