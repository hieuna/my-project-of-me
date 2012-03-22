<?php 
// no direct access
/** Mod ty gia thoi tiet cho website joomlaa
*** Cai dat don gian de hieu
*** Version 1.080911.654
*** Viet boi Le Duy. Website kiethuc.vn2up.com
*** Support duyle.2oco@gmail.com hoac tham khao tai website kienthuc.vn2up.com
**/
defined('_JEXEC') or die('Restricted access'); ?>
<script>
function $(url,id,eval_str){
    if(document.getElementById){var x=(window.ActiveXObject)?new ActiveXObject("Microsoft.XMLHTTP"):new XMLHttpRequest();}
    if(x){x.onreadystatechange=function() {
        el=document.getElementById(id);
        el.innerHTML='loading....';
        if(x.readyState==4&&x.status==200){
            el.innerHTML='';
            el=document.getElementById(id);
            el.innerHTML=x.responseText;
            eval(eval_str);
            }
        }
    x.open("GET",url,true);x.send(null);
    }
}
function change(id){
    $('../modules/mod_gold/tmpl/weather.php?id='+id,'noidung');
}
</script>
<div class="box_grw">
    <div class="box_grwbg_horizontal">
        <div class="box_weather">
        	<div class="box_weather_text" id="noidung">
            </div>
            <div class="box_weather_ddb">
            	<form name="form1"  method="post" action="">
                	<select id="thoitiet" name="thoitiet" onChange="change(this.value);">
                    	<option value="0">TP HCM</option>
                        <option value="1">Son la</option>
                        <option value="2">Hai phong</option>
                        <option value="3">Ha noi</option>
                        <option value="4">Vinh</option> 
                        <option value="5">Da nang</option>
                        <option value="6">Nhan trang</option>
                        <option value="7">Pleiku</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="box_gr_horizontal">
            <div class="box_goldrate_horizontal">
            	<div class="title">
                	<div class="goldicon">
                    </div>
                    <span>Giá vàng 999.9</span>
                </div>
                <div class="unit">
                	<div class="unit_bold">ĐVT: tr.vnđ/ lượng</div>
                </div>
                <table class="tbl_allBox" cellpadding="2px" cellspacing="1px" border="0">
                  <tr>
                    <td class="td_allBox" width="30%">Loại</td>
                    <td class="td_allBox" width="35%">Mua</td>
                    <td class="td_allBox" width="35%">Bán</td>
                  </tr>
                  <tr>
                    <td class="td_allBox" width="30%">SBJ</td>
                    <td class="td_allBox" width="35%"><script language="javascript">document.write(vGoldSbjBuy);</script></td>
                    <td class="td_allBox" width="35%"><script language="javascript">document.write(vGoldSbjSell);</script></td>
                  </tr>
                  <tr>
                    <td class="td_allBox">SJC</td>
                    <td class="td_allBox" width="35%"><script language="javascript">document.write(vGoldSjcBuy);</script></td>
                    <td class="td_allBox" width="35%"><script language="javascript">document.write(vGoldSjcSell);</script></td>
                  </tr>
                </table>
            </div>
    	</div>
        <div class="box_gr_horizontal">
        	<div class="box_goldrate_horizontal">
            	<div class="title">
                	<div class="priceicon">
                    </div>
                    <span>Tỷ giá</span>
                </div>
                <div class="unit">
					<div class="unit_bold">ĐVT: ngàn.vnđ/ ngoại tệ</div>
               </div>
                <div class="box_rate_slide">
                    <table class="tbl_allBox" cellpadding="2px" cellspacing="1px" border="0">
                      <tr>
                        <td class="td_allBox" width="40%">Loại</td>
                        <td class="td_allBox" width="60%">Giá</td>
                      </tr>
                      <tr>
                        <td class="td_allBox" width="30%">USD</td>
                        <td class="td_allBox" width="35%"><script language="javascript">document.write(vCosts[0]);</script></td>
                      </tr>
                      <tr>
                        <td class="td_allBox" width="30%">GBP</td>
                        <td class="td_allBox" width="35%"><script language="javascript">document.write(vCosts[1]);</script></td>
                      </tr>
                      <tr>
                        <td class="td_allBox" width="30%">HKD</td>
                        <td class="td_allBox" width="35%"><script language="javascript">document.write(vCosts[2]);</script></td>
                      </tr>
                      <tr>
                        <td class="td_allBox" width="30%">CHF</td>
                        <td class="td_allBox" width="35%"><script language="javascript">document.write(vCosts[3]);</script></td>
                      </tr>
                      <tr>
                        <td class="td_allBox" width="30%">JPY</td>
                        <td class="td_allBox" width="35%"><script language="javascript">document.write(vCosts[4]);</script></td>
                      </tr>
                      <tr>
                        <td class="td_allBox" width="30%">AUD</td>
                        <td class="td_allBox" width="35%"><script language="javascript">document.write(vCosts[5]);</script></td>
                      </tr>
                      <tr>
                        <td class="td_allBox" width="30%">CAD</td>
                        <td class="td_allBox" width="35%"><script language="javascript">document.write(vCosts[6]);</script></td>
                      </tr>
                      <tr>
                        <td class="td_allBox" width="30%">SGD</td>
                        <td class="td_allBox" width="35%"><script language="javascript">document.write(vCosts[7]);</script></td>
                      </tr>
                      <tr>
                        <td class="td_allBox" width="30%">EUR</td>
                        <td class="td_allBox" width="35%"><script language="javascript">document.write(vCosts[8]);</script></td>
                      </tr>
                      <tr>
                        <td class="td_allBox" width="30%">NZD</td>
                        <td class="td_allBox" width="35%"><script language="javascript">document.write(vCosts[9]);</script></td>
                      </tr>
                      <tr>
                        <td class="td_allBox" width="30%">Bat Thai</td>
                        <td class="td_allBox" width="35%"><script language="javascript">document.write(vCosts[10]);</script></td>
                      </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>