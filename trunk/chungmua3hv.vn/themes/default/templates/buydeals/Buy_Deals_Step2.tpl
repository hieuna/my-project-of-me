<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js" type="text/javascript"></script>
<script language="javascript" src="{$smarty.const.SITE_URL}lib/datepicker/js/prototype-1.6.0.2.js"></script>
<script language="javascript" src="{$smarty.const.SITE_URL}lib/datepicker/js/prototype-base-extensions.js"></script>
<script language="javascript" src="{$smarty.const.SITE_URL}lib/datepicker/js/prototype-date-extensions.js"></script>
<script language="javascript" src="{$smarty.const.SITE_URL}lib/datepicker/js/datepicker.js"></script>
<link rel="stylesheet" href="{$smarty.const.SITE_URL}lib/datepicker/css/datepicker.css"></script>
<link rel="stylesheet" type="text/css" href="{$smarty.const.SITE_URL}themes/default/site.css" media="screen" />
{literal}
<script>
$(document).ready(function(){
$("#bodyhtml").fadeIn('200');
});
</script>
{/literal}
<title>Buy deals</title>
</head>

<body><div id="bodyhtml">
    <div class="modal_box">
<h2>Buy deals</h2>
<form method="post">
<input type="hidden" name="ac" value="{$smarty.get.action|default:'ad'}" />
<input type="hidden" name="txtDealsDealsID" value="{$smarty.get.DealsID}" />
<ul class="deals_form">
<li><label>Your Email:</label><input type="text" class="form_text" value="{$guest_reg.Shopping_Email}" name="txtDealsEmail" /></li>
<li><label>Your Name:</label><input type="text" class="form_text" value="{$guest_reg.Shopping_Name}" name="txtDealsName" /></li>
<li><label>Date use:</label><input type="text" id="txtDealsDate" value="{$guest_reg.Shopping_Create}" name="txtDealsDate" style="width:235px;" class="form_text" /></li>
<li><label>Number of deals:</label><select class="form_select" id="txtDealsQuantity" name="txtDealsQuantity">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select></li>
<li><label>Messege:</label><textarea class="form_area" style="width:255px; height:60px;" name="txtDealsMessege">{$guest_reg.Shopping_Messege}</textarea></li>
<li><input type="submit" style=" margin:5px 20px 0 10px" class="form_button" value="Next step" /><input type="button" onclick="history.go(-1)" class="form_button" value="Back" /></li>
</ul>
</form></div>
{literal}
            <script language="javascript">
                new Control.DatePicker('txtDealsDate', { icon: '{/literal}{$smarty.const.SITE_URL}{literal}lib/datepicker/images/calendar.png',dateFormat:'d/M/y' });
            </script>
{/literal}
</body>
</html>
