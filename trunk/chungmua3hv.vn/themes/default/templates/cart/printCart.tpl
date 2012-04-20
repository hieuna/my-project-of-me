<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verify-v1" content="+8LX/nqxE+1iH51ahRgNQdlvQoAFM+AvzmqFQf5nuUE=" >
<title>{#print_cart#}</title>
<script type="text/javascript" src="{$smarty.const.SITE_URL}lib/jquery/jquery.js"></script>
</head>
<body>
<center>
	<div style="font-size:25px; margin-bottom:30px;"><b>{#head_bill#}</b></div>
	<table width="100%" cellpadding="10" cellspacing="5" border="0">
		<tr>
			<td width="40%" align="left"><b>{#personal_infor#}</b><br><br>
			<div style="padding-left:15px;">
				{#name#}: .............................................................................<br>
				{#address#}: ........................................................................<br>
				{#phone#}: ..................................................................<br>
			</div>
			</td>
			<td align="left" valign="top"><b>{#company_infor#}</b><br><br>
				<div style="padding-left:15px;">
					{#company_name#}: ..........................................................................<br>
					{#company_address#}: .......................................................................<br>
					{#company_phone#}: ..............................................................<br>
				</div>
			</td>
		</tr>
	</table>	
	<br>
	 <table width="100%" cellpadding="3" cellspacing="1" border="1" bordercolor="#18486E" style="border-collapse:collapse;">
	   <tr align="center">
	   		<th>{#code#}</th>
	   		<th>{#size#}</th>					   	
		   	<th>{#quantity#}</th>
	   		<th>{#price#}</th>						
			<th>{#money#}</th>						
	   </tr>
	   
	   {foreach item=item from=$result}				   
	   <tr>
	   		<td width="10%" align="center">{$item.Product_Code}</td>
	   		<td width="10%" align="center">{$item.Product_Size}</td>
		   	<td width="10%" align="center" valign="middle">{$item.quantity}</td>
	   		<td width="20%" align="center" valign="middle">
		   		{$item.Product_Price|number_format:0:".":"."} {#currency#}
		   	</td>					   	
		   	<td width="20%" align="center">{$item.subtotal|number_format:0:".":"."} {#currency#}&nbsp;&nbsp;</td>
		   </td>
	   </tr>				   
	   {/foreach}		   				   
	   {if $result}
	   	<tr>
		   <td colspan="4" align="right" style="font-weight:bold; text-transform:uppercase">{#total_money#}</td>
		   <td>{$total|number_format:0:".":"."} {#currency#}</td>				   
	   </tr>
	   {/if}
	 </table>
	 <br>
	 <div style="margin:0 100px;" align="right"><i>{#footer_bill#} {#date#} {$datetime.date} {#month#} {$datetime.month} {#year#} {$datetime.year}</i></div>
	 <br>
	 <div align="right" style="margin:0px 160px;"><b>{#signature_customer#}</b></div>
</center>
</body>
</html>
{literal}
<script type="text/javascript">
	$("document").ready(function(){		
		window.print();
	});
</script>

{/literal}