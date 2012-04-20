{literal}
<script language="javascript">
$(document).ready(function(){
$("#bodyhtml").fadeIn('200');
});

</script>
{/literal}
{literal}<script>
<!--//
function get_shopping() {

    var p = {}; 
		p['DealsID'] = $('#dealid').val();
		p['name'] = $('#dealname').val();
		p['email'] = $('#dealemail').val();
		p['quantity'] = $('#txtDealsQuantity').val();
		p['dealarea'] = $('#dealarea').val();
		p['day'] = $('#StartDateidDay').val();
		p['month'] = $('#StartDateidMonth').val();
		p['year'] = $('#StartDateidYear').val();
		p['ac'] = $('#ac').val();
    $('#step2').load('{/literal}{$smarty.const.SITE_URL}{literal}index.php/?mod=buydeals&task=step2&ajax=true',p);
}
//-->

</script>{/literal}

<div id="bodyhtml">
    <div class="modal_box" id="step2">
    <h2>{#buyDeals#}</h2>
    <form method="post" action="{$smarty.const.SITE_URL}buydeals">
    <table border="0">
    <input type="hidden" name="DealsID" id="dealid" value="{$smarty.get.DealsID}" />
    <input type="hidden" name="ac" id="ac" value="{$smarty.get.action|default:'ad'}" />
    <tr>
    	<td width="200" style="color:#000;">{#fullName#}</td>
        <td><input class="frmEditInput" name="txtDealsName" id="dealname" type="text" value="{$guest_reg.Shopping_Name}"></td>
     </tr>
    <tr>
    	<td width="200" style="color:#000;">Email</td>
        <td><input class="frmEditInput"  name="txtDealsEmail" id="dealemail" type="text" value="{$guest_reg.Shopping_Email}"></td>
     </tr>
    <tr>
    	<td width="200" style="color:#000;">{#pnumber#}</td>
        <td><input  class="frmEditInput"  type="text" value=""></td>
     </tr>
    <tr>
    	<td width="200" style="color:#000;">{#citytp#}</td>
        <td><input  class="frmEditInput"  type="text" value=""></td>
     </tr>
    <tr>
    	<td width="200" style="color:#000;">{#buyAddress#}</td>
        <td><input  class="frmEditInput"  type="text" value=""></td>
     </tr>
    <tr>
    	<td width="200" style="color:#000;">{#dateUse#}</td>
        <td>{html_select_date prefix='StartDate' time=$time start_year='-5'
   end_year='+1'}</td>
     </tr>
    <tr>
    	<td width="200" style="color:#000;">{#buyqty#}</td>
        <td><select class="form_select" id="txtDealsQuantity" style="width:50px;" name="txtDealsQuantity">
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
</select></td>
     </tr>
    <tr>
    	<td width="200" style="color:#000;">{#messbuyDeal#}</td>
        <td><textarea  class="frmEditInput" id="dealarea" name="txtDealsMessege"></textarea></td>
     </tr>
     <tr><td></td><td><input type="button"  onclick="return get_shopping();" style=" margin:5px 5px 0 10px"  class="form_button" value="{#nextStep#}"><input class="form_button" type="button" onclick="return closeForm();" value="{#closePop#}"></td></tr>
    </table>
    </form>
    </div>
</div>
