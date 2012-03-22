<?php 
// no direct access
/** Mod ty gia thoi tiet cho website joomlaa
*** Cai dat don gian de hieu
*** Version 1.190911.444
*** Viet boi Le Duy. Website kiethuc.vn2up.com
*** Support duyle.2oco@gmail.com hoac tham khao tai website kienthuc.vn2up.com
**/
defined('_JEXEC') or die('Restricted access'); ?>
<?php if($showGrw){?>
<div class="box_grw">
    <div class="box_grwbg">
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
        <div class="box_gr">
            <div class="box_gold">
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
            <div class="Hgold"></div>
            <div class="box_rate">
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
<?php } ?>
<!-- Chứng khoán -->
<?php if($showSec){?>
<div class="security">
	<ul class="tabs_vnchoice">
		<li><a href="#tab_HOSE">HOSE</a></li>  
        <li><a href="#tab_HNX">HNX</a></li> 
        <div class="box_vnchoice">
        	<div class="box_vnchoice_code">Mã CK
            </div>
            <div class="box_vnchoice_price">GTC
            </div>
            <div class="box_vnchoice_pmatched">
            	<div class="box_vnchoice_match">Khớp lệnh
                </div>
                <div class="box_vnchoice_pmatch">Giá
                </div>
                <div class="box_vnchoice_matched">KL
                </div>
            </div>
            <div class="box_vnchoice_rate">+/-
            </div>
        </div>
        <ul class="tabs_vncontent" id="tab_HOSE">
        	<iframe src="http://vnexpress.net/User/ck/hcms/HCMStockSmall.asp" noresize="" border="false" width="100%" frameborder="0" height="190px" scrolling="no"></iframe>
    	</ul>
        <ul class="tabs_vncontent" id="tab_HNX">
        	<iframe src="http://vnexpress.net/User/ck/hns/HNStockSmall.asp" noresize="" border="false" width="100%" frameborder="0" height="191px" scrolling="no"></iframe>
    	</ul>
	</ul>         
</div>
<?php } ?>