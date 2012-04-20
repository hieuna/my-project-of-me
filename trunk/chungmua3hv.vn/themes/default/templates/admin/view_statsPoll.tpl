<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
{literal}
<style type="text/css">
	html,body{
		font-family:Arial, Helvetica, sans-serif;
		font-size:12px;
		background:url(/images/donganh_images/background/bg-pollstats.jpg) top repeat-x;
		overflow:hidden;
	}
</style>
{/literal}
<body>
<center>
	<div style=" font-size:13px; text-transform:uppercase; font-weight:bold; margin-top:10px; color:#006600" align="center">{#poll_title#}</div><br /><br />
	<div style="width:550px; text-align:left; height:20px;">{#total_vote#} : {$pollQuestion.total_poll|default:0}</div>
	<table width="550" border="1" bordercolor="#666666" style=" border-collapse:collapse;text-align:left; font-size:11px;">
	  <tr>
		<td colspan="2" align="left" style="background-color:#0066FF; color:#FFFFFF; padding:5px;"><b>{$pollQuestion.Poll_Question}</b></td>    
	  </tr>
		{foreach from = $pollAnswer item=answer}
		<tr>
			<td style="padding:5px;">{$answer.Vote_Answer}</td>		
			<td width="400" style="padding:5px;"><span style=" float:left; margin-right:5px;width:{$answer.width+2}px; background-color:#6699FF; border:1px solid #333333">&nbsp;</span><span style="color:#FF0000">{$answer.percent|default:0}% ({$answer.Vote_Number|default:0} {#vote#})</span></td>
		</tr>
		 {/foreach}
	</table><br />
	<a href="#" onclick="window.close(); return false;" style="color:#003399;">{#close_window#}</a>
	<div style="clear:both"></div>
</center>
</body>
</html>

